<?php

namespace Yabx\Telegram\Objects;

final class StarTransaction extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier of the transaction. Coincides with the identifier of the original transaction for refund transactions. Coincides with SuccessfulPayment.telegram_payment_charge_id for successful incoming payments from users.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Amount
     *
     * Integer amount of Telegram Stars transferred by the transaction
     * @var int|null
     */
    protected ?int $amount = null;

    /**
     * Nanostar Amount
     *
     * Optional. The number of 1/1000000000 shares of Telegram Stars transferred by the transaction; from 0 to 999999999
     * @var int|null
     */
    protected ?int $nanostarAmount = null;

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
        if (isset($data['nanostar_amount'])) {
            $instance->nanostarAmount = $data['nanostar_amount'];
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
        ?int                $nanostarAmount = null,
        ?int                $date = null,
        ?TransactionPartner $source = null,
        ?TransactionPartner $receiver = null,
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->nanostarAmount = $nanostarAmount;
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

    public function getNanostarAmount(): ?int {
        return $this->nanostarAmount;
    }

    public function setNanostarAmount(?int $value): self {
        $this->nanostarAmount = $value;
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
