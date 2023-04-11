<?php

namespace Yabx\Telegram\Objects;

class GeneralForumTopicUnhidden {

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
