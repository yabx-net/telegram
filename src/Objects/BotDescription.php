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


    public function __construct(array $data) {
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
    }

    public function getDescription(): string {
        return $this->description;
    }


}
