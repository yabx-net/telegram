<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultContact extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be contact
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 Bytes
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Phone Number
     *
     * Contact's phone number
     * @var string|null
     */
    protected ?string $phoneNumber = null;

    /**
     * First Name
     *
     * Contact's first name
     * @var string|null
     */
    protected ?string $firstName = null;

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

    public function __construct(
        ?string               $type = null,
        ?string               $id = null,
        ?string               $phoneNumber = null,
        ?string               $firstName = null,
        ?string               $lastName = null,
        ?string               $vcard = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
        ?InputMessageContent  $inputMessageContent = null,
        ?string               $thumbnailUrl = null,
        ?int                  $thumbnailWidth = null,
        ?int                  $thumbnailHeight = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->vcard = $vcard;
        $this->replyMarkup = $replyMarkup;
        $this->inputMessageContent = $inputMessageContent;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->thumbnailWidth = $thumbnailWidth;
        $this->thumbnailHeight = $thumbnailHeight;
    }

    public static function fromArray(array $data): InlineQueryResultContact {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['phone_number'])) {
            $instance->phoneNumber = $data['phone_number'];
        }
        if (isset($data['first_name'])) {
            $instance->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $instance->lastName = $data['last_name'];
        }
        if (isset($data['vcard'])) {
            $instance->vcard = $data['vcard'];
        }
        if (isset($data['reply_markup'])) {
            $instance->replyMarkup = InlineKeyboardMarkup::fromArray($data['reply_markup']);
        }
        if (isset($data['input_message_content'])) {
            $instance->inputMessageContent = InputMessageContent::fromArray($data['input_message_content']);
        }
        if (isset($data['thumbnail_url'])) {
            $instance->thumbnailUrl = $data['thumbnail_url'];
        }
        if (isset($data['thumbnail_width'])) {
            $instance->thumbnailWidth = $data['thumbnail_width'];
        }
        if (isset($data['thumbnail_height'])) {
            $instance->thumbnailHeight = $data['thumbnail_height'];
        }
        return $instance;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getPhoneNumber(): ?string {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $value): self {
        $this->phoneNumber = $value;
        return $this;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function setFirstName(?string $value): self {
        $this->firstName = $value;
        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(?string $value): self {
        $this->lastName = $value;
        return $this;
    }

    public function getVcard(): ?string {
        return $this->vcard;
    }

    public function setVcard(?string $value): self {
        $this->vcard = $value;
        return $this;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function setReplyMarkup(?InlineKeyboardMarkup $value): self {
        $this->replyMarkup = $value;
        return $this;
    }

    public function getInputMessageContent(): ?InputMessageContent {
        return $this->inputMessageContent;
    }

    public function setInputMessageContent(?InputMessageContent $value): self {
        $this->inputMessageContent = $value;
        return $this;
    }

    public function getThumbnailUrl(): ?string {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(?string $value): self {
        $this->thumbnailUrl = $value;
        return $this;
    }

    public function getThumbnailWidth(): ?int {
        return $this->thumbnailWidth;
    }

    public function setThumbnailWidth(?int $value): self {
        $this->thumbnailWidth = $value;
        return $this;
    }

    public function getThumbnailHeight(): ?int {
        return $this->thumbnailHeight;
    }

    public function setThumbnailHeight(?int $value): self {
        $this->thumbnailHeight = $value;
        return $this;
    }

}
