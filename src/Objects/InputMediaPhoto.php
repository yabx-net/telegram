<?php

namespace Yabx\Telegram\Objects;

class InputMediaPhoto {

    /**
     * Type
     *
     * Type of the result, must be photo
     * @var string
     */
    protected string $type;

    /**
     * Media
     *
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files »
     * @var string
     */
    protected string $media;

    /**
     * Caption
     *
     * Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the photo caption. See formatting options for more details.
     * @var string|null
     */
    protected ?string $parseMode = null;

    /**
     * Caption Entities
     *
     * Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @var MessageEntity[]|null
     */
    protected ?array $captionEntities = null;

    /**
     * Has Spoiler
     *
     * Optional. Pass True if the photo needs to be covered with a spoiler animation
     * @var bool|null
     */
    protected ?bool $hasSpoiler = null;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['media'])) {
            $this->media = $data['media'];
        }
        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }
        if (isset($data['parse_mode'])) {
            $this->parseMode = $data['parse_mode'];
        }
        if (isset($data['caption_entities'])) {
            $this->captionEntities = [];
            foreach ($data['caption_entities'] as $item) {
                $this->captionEntities[] = new MessageEntity($item);
            }
        }
        if (isset($data['has_spoiler'])) {
            $this->hasSpoiler = $data['has_spoiler'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getMedia(): string {
        return $this->media;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function getCaptionEntities(): ?array {
        return $this->captionEntities;
    }

    public function getHasSpoiler(): ?bool {
        return $this->hasSpoiler;
    }


}
