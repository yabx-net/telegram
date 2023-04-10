<?php

namespace Yabx\Telegram\Objects;

class InputMediaDocument {

    /**
     * Type
     *
     * Type of the result, must be document
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
     * Thumbnail
     *
     * Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files »
     * @var InputFile|string|null
     */
    protected InputFile|string|null $thumbnail = null;

    /**
     * Caption
     *
     * Optional. Caption of the document to be sent, 0-1024 characters after entities parsing
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the document caption. See formatting options for more details.
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
     * Disable Content Type Detection
     *
     * Optional. Disables automatic server-side content type detection for files uploaded using multipart/form-data. Always True, if the document is sent as part of an album.
     * @var bool|null
     */
    protected ?bool $disableContentTypeDetection = null;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['media'])) {
            $this->media = $data['media'];
        }
        if (isset($data['thumbnail'])) {
            $this->thumbnail = new InputFile | string($data['thumbnail']);
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
        if (isset($data['disable_content_type_detection'])) {
            $this->disableContentTypeDetection = $data['disable_content_type_detection'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getMedia(): string {
        return $this->media;
    }

    public function getThumbnail(): InputFile|string|null {
        return $this->thumbnail;
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

    public function getDisableContentTypeDetection(): ?bool {
        return $this->disableContentTypeDetection;
    }


}
