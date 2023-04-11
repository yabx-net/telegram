<?php

namespace Yabx\Telegram\Objects;

class InputTextMessageContent {

    /**
     * Message Text
     *
     * Text of the message to be sent, 1-4096 characters
     * @var string
     */
    protected string $messageText;

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

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['message_text'])) {
            $this->messageText = $data['message_text'];
        }
        if (isset($data['parse_mode'])) {
            $this->parseMode = $data['parse_mode'];
        }
        if (isset($data['entities'])) {
            $this->entities = [];
            foreach ($data['entities'] as $item) {
                $this->entities[] = new MessageEntity($item);
            }
        }
        if (isset($data['disable_web_page_preview'])) {
            $this->disableWebPagePreview = $data['disable_web_page_preview'];
        }
    }

    public function getMessageText(): string {
        return $this->messageText;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function getEntities(): ?array {
        return $this->entities;
    }

    public function getDisableWebPagePreview(): ?bool {
        return $this->disableWebPagePreview;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
