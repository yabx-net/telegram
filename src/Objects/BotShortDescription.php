<?php

namespace Yabx\Telegram\Objects;

class BotShortDescription {

    /**
     * Short Description
     *
     * The bot's short description
     * @var string
     */
    protected string $shortDescription;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['short_description'])) {
            $this->shortDescription = $data['short_description'];
        }
    }

    public function getShortDescription(): string {
        return $this->shortDescription;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
