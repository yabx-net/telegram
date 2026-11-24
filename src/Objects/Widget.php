<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes an HTML widget.
 * @link https://core.telegram.org/bots/api#widget
 */
final class Widget extends AbstractObject {

    /**
     * Id
     *
     * Optional. Unique identifier of the shared widget, which can be used to send the widget again using the method sendSharedWidget; omitted if the widget isn't shared
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Width
     *
     * Optional. Width of the widget in logical pixels; omitted if the widget must occupy the whole width of the message bubble
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Optional. Height of the widget in logical pixels; omitted if the height of the widget isn't fixed
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Html
     *
     * HTML code of the widget
     * @var string|null
     */
    protected ?string $html = null;

    /**
     * Public Data
     *
     * Optional. Public data of the widget, which is available wherever the widget is shown. All messages with a shared widget have the same public data.
     * @var string|null
     */
    protected ?string $publicData = null;

    /**
     * Chat Data
     *
     * Optional. Data of the widget, which is specific to the message
     * @var string|null
     */
    protected ?string $chatData = null;

    public function __construct(
        ?string $id = null,
        ?int $width = null,
        ?int $height = null,
        ?string $html = null,
        ?string $publicData = null,
        ?string $chatData = null
    ) {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
        $this->html = $html;
        $this->publicData = $publicData;
        $this->chatData = $chatData;
    }

    public static function fromArray(array $data): Widget {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['width'])) {
            $instance->width = $data['width'];
        }
        if (isset($data['height'])) {
            $instance->height = $data['height'];
        }
        if (isset($data['html'])) {
            $instance->html = $data['html'];
        }
        if (isset($data['public_data'])) {
            $instance->publicData = $data['public_data'];
        }
        if (isset($data['chat_data'])) {
            $instance->chatData = $data['chat_data'];
        }
        return $instance;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getWidth(): ?int {
        return $this->width;
    }

    public function setWidth(?int $value): self {
        $this->width = $value;
        return $this;
    }

    public function getHeight(): ?int {
        return $this->height;
    }

    public function setHeight(?int $value): self {
        $this->height = $value;
        return $this;
    }

    public function getHtml(): ?string {
        return $this->html;
    }

    public function setHtml(?string $value): self {
        $this->html = $value;
        return $this;
    }

    public function getPublicData(): ?string {
        return $this->publicData;
    }

    public function setPublicData(?string $value): self {
        $this->publicData = $value;
        return $this;
    }

    public function getChatData(): ?string {
        return $this->chatData;
    }

    public function setChatData(?string $value): self {
        $this->chatData = $value;
        return $this;
    }

}
