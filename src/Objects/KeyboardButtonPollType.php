<?php

namespace Yabx\Telegram\Objects;

class KeyboardButtonPollType {

    /**
     * Type
     *
     * Optional. If quiz is passed, the user will be allowed to create only polls in the quiz mode. If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create a poll of any type.
     * @var string|null
     */
    protected ?string $type = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
