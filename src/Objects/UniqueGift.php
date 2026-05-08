<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes a unique gift that was upgraded from a regular gift.
 * @link https://core.telegram.org/bots/api#uniquegift
 */
final class UniqueGift extends AbstractObject {

    /**
     * Gift Id
     *
     * Identifier of the regular gift from which the gift was upgraded
     * @var string|null
     */
    protected ?string $giftId = null;

    /**
     * Base Name
     *
     * Human-readable name of the regular gift from which this unique gift was upgraded
     * @var string|null
     */
    protected ?string $baseName = null;

    /**
     * Name
     *
     * Unique name of the gift. This name can be used in https://t.me/nft/... links and story areas
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Number
     *
     * Unique number of the upgraded gift among gifts upgraded from the same regular gift
     * @var int|null
     */
    protected ?int $number = null;

    /**
     * Model
     *
     * Model of the gift
     * @var UniqueGiftModel|null
     */
    protected ?UniqueGiftModel $model = null;

    /**
     * Symbol
     *
     * Symbol of the gift
     * @var UniqueGiftSymbol|null
     */
    protected ?UniqueGiftSymbol $symbol = null;

    /**
     * Backdrop
     *
     * Backdrop of the gift
     * @var UniqueGiftBackdrop|null
     */
    protected ?UniqueGiftBackdrop $backdrop = null;

    /**
     * Is Premium
     *
     * Optional. True, if the original regular gift was exclusively purchaseable by Telegram Premium subscribers
     * @var bool|null
     */
    protected ?bool $isPremium = null;

    /**
     * Is Burned
     *
     * Optional. True, if the gift was used to craft another gift and isn't available anymore
     * @var bool|null
     */
    protected ?bool $isBurned = null;

    /**
     * Is From Blockchain
     *
     * Optional. True, if the gift is assigned from the TON blockchain and can't be resold or transferred in Telegram
     * @var bool|null
     */
    protected ?bool $isFromBlockchain = null;

    /**
     * Colors
     *
     * Optional. The color scheme that can be used by the gift's owner for the chat's name, replies to messages and link previews; for business account gifts and gifts that are currently on sale only
     * @var UniqueGiftColors|null
     */
    protected ?UniqueGiftColors $colors = null;

    /**
     * Publisher Chat
     *
     * Optional. Information about the chat that published the gift
     * @var Chat|null
     */
    protected ?Chat $publisherChat = null;

    public static function fromArray(array $data): UniqueGift {
        $instance = new self();
        if (isset($data['gift_id'])) {
            $instance->giftId = $data['gift_id'];
        }
        if (isset($data['base_name'])) {
            $instance->baseName = $data['base_name'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['number'])) {
            $instance->number = $data['number'];
        }
        if (isset($data['model'])) {
            $instance->model = UniqueGiftModel::fromArray($data['model']);
        }
        if (isset($data['symbol'])) {
            $instance->symbol = UniqueGiftSymbol::fromArray($data['symbol']);
        }
        if (isset($data['backdrop'])) {
            $instance->backdrop = UniqueGiftBackdrop::fromArray($data['backdrop']);
        }
        if (isset($data['is_premium'])) {
            $instance->isPremium = $data['is_premium'];
        }
        if (isset($data['is_burned'])) {
            $instance->isBurned = $data['is_burned'];
        }
        if (isset($data['is_from_blockchain'])) {
            $instance->isFromBlockchain = $data['is_from_blockchain'];
        }
        if (isset($data['colors'])) {
            $instance->colors = UniqueGiftColors::fromArray($data['colors']);
        }
        if (isset($data['publisher_chat'])) {
            $instance->publisherChat = Chat::fromArray($data['publisher_chat']);
        }
        return $instance;
    }

    public function __construct(
        ?string $giftId = null,
        ?string $baseName = null,
        ?string $name = null,
        ?int $number = null,
        ?UniqueGiftModel $model = null,
        ?UniqueGiftSymbol $symbol = null,
        ?UniqueGiftBackdrop $backdrop = null,
        ?bool $isPremium = null,
        ?bool $isBurned = null,
        ?bool $isFromBlockchain = null,
        ?UniqueGiftColors $colors = null,
        ?Chat $publisherChat = null,
    ) {
        $this->giftId = $giftId;
        $this->baseName = $baseName;
        $this->name = $name;
        $this->number = $number;
        $this->model = $model;
        $this->symbol = $symbol;
        $this->backdrop = $backdrop;
        $this->isPremium = $isPremium;
        $this->isBurned = $isBurned;
        $this->isFromBlockchain = $isFromBlockchain;
        $this->colors = $colors;
        $this->publisherChat = $publisherChat;
    }

    public function getGiftId(): ?string {
        return $this->giftId;
    }

    public function setGiftId(?string $value): self {
        $this->giftId = $value;
        return $this;
    }

    public function getBaseName(): ?string {
        return $this->baseName;
    }

    public function setBaseName(?string $value): self {
        $this->baseName = $value;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getNumber(): ?int {
        return $this->number;
    }

    public function setNumber(?int $value): self {
        $this->number = $value;
        return $this;
    }

    public function getModel(): ?UniqueGiftModel {
        return $this->model;
    }

    public function setModel(?UniqueGiftModel $value): self {
        $this->model = $value;
        return $this;
    }

    public function getSymbol(): ?UniqueGiftSymbol {
        return $this->symbol;
    }

    public function setSymbol(?UniqueGiftSymbol $value): self {
        $this->symbol = $value;
        return $this;
    }

    public function getBackdrop(): ?UniqueGiftBackdrop {
        return $this->backdrop;
    }

    public function setBackdrop(?UniqueGiftBackdrop $value): self {
        $this->backdrop = $value;
        return $this;
    }

    public function getIsPremium(): ?bool {
        return $this->isPremium;
    }

    public function setIsPremium(?bool $value): self {
        $this->isPremium = $value;
        return $this;
    }

    public function getIsBurned(): ?bool {
        return $this->isBurned;
    }

    public function setIsBurned(?bool $value): self {
        $this->isBurned = $value;
        return $this;
    }

    public function getIsFromBlockchain(): ?bool {
        return $this->isFromBlockchain;
    }

    public function setIsFromBlockchain(?bool $value): self {
        $this->isFromBlockchain = $value;
        return $this;
    }

    public function getColors(): ?UniqueGiftColors {
        return $this->colors;
    }

    public function setColors(?UniqueGiftColors $value): self {
        $this->colors = $value;
        return $this;
    }

    public function getPublisherChat(): ?Chat {
        return $this->publisherChat;
    }

    public function setPublisherChat(?Chat $value): self {
        $this->publisherChat = $value;
        return $this;
    }

}
