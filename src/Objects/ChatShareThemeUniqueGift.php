<?php

namespace Yabx\Telegram\Objects;

/**
 * The theme based on a unique gift owned by the user or the chat.
 * @link https://core.telegram.org/bots/api#chatsharethemeuniquegift
 */
final class ChatShareThemeUniqueGift extends ChatShareTheme {

    /**
     * Type
     *
     * Type of the object, always "unique_gift"
     * @var string
     */
    protected string $type = 'unique_gift';

    /**
     * Gift
     *
     * The gift
     * @var UniqueGift|null
     */
    protected ?UniqueGift $gift = null;

    public function __construct(
        ?UniqueGift $gift = null
    ) {
        $this->gift = $gift;
    }

    public static function fromArray(array $data): ChatShareThemeUniqueGift {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['gift'])) {
            $instance->gift = UniqueGift::fromArray($data['gift']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getGift(): ?UniqueGift {
        return $this->gift;
    }

    public function setGift(?UniqueGift $value): self {
        $this->gift = $value;
        return $this;
    }
}
