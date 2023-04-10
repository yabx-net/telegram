<?php

namespace Yabx\Telegram\Objects;

class InlineQueryResultContact {

    /**
     * Type
     *
     * Type of the result, must be contact
     * @var string
     */
    protected string $type;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 Bytes
     * @var string
     */
    protected string $id;

    /**
     * Phone Number
     *
     * Contact's phone number
     * @var string
     */
    protected string $phoneNumber;

    /**
     * First Name
     *
     * Contact's first name
     * @var string
     */
    protected string $firstName;

    /**
     * Last Name
     *
     * Optional. Contact's last name
     * @var string|null
     */
    protected ?string $lastName = null;

    /**
     * Vcard
     *
     * Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @var string|null
     */
    protected ?string $vcard = null;

    /**
     * Reply Markup
     *
     * Optional. Inline keyboard attached to the message
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup = null;

    /**
     * Input Message Content
     *
     * Optional. Content of the message to be sent instead of the contact
     * @var InputMessageContent|null
     */
    protected ?InputMessageContent $inputMessageContent = null;

    /**
     * Thumbnail Url
     *
     * Optional. Url of the thumbnail for the result
     * @var string|null
     */
    protected ?string $thumbnailUrl = null;

    /**
     * Thumbnail Width
     *
     * Optional. Thumbnail width
     * @var int|null
     */
    protected ?int $thumbnailWidth = null;

    /**
     * Thumbnail Height
     *
     * Optional. Thumbnail height
     * @var int|null
     */
    protected ?int $thumbnailHeight = null;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['phone_number'])) {
            $this->phoneNumber = $data['phone_number'];
        }
        if (isset($data['first_name'])) {
            $this->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $this->lastName = $data['last_name'];
        }
        if (isset($data['vcard'])) {
            $this->vcard = $data['vcard'];
        }
        if (isset($data['reply_markup'])) {
            $this->replyMarkup = new InlineKeyboardMarkup($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $this->inputMessageContent = new InputMessageContent($data['input_message_content']);
        }
        if (isset($data['thumbnail_url'])) {
            $this->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['thumbnail_width'])) {
            $this->thumbnailWidth = $data['thumbnail_width'];
        }
        if (isset($data['thumbnail_height'])) {
            $this->thumbnailHeight = $data['thumbnail_height'];
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function getVcard(): ?string {
        return $this->vcard;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    public function getThumbnailWidth(): ?int {
        return $this->thumbnailWidth;
    }

    public function getThumbnailHeight(): ?int {
        return $this->thumbnailHeight;
    }


}
