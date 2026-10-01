<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a unique gift that was sent or received.
 * @link https://core.telegram.org/bots/api#uniquegiftinfo
 */
final class UniqueGiftInfo extends AbstractObject {

    /**
     * Gift
     *
     * Information about the gift
     * @var UniqueGift|null
     */
    protected ?UniqueGift $gift = null;

    /**
     * Origin
     *
     * Origin of the gift. Currently, either “upgrade” for gifts upgraded from regular gifts, “transfer” for gifts transferred from other users or channels, “resale” for gifts bought from other users, “gifted_upgrade” for upgrades purchased after the gift was sent, or “offer” for gifts bought or sold through gift purchase offers
     * @var string|null
     */
    protected ?string $origin = null;

    /**
     * Last Resale Currency
     *
     * Optional. For gifts bought from other users, the currency in which the payment for the gift was done. Currently, one of “XTR” for Telegram Stars or “TON” for toncoins.
     * @var string|null
     */
    protected ?string $lastResaleCurrency = null;

    /**
     * Last Resale Amount
     *
     * Optional. For gifts bought from other users, the price paid for the gift in either Telegram Stars or nanotoncoins
     * @var int|null
     */
    protected ?int $lastResaleAmount = null;

    /**
     * Owned Gift Id
     *
     * Optional. Unique identifier of the received gift for the bot; only present for gifts received on behalf of business accounts
     * @var string|null
     */
    protected ?string $ownedGiftId = null;

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

    /**
     * Text
     *
     * Optional. Text of the message that was added to the gift
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Entities
     *
     * Optional. Special entities that appear in the text
     * @var MessageEntity[]|null
     */
    protected ?array $entities = null;

    /**
     * Is Private
     *
     * Optional. True, if the sender and gift text are shown only to the gift receiver; otherwise, everyone will be able to see them
     * @var bool|null
     */
    protected ?bool $isPrivate = null;

    public static function fromArray(array $data): UniqueGiftInfo {
        $instance = new self();
        if (isset($data['gift'])) {
            $instance->gift = UniqueGift::fromArray($data['gift']);
        }
        if (isset($data['origin'])) {
            $instance->origin = $data['origin'];
        }
        if (isset($data['last_resale_currency'])) {
            $instance->lastResaleCurrency = $data['last_resale_currency'];
        }
        if (isset($data['last_resale_amount'])) {
            $instance->lastResaleAmount = $data['last_resale_amount'];
        }
        if (isset($data['owned_gift_id'])) {
            $instance->ownedGiftId = $data['owned_gift_id'];
        }
        if (isset($data['transfer_star_count'])) {
            $instance->transferStarCount = $data['transfer_star_count'];
        }
        if (isset($data['next_transfer_date'])) {
            $instance->nextTransferDate = $data['next_transfer_date'];
        }
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['entities'])) {
            $instance->entities = [];
            foreach ($data['entities'] as $item) {
                $instance->entities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['is_private'])) {
            $instance->isPrivate = $data['is_private'];
        }
        return $instance;
    }

    public function __construct(
        ?UniqueGift $gift = null,
        ?string $origin = null,
        ?string $lastResaleCurrency = null,
        ?int $lastResaleAmount = null,
        ?string $ownedGiftId = null,
        ?int $transferStarCount = null,
        ?int $nextTransferDate = null,
        ?string $text = null,
        ?array $entities = null,
        ?bool $isPrivate = null,
    ) {
        $this->gift = $gift;
        $this->origin = $origin;
        $this->lastResaleCurrency = $lastResaleCurrency;
        $this->lastResaleAmount = $lastResaleAmount;
        $this->ownedGiftId = $ownedGiftId;
        $this->transferStarCount = $transferStarCount;
        $this->nextTransferDate = $nextTransferDate;
        $this->text = $text;
        $this->entities = $entities;
        $this->isPrivate = $isPrivate;
    }

    public function getGift(): ?UniqueGift {
        return $this->gift;
    }

    public function setGift(?UniqueGift $value): self {
        $this->gift = $value;
        return $this;
    }

    public function getOrigin(): ?string {
        return $this->origin;
    }

    public function setOrigin(?string $value): self {
        $this->origin = $value;
        return $this;
    }

    public function getLastResaleCurrency(): ?string {
        return $this->lastResaleCurrency;
    }

    public function setLastResaleCurrency(?string $value): self {
        $this->lastResaleCurrency = $value;
        return $this;
    }

    public function getLastResaleAmount(): ?int {
        return $this->lastResaleAmount;
    }

    public function setLastResaleAmount(?int $value): self {
        $this->lastResaleAmount = $value;
        return $this;
    }

    public function getOwnedGiftId(): ?string {
        return $this->ownedGiftId;
    }

    public function setOwnedGiftId(?string $value): self {
        $this->ownedGiftId = $value;
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

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $value): self {
        $this->text = $value;
        return $this;
    }

    public function getEntities(): ?array {
        return $this->entities;
    }

    public function setEntities(?array $value): self {
        $this->entities = $value;
        return $this;
    }

    public function getIsPrivate(): ?bool {
        return $this->isPrivate;
    }

    public function setIsPrivate(?bool $value): self {
        $this->isPrivate = $value;
        return $this;
    }

}
