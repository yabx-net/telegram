<?php

namespace Yabx\Telegram\Objects;

class VideoChatEnded {

    /**
     * Duration
     *
     * Video chat duration in seconds
     * @var int
     */
    protected int $duration;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['duration'])) {
            $this->duration = $data['duration'];
        }
    }

    public function getDuration(): int {
        return $this->duration;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
