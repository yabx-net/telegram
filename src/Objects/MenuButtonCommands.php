<?php

namespace Yabx\Telegram\Objects;

class MenuButtonCommands {

    /**
     * Type
     *
     * Type of the button, must be commands
     * @var string
     */
    protected string $type;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
