<?php

namespace Yabx\Telegram\Objects;

final class SentWebAppMessage extends AbstractObject {

    /**
     * Inline Message Id
     *
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message.
     * @var string|null
     */
    protected ?string $inlineMessageId = null;

    public static function fromArray(array $data): SentWebAppMessage {
        $instance = new self();
        if (isset($data['inline_message_id'])) {
            $instance->inlineMessageId = $data['inline_message_id'];
        }
        return $instance;
    }

    public function __construct(
        ?string $inlineMessageId = null,
    ) {
        $this->inlineMessageId = $inlineMessageId;
    }

    public function getInlineMessageId(): ?string {
        return $this->inlineMessageId;
    }

    public function setInlineMessageId(?string $value): self {
        $this->inlineMessageId = $value;
        return $this;
    }

}
