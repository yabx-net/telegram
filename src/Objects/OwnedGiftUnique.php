<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a unique gift received and owned by a user or a chat.
 * @link https://core.telegram.org/bots/api#ownedgiftunique
 */
final class OwnedGiftUnique extends OwnedGift {

    /**
     * Type
     *
     * Type of the gift, always “unique”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Gift
     *
     * Information about the unique gift
     * @var UniqueGift|null
     */
    protected ?UniqueGift $gift = null;

    /**
     * Owned Gift Id
     *
     * Optional. Unique identifier of the received gift for the bot; for gifts received on behalf of business accounts only
     * @var string|null
     */
    protected ?string $ownedGiftId = null;

    /**
     * Sender User
     *
     * Optional. Sender of the gift if it is a known user
     * @var User|null
     */
    protected ?User $senderUser = null;

    /**
     * Send Date
     *
     * Date the gift was sent in Unix time
     * @var int|null
     */
    protected ?int $sendDate = null;

    /**
     * Is Saved
     *
     * Optional. True, if the gift is displayed on the account's profile page; for gifts received on behalf of business accounts only
     * @var bool|null
     */
    protected ?bool $isSaved = null;

    /**
     * Can Be Transferred
     *
     * Optional. True, if the gift can be transferred to another owner; for gifts received on behalf of business accounts only
     * @var bool|null
     */
    protected ?bool $canBeTransferred = null;

    /**
     * Transfer Star Count
     *
     * Optional. Number of Telegram Stars that must be paid to transfer the gift; omitted if the bot cannot transfer the gift
     * @var int|null
     */
    protected ?int $transferStarCount = null;

    /**
     * Next Transfer Date
     *
     * Optional. Point in time (Unix timestamp) when the gift can be transferred. If it is in the past, then the gift can be transferred now
     * @var int|null
     */
    protected ?int $nextTransferDate = null;

    public static function fromArray(array $data): OwnedGiftUnique {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['gift'])) {
            $instance->gift = UniqueGift::fromArray($data['gift']);
        }
        if (isset($data['owned_gift_id'])) {
            $instance->ownedGiftId = $data['owned_gift_id'];
        }
        if (isset($data['sender_user'])) {
            $instance->senderUser = User::fromArray($data['sender_user']);
        }
        if (isset($data['send_date'])) {
            $instance->sendDate = $data['send_date'];
        }
        if (isset($data['is_saved'])) {
            $instance->isSaved = $data['is_saved'];
        }
        if (isset($data['can_be_transferred'])) {
            $instance->canBeTransferred = $data['can_be_transferred'];
        }
        if (isset($data['transfer_star_count'])) {
            $instance->transferStarCount = $data['transfer_star_count'];
        }
        if (isset($data['next_transfer_date'])) {
            $instance->nextTransferDate = $data['next_transfer_date'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?UniqueGift $gift = null,
        ?string $ownedGiftId = null,
        ?User $senderUser = null,
        ?int $sendDate = null,
        ?bool $isSaved = null,
        ?bool $canBeTransferred = null,
        ?int $transferStarCount = null,
        ?int $nextTransferDate = null,
    ) {
        $this->type = $type;
        $this->gift = $gift;
        $this->ownedGiftId = $ownedGiftId;
        $this->senderUser = $senderUser;
        $this->sendDate = $sendDate;
        $this->isSaved = $isSaved;
        $this->canBeTransferred = $canBeTransferred;
        $this->transferStarCount = $transferStarCount;
        $this->nextTransferDate = $nextTransferDate;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getGift(): ?UniqueGift {
        return $this->gift;
    }

    public function setGift(?UniqueGift $value): self {
        $this->gift = $value;
        return $this;
    }

    public function getOwnedGiftId(): ?string {
        return $this->ownedGiftId;
    }

    public function setOwnedGiftId(?string $value): self {
        $this->ownedGiftId = $value;
        return $this;
    }

    public function getSenderUser(): ?User {
        return $this->senderUser;
    }

    public function setSenderUser(?User $value): self {
        $this->senderUser = $value;
        return $this;
    }

    public function getSendDate(): ?int {
        return $this->sendDate;
    }

    public function setSendDate(?int $value): self {
        $this->sendDate = $value;
        return $this;
    }

    public function getIsSaved(): ?bool {
        return $this->isSaved;
    }

    public function setIsSaved(?bool $value): self {
        $this->isSaved = $value;
        return $this;
    }

    public function getCanBeTransferred(): ?bool {
        return $this->canBeTransferred;
    }

    public function setCanBeTransferred(?bool $value): self {
        $this->canBeTransferred = $value;
        return $this;
    }

    public function getTransferStarCount(): ?int {
        return $this->transferStarCount;
    }

    public function setTransferStarCount(?int $value): self {
        $this->transferStarCount = $value;
        return $this;
    }

    public function getNextTransferDate(): ?int {
        return $this->nextTransferDate;
    }

    public function setNextTransferDate(?int $value): self {
        $this->nextTransferDate = $value;
        return $this;
    }

}
