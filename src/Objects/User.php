<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class User {

    use ObjectTrait;

    /**
     * Id
     *
     * Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Is Bot
     *
     * True, if this user is a bot
     * @var bool|null
     */
    protected ?bool $isBot = null;

    /**
     * First Name
     *
     * User's or bot's first name
     * @var string|null
     */
    protected ?string $firstName = null;

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

    /**
     * Can Connect To Business
     *
     * Optional. True, if the bot can be connected to a Telegram Business account to receive its messages. Returned only in getMe.
     * @var bool|null
     */
    protected ?bool $canConnectToBusiness = null;

    /**
     * Has Main Web App
     *
     * Optional. True, if the bot has a main Web App. Returned only in getMe.
     * @var bool|null
     */
    protected ?bool $hasMainWebApp = null;

    public static function fromArray(array $data): User {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['is_bot'])) {
            $instance->isBot = $data['is_bot'];
        }
        if (isset($data['first_name'])) {
            $instance->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $instance->lastName = $data['last_name'];
        }
        if (isset($data['username'])) {
            $instance->username = $data['username'];
        }
        if (isset($data['language_code'])) {
            $instance->languageCode = $data['language_code'];
        }
        if (isset($data['is_premium'])) {
            $instance->isPremium = $data['is_premium'];
        }
        if (isset($data['added_to_attachment_menu'])) {
            $instance->addedToAttachmentMenu = $data['added_to_attachment_menu'];
        }
        if (isset($data['can_join_groups'])) {
            $instance->canJoinGroups = $data['can_join_groups'];
        }
        if (isset($data['can_read_all_group_messages'])) {
            $instance->canReadAllGroupMessages = $data['can_read_all_group_messages'];
        }
        if (isset($data['supports_inline_queries'])) {
            $instance->supportsInlineQueries = $data['supports_inline_queries'];
        }
        if (isset($data['can_connect_to_business'])) {
            $instance->canConnectToBusiness = $data['can_connect_to_business'];
        }
        if (isset($data['has_main_web_app'])) {
            $instance->hasMainWebApp = $data['has_main_web_app'];
        }
        return $instance;
    }

    public function __construct(
        ?int    $id = null,
        ?bool   $isBot = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $username = null,
        ?string $languageCode = null,
        ?bool   $isPremium = null,
        ?bool   $addedToAttachmentMenu = null,
        ?bool   $canJoinGroups = null,
        ?bool   $canReadAllGroupMessages = null,
        ?bool   $supportsInlineQueries = null,
        ?bool   $canConnectToBusiness = null,
        ?bool   $hasMainWebApp = null,
    ) {
        $this->id = $id;
        $this->isBot = $isBot;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->languageCode = $languageCode;
        $this->isPremium = $isPremium;
        $this->addedToAttachmentMenu = $addedToAttachmentMenu;
        $this->canJoinGroups = $canJoinGroups;
        $this->canReadAllGroupMessages = $canReadAllGroupMessages;
        $this->supportsInlineQueries = $supportsInlineQueries;
        $this->canConnectToBusiness = $canConnectToBusiness;
        $this->hasMainWebApp = $hasMainWebApp;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $value): self {
        $this->id = $value;
        return $this;
    }

    public function getIsBot(): ?bool {
        return $this->isBot;
    }

    public function setIsBot(?bool $value): self {
        $this->isBot = $value;
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

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $value): self {
        $this->username = $value;
        return $this;
    }

    public function getLanguageCode(): ?string {
        return $this->languageCode;
    }

    public function setLanguageCode(?string $value): self {
        $this->languageCode = $value;
        return $this;
    }

    public function getIsPremium(): ?bool {
        return $this->isPremium;
    }

    public function setIsPremium(?bool $value): self {
        $this->isPremium = $value;
        return $this;
    }

    public function getAddedToAttachmentMenu(): ?bool {
        return $this->addedToAttachmentMenu;
    }

    public function setAddedToAttachmentMenu(?bool $value): self {
        $this->addedToAttachmentMenu = $value;
        return $this;
    }

    public function getCanJoinGroups(): ?bool {
        return $this->canJoinGroups;
    }

    public function setCanJoinGroups(?bool $value): self {
        $this->canJoinGroups = $value;
        return $this;
    }

    public function getCanReadAllGroupMessages(): ?bool {
        return $this->canReadAllGroupMessages;
    }

    public function setCanReadAllGroupMessages(?bool $value): self {
        $this->canReadAllGroupMessages = $value;
        return $this;
    }

    public function getSupportsInlineQueries(): ?bool {
        return $this->supportsInlineQueries;
    }

    public function setSupportsInlineQueries(?bool $value): self {
        $this->supportsInlineQueries = $value;
        return $this;
    }

    public function getCanConnectToBusiness(): ?bool {
        return $this->canConnectToBusiness;
    }

    public function setCanConnectToBusiness(?bool $value): self {
        $this->canConnectToBusiness = $value;
        return $this;
    }

    public function getHasMainWebApp(): ?bool {
        return $this->hasMainWebApp;
    }

    public function setHasMainWebApp(?bool $value): self {
        $this->hasMainWebApp = $value;
        return $this;
    }

}
