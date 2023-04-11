<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InputSticker {

    use ObjectTrait;

    /**
     * Sticker
     *
     * The added sticker. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, upload a new one using multipart/form-data, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. Animated and video stickers can't be uploaded via HTTP URL. More information on Sending Files »
     * @var string|null
     */
    protected ?string $sticker = null;

    /**
     * Emoji List
     *
     * List of 1-20 emoji associated with the sticker
     * @var string[]|null
     */
    protected ?array $emojiList = null;

    /**
     * Mask Position
     *
     * Optional. Position where the mask should be placed on faces. For “mask” stickers only.
     * @var MaskPosition|null
     */
    protected ?MaskPosition $maskPosition = null;

    /**
     * Keywords
     *
     * Optional. List of 0-20 search keywords for the sticker with total length of up to 64 characters. For “regular” and “custom_emoji” stickers only.
     * @var string[]|null
     */
    protected ?array $keywords = null;

    public function __construct(
        ?string       $sticker = null,
        ?array        $emojiList = null,
        ?MaskPosition $maskPosition = null,
        ?array        $keywords = null,
    ) {
        $this->sticker = $sticker;
        $this->emojiList = $emojiList;
        $this->maskPosition = $maskPosition;
        $this->keywords = $keywords;
    }

    public static function fromArray(array $data): InputSticker {
        $instance = new self();
        if (isset($data['sticker'])) {
            $instance->sticker = $data['sticker'];
        }
        if (isset($data['emoji_list'])) {
            $instance->emojiList = [];
            foreach ($data['emoji_list'] as $item) {
                $instance->emojiList[] = $item;
            }
        }
        if (isset($data['mask_position'])) {
            $instance->maskPosition = MaskPosition::fromArray($data['mask_position']);
        }
        if (isset($data['keywords'])) {
            $instance->keywords = [];
            foreach ($data['keywords'] as $item) {
                $instance->keywords[] = $item;
            }
        }
        return $instance;
    }

    public function getSticker(): ?string {
        return $this->sticker;
    }

    public function setSticker(?string $value): self {
        $this->sticker = $value;
        return $this;
    }

    public function getEmojiList(): ?array {
        return $this->emojiList;
    }

    public function setEmojiList(?array $value): self {
        $this->emojiList = $value;
        return $this;
    }

    public function getMaskPosition(): ?MaskPosition {
        return $this->maskPosition;
    }

    public function setMaskPosition(?MaskPosition $value): self {
        $this->maskPosition = $value;
        return $this;
    }

    public function getKeywords(): ?array {
        return $this->keywords;
    }

    public function setKeywords(?array $value): self {
        $this->keywords = $value;
        return $this;
    }

}
