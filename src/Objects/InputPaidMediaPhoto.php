<?php

namespace Yabx\Telegram\Objects;

final class InputPaidMediaPhoto extends InputPaidMedia {

    /**
     * Type
     *
     * Type of the media, must be photo
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files »
     * @var string|null
     */
    protected ?string $media = null;

    public static function fromArray(array $data): InputPaidMediaPhoto {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['media'])) {
            $instance->media = $data['media'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?string $media = null,
    ) {
        $this->type = $type;
        $this->media = $media;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getMedia(): ?string {
        return $this->media;
    }

    public function setMedia(?string $value): self {
        $this->media = $value;
        return $this;
    }

}
