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


    public function __construct(array $data) {
        if (isset($data['short_description'])) {
            $this->shortDescription = $data['short_description'];
        }
    }

    public function getShortDescription(): string {
        return $this->shortDescription;
    }


}
