<?php

namespace Yabx\Telegram\Objects;

class User {

    /**
     * Id
     *
     * Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int
     */
    protected int $id;

    /**
     * Is Bot
     *
     * True, if this user is a bot
     * @var bool
     */
    protected bool $isBot;

    /**
     * First Name
     *
     * User's or bot's first name
     * @var string
     */
    protected string $firstName;

    /**
     * Last Name
     *
     * Optional. User's or bot's last name
     * @var string|null
     */
    protected ?string $lastName = null;

    /**
     * Username
     *
     * Optional. User's or bot's username
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * Language Code
     *
     * Optional. IETF language tag of the user's language
     * @var string|null
     */
    protected ?string $languageCode = null;

    /**
     * Is Premium
     *
     * Optional. True, if this user is a Telegram Premium user
     * @var bool|null
     */
    protected ?bool $isPremium = null;

    /**
     * Added To Attachment Menu
     *
     * Optional. True, if this user added the bot to the attachment menu
     * @var bool|null
     */
    protected ?bool $addedToAttachmentMenu = null;

    /**
     * Can Join Groups
     *
     * Optional. True, if the bot can be invited to groups. Returned only in getMe.
     * @var bool|null
     */
    protected ?bool $canJoinGroups = null;

    /**
     * Can Read All Group Messages
     *
     * Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
     * @var bool|null
     */
    protected ?bool $canReadAllGroupMessages = null;

    /**
     * Supports Inline Queries
     *
     * Optional. True, if the bot supports inline queries. Returned only in getMe.
     * @var bool|null
     */
    protected ?bool $supportsInlineQueries = null;


    public function __construct(array $data) {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['is_bot'])) {
            $this->isBot = $data['is_bot'];
        }
        if (isset($data['first_name'])) {
            $this->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $this->lastName = $data['last_name'];
        }
        if (isset($data['username'])) {
            $this->username = $data['username'];
        }
        if (isset($data['language_code'])) {
            $this->languageCode = $data['language_code'];
        }
        if (isset($data['is_premium'])) {
            $this->isPremium = $data['is_premium'];
        }
        if (isset($data['added_to_attachment_menu'])) {
            $this->addedToAttachmentMenu = $data['added_to_attachment_menu'];
        }
        if (isset($data['can_join_groups'])) {
            $this->canJoinGroups = $data['can_join_groups'];
        }
        if (isset($data['can_read_all_group_messages'])) {
            $this->canReadAllGroupMessages = $data['can_read_all_group_messages'];
        }
        if (isset($data['supports_inline_queries'])) {
            $this->supportsInlineQueries = $data['supports_inline_queries'];
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIsBot(): bool {
        return $this->isBot;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function getLanguageCode(): ?string {
        return $this->languageCode;
    }

    public function getIsPremium(): ?bool {
        return $this->isPremium;
    }

    public function getAddedToAttachmentMenu(): ?bool {
        return $this->addedToAttachmentMenu;
    }

    public function getCanJoinGroups(): ?bool {
        return $this->canJoinGroups;
    }

    public function getCanReadAllGroupMessages(): ?bool {
        return $this->canReadAllGroupMessages;
    }

    public function getSupportsInlineQueries(): ?bool {
        return $this->supportsInlineQueries;
    }


}
