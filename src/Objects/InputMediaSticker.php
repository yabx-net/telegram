<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents a sticker file to be sent.
 * @link https://core.telegram.org/bots/api#inputmediasticker
 */
final class InputMediaSticker extends InputMedia implements InputPollOptionMedia {

    /**
     * Type
     *
     * Type of the result, must be sticker
     * @var string
     */
    protected string $type = 'sticker';

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers, pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one.
     * @var string|null
     */
    protected ?string $media = null;

    /**
     * Emoji
     *
     * Optional. Emoji associated with the sticker.
     * @var string|null
     */
    protected ?string $emoji = null;

    public function __construct(
        ?string $media = null,
        ?string $emoji = null,
    ) {
        $this->media = $media;
        $this->emoji = $emoji;
    }

    public static function fromArray(array $data): InputMediaSticker {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['media'])) {
            $instance->media = $data['media'];
        }
        if (isset($data['emoji'])) {
            $instance->emoji = $data['emoji'];
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

    public function getEmoji(): ?string {
        return $this->emoji;
    }

    public function setEmoji(?string $value): self {
        $this->emoji = $value;
        return $this;
    }

}
