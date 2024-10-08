<?php

namespace Yabx\Telegram\Objects;

final class StickerSet extends AbstractObject {

    /**
     * Name
     *
     * Sticker set name
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Title
     *
     * Sticker set title
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Sticker Type
     *
     * Type of stickers in the set, currently one of “regular”, “mask”, “custom_emoji”
     * @var string|null
     */
    protected ?string $stickerType = null;

    /**
     * Stickers
     *
     * List of all set stickers
     * @var Sticker[]|null
     */
    protected ?array $stickers = null;

    /**
     * Thumbnail
     *
     * Optional. Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail = null;

    public function __construct(
        ?string    $name = null,
        ?string    $title = null,
        ?string    $stickerType = null,
        ?array     $stickers = null,
        ?PhotoSize $thumbnail = null,
    ) {
        $this->name = $name;
        $this->title = $title;
        $this->stickerType = $stickerType;
        $this->stickers = $stickers;
        $this->thumbnail = $thumbnail;
    }

    public static function fromArray(array $data): StickerSet {
        $instance = new self();
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['sticker_type'])) {
            $instance->stickerType = $data['sticker_type'];
        }
        if (isset($data['stickers'])) {
            $instance->stickers = [];
            foreach ($data['stickers'] as $item) {
                $instance->stickers[] = Sticker::fromArray($item);
            }
        }
        if (isset($data['thumbnail'])) {
            $instance->thumbnail = PhotoSize::fromArray($data['thumbnail']);
        }
        return $instance;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getStickerType(): ?string {
        return $this->stickerType;
    }

    public function setStickerType(?string $value): self {
        $this->stickerType = $value;
        return $this;
    }

    public function getStickers(): ?array {
        return $this->stickers;
    }

    public function setStickers(?array $value): self {
        $this->stickers = $value;
        return $this;
    }

    public function getThumbnail(): ?PhotoSize {
        return $this->thumbnail;
    }

    public function setThumbnail(?PhotoSize $value): self {
        $this->thumbnail = $value;
        return $this;
    }

}
