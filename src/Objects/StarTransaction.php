<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class StarTransaction {

    use ObjectTrait;

    /**
     * Id
     *
     * Unique identifier of the transaction. Coincides with the identifer of the original transaction for refund transactions. Coincides with SuccessfulPayment.telegram_payment_charge_id for successful incoming payments from users.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Amount
     *
     * Number of Telegram Stars transferred by the transaction
     * @var int|null
     */
    protected ?int $amount = null;

    /**
     * Date
     *
     * Date the transaction was created in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Source
     *
     * Optional. Source of an incoming transaction (e.g., a user purchasing goods or services, Fragment refunding a failed withdrawal). Only for incoming transactions
     * @var TransactionPartner|null
     */
    protected ?TransactionPartner $source = null;

    /**
     * Receiver
     *
     * Optional. Receiver of an outgoing transaction (e.g., a user for a purchase refund, Fragment for a withdrawal). Only for outgoing transactions
     * @var TransactionPartner|null
     */
    protected ?TransactionPartner $receiver = null;

    public static function fromArray(array $data): StarTransaction {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['amount'])) {
            $instance->amount = $data['amount'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['source'])) {
            $instance->source = TransactionPartner::fromArray($data['source']);
        }
        if (isset($data['receiver'])) {
            $instance->receiver = TransactionPartner::fromArray($data['receiver']);
        }
        return $instance;
    }

    public function __construct(
        ?string             $id = null,
        ?int                $amount = null,
        ?int                $date = null,
        ?TransactionPartner $source = null,
        ?TransactionPartner $receiver = null,
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->date = $date;
        $this->source = $source;
        $this->receiver = $receiver;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getAmount(): ?int {
        return $this->amount;
    }

    public function setAmount(?int $value): self {
        $this->amount = $value;
        return $this;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

    public function getSource(): ?TransactionPartner {
        return $this->source;
    }

    public function setSource(?TransactionPartner $value): self {
        $this->source = $value;
        return $this;
    }

    public function getReceiver(): ?TransactionPartner {
        return $this->receiver;
    }

    public function setReceiver(?TransactionPartner $value): self {
        $this->receiver = $value;
        return $this;
    }

}
