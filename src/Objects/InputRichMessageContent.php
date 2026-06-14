<?php

namespace Yabx\Telegram\Objects;

class InputRichMessageContent extends InputMessageContent {

    protected ?InputRichMessage $richMessage = null;

    public function __construct(
        ?InputRichMessage $richMessage = null
    ) {
        $this->richMessage = $richMessage;
    }

    public static function fromArray(array $data): InputRichMessageContent {
        $instance = new self();
        if (isset($data['rich_message'])) {
            $instance->richMessage = InputRichMessage::fromArray($data['rich_message']);
        }
        return $instance;
    }

    public function getRichMessage(): ?InputRichMessage {
        return $this->richMessage;
    }

    public function setRichMessage(?InputRichMessage $value): self {
        $this->richMessage = $value;
        return $this;
    }
}
