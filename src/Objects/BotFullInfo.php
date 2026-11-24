<?php

namespace Yabx\Telegram\Objects;

/**
 * This object contains full information about the bot itself.
 * @link https://core.telegram.org/bots/api#botfullinfo
 */
final class BotFullInfo extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier for this bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Is Bot
     *
     * Always True
     * @var bool|null
     */
    protected ?bool $isBot = null;

    /**
     * First Name
     *
     * Bot's first name
     * @var string|null
     */
    protected ?string $firstName = null;

    /**
     * Username
     *
     * Optional. Bot's username
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * Active Usernames
     *
     * Optional. If non-empty, the list of all active usernames of the bot
     * @var array|null
     */
    protected ?array $activeUsernames = null;

    /**
     * Can Join Groups
     *
     * True, if the bot can be added to groups
     * @var bool|null
     */
    protected ?bool $canJoinGroups = null;

    /**
     * Can Read All Group Messages
     *
     * True, if privacy mode is disabled for the bot
     * @var bool|null
     */
    protected ?bool $canReadAllGroupMessages = null;

    /**
     * Supports Guest Queries
     *
     * True, if the bot supports guest queries from chats it is not a member of
     * @var bool|null
     */
    protected ?bool $supportsGuestQueries = null;

    /**
     * Supports Inline Queries
     *
     * True, if the bot supports inline queries
     * @var bool|null
     */
    protected ?bool $supportsInlineQueries = null;

    /**
     * Inline Query Placeholder
     *
     * Optional. Placeholder for inline queries, which is shown in the input field after the bot's username; omitted if the default placeholder is used
     * @var string|null
     */
    protected ?string $inlineQueryPlaceholder = null;

    /**
     * Needs Inline Query Location
     *
     * True, if the bot requests the location of the user with every inline query
     * @var bool|null
     */
    protected ?bool $needsInlineQueryLocation = null;

    /**
     * Can Connect To Business
     *
     * True, if the bot can be connected to a user account to manage it
     * @var bool|null
     */
    protected ?bool $canConnectToBusiness = null;

    /**
     * Has Main Web App
     *
     * True, if the bot has a main Web App
     * @var bool|null
     */
    protected ?bool $hasMainWebApp = null;

    /**
     * Has Topics Enabled
     *
     * True, if the bot has forum topic mode enabled in private chats
     * @var bool|null
     */
    protected ?bool $hasTopicsEnabled = null;

    /**
     * Allows Users To Create Topics
     *
     * True, if the bot allows users to create and delete topics in private chats
     * @var bool|null
     */
    protected ?bool $allowsUsersToCreateTopics = null;

    /**
     * Has Topic Sidebar
     *
     * True, if topics in private chats with the bot are shown in a sidebar
     * @var bool|null
     */
    protected ?bool $hasTopicSidebar = null;

    /**
     * Can Manage Bots
     *
     * True, if other bots can be created to be controlled by the bot
     * @var bool|null
     */
    protected ?bool $canManageBots = null;

    /**
     * Supports Join Request Queries
     *
     * True, if the bot supports join request queries and can be assigned to process them
     * @var bool|null
     */
    protected ?bool $supportsJoinRequestQueries = null;

    public function __construct(
        ?int $id = null,
        ?bool $isBot = null,
        ?string $firstName = null,
        ?string $username = null,
        ?array $activeUsernames = null,
        ?bool $canJoinGroups = null,
        ?bool $canReadAllGroupMessages = null,
        ?bool $supportsGuestQueries = null,
        ?bool $supportsInlineQueries = null,
        ?string $inlineQueryPlaceholder = null,
        ?bool $needsInlineQueryLocation = null,
        ?bool $canConnectToBusiness = null,
        ?bool $hasMainWebApp = null,
        ?bool $hasTopicsEnabled = null,
        ?bool $allowsUsersToCreateTopics = null,
        ?bool $hasTopicSidebar = null,
        ?bool $canManageBots = null,
        ?bool $supportsJoinRequestQueries = null
    ) {
        $this->id = $id;
        $this->isBot = $isBot;
        $this->firstName = $firstName;
        $this->username = $username;
        $this->activeUsernames = $activeUsernames;
        $this->canJoinGroups = $canJoinGroups;
        $this->canReadAllGroupMessages = $canReadAllGroupMessages;
        $this->supportsGuestQueries = $supportsGuestQueries;
        $this->supportsInlineQueries = $supportsInlineQueries;
        $this->inlineQueryPlaceholder = $inlineQueryPlaceholder;
        $this->needsInlineQueryLocation = $needsInlineQueryLocation;
        $this->canConnectToBusiness = $canConnectToBusiness;
        $this->hasMainWebApp = $hasMainWebApp;
        $this->hasTopicsEnabled = $hasTopicsEnabled;
        $this->allowsUsersToCreateTopics = $allowsUsersToCreateTopics;
        $this->hasTopicSidebar = $hasTopicSidebar;
        $this->canManageBots = $canManageBots;
        $this->supportsJoinRequestQueries = $supportsJoinRequestQueries;
    }

    public static function fromArray(array $data): BotFullInfo {
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
        if (isset($data['username'])) {
            $instance->username = $data['username'];
        }
        if (isset($data['active_usernames'])) {
            $instance->activeUsernames = $data['active_usernames'];
        }
        if (isset($data['can_join_groups'])) {
            $instance->canJoinGroups = $data['can_join_groups'];
        }
        if (isset($data['can_read_all_group_messages'])) {
            $instance->canReadAllGroupMessages = $data['can_read_all_group_messages'];
        }
        if (isset($data['supports_guest_queries'])) {
            $instance->supportsGuestQueries = $data['supports_guest_queries'];
        }
        if (isset($data['supports_inline_queries'])) {
            $instance->supportsInlineQueries = $data['supports_inline_queries'];
        }
        if (isset($data['inline_query_placeholder'])) {
            $instance->inlineQueryPlaceholder = $data['inline_query_placeholder'];
        }
        if (isset($data['needs_inline_query_location'])) {
            $instance->needsInlineQueryLocation = $data['needs_inline_query_location'];
        }
        if (isset($data['can_connect_to_business'])) {
            $instance->canConnectToBusiness = $data['can_connect_to_business'];
        }
        if (isset($data['has_main_web_app'])) {
            $instance->hasMainWebApp = $data['has_main_web_app'];
        }
        if (isset($data['has_topics_enabled'])) {
            $instance->hasTopicsEnabled = $data['has_topics_enabled'];
        }
        if (isset($data['allows_users_to_create_topics'])) {
            $instance->allowsUsersToCreateTopics = $data['allows_users_to_create_topics'];
        }
        if (isset($data['has_topic_sidebar'])) {
            $instance->hasTopicSidebar = $data['has_topic_sidebar'];
        }
        if (isset($data['can_manage_bots'])) {
            $instance->canManageBots = $data['can_manage_bots'];
        }
        if (isset($data['supports_join_request_queries'])) {
            $instance->supportsJoinRequestQueries = $data['supports_join_request_queries'];
        }
        return $instance;
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

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $value): self {
        $this->username = $value;
        return $this;
    }

    public function getActiveUsernames(): ?array {
        return $this->activeUsernames;
    }

    public function setActiveUsernames(?array $value): self {
        $this->activeUsernames = $value;
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

    public function getSupportsGuestQueries(): ?bool {
        return $this->supportsGuestQueries;
    }

    public function setSupportsGuestQueries(?bool $value): self {
        $this->supportsGuestQueries = $value;
        return $this;
    }

    public function getSupportsInlineQueries(): ?bool {
        return $this->supportsInlineQueries;
    }

    public function setSupportsInlineQueries(?bool $value): self {
        $this->supportsInlineQueries = $value;
        return $this;
    }

    public function getInlineQueryPlaceholder(): ?string {
        return $this->inlineQueryPlaceholder;
    }

    public function setInlineQueryPlaceholder(?string $value): self {
        $this->inlineQueryPlaceholder = $value;
        return $this;
    }

    public function getNeedsInlineQueryLocation(): ?bool {
        return $this->needsInlineQueryLocation;
    }

    public function setNeedsInlineQueryLocation(?bool $value): self {
        $this->needsInlineQueryLocation = $value;
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

    public function getHasTopicsEnabled(): ?bool {
        return $this->hasTopicsEnabled;
    }

    public function setHasTopicsEnabled(?bool $value): self {
        $this->hasTopicsEnabled = $value;
        return $this;
    }

    public function getAllowsUsersToCreateTopics(): ?bool {
        return $this->allowsUsersToCreateTopics;
    }

    public function setAllowsUsersToCreateTopics(?bool $value): self {
        $this->allowsUsersToCreateTopics = $value;
        return $this;
    }

    public function getHasTopicSidebar(): ?bool {
        return $this->hasTopicSidebar;
    }

    public function setHasTopicSidebar(?bool $value): self {
        $this->hasTopicSidebar = $value;
        return $this;
    }

    public function getCanManageBots(): ?bool {
        return $this->canManageBots;
    }

    public function setCanManageBots(?bool $value): self {
        $this->canManageBots = $value;
        return $this;
    }

    public function getSupportsJoinRequestQueries(): ?bool {
        return $this->supportsJoinRequestQueries;
    }

    public function setSupportsJoinRequestQueries(?bool $value): self {
        $this->supportsJoinRequestQueries = $value;
        return $this;
    }

}
