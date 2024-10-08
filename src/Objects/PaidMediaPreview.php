<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PaidMediaPreview extends PaidMedia {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the paid media, always “preview”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Width
     *
     * Optional. Media width as defined by the sender
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Optional. Media height as defined by the sender
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Duration
     *
     * Optional. Duration of the media in seconds as defined by the sender
     * @var int|null
     */
    protected ?int $duration = null;

    public static function fromArray(array $data): PaidMediaPreview {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['width'])) {
            $instance->width = $data['width'];
        }
        if (isset($data['height'])) {
            $instance->height = $data['height'];
        }
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?int    $width = null,
        ?int    $height = null,
        ?int    $duration = null,
    ) {
        $this->type = $type;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
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

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function setDuration(?int $value): self {
        $this->duration = $value;
        return $this;
    }

}