<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes parameters of an ephemeral message to send.
 * @link https://core.telegram.org/bots/api#ephemeralmessageparameters
 */
final class EphemeralMessageParameters extends AbstractObject {

    /**
     * Receiver User Id
     *
     * Identifier of the user who will receive the message. It is not guaranteed that the user will receive the message, especially if they are offline.
     * @var int|null
     */
    protected ?int $receiverUserId = null;

    /**
     * Callback Query Id
     *
     * Optional. Identifier of the callback query which triggered the message, if any
     * @var string|null
     */
    protected ?string $callbackQueryId = null;

    /**
     * Replace Callback Query Message
     *
     * Optional. Pass True if the ephemeral message must be shown in place of the original message. Must be False for callback queries from ephemeral messages, which must be edited using regular editEphemeralMessage methods.
     * @var bool|null
     */
    protected ?bool $replaceCallbackQueryMessage = null;

    public function __construct(
        ?int $receiverUserId = null,
        ?string $callbackQueryId = null,
        ?bool $replaceCallbackQueryMessage = null,
    ) {
        $this->receiverUserId = $receiverUserId;
        $this->callbackQueryId = $callbackQueryId;
        $this->replaceCallbackQueryMessage = $replaceCallbackQueryMessage;
    }

    public static function fromArray(array $data): EphemeralMessageParameters {
        $instance = new self();
        if (isset($data['receiver_user_id'])) {
            $instance->receiverUserId = $data['receiver_user_id'];
        }
        if (isset($data['callback_query_id'])) {
            $instance->callbackQueryId = $data['callback_query_id'];
        }
        if (isset($data['replace_callback_query_message'])) {
            $instance->replaceCallbackQueryMessage = $data['replace_callback_query_message'];
        }
        return $instance;
    }

    public function getReceiverUserId(): ?int {
        return $this->receiverUserId;
    }

    public function setReceiverUserId(?int $value): self {
        $this->receiverUserId = $value;
        return $this;
    }

    public function getCallbackQueryId(): ?string {
        return $this->callbackQueryId;
    }

    public function setCallbackQueryId(?string $value): self {
        $this->callbackQueryId = $value;
        return $this;
    }

    public function getReplaceCallbackQueryMessage(): ?bool {
        return $this->replaceCallbackQueryMessage;
    }

    public function setReplaceCallbackQueryMessage(?bool $value): self {
        $this->replaceCallbackQueryMessage = $value;
        return $this;
    }
}
