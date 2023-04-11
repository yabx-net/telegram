<?php

namespace Yabx\Telegram\Objects;

class BotDescription {

    /**
     * Description
     *
     * The bot's description
     * @var string
     */
    protected string $description;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
