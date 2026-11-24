<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a transfer with a TON wallet.
 * @link https://core.telegram.org/bots/api#tonwallettransfer
 */
final class TonWalletTransfer extends AbstractObject {

    /**
     * Transaction Id
     *
     * Unique identifier of the transaction; may be empty if the transfer hasn't been sent yet
     * @var string|null
     */
    protected ?string $transactionId = null;

    /**
     * Peer Address
     *
     * Address of the transfer peer in the TON blockchain
     * @var string|null
     */
    protected ?string $peerAddress = null;

    /**
     * Amount
     *
     * The amount of transferred cryptocurrency, in the smallest units of the cryptocurrency, as a decimal number; negative for outgoing transfers
     * @var string|null
     */
    protected ?string $amount = null;

    /**
     * Comment
     *
     * Optional. Comment added to the transfer; omitted if the comment is encrypted
     * @var string|null
     */
    protected ?string $comment = null;

    public function __construct(
        ?string $transactionId = null,
        ?string $peerAddress = null,
        ?string $amount = null,
        ?string $comment = null
    ) {
        $this->transactionId = $transactionId;
        $this->peerAddress = $peerAddress;
        $this->amount = $amount;
        $this->comment = $comment;
    }

    public static function fromArray(array $data): TonWalletTransfer {
        $instance = new self();
        if (isset($data['transaction_id'])) {
            $instance->transactionId = $data['transaction_id'];
        }
        if (isset($data['peer_address'])) {
            $instance->peerAddress = $data['peer_address'];
        }
        if (isset($data['amount'])) {
            $instance->amount = $data['amount'];
        }
        if (isset($data['comment'])) {
            $instance->comment = $data['comment'];
        }
        return $instance;
    }

    public function getTransactionId(): ?string {
        return $this->transactionId;
    }

    public function setTransactionId(?string $value): self {
        $this->transactionId = $value;
        return $this;
    }

    public function getPeerAddress(): ?string {
        return $this->peerAddress;
    }

    public function setPeerAddress(?string $value): self {
        $this->peerAddress = $value;
        return $this;
    }

    public function getAmount(): ?string {
        return $this->amount;
    }

    public function setAmount(?string $value): self {
        $this->amount = $value;
        return $this;
    }

    public function getComment(): ?string {
        return $this->comment;
    }

    public function setComment(?string $value): self {
        $this->comment = $value;
        return $this;
    }

}
