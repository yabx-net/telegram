<?php

namespace Yabx\Telegram\Objects;

class StickerSet {

    /**
     * Name
     *
     * Sticker set name
     * @var string
     */
    protected string $name;

    /**
     * Title
     *
     * Sticker set title
     * @var string
     */
    protected string $title;

    /**
     * Sticker Type
     *
     * Type of stickers in the set, currently one of “regular”, “mask”, “custom_emoji”
     * @var string
     */
    protected string $stickerType;

    /**
     * Is Animated
     *
     * True, if the sticker set contains animated stickers
     * @var bool
     */
    protected bool $isAnimated;

    /**
     * Is Video
     *
     * True, if the sticker set contains video stickers
     * @var bool
     */
    protected bool $isVideo;

    /**
     * Stickers
     *
     * List of all set stickers
     * @var Sticker[]
     */
    protected array $stickers;

    /**
     * Thumbnail
     *
     * Optional. Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail = null;


    public function __construct(array $data) {
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['sticker_type'])) {
            $this->stickerType = $data['sticker_type'];
        }
        if (isset($data['is_animated'])) {
            $this->isAnimated = $data['is_animated'];
        }
        if (isset($data['is_video'])) {
            $this->isVideo = $data['is_video'];
        }
        if (isset($data['stickers'])) {
            $this->stickers = [];
            foreach ($data['stickers'] as $item) {
                $this->stickers[] = new Sticker($item);
            }
        }
        if (isset($data['thumbnail'])) {
            $this->thumbnail = new PhotoSize($data['thumbnail']);
        }
    }

    public function getName(): string {
        return $this->name;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getStickerType(): string {
        return $this->stickerType;
    }

    public function getIsAnimated(): bool {
        return $this->isAnimated;
    }

    public function getIsVideo(): bool {
        return $this->isVideo;
    }

    public function getStickers(): array {
        return $this->stickers;
    }

    public function getThumbnail(): ?PhotoSize {
        return $this->thumbnail;
    }


}
