<?php

namespace Yabx\Telegram\Objects;

final class VideoChatEnded extends AbstractObject {

    /**
     * Duration
     *
     * Video chat duration in seconds
     * @var int|null
     */
    protected ?int $duration = null;

    public function __construct(
        ?int $duration = null,
    ) {
        $this->duration = $duration;
    }

    public static function fromArray(array $data): VideoChatEnded {
        $instance = new self();
        if (isset($data['duration'])) {
            $instance->duration = $data['duration'];
        }
        return $instance;
    }

    public function getDuration(): ?int {
        return $this->duration;
    }

    public function setDuration(?int $value): self {
        $this->duration = $value;
        return $this;
    }

}
