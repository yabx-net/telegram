<?php

namespace Yabx\Telegram\Objects;

class SentWebAppMessage {

    /**
     * Inline Message Id
     *
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message.
     * @var string|null
     */
    protected ?string $inlineMessageId = null;


    public function __construct(array $data) {
        if (isset($data['inline_message_id'])) {
            $this->inlineMessageId = $data['inline_message_id'];
        }
    }

    public function getInlineMessageId(): ?string {
        return $this->inlineMessageId;
    }


}
