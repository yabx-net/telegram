<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class VideoChatScheduled {

    use ObjectTrait;

    /**
     * Start Date
     *
     * Point in time (Unix timestamp) when the video chat is supposed to be started by a chat administrator
     * @var int|null
     */
    protected ?int $startDate = null;

    public function __construct(
        ?int $startDate = null,
    ) {
        $this->startDate = $startDate;
    }

    public static function fromArray(array $data): VideoChatScheduled {
        $instance = new self();
        if (isset($data['start_date'])) {
            $instance->startDate = $data['start_date'];
        }
        return $instance;
    }

    public function getStartDate(): ?int {
        return $this->startDate;
    }

    public function setStartDate(?int $value): self {
        $this->startDate = $value;
        return $this;
    }

}
