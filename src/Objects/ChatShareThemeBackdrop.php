<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes a backdrop, which can be used as the background of a theme of the screen for sharing a link to a user or a chat.
 * @link https://core.telegram.org/bots/api#chatsharethemebackdrop
 */
final class ChatShareThemeBackdrop extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier of the backdrop
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Name
     *
     * Name of the backdrop
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Colors
     *
     * Colors of the backdrop
     * @var UniqueGiftBackdropColors|null
     */
    protected ?UniqueGiftBackdropColors $colors = null;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?UniqueGiftBackdropColors $colors = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->colors = $colors;
    }

    public static function fromArray(array $data): ChatShareThemeBackdrop {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['colors'])) {
            $instance->colors = UniqueGiftBackdropColors::fromArray($data['colors']);
        }
        return $instance;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $value): self {
        $this->id = $value;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getColors(): ?UniqueGiftBackdropColors {
        return $this->colors;
    }

    public function setColors(?UniqueGiftBackdropColors $value): self {
        $this->colors = $value;
        return $this;
    }

}
