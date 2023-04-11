<?php

namespace Yabx\Telegram\Objects;

class VideoChatScheduled {

    /**
     * Start Date
     *
     * Point in time (Unix timestamp) when the video chat is supposed to be started by a chat administrator
     * @var int
     */
    protected int $startDate;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['start_date'])) {
            $this->startDate = $data['start_date'];
        }
    }

    public function getStartDate(): int {
        return $this->startDate;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
