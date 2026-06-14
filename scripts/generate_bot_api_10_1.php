<?php

declare(strict_types=1);

$outDir = dirname(__DIR__) . '/src/Objects';

$richTextTypes = [
    'bold' => ['text' => 'richtext'],
    'italic' => ['text' => 'richtext'],
    'underline' => ['text' => 'richtext'],
    'strikethrough' => ['text' => 'richtext'],
    'spoiler' => ['text' => 'richtext'],
    'date_time' => ['text' => 'richtext', 'unix_time' => 'int', 'date_time_format' => 'string'],
    'text_mention' => ['text' => 'richtext', 'user' => 'User'],
    'subscript' => ['text' => 'richtext'],
    'superscript' => ['text' => 'richtext'],
    'marked' => ['text' => 'richtext'],
    'code' => ['text' => 'richtext'],
    'custom_emoji' => ['custom_emoji_id' => 'string', 'alternative_text' => 'string'],
    'mathematical_expression' => ['expression' => 'string'],
    'url' => ['text' => 'richtext', 'url' => 'string'],
    'email_address' => ['text' => 'richtext', 'email_address' => 'string'],
    'phone_number' => ['text' => 'richtext', 'phone_number' => 'string'],
    'bank_card_number' => ['text' => 'richtext', 'bank_card_number' => 'string'],
    'mention' => ['text' => 'richtext', 'username' => 'string'],
    'hashtag' => ['text' => 'richtext', 'hashtag' => 'string'],
    'cashtag' => ['text' => 'richtext', 'cashtag' => 'string'],
    'bot_command' => ['text' => 'richtext', 'bot_command' => 'string'],
    'anchor' => ['name' => 'string'],
    'anchor_link' => ['text' => 'richtext', 'anchor_name' => 'string'],
    'reference' => ['text' => 'richtext', 'name' => 'string'],
    'reference_link' => ['text' => 'richtext', 'reference_name' => 'string'],
];

$richBlockTypes = [
    'paragraph' => ['text' => 'richtext'],
    'heading' => ['text' => 'richtext', 'size' => 'int'],
    'pre' => ['text' => 'richtext', 'language' => 'string?'],
    'footer' => ['text' => 'richtext'],
    'divider' => [],
    'mathematical_expression' => ['expression' => 'string'],
    'anchor' => ['name' => 'string'],
    'list' => ['items' => 'RichBlockListItem[]'],
    'blockquote' => ['blocks' => 'RichBlock[]', 'credit' => 'richtext?'],
    'pullquote' => ['text' => 'richtext', 'credit' => 'richtext?'],
    'collage' => ['blocks' => 'RichBlock[]', 'caption' => 'RichBlockCaption?'],
    'slideshow' => ['blocks' => 'RichBlock[]', 'caption' => 'RichBlockCaption?'],
    'table' => ['cells' => 'RichBlockTableCell[][]', 'is_bordered' => 'bool?', 'is_striped' => 'bool?', 'caption' => 'richtext?'],
    'details' => ['summary' => 'richtext', 'blocks' => 'RichBlock[]', 'is_open' => 'bool?'],
    'map' => ['location' => 'Location', 'zoom' => 'int', 'width' => 'int', 'height' => 'int', 'caption' => 'RichBlockCaption?'],
    'animation' => ['animation' => 'Animation', 'has_spoiler' => 'bool?', 'caption' => 'RichBlockCaption?'],
    'audio' => ['audio' => 'Audio', 'caption' => 'RichBlockCaption?'],
    'photo' => ['photo' => 'PhotoSize[]', 'has_spoiler' => 'bool?', 'caption' => 'RichBlockCaption?'],
    'video' => ['video' => 'Video', 'has_spoiler' => 'bool?', 'caption' => 'RichBlockCaption?'],
    'voice_note' => ['voice_note' => 'Voice', 'caption' => 'RichBlockCaption?'],
    'thinking' => ['text' => 'richtext'],
];

function camel(string $snake): string {
    return lcfirst(str_replace('_', '', ucwords($snake, '_')));
}

function phpType(string $type): string {
    return match (true) {
        $type === 'richtext', $type === 'richtext?' => 'mixed',
        str_ends_with($type, '?') => '?' . phpType(substr($type, 0, -1)),
        str_ends_with($type, '[]') => 'array',
        $type === 'int' => 'int',
        $type === 'bool' => 'bool',
        $type === 'string' => 'string',
        default => $type,
    };
}

function objectType(string $type): string {
    return str_ends_with($type, '?') ? substr($type, 0, -1) : $type;
}

function isScalarType(string $type): bool {
    return in_array(objectType($type), ['int', 'bool', 'string', 'float'], true);
}

function getterType(string $type): string {
    return match (true) {
        $type === 'richtext', $type === 'richtext?' => 'mixed',
        str_ends_with($type, '[]') => '?array',
        default => '?' . ltrim(phpType($type), '?'),
    };
}

function fromArrayBody(string $snake, string $type): string {
    $key = $snake;
    $prop = camel($snake);
    return match (true) {
        $type === 'richtext', $type === 'richtext?' => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = RichText::fromMixed(\$data['{$key}']);\n        }",
        str_ends_with($type, '[]') && str_starts_with($type, 'RichBlock[]') => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = array_map(fn(array \$item) => RichBlock::fromArray(\$item), \$data['{$key}']);\n        }",
        str_ends_with($type, '[]') && str_starts_with($type, 'RichBlockListItem[]') => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = RichBlockListItem::arrayOf(\$data['{$key}']);\n        }",
        str_ends_with($type, '[]') && str_starts_with($type, 'PhotoSize[]') => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = PhotoSize::arrayOf(\$data['{$key}']);\n        }",
        $type === 'RichBlockTableCell[][]' => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = array_map(fn(array \$row) => RichBlockTableCell::arrayOf(\$row), \$data['{$key}']);\n        }",
        isScalarType($type) => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = \$data['{$key}'];\n        }",
        default => "        if (isset(\$data['{$key}'])) {\n            \$instance->{$prop} = " . objectType($type) . "::fromArray(\$data['{$key}']);\n        }",
    };
}

function joinCtorParams(array $params): string {
    if ($params === []) {
        return '';
    }
    return implode(",\n        ", $params);
}

// Fix the generateClass - I used $this incorrectly. Let me rewrite generate function properly.
function buildClass(string $className, array $fields, string $parent, ?string $typeConst = null, bool $isFinal = true): string {
    $final = $isFinal ? 'final ' : '';
    $props = '';
    $ctorParams = [];
    $ctorAssign = '';
    $fromArray = '';
    $getters = '';

    if ($typeConst !== null) {
        $props .= "    protected string \$type = '{$typeConst}';\n\n";
        $fromArray .= "        if (isset(\$data['type'])) {\n            \$instance->type = \$data['type'];\n        }\n";
        $getters .= "\n    public function getType(): string {\n        return \$this->type;\n    }\n";
    }

    foreach ($fields as $snake => $type) {
        $prop = camel($snake);
        $php = phpType($type);
        if ($type === 'richtext' || $type === 'richtext?') {
            $php = 'mixed';
        } elseif (str_ends_with($type, '[]')) {
            $php = '?array';
        } else {
            $php = '?' . ltrim($php, '?');
        }
        $props .= "    protected {$php} \${$prop} = null;\n\n";
        $ctorParams[] = "{$php} \${$prop} = null";
        $ctorAssign .= "        \$this->{$prop} = \${$prop};\n";
        $fromArray .= fromArrayBody($snake, $type) . "\n";
        $getterType = getterType($type);
        $getters .= "\n    public function get" . ucfirst($prop) . "(): {$getterType} {\n        return \$this->{$prop};\n    }\n\n";
        $getters .= "    public function set" . ucfirst($prop) . "({$getterType} \$value): self {\n        \$this->{$prop} = \$value;\n        return \$this;\n    }\n";
    }

    $hasRichText = (bool) array_filter($fields, fn($t) => str_starts_with($t, 'richtext'));
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

    $ctor = joinCtorParams($ctorParams);

    return <<<PHP
<?php

namespace Yabx\Telegram\Objects;

{$uses}{$final}class {$className} extends {$parent} {

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

// RichText base
$richTextMatch = '';
foreach ($richTextTypes as $type => $_) {
    $class = 'RichText' . str_replace('_', '', ucwords($type, '_'));
    $richTextMatch .= "            '{$type}' => {$class}::fromArray(\$data),\n";
}

file_put_contents("$outDir/RichText.php", <<<PHP
<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

abstract class RichText extends AbstractObject {

    public static function fromMixed(mixed \$data): mixed {
        if (is_string(\$data)) {
            return \$data;
        }
        if (!is_array(\$data)) {
            throw new InvalidArgumentException('Invalid RichText value');
        }
        if (isset(\$data['type'])) {
            return self::fromArray(\$data);
        }
        return array_map(fn(mixed \$item) => self::fromMixed(\$item), \$data);
    }

    public static function fromArray(array \$data): RichText {
        return match (\$data['type']) {
{$richTextMatch}            default => throw new InvalidArgumentException('Invalid RichText type'),
        };
    }

    public static function toMixed(mixed \$value): mixed {
        if (\$value === null || is_string(\$value)) {
            return \$value;
        }
        if (is_array(\$value)) {
            return array_map(fn(mixed \$item) => self::toMixed(\$item), \$value);
        }
        if (\$value instanceof AbstractObject) {
            return \$value->toArray();
        }
        return \$value;
    }

}

PHP);

foreach ($richTextTypes as $type => $fields) {
    $class = 'RichText' . str_replace('_', '', ucwords($type, '_'));
    file_put_contents("$outDir/{$class}.php", buildClass($class, $fields, 'RichText', $type));
}

// RichBlock base
$richBlockMatch = '';
foreach ($richBlockTypes as $type => $fields) {
    $class = match ($type) {
        'pre' => 'RichBlockPreformatted',
        'mathematical_expression' => 'RichBlockMathematicalExpression',
        'heading' => 'RichBlockSectionHeading',
        'blockquote' => 'RichBlockBlockQuotation',
        'pullquote' => 'RichBlockPullQuotation',
        default => 'RichBlock' . str_replace('_', '', ucwords($type, '_')),
    };
    $richBlockMatch .= "            '{$type}' => {$class}::fromArray(\$data),\n";
}

file_put_contents("$outDir/RichBlock.php", <<<PHP
<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

abstract class RichBlock extends AbstractObject {

    public static function fromArray(array \$data): RichBlock {
        return match (\$data['type']) {
{$richBlockMatch}            default => throw new InvalidArgumentException('Invalid RichBlock type'),
        };
    }

}

PHP);

file_put_contents("$outDir/RichBlockCaption.php", buildClass('RichBlockCaption', [
    'text' => 'richtext',
    'credit' => 'richtext?',
], 'AbstractObject'));

file_put_contents("$outDir/RichBlockTableCell.php", buildClass('RichBlockTableCell', [
    'text' => 'richtext?',
    'is_header' => 'bool?',
    'colspan' => 'int?',
    'rowspan' => 'int?',
    'align' => 'string?',
    'valign' => 'string?',
], 'AbstractObject'));

file_put_contents("$outDir/RichBlockListItem.php", buildClass('RichBlockListItem', [
    'label' => 'string',
    'blocks' => 'RichBlock[]',
    'has_checkbox' => 'bool?',
    'is_checked' => 'bool?',
    'value' => 'int?',
    'type' => 'string?',
], 'AbstractObject'));

foreach ($richBlockTypes as $type => $fields) {
    $class = match ($type) {
        'pre' => 'RichBlockPreformatted',
        'mathematical_expression' => 'RichBlockMathematicalExpression',
        'heading' => 'RichBlockSectionHeading',
        'blockquote' => 'RichBlockBlockQuotation',
        'pullquote' => 'RichBlockPullQuotation',
        default => 'RichBlock' . str_replace('_', '', ucwords($type, '_')),
    };
    file_put_contents("$outDir/{$class}.php", buildClass($class, $fields, 'RichBlock', $type));
}

file_put_contents("$outDir/RichMessage.php", buildClass('RichMessage', [
    'blocks' => 'RichBlock[]',
    'is_rtl' => 'bool?',
], 'AbstractObject'));

file_put_contents("$outDir/InputRichMessage.php", buildClass('InputRichMessage', [
    'html' => 'string?',
    'markdown' => 'string?',
    'is_rtl' => 'bool?',
    'skip_entity_detection' => 'bool?',
], 'AbstractObject'));

file_put_contents("$outDir/InputRichMessageContent.php", buildClass('InputRichMessageContent', [
    'rich_message' => 'InputRichMessage',
], 'InputMessageContent', null, false));

file_put_contents("$outDir/Link.php", buildClass('Link', [
    'url' => 'string',
], 'AbstractObject'));

file_put_contents("$outDir/InputMediaLink.php", <<<PHP
<?php

namespace Yabx\Telegram\Objects;

final class InputMediaLink extends AbstractObject implements InputPollOptionMedia {

    protected string \$type = 'link';

    protected ?string \$url = null;

    public function __construct(?string \$url = null) {
        \$this->url = \$url;
    }

    public static function fromArray(array \$data): InputMediaLink {
        \$instance = new self();
        if (isset(\$data['type'])) {
            \$instance->type = \$data['type'];
        }
        if (isset(\$data['url'])) {
            \$instance->url = \$data['url'];
        }
        return \$instance;
    }

    public function getType(): string {
        return \$this->type;
    }

    public function getUrl(): ?string {
        return \$this->url;
    }

    public function setUrl(?string \$value): self {
        \$this->url = \$value;
        return \$this;
    }

}

PHP);

echo "Generated Bot API 10.1 object classes in {$outDir}\n";
