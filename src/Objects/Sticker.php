<?php

namespace Yabx\Telegram\Objects;

class Sticker {

    /**
     * File Id
     *
     * Identifier for this file, which can be used to download or reuse the file
     * @var string
     */
    protected string $fileId;

    /**
     * File Unique Id
     *
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @var string
     */
    protected string $fileUniqueId;

    /**
     * Type
     *
     * Type of the sticker, currently one of “regular”, “mask”, “custom_emoji”. The type of the sticker is independent from its format, which is determined by the fields is_animated and is_video.
     * @var string
     */
    protected string $type;

    /**
     * Width
     *
     * Sticker width
     * @var int
     */
    protected int $width;

    /**
     * Height
     *
     * Sticker height
     * @var int
     */
    protected int $height;

    /**
     * Is Animated
     *
     * True, if the sticker is animated
     * @var bool
     */
    protected bool $isAnimated;

    /**
     * Is Video
     *
     * True, if the sticker is a video sticker
     * @var bool
     */
    protected bool $isVideo;

    /**
     * Thumbnail
     *
     * Optional. Sticker thumbnail in the .WEBP or .JPG format
     * @var PhotoSize|null
     */
    protected ?PhotoSize $thumbnail = null;

    /**
     * Emoji
     *
     * Optional. Emoji associated with the sticker
     * @var string|null
     */
    protected ?string $emoji = null;

    /**
     * Set Name
     *
     * Optional. Name of the sticker set to which the sticker belongs
     * @var string|null
     */
    protected ?string $setName = null;

    /**
     * Premium Animation
     *
     * Optional. For premium regular stickers, premium animation for the sticker
     * @var File|null
     */
    protected ?File $premiumAnimation = null;

    /**
     * Mask Position
     *
     * Optional. For mask stickers, the position where the mask should be placed
     * @var MaskPosition|null
     */
    protected ?MaskPosition $maskPosition = null;

    /**
     * Custom Emoji Id
     *
     * Optional. For custom emoji stickers, unique identifier of the custom emoji
     * @var string|null
     */
    protected ?string $customEmojiId = null;

    /**
     * Needs Repainting
     *
     * Optional. True, if the sticker must be repainted to a text color in messages, the color of the Telegram Premium badge in emoji status, white color on chat photos, or another appropriate color in other places
     * @var bool|null
     */
    protected ?bool $needsRepainting = null;

    /**
     * File Size
     *
     * Optional. File size in bytes
     * @var int|null
     */
    protected ?int $fileSize = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['file_id'])) {
            $this->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $this->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['width'])) {
            $this->width = $data['width'];
        }
        if (isset($data['height'])) {
            $this->height = $data['height'];
        }
        if (isset($data['is_animated'])) {
            $this->isAnimated = $data['is_animated'];
        }
        if (isset($data['is_video'])) {
            $this->isVideo = $data['is_video'];
        }
        if (isset($data['thumbnail'])) {
            $this->thumbnail = new PhotoSize($data['thumbnail']);
        }
        if (isset($data['emoji'])) {
            $this->emoji = $data['emoji'];
        }
        if (isset($data['set_name'])) {
            $this->setName = $data['set_name'];
        }
        if (isset($data['premium_animation'])) {
            $this->premiumAnimation = new File($data['premium_animation']);
        }
        if (isset($data['mask_position'])) {
            $this->maskPosition = new MaskPosition($data['mask_position']);
        }
        if (isset($data['custom_emoji_id'])) {
            $this->customEmojiId = $data['custom_emoji_id'];
        }
        if (isset($data['needs_repainting'])) {
            $this->needsRepainting = $data['needs_repainting'];
        }
        if (isset($data['file_size'])) {
            $this->fileSize = $data['file_size'];
        }
    }

    public function getFileId(): string {
        return $this->fileId;
    }

    public function getFileUniqueId(): string {
        return $this->fileUniqueId;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getWidth(): int {
        return $this->width;
    }

    public function getHeight(): int {
        return $this->height;
    }

    public function getIsAnimated(): bool {
        return $this->isAnimated;
    }

    public function getIsVideo(): bool {
        return $this->isVideo;
    }

    public function getThumbnail(): ?PhotoSize {
        return $this->thumbnail;
    }

    public function getEmoji(): ?string {
        return $this->emoji;
    }

    public function getSetName(): ?string {
        return $this->setName;
    }

    public function getPremiumAnimation(): ?File {
        return $this->premiumAnimation;
    }

    public function getMaskPosition(): ?MaskPosition {
        return $this->maskPosition;
    }

    public function getCustomEmojiId(): ?string {
        return $this->customEmojiId;
    }

    public function getNeedsRepainting(): ?bool {
        return $this->needsRepainting;
    }

    public function getFileSize(): ?int {
        return $this->fileSize;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
