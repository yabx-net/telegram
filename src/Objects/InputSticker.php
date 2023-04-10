<?php

namespace Yabx\Telegram\Objects;

class InputSticker {

    /**
     * Sticker
     *
     * The added sticker. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, upload a new one using multipart/form-data, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. Animated and video stickers can't be uploaded via HTTP URL. More information on Sending Files »
     * @var InputFile|string
     */
    protected InputFile|string $sticker;

    /**
     * Emoji List
     *
     * List of 1-20 emoji associated with the sticker
     * @var string[]
     */
    protected array $emojiList;

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


    public function __construct(array $data) {
        if (isset($data['sticker'])) {
            $this->sticker = new InputFile | string($data['sticker']);
        }
        if (isset($data['emoji_list'])) {
            $this->emojiList = [];
            foreach ($data['emoji_list'] as $item) {
                $this->emojiList[] = $item;
            }
        }
        if (isset($data['mask_position'])) {
            $this->maskPosition = new MaskPosition($data['mask_position']);
        }
        if (isset($data['keywords'])) {
            $this->keywords = [];
            foreach ($data['keywords'] as $item) {
                $this->keywords[] = $item;
            }
        }
    }

    public function getSticker(): InputFile|string {
        return $this->sticker;
    }

    public function getEmojiList(): array {
        return $this->emojiList;
    }

    public function getMaskPosition(): ?MaskPosition {
        return $this->maskPosition;
    }

    public function getKeywords(): ?array {
        return $this->keywords;
    }


}
