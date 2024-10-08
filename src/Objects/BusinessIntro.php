<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BusinessIntro {

    use ObjectTrait;

    /**
     * Title
     *
     * Optional. Title text of the business intro
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Message
     *
     * Optional. Message text of the business intro
     * @var string|null
     */
    protected ?string $message = null;

    /**
     * Sticker
     *
     * Optional. Sticker of the business intro
     * @var Sticker|null
     */
    protected ?Sticker $sticker = null;

    public function __construct(
        ?string  $title = null,
        ?string  $message = null,
        ?Sticker $sticker = null,
    ) {
        $this->title = $title;
        $this->message = $message;
        $this->sticker = $sticker;
    }

    public static function fromArray(array $data): BusinessIntro {
        $instance = new self();
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['message'])) {
            $instance->message = $data['message'];
        }
        if (isset($data['sticker'])) {
            $instance->sticker = Sticker::fromArray($data['sticker']);
        }
        return $instance;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getMessage(): ?string {
        return $this->message;
    }

    public function setMessage(?string $value): self {
        $this->message = $value;
        return $this;
    }

    public function getSticker(): ?Sticker {
        return $this->sticker;
    }

    public function setSticker(?Sticker $value): self {
        $this->sticker = $value;
        return $this;
    }

}
