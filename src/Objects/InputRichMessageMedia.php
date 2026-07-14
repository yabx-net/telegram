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
