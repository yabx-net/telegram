<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a regular gift owned by a user or a chat.
 * @link https://core.telegram.org/bots/api#ownedgiftregular
 */
final class OwnedGiftRegular extends OwnedGift {

    /**
     * Type
     *
     * Type of the gift, always “regular”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Gift
     *
     * Information about the regular gift
     * @var Gift|null
     */
    protected ?Gift $gift = null;

    /**
     * Owned Gift Id
     *
     * Optional. Unique identifier of the gift for the bot; for gifts received on behalf of business accounts only
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

    /**
     * Is Saved
     *
     * Optional. True, if the gift is displayed on the account's profile page; for gifts received on behalf of business accounts only
     * @var bool|null
     */
    protected ?bool $isSaved = null;

    /**
     * Can Be Upgraded
     *
     * Optional. True, if the gift can be upgraded to a unique gift; for gifts received on behalf of business accounts only
     * @var bool|null
     */
    protected ?bool $canBeUpgraded = null;

    /**
     * Was Refunded
     *
     * Optional. True, if the gift was refunded and isn't available anymore
     * @var bool|null
     */
    protected ?bool $wasRefunded = null;

    /**
     * Convert Star Count
     *
     * Optional. Number of Telegram Stars that can be claimed by the receiver instead of the gift; omitted if the gift cannot be converted to Telegram Stars; for gifts received on behalf of business accounts only
     * @var int|null
     */
    protected ?int $convertStarCount = null;

    /**
     * Prepaid Upgrade Star Count
     *
     * Optional. Number of Telegram Stars that were paid for the ability to upgrade the gift
     * @var int|null
     */
    protected ?int $prepaidUpgradeStarCount = null;

    /**
     * Is Upgrade Separate
     *
     * Optional. True, if the gift's upgrade was purchased after the gift was sent; for gifts received on behalf of business accounts only
     * @var bool|null
     */
    protected ?bool $isUpgradeSeparate = null;

    /**
     * Unique Gift Number
     *
     * Optional. Unique number reserved for this gift when upgraded. See the number field in UniqueGift
     * @var int|null
     */
    protected ?int $uniqueGiftNumber = null;

    public static function fromArray(array $data): OwnedGiftRegular {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['gift'])) {
            $instance->gift = Gift::fromArray($data['gift']);
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
        if (isset($data['is_saved'])) {
            $instance->isSaved = $data['is_saved'];
        }
        if (isset($data['can_be_upgraded'])) {
            $instance->canBeUpgraded = $data['can_be_upgraded'];
        }
        if (isset($data['was_refunded'])) {
            $instance->wasRefunded = $data['was_refunded'];
        }
        if (isset($data['convert_star_count'])) {
            $instance->convertStarCount = $data['convert_star_count'];
        }
        if (isset($data['prepaid_upgrade_star_count'])) {
            $instance->prepaidUpgradeStarCount = $data['prepaid_upgrade_star_count'];
        }
        if (isset($data['is_upgrade_separate'])) {
            $instance->isUpgradeSeparate = $data['is_upgrade_separate'];
        }
        if (isset($data['unique_gift_number'])) {
            $instance->uniqueGiftNumber = $data['unique_gift_number'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?Gift $gift = null,
        ?string $ownedGiftId = null,
        ?User $senderUser = null,
        ?int $sendDate = null,
        ?string $text = null,
        ?array $entities = null,
        ?bool $isPrivate = null,
        ?bool $isSaved = null,
        ?bool $canBeUpgraded = null,
        ?bool $wasRefunded = null,
        ?int $convertStarCount = null,
        ?int $prepaidUpgradeStarCount = null,
        ?bool $isUpgradeSeparate = null,
        ?int $uniqueGiftNumber = null,
    ) {
        $this->type = $type;
        $this->gift = $gift;
        $this->ownedGiftId = $ownedGiftId;
        $this->senderUser = $senderUser;
        $this->sendDate = $sendDate;
        $this->text = $text;
        $this->entities = $entities;
        $this->isPrivate = $isPrivate;
        $this->isSaved = $isSaved;
        $this->canBeUpgraded = $canBeUpgraded;
        $this->wasRefunded = $wasRefunded;
        $this->convertStarCount = $convertStarCount;
        $this->prepaidUpgradeStarCount = $prepaidUpgradeStarCount;
        $this->isUpgradeSeparate = $isUpgradeSeparate;
        $this->uniqueGiftNumber = $uniqueGiftNumber;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getGift(): ?Gift {
        return $this->gift;
    }

    public function setGift(?Gift $value): self {
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

    public function getIsSaved(): ?bool {
        return $this->isSaved;
    }

    public function setIsSaved(?bool $value): self {
        $this->isSaved = $value;
        return $this;
    }

    public function getCanBeUpgraded(): ?bool {
        return $this->canBeUpgraded;
    }

    public function setCanBeUpgraded(?bool $value): self {
        $this->canBeUpgraded = $value;
        return $this;
    }

    public function getWasRefunded(): ?bool {
        return $this->wasRefunded;
    }

    public function setWasRefunded(?bool $value): self {
        $this->wasRefunded = $value;
        return $this;
    }

    public function getConvertStarCount(): ?int {
        return $this->convertStarCount;
    }

    public function setConvertStarCount(?int $value): self {
        $this->convertStarCount = $value;
        return $this;
    }

    public function getPrepaidUpgradeStarCount(): ?int {
        return $this->prepaidUpgradeStarCount;
    }

    public function setPrepaidUpgradeStarCount(?int $value): self {
        $this->prepaidUpgradeStarCount = $value;
        return $this;
    }

    public function getIsUpgradeSeparate(): ?bool {
        return $this->isUpgradeSeparate;
    }

    public function setIsUpgradeSeparate(?bool $value): self {
        $this->isUpgradeSeparate = $value;
        return $this;
    }

    public function getUniqueGiftNumber(): ?int {
        return $this->uniqueGiftNumber;
    }

    public function setUniqueGiftNumber(?int $value): self {
        $this->uniqueGiftNumber = $value;
        return $this;
    }

}
