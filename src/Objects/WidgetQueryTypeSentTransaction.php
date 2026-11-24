<?php

namespace Yabx\Telegram\Objects;

/**
 * The query notifies the bot about a transaction sent from a TON wallet of the user who sent the query.
 * @link https://core.telegram.org/bots/api#widgetquerytypesenttransaction
 */
final class WidgetQueryTypeSentTransaction extends WidgetQueryType {

    /**
     * Type
     *
     * Type of the object, always "sent_transaction"
     * @var string
     */
    protected string $type = 'sent_transaction';

    /**
     * Wallet
     *
     * The wallet from which the transaction was sent
     * @var WidgetQueryWallet|null
     */
    protected ?WidgetQueryWallet $wallet = null;

    /**
     * Msg Hash
     *
     * Value of msg_hash of the transaction
     * @var string|null
     */
    protected ?string $msgHash = null;

    public function __construct(
        ?WidgetQueryWallet $wallet = null,
        ?string $msgHash = null
    ) {
        $this->wallet = $wallet;
        $this->msgHash = $msgHash;
    }

    public static function fromArray(array $data): WidgetQueryTypeSentTransaction {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['wallet'])) {
            $instance->wallet = WidgetQueryWallet::fromArray($data['wallet']);
        }
        if (isset($data['msg_hash'])) {
            $instance->msgHash = $data['msg_hash'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getWallet(): ?WidgetQueryWallet {
        return $this->wallet;
    }

    public function setWallet(?WidgetQueryWallet $value): self {
        $this->wallet = $value;
        return $this;
    }

    public function getMsgHash(): ?string {
        return $this->msgHash;
    }

    public function setMsgHash(?string $value): self {
        $this->msgHash = $value;
        return $this;
    }
}
