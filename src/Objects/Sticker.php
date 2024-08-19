<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Sticker {

    use ObjectTrait;

    /**
     * File Id
     *
     * Identifier for this file, which can be used to download or reuse the file
     * @var string|null
     */
    protected ?string $fileId = null;

    /**
     * File Unique Id
     *
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @var string|null
     */
    protected ?string $fileUniqueId = null;

    /**
     * Type
     *
     * Type of the sticker, currently one of “regular”, “mask”, “custom_emoji”. The type of the sticker is independent from its format, which is determined by the fields is_animated and is_video.
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Width
     *
     * Sticker width
     * @var int|null
     */
    protected ?int $width = null;

    /**
     * Height
     *
     * Sticker height
     * @var int|null
     */
    protected ?int $height = null;

    /**
     * Is Animated
     *
     * True, if the sticker is animated
     * @var bool|null
     */
    protected ?bool $isAnimated = null;

    /**
     * Is Video
     *
     * True, if the sticker is a video sticker
     * @var bool|null
     */
    protected ?bool $isVideo = null;

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

    public static function fromArray(array $data): Sticker {
        $instance = new self();
        if (isset($data['file_id'])) {
            $instance->fileId = $data['file_id'];
        }
        if (isset($data['file_unique_id'])) {
            $instance->fileUniqueId = $data['file_unique_id'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['width'])) {
            $instance->width = $data['width'];
        }
        if (isset($data['height'])) {
            $instance->height = $data['height'];
        }
        if (isset($data['is_animated'])) {
            $instance->isAnimated = $data['is_animated'];
        }
        if (isset($data['is_video'])) {
            $instance->isVideo = $data['is_video'];
        }
        if (isset($data['thumbnail'])) {
            $instance->thumbnail = PhotoSize::fromArray($data['thumbnail']);
        }
        if (isset($data['emoji'])) {
            $instance->emoji = $data['emoji'];
        }
        if (isset($data['set_name'])) {
            $instance->setName = $data['set_name'];
        }
        if (isset($data['premium_animation'])) {
            $instance->premiumAnimation = File::fromArray($data['premium_animation']);
        }
        if (isset($data['mask_position'])) {
            $instance->maskPosition = MaskPosition::fromArray($data['mask_position']);
        }
        if (isset($data['custom_emoji_id'])) {
            $instance->customEmojiId = $data['custom_emoji_id'];
        }
        if (isset($data['needs_repainting'])) {
            $instance->needsRepainting = $data['needs_repainting'];
        }
        if (isset($data['file_size'])) {
            $instance->fileSize = $data['file_size'];
        }
        return $instance;
    }

    public function __construct(
        ?string       $fileId = null,
        ?string       $fileUniqueId = null,
        ?string       $type = null,
        ?int          $width = null,
        ?int          $height = null,
        ?bool         $isAnimated = null,
        ?bool         $isVideo = null,
        ?PhotoSize    $thumbnail = null,
        ?string       $emoji = null,
        ?string       $setName = null,
        ?File         $premiumAnimation = null,
        ?MaskPosition $maskPosition = null,
        ?string       $customEmojiId = null,
        ?bool         $needsRepainting = null,
        ?int          $fileSize = null,
    ) {
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->type = $type;
        $this->width = $width;
        $this->height = $height;
        $this->isAnimated = $isAnimated;
        $this->isVideo = $isVideo;
        $this->thumbnail = $thumbnail;
        $this->emoji = $emoji;
        $this->setName = $setName;
        $this->premiumAnimation = $premiumAnimation;
        $this->maskPosition = $maskPosition;
        $this->customEmojiId = $customEmojiId;
        $this->needsRepainting = $needsRepainting;
        $this->fileSize = $fileSize;
    }

    public function getFileId(): ?string {
        return $this->fileId;
    }

    public function setFileId(?string $value): self {
        $this->fileId = $value;
        return $this;
    }

    public function getFileUniqueId(): ?string {
        return $this->fileUniqueId;
    }

    public function setFileUniqueId(?string $value): self {
        $this->fileUniqueId = $value;
        return $this;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getWidth(): ?int {
        return $this->width;
    }

    public function setWidth(?int $value): self {
        $this->width = $value;
        return $this;
    }

    public function getHeight(): ?int {
        return $this->height;
    }

    public function setHeight(?int $value): self {
        $this->height = $value;
        return $this;
    }

    public function getIsAnimated(): ?bool {
        return $this->isAnimated;
    }

    public function setIsAnimated(?bool $value): self {
        $this->isAnimated = $value;
        return $this;
    }

    public function getIsVideo(): ?bool {
        return $this->isVideo;
    }

    public function setIsVideo(?bool $value): self {
        $this->isVideo = $value;
        return $this;
    }

    public function getThumbnail(): ?PhotoSize {
        return $this->thumbnail;
    }

    public function setThumbnail(?PhotoSize $value): self {
        $this->thumbnail = $value;
        return $this;
    }

    public function getEmoji(): ?string {
        return $this->emoji;
    }

    public function setEmoji(?string $value): self {
        $this->emoji = $value;
        return $this;
    }

    public function getSetName(): ?string {
        return $this->setName;
    }

    public function setSetName(?string $value): self {
        $this->setName = $value;
        return $this;
    }

    public function getPremiumAnimation(): ?File {
        return $this->premiumAnimation;
    }

    public function setPremiumAnimation(?File $value): self {
        $this->premiumAnimation = $value;
        return $this;
    }

    public function getMaskPosition(): ?MaskPosition {
        return $this->maskPosition;
    }

    public function setMaskPosition(?MaskPosition $value): self {
        $this->maskPosition = $value;
        return $this;
    }

    public function getCustomEmojiId(): ?string {
        return $this->customEmojiId;
    }

    public function setCustomEmojiId(?string $value): self {
        $this->customEmojiId = $value;
        return $this;
    }

    public function getNeedsRepainting(): ?bool {
        return $this->needsRepainting;
    }

    public function setNeedsRepainting(?bool $value): self {
        $this->needsRepainting = $value;
        return $this;
    }

    public function getFileSize(): ?int {
        return $this->fileSize;
    }

    public function setFileSize(?int $value): self {
        $this->fileSize = $value;
        return $this;
    }

}
