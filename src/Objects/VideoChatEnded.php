<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class VideoChatEnded {

    use ObjectTrait;

    /**
     * Duration
     *
     * Video chat duration in seconds
     * @var int|null
     */
    protected ?int $duration = null;

    public static function fromArray(array $data): VideoChatEnded {
        $instance = new self();
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        return $instance;
    }

    public function __construct(
        ?int $duration = null,
    ) {
        $this->duration = $duration;
    }

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function setDuration(?int $value): self {
        $this->duration = $value;
        return $this;
    }

}
