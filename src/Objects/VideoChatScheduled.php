<?php

namespace Yabx\Telegram\Objects;

final class VideoChatScheduled extends AbstractObject {

    /**
     * Start Date
     *
     * Point in time (Unix timestamp) when the video chat is supposed to be started by a chat administrator
     * @var int|null
     */
    protected ?int $startDate = null;

    public static function fromArray(array $data): VideoChatScheduled {
        $instance = new self();
        if (isset($data['start_date'])) {
            $instance->startDate = $data['start_date'];
        }
        return $instance;
    }

    public function __construct(
        ?int $startDate = null,
    ) {
        $this->startDate = $startDate;
    }

    public function getStartDate(): ?int {
        return $this->startDate;
    }

    public function setStartDate(?int $value): self {
        $this->startDate = $value;
        return $this;
    }

}
