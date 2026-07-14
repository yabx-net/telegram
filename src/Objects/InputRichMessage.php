<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a rich message to be sent. Exactly one of the fields html, markdown, or blocks must be used.
 * @link https://core.telegram.org/bots/api#inputrichmessage
 */
final class InputRichMessage extends AbstractObject {

    /**
     * Html
     *
     * Optional. Content of the rich message to send described using HTML formatting. See rich message formatting options for more details. Use media field to specify the media used in the message.
     * @var string|null
     */
    protected ?string $html = null;

    /**
     * Markdown
     *
     * Optional. Content of the rich message to send described using Markdown formatting. See rich message formatting options for more details. Use media field to specify the media used in the message.
     * @var string|null
     */
    protected ?string $markdown = null;

    /**
     * Blocks
     *
     * Optional. Content of the rich message to send described as a list of blocks
     * @var InputRichBlock[]|null
     */
    protected ?array $blocks = null;

    /**
     * Media
     *
     * Optional. List of media that are specified in the markdown or html fields using tg://photo?id=, tg://video?id=, and tg://audio?id= links
     * @var InputRichMessageMedia[]|null
     */
    protected ?array $media = null;

    /**
     * Is Rtl
     *
     * Optional. Pass True if the rich message must be shown right-to-left
     * @var bool|null
     */
    protected ?bool $isRtl = null;

    /**
     * Skip Entity Detection
     *
     * Optional. Pass True to skip automatic detection of entities (e.g., URLs, email addresses, username mentions, hashtags, cashtags, bot commands, or phone numbers) in the text
     * @var bool|null
     */
    protected ?bool $skipEntityDetection = null;

    public function __construct(
        ?string $html = null,
        ?string $markdown = null,
        ?array $blocks = null,
        ?array $media = null,
        ?bool $isRtl = null,
        ?bool $skipEntityDetection = null
    ) {
        $this->html = $html;
        $this->markdown = $markdown;
        $this->blocks = $blocks;
        $this->media = $media;
        $this->isRtl = $isRtl;
        $this->skipEntityDetection = $skipEntityDetection;
    }

    public static function fromArray(array $data): InputRichMessage {
        $instance = new self();
        if (isset($data['html'])) {
            $instance->html = $data['html'];
        }
        if (isset($data['markdown'])) {
            $instance->markdown = $data['markdown'];
        }
        if (isset($data['blocks'])) {
            $instance->blocks = array_map(fn(array $item) => InputRichBlock::fromArray($item), $data['blocks']);
        }
        if (isset($data['media'])) {
            $instance->media = InputRichMessageMedia::arrayOf($data['media']);
        }
        if (isset($data['is_rtl'])) {
            $instance->isRtl = $data['is_rtl'];
        }
        if (isset($data['skip_entity_detection'])) {
            $instance->skipEntityDetection = $data['skip_entity_detection'];
        }
        return $instance;
    }

    public function getHtml(): ?string {
        return $this->html;
    }

    public function setHtml(?string $value): self {
        $this->html = $value;
        return $this;
    }

    public function getMarkdown(): ?string {
        return $this->markdown;
    }

    public function setMarkdown(?string $value): self {
        $this->markdown = $value;
        return $this;
    }

    public function getBlocks(): ?array {
        return $this->blocks;
    }

    public function setBlocks(?array $value): self {
        $this->blocks = $value;
        return $this;
    }

    public function getMedia(): ?array {
        return $this->media;
    }

    public function setMedia(?array $value): self {
        $this->media = $value;
        return $this;
    }

    public function getIsRtl(): ?bool {
        return $this->isRtl;
    }

    public function setIsRtl(?bool $value): self {
        $this->isRtl = $value;
        return $this;
    }

    public function getSkipEntityDetection(): ?bool {
        return $this->skipEntityDetection;
    }

    public function setSkipEntityDetection(?bool $value): self {
        $this->skipEntityDetection = $value;
        return $this;
    }
}
