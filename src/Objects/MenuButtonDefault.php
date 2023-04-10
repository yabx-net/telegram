<?php

namespace Yabx\Telegram\Objects;

class MenuButtonDefault {

    /**
     * Type
     *
     * Type of the button, must be default
     * @var string
     */
    protected string $type;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
    }

    public function getType(): string {
        return $this->type;
    }


}
