<?php

declare(strict_types=1);

$outDir = dirname(__DIR__) . '/src/Objects';

function camel(string $snake): string {
    return lcfirst(str_replace('_', '', ucwords($snake, '_')));
}

function fieldTitle(string $snake): string {
    return ucwords(str_replace('_', ' ', $snake));
}

function phpPropType(string $type): string {
    return match (true) {
        $type === 'richtext', $type === 'richtext?' => 'mixed',
        str_ends_with($type, '[]') => '?array',
        $type === 'int', $type === 'int?' => '?int',
        $type === 'bool', $type === 'bool?' => '?bool',
        $type === 'string', $type === 'string?' => '?string',
        str_ends_with($type, '?') => '?' . substr($type, 0, -1),
        default => '?' . $type,
    };
}

function varType(string $type): string {
    return match (true) {
        $type === 'richtext', $type === 'richtext?' => 'RichText|string|array|null',
        str_ends_with($type, '[][]') => str_replace('[][]', '[][]|null', $type),
        str_ends_with($type, '[]') => rtrim($type, '?') . '|null',
        str_ends_with($type, '?') => substr($type, 0, -1) . '|null',
        $type === 'int' => 'int|null',
        $type === 'bool' => 'bool|null',
        $type === 'string' => 'string|null',
        default => $type . '|null',
    };
}

function objectType(string $type): string {
    $t = str_ends_with($type, '?') ? substr($type, 0, -1) : $type;
    return preg_replace('/\[\]+$/', '', $t) ?? $t;
}

function isScalarType(string $type): bool {
    return in_array(objectType($type), ['int', 'bool', 'string', 'float'], true);
}

function getterType(string $type): string {
    return match (true) {
        $type === 'richtext', $type === 'richtext?' => 'mixed',
        str_ends_with($type, '[]') => '?array',
        default => '?' . ltrim(phpPropType(rtrim($type, '?')), '?'),
    };
}

function fromArrayBody(string $snake, string $type): string {
    $key = $snake;
    $prop = camel($snake);
    return match (true) {
        $type === 'richtext', $type === 'richtext?' => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = RichText::fromMixed(\$data['{$key}']);\n        }",
        str_ends_with($type, '[]') && str_starts_with($type, 'InputRichBlock[]') => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = array_map(fn(array \$item) => InputRichBlock::fromArray(\$item), \$data['{$key}']);\n        }",
        str_ends_with($type, '[]') && str_starts_with($type, 'InputRichBlockListItem[]') => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = InputRichBlockListItem::arrayOf(\$data['{$key}']);\n        }",
        str_ends_with($type, '[]') && str_starts_with($type, 'InputRichMessageMedia[]') => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = InputRichMessageMedia::arrayOf(\$data['{$key}']);\n        }",
        $type === 'RichBlockTableCell[][]' => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = array_map(fn(array \$row) => RichBlockTableCell::arrayOf(\$row), \$data['{$key}']);\n        }",
        isScalarType($type) => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = \$data['{$key}'];\n        }",
        default => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = " . objectType($type) . "::fromArray(\$data['{$key}']);\n        }",
    };
}

function propDoc(string $snake, string $type, string $description): string {
    $title = fieldTitle($snake);
    $var = varType($type);
    // Normalize curly quotes / backticks from docs
    $description = str_replace(['`', "\u{201c}", "\u{201d}"], ['', '"', '"'], $description);
    return <<<PHP
    /**
     * {$title}
     *
     * {$description}
     * @var {$var}
     */

PHP;
}

function buildClass(
    string $className,
    string $classDescription,
    array $fields,
    string $parent,
    ?string $typeConst = null,
    bool $isFinal = true,
    ?string $anchor = null
): string {
    $final = $isFinal ? 'final ' : '';
    $link = strtolower($anchor ?? $className);
    $classDoc = "/**\n * {$classDescription}\n * @link https://core.telegram.org/bots/api#{$link}\n */\n";
    $props = '';
    $ctorParams = [];
    $ctorAssign = '';
    $fromArray = '';
    $getters = '';

    if ($typeConst !== null) {
        $typeDesc = $fields['type']['desc'] ?? "Type of the block, always \"{$typeConst}\"";
        unset($fields['type']);
        $props .= propDoc('type', 'string', $typeDesc);
        // type is non-null string with default
        $props = str_replace('@var string|null', '@var string', $props);
        $props .= "    protected string \$type = '{$typeConst}';\n\n";
        $fromArray .= "        if (isset(\$data['type'])) {\n            \$instance->type = \$data['type'];\n        }\n";
        $getters .= "\n    public function getType(): string {\n        return \$this->type;\n    }\n";
    }

    foreach ($fields as $snake => $meta) {
        $type = $meta['type'];
        $desc = $meta['desc'];
        $prop = camel($snake);
        $php = phpPropType($type);
        if ($type === 'richtext' || $type === 'richtext?') {
            $php = 'mixed';
        } elseif (str_ends_with($type, '[]')) {
            $php = '?array';
        }
        $props .= propDoc($snake, $type, $desc);
        $props .= "    protected {$php} \${$prop} = null;\n\n";
        $ctorParams[] = "{$php} \${$prop} = null";
        $ctorAssign .= "        \$this->{$prop} = \${$prop};\n";
        $fromArray .= fromArrayBody($snake, $type) . "\n";
        $gt = getterType($type);
        $getters .= "\n    public function get" . ucfirst($prop) . "(): {$gt} {\n        return \$this->{$prop};\n    }\n\n";
        $getters .= "    public function set" . ucfirst($prop) . "({$gt} \$value): self {\n        \$this->{$prop} = \$value;\n        return \$this;\n    }\n";
    }

    $hasRichText = (bool) array_filter($fields, fn($m) => str_starts_with($m['type'], 'richtext'));
    $toArrayOverride = '';
    $uses = '';
    if ($hasRichText) {
        $uses = "use Yabx\\Telegram\\Utils;\n\n";
        $toArrayOverride = <<<'PHP'

    public function toArray(): array {
        $result = [];
        foreach (array_keys(get_object_vars($this)) as $key) {
            $value = $this->$key ?? null;
            if ($value === null) {
                continue;
            }
            if (in_array($key, ['text', 'credit', 'summary', 'caption'], true)) {
                $result[Utils::toSnakeCase($key)] = RichText::toMixed($value);
                continue;
            }
            if (is_array($value)) {
                array_walk_recursive($value, function (&$item) {
                    if (is_object($item) && method_exists($item, 'toArray')) {
                        $item = $item->toArray();
                    }
                });
            } elseif (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }
            $result[Utils::toSnakeCase($key)] = $value;
        }
        return $result;
    }

PHP;
    }

    $ctor = $ctorParams === [] ? '' : implode(",\n        ", $ctorParams);

    return <<<PHP
<?php

namespace Yabx\Telegram\Objects;

{$uses}{$classDoc}{$final}class {$className} extends {$parent} {

{$props}    public function __construct(
        {$ctor}
    ) {
{$ctorAssign}    }

    public static function fromArray(array \$data): {$className} {
        \$instance = new self();
{$fromArray}        return \$instance;
    }
{$getters}{$toArrayOverride}}

PHP;
}

function blockClassName(string $type): string {
    return match ($type) {
        'pre' => 'InputRichBlockPreformatted',
        'mathematical_expression' => 'InputRichBlockMathematicalExpression',
        'heading' => 'InputRichBlockSectionHeading',
        'blockquote' => 'InputRichBlockBlockQuotation',
        'pullquote' => 'InputRichBlockPullQuotation',
        default => 'InputRichBlock' . str_replace('_', '', ucwords($type, '_')),
    };
}

$inputRichBlockTypes = [
    'paragraph' => [
        'desc' => 'A text paragraph, corresponding to the HTML tag <p>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "paragraph"'],
            'text' => ['type' => 'richtext', 'desc' => 'Text of the block'],
        ],
    ],
    'heading' => [
        'desc' => 'A section heading, corresponding to the HTML tags <h1>, <h2>, <h3>, <h4>, <h5>, or <h6>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "heading"'],
            'text' => ['type' => 'richtext', 'desc' => 'Text of the block'],
            'size' => ['type' => 'int', 'desc' => 'Relative size of the text font; 1-6, 1 is the largest, 6 is the smallest'],
        ],
    ],
    'pre' => [
        'desc' => 'A preformatted text block, corresponding to the nested HTML tags <pre> and <code>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "pre"'],
            'text' => ['type' => 'richtext', 'desc' => 'Text of the block'],
            'language' => ['type' => 'string?', 'desc' => 'Optional. The programming language of the text'],
        ],
    ],
    'footer' => [
        'desc' => 'A footer, corresponding to the HTML tag <footer>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "footer"'],
            'text' => ['type' => 'richtext', 'desc' => 'Text of the block'],
        ],
    ],
    'divider' => [
        'desc' => 'A divider, corresponding to the HTML tag <hr/>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "divider"'],
        ],
    ],
    'mathematical_expression' => [
        'desc' => 'A block with a mathematical expression in LaTeX format, corresponding to the custom HTML tag <tg-math-block>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "mathematical_expression"'],
            'expression' => ['type' => 'string', 'desc' => 'The mathematical expression in LaTeX format'],
        ],
    ],
    'anchor' => [
        'desc' => 'A block with an anchor, corresponding to the HTML tag <a> with the attribute name.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "anchor"'],
            'name' => ['type' => 'string', 'desc' => 'The name of the anchor'],
        ],
    ],
    'list' => [
        'desc' => 'A list of blocks, corresponding to the HTML tag <ul> or <ol> with multiple nested tags <li>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "list"'],
            'items' => ['type' => 'InputRichBlockListItem[]', 'desc' => 'Items of the list'],
        ],
    ],
    'blockquote' => [
        'desc' => 'A block quotation, corresponding to the HTML tag <blockquote>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "blockquote"'],
            'blocks' => ['type' => 'InputRichBlock[]', 'desc' => 'Content of the block'],
            'credit' => ['type' => 'richtext?', 'desc' => 'Optional. Credit of the block'],
        ],
    ],
    'pullquote' => [
        'desc' => 'A quotation with centered text, loosely corresponding to the HTML tag <aside>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "pullquote"'],
            'text' => ['type' => 'richtext', 'desc' => 'Text of the block'],
            'credit' => ['type' => 'richtext?', 'desc' => 'Optional. Credit of the block'],
        ],
    ],
    'collage' => [
        'desc' => 'A collage, corresponding to the custom HTML tag <tg-collage>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "collage"'],
            'blocks' => ['type' => 'InputRichBlock[]', 'desc' => 'Elements of the collage'],
            'caption' => ['type' => 'RichBlockCaption?', 'desc' => 'Optional. Caption of the block'],
        ],
    ],
    'slideshow' => [
        'desc' => 'A slideshow, corresponding to the custom HTML tag <tg-slideshow>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "slideshow"'],
            'blocks' => ['type' => 'InputRichBlock[]', 'desc' => 'Elements of the slideshow'],
            'caption' => ['type' => 'RichBlockCaption?', 'desc' => 'Optional. Caption of the block'],
        ],
    ],
    'table' => [
        'desc' => 'A table, corresponding to the HTML tag <table>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "table"'],
            'cells' => ['type' => 'RichBlockTableCell[][]', 'desc' => 'Cells of the table'],
            'is_bordered' => ['type' => 'bool?', 'desc' => 'Optional. Pass True if the table has borders'],
            'is_striped' => ['type' => 'bool?', 'desc' => 'Optional. Pass True if the table is striped'],
            'caption' => ['type' => 'richtext?', 'desc' => 'Optional. Caption of the table'],
        ],
    ],
    'details' => [
        'desc' => 'An expandable block for details disclosure, corresponding to the HTML tag <details>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "details"'],
            'summary' => ['type' => 'richtext', 'desc' => 'Always shown summary of the block'],
            'blocks' => ['type' => 'InputRichBlock[]', 'desc' => 'Content of the block'],
            'is_open' => ['type' => 'bool?', 'desc' => 'Optional. Pass True if the content of the block is visible by default'],
        ],
    ],
    'map' => [
        'desc' => 'A block with a map, corresponding to the custom HTML tag <tg-map>. The map\'s width and height must not exceed 10000 in total. The width and height ratio must be at most 20.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "map"'],
            'location' => ['type' => 'Location', 'desc' => 'Location of the center of the map'],
            'zoom' => ['type' => 'int', 'desc' => 'Map zoom level; 0-24'],
            'width' => ['type' => 'int', 'desc' => 'Map width; 0-10000'],
            'height' => ['type' => 'int', 'desc' => 'Map height; 0-10000'],
            'caption' => ['type' => 'RichBlockCaption?', 'desc' => 'Optional. Caption of the block'],
        ],
    ],
    'animation' => [
        'desc' => 'A block with an animation, corresponding to the HTML tag <video>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "animation"'],
            'animation' => ['type' => 'InputMediaAnimation', 'desc' => 'The animation. Caption is ignored.'],
            'caption' => ['type' => 'RichBlockCaption?', 'desc' => 'Optional. Caption of the block'],
        ],
    ],
    'audio' => [
        'desc' => 'A block with a music file, corresponding to the HTML tag <audio>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "audio"'],
            'audio' => ['type' => 'InputMediaAudio', 'desc' => 'The audio. Caption is ignored.'],
            'caption' => ['type' => 'RichBlockCaption?', 'desc' => 'Optional. Caption of the block'],
        ],
    ],
    'photo' => [
        'desc' => 'A block with a photo, corresponding to the HTML tag <img>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "photo"'],
            'photo' => ['type' => 'InputMediaPhoto', 'desc' => 'The photo. Caption is ignored.'],
            'caption' => ['type' => 'RichBlockCaption?', 'desc' => 'Optional. Caption of the block'],
        ],
    ],
    'video' => [
        'desc' => 'A block with a video, corresponding to the HTML tag <video>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "video"'],
            'video' => ['type' => 'InputMediaVideo', 'desc' => 'The video. Caption is ignored.'],
            'caption' => ['type' => 'RichBlockCaption?', 'desc' => 'Optional. Caption of the block'],
        ],
    ],
    'voice_note' => [
        'desc' => 'A block with a voice note, corresponding to the HTML tag <audio>.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "voice_note"'],
            'voice_note' => ['type' => 'InputMediaVoiceNote', 'desc' => 'The voice note. Caption is ignored.'],
            'caption' => ['type' => 'RichBlockCaption?', 'desc' => 'Optional. Caption of the block'],
        ],
    ],
    'thinking' => [
        'desc' => 'A block with a "Thinking..." placeholder, corresponding to the custom HTML tag <tg-thinking>. The block may be used only in sendRichMessageDraft, therefore it can\'t be received in messages.',
        'fields' => [
            'type' => ['type' => 'string', 'desc' => 'Type of the block, always "thinking"'],
            'text' => ['type' => 'richtext', 'desc' => 'Text of the block. See https://t.me/addemoji/AIActions for examples of custom emoji that are recommended for usage in the block.'],
        ],
    ],
];

$match = '';
foreach ($inputRichBlockTypes as $type => $_) {
    $class = blockClassName($type);
    $match .= "            '{$type}' => {$class}::fromArray(\$data),\n";
}

file_put_contents("$outDir/InputRichBlock.php", <<<PHP
<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * This object represents a block in a rich formatted message to be sent. Currently, it can be any of the following types:
 * InputRichBlockParagraph, InputRichBlockSectionHeading, InputRichBlockPreformatted, InputRichBlockFooter,
 * InputRichBlockDivider, InputRichBlockMathematicalExpression, InputRichBlockAnchor, InputRichBlockList,
 * InputRichBlockBlockQuotation, InputRichBlockPullQuotation, InputRichBlockCollage, InputRichBlockSlideshow,
 * InputRichBlockTable, InputRichBlockDetails, InputRichBlockMap, InputRichBlockAnimation, InputRichBlockAudio,
 * InputRichBlockPhoto, InputRichBlockVideo, InputRichBlockVoiceNote, InputRichBlockThinking
 * @link https://core.telegram.org/bots/api#inputrichblock
 */
abstract class InputRichBlock extends AbstractObject {

    public static function fromArray(array \$data): InputRichBlock {
        return match (\$data['type']) {
{$match}            default => throw new InvalidArgumentException('Invalid InputRichBlock type'),
        };
    }

}

PHP);

file_put_contents("$outDir/InputRichBlockListItem.php", buildClass(
    'InputRichBlockListItem',
    'An item of a list to be sent.',
    [
        'blocks' => ['type' => 'InputRichBlock[]', 'desc' => 'The content of the item'],
        'has_checkbox' => ['type' => 'bool?', 'desc' => 'Optional. Pass True if the item has a checkbox'],
        'is_checked' => ['type' => 'bool?', 'desc' => 'Optional. Pass True if the item has a checked checkbox'],
        'value' => ['type' => 'int?', 'desc' => 'Optional. For ordered lists, the numeric value of the item label'],
        'type' => ['type' => 'string?', 'desc' => 'Optional. For ordered lists, the type of the item label; must be one of "a" for lowercase letters, "A" for uppercase letters, "i" for lowercase Roman numerals, "I" for uppercase Roman numerals, or "1" for decimal numbers'],
    ],
    'AbstractObject'
));

foreach ($inputRichBlockTypes as $type => $meta) {
    $class = blockClassName($type);
    file_put_contents("$outDir/{$class}.php", buildClass($class, $meta['desc'], $meta['fields'], 'InputRichBlock', $type));
}

file_put_contents("$outDir/InputRichMessage.php", buildClass(
    'InputRichMessage',
    'Describes a rich message to be sent. Exactly one of the fields html, markdown, or blocks must be used.',
    [
        'html' => ['type' => 'string?', 'desc' => 'Optional. Content of the rich message to send described using HTML formatting. See rich message formatting options for more details. Use media field to specify the media used in the message.'],
        'markdown' => ['type' => 'string?', 'desc' => 'Optional. Content of the rich message to send described using Markdown formatting. See rich message formatting options for more details. Use media field to specify the media used in the message.'],
        'blocks' => ['type' => 'InputRichBlock[]', 'desc' => 'Optional. Content of the rich message to send described as a list of blocks'],
        'media' => ['type' => 'InputRichMessageMedia[]', 'desc' => 'Optional. List of media that are specified in the markdown or html fields using tg://photo?id=, tg://video?id=, and tg://audio?id= links'],
        'is_rtl' => ['type' => 'bool?', 'desc' => 'Optional. Pass True if the rich message must be shown right-to-left'],
        'skip_entity_detection' => ['type' => 'bool?', 'desc' => 'Optional. Pass True to skip automatic detection of entities (e.g., URLs, email addresses, username mentions, hashtags, cashtags, bot commands, or phone numbers) in the text'],
    ],
    'AbstractObject'
));

file_put_contents("$outDir/InputRichMessageMedia.php", <<<'PHP'
<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * Describes a media element embedded in an outgoing rich message.
 * @link https://core.telegram.org/bots/api#inputrichmessagemedia
 */
final class InputRichMessageMedia extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier of the media used in a tg://photo?id=, tg://video?id=, or tg://audio?id= link. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Media
     *
     * The media to be sent. Everything except the media itself and its properties is ignored.
     * @var InputMediaAnimation|InputMediaAudio|InputMediaPhoto|InputMediaVideo|InputMediaVoiceNote|null
     */
    protected InputMediaAnimation|InputMediaAudio|InputMediaPhoto|InputMediaVideo|InputMediaVoiceNote|null $media = null;

    public function __construct(
        ?string $id = null,
        InputMediaAnimation|InputMediaAudio|InputMediaPhoto|InputMediaVideo|InputMediaVoiceNote|null $media = null
    ) {
        $this->id = $id;
        $this->media = $media;
    }

    public static function fromArray(array $data): InputRichMessageMedia {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['media'])) {
            $instance->media = self::mediaFromArray($data['media']);
        }
        return $instance;
    }

    private static function mediaFromArray(array $data): InputMediaAnimation|InputMediaAudio|InputMediaPhoto|InputMediaVideo|InputMediaVoiceNote {
        return match ($data['type'] ?? null) {
            'animation' => InputMediaAnimation::fromArray($data),
            'audio' => InputMediaAudio::fromArray($data),
            'photo' => InputMediaPhoto::fromArray($data),
            'video' => InputMediaVideo::fromArray($data),
            'voice_note' => InputMediaVoiceNote::fromArray($data),
            default => throw new InvalidArgumentException('Invalid InputRichMessageMedia media type'),
        };
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getMedia(): InputMediaAnimation|InputMediaAudio|InputMediaPhoto|InputMediaVideo|InputMediaVoiceNote|null {
        return $this->media;
    }

    public function setMedia(InputMediaAnimation|InputMediaAudio|InputMediaPhoto|InputMediaVideo|InputMediaVoiceNote|null $value): self {
        $this->media = $value;
        return $this;
    }
}

PHP);

file_put_contents("$outDir/InputMediaVoiceNote.php", <<<'PHP'
<?php

namespace Yabx\Telegram\Objects;

/**
 * Represents a voice message file to be sent.
 * @link https://core.telegram.org/bots/api#inputmediavoicenote
 */
final class InputMediaVoiceNote extends AbstractObject {

    /**
     * Type
     *
     * Type of the media, must be voice_note
     * @var string
     */
    protected string $type = 'voice_note';

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files »
     * @var string|null
     */
    protected ?string $media = null;

    /**
     * Caption
     *
     * Optional. Caption of the voice message to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the voice message caption. See formatting options for more details.
     * @var string|null
     */
    protected ?string $parseMode = null;

    /**
     * Caption Entities
     *
     * Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @var MessageEntity[]|null
     */
    protected ?array $captionEntities = null;

    /**
     * Duration
     *
     * Optional. Duration of the voice message in seconds
     * @var int|null
     */
    protected ?int $duration = null;

    public function __construct(
        ?string $media = null,
        ?string $caption = null,
        ?string $parseMode = null,
        ?array $captionEntities = null,
        ?int $duration = null
    ) {
        $this->media = $media;
        $this->caption = $caption;
        $this->parseMode = $parseMode;
        $this->captionEntities = $captionEntities;
        $this->duration = $duration;
    }

    public static function fromArray(array $data): InputMediaVoiceNote {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['media'])) {
            $instance->media = $data['media'];
        }
        if (isset($data['caption'])) {
            $instance->caption = $data['caption'];
        }
        if (isset($data['parse_mode'])) {
            $instance->parseMode = $data['parse_mode'];
        }
        if (isset($data['caption_entities'])) {
            $instance->captionEntities = [];
            foreach ($data['caption_entities'] as $item) {
                $instance->captionEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getMedia(): ?string {
        return $this->media;
    }

    public function setMedia(?string $value): self {
        $this->media = $value;
        return $this;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function setCaption(?string $value): self {
        $this->caption = $value;
        return $this;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function setParseMode(?string $value): self {
        $this->parseMode = $value;
        return $this;
    }

    public function getCaptionEntities(): ?array {
        return $this->captionEntities;
    }

    public function setCaptionEntities(?array $value): self {
        $this->captionEntities = $value;
        return $this;
    }

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function setDuration(?int $value): self {
        $this->duration = $value;
        return $this;
    }
}

PHP);

file_put_contents("$outDir/Community.php", buildClass(
    'Community',
    'Represents a community (a group of chats).',
    [
        'id' => ['type' => 'int', 'desc' => 'Unique identifier for this community. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.'],
        'name' => ['type' => 'string', 'desc' => 'Name of the community'],
    ],
    'AbstractObject'
));

file_put_contents("$outDir/CommunityChatAdded.php", buildClass(
    'CommunityChatAdded',
    'Describes a service message about a chat being added to a community.',
    [
        'community' => ['type' => 'Community', 'desc' => 'The new community to which the chat belongs'],
    ],
    'AbstractObject'
));

file_put_contents("$outDir/CommunityChatRemoved.php", <<<'PHP'
<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a chat being removed from a community. Currently holds no information.
 * @link https://core.telegram.org/bots/api#communitychatremoved
 */
final class CommunityChatRemoved extends AbstractObject {

    public function __construct() {
    }

    public static function fromArray(array $data): CommunityChatRemoved {
        return new self();
    }
}

PHP);

file_put_contents("$outDir/BotSubscriptionUpdated.php", buildClass(
    'BotSubscriptionUpdated',
    'This object contains information about changes to a user payment subscription toward the current bot.',
    [
        'user' => ['type' => 'User', 'desc' => 'User who subscribed for payments toward the bot'],
        'invoice_payload' => ['type' => 'string', 'desc' => 'Bot-specified invoice payload'],
        'state' => ['type' => 'string', 'desc' => 'The new state of the subscription. Currently, it can be one of "canceled" if the user canceled the subscription, "active" if the user re-enabled a previously canceled subscription, or "failed" if payment for the subscription failed.'],
    ],
    'AbstractObject'
));

echo "Regenerated Bot API 10.2 object classes with docblocks in {$outDir}\n";
