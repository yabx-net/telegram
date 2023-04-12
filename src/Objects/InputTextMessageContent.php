<?php

namespace Yabx\Telegram\Objects;

final class InputTextMessageContent extends InputMessageContent {

    /**
     * Message Text
     *
     * Text of the message to be sent, 1-4096 characters
     * @var string|null
     */
    protected ?string $messageText = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the message text. See formatting options for more details.
     * @var string|null
     */
    protected ?string $parseMode = null;

    /**
     * Entities
     *
     * Optional. List of special entities that appear in message text, which can be specified instead of parse_mode
     * @var MessageEntity[]|null
     */
    protected ?array $entities = null;

    /**
     * Disable Web Page Preview
     *
     * Optional. Disables link previews for links in the sent message
     * @var bool|null
     */
    protected ?bool $disableWebPagePreview = null;

    public function __construct(
        ?string $messageText = null,
        ?string $parseMode = null,
        ?array  $entities = null,
        ?bool   $disableWebPagePreview = null,
    ) {
        $this->messageText = $messageText;
        $this->parseMode = $parseMode;
        $this->entities = $entities;
        $this->disableWebPagePreview = $disableWebPagePreview;
    }

    public static function fromArray(array $data): InputTextMessageContent {
        $instance = new self();
        if (isset($data['message_text'])) {
            $instance->messageText = $data['message_text'];
        }
        if (isset($data['parse_mode'])) {
            $instance->parseMode = $data['parse_mode'];
        }
        if (isset($data['entities'])) {
            $instance->entities = [];
            foreach ($data['entities'] as $item) {
                $instance->entities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['disable_web_page_preview'])) {
            $instance->disableWebPagePreview = $data['disable_web_page_preview'];
        }
        return $instance;
    }

    public function getMessageText(): ?string {
        return $this->messageText;
    }

    public function setMessageText(?string $value): self {
        $this->messageText = $value;
        return $this;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function setParseMode(?string $value): self {
        $this->parseMode = $value;
        return $this;
    }

    public function getEntities(): ?array {
        return $this->entities;
    }

    public function setEntities(?array $value): self {
        $this->entities = $value;
        return $this;
    }

    public function getDisableWebPagePreview(): ?bool {
        return $this->disableWebPagePreview;
    }

    public function setDisableWebPagePreview(?bool $value): self {
        $this->disableWebPagePreview = $value;
        return $this;
    }

}
