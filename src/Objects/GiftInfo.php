<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about a regular gift that was sent or received.
 * @link https://core.telegram.org/bots/api#giftinfo
 */
final class GiftInfo extends AbstractObject {

    /**
     * Gift
     *
     * Information about the gift
     * @var Gift|null
     */
    protected ?Gift $gift = null;

    /**
     * Owned Gift Id
     *
     * Optional. Unique identifier of the received gift for the bot; only present for gifts received on behalf of business accounts
     * @var string|null
     */
    protected ?string $ownedGiftId = null;

    /**
     * Convert Star Count
     *
     * Optional. Number of Telegram Stars that can be claimed by the receiver by converting the gift; omitted if conversion to Telegram Stars is impossible
     * @var int|null
     */
    protected ?int $convertStarCount = null;

    /**
     * Prepaid Upgrade Star Count
     *
     * Optional. Number of Telegram Stars that were prepaid for the ability to upgrade the gift
     * @var int|null
     */
    protected ?int $prepaidUpgradeStarCount = null;

    /**
     * Is Upgrade Separate
     *
     * Optional. True, if the gift's upgrade was purchased after the gift was sent
     * @var bool|null
     */
    protected ?bool $isUpgradeSeparate = null;

    /**
     * Can Be Upgraded
     *
     * Optional. True, if the gift can be upgraded to a unique gift
     * @var bool|null
     */
    protected ?bool $canBeUpgraded = null;

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
     * Unique Gift Number
     *
     * Optional. Unique number reserved for this gift when upgraded. See the number field in UniqueGift
     * @var int|null
     */
    protected ?int $uniqueGiftNumber = null;

    public static function fromArray(array $data): GiftInfo {
        $instance = new self();
        if (isset($data['gift'])) {
            $instance->gift = Gift::fromArray($data['gift']);
        }
        if (isset($data['owned_gift_id'])) {
            $instance->ownedGiftId = $data['owned_gift_id'];
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
        if (isset($data['can_be_upgraded'])) {
            $instance->canBeUpgraded = $data['can_be_upgraded'];
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
        if (isset($data['unique_gift_number'])) {
            $instance->uniqueGiftNumber = $data['unique_gift_number'];
        }
        return $instance;
    }

    public function __construct(
        ?Gift $gift = null,
        ?string $ownedGiftId = null,
        ?int $convertStarCount = null,
        ?int $prepaidUpgradeStarCount = null,
        ?bool $isUpgradeSeparate = null,
        ?bool $canBeUpgraded = null,
        ?string $text = null,
        ?array $entities = null,
        ?bool $isPrivate = null,
        ?int $uniqueGiftNumber = null,
    ) {
        $this->gift = $gift;
        $this->ownedGiftId = $ownedGiftId;
        $this->convertStarCount = $convertStarCount;
        $this->prepaidUpgradeStarCount = $prepaidUpgradeStarCount;
        $this->isUpgradeSeparate = $isUpgradeSeparate;
        $this->canBeUpgraded = $canBeUpgraded;
        $this->text = $text;
        $this->entities = $entities;
        $this->isPrivate = $isPrivate;
        $this->uniqueGiftNumber = $uniqueGiftNumber;
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

    public function getCanBeUpgraded(): ?bool {
        return $this->canBeUpgraded;
    }

    public function setCanBeUpgraded(?bool $value): self {
        $this->canBeUpgraded = $value;
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

    public function getUniqueGiftNumber(): ?int {
        return $this->uniqueGiftNumber;
    }

    public function setUniqueGiftNumber(?int $value): self {
        $this->uniqueGiftNumber = $value;
        return $this;
    }

}
