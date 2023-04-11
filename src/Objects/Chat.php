<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Chat {

    use ObjectTrait;

    /**
     * Id
     *
     * Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Type
     *
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Title
     *
     * Optional. Title, for supergroups, channels and group chats
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Username
     *
     * Optional. Username, for private chats, supergroups and channels if available
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * First Name
     *
     * Optional. First name of the other party in a private chat
     * @var string|null
     */
    protected ?string $firstName = null;

    /**
     * Last Name
     *
     * Optional. Last name of the other party in a private chat
     * @var string|null
     */
    protected ?string $lastName = null;

    /**
     * Is Forum
     *
     * Optional. True, if the supergroup chat is a forum (has topics enabled)
     * @var bool|null
     */
    protected ?bool $isForum = null;

    /**
     * Photo
     *
     * Optional. Chat photo. Returned only in getChat.
     * @var ChatPhoto|null
     */
    protected ?ChatPhoto $photo = null;

    /**
     * Active Usernames
     *
     * Optional. If non-empty, the list of all active chat usernames; for private chats, supergroups and channels. Returned only in getChat.
     * @var string[]|null
     */
    protected ?array $activeUsernames = null;

    /**
     * Emoji Status Custom Emoji Id
     *
     * Optional. Custom emoji identifier of emoji status of the other party in a private chat. Returned only in getChat.
     * @var string|null
     */
    protected ?string $emojiStatusCustomEmojiId = null;

    /**
     * Bio
     *
     * Optional. Bio of the other party in a private chat. Returned only in getChat.
     * @var string|null
     */
    protected ?string $bio = null;

    /**
     * Has Private Forwards
     *
     * Optional. True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user. Returned only in getChat.
     * @var bool|null
     */
    protected ?bool $hasPrivateForwards = null;

    /**
     * Has Restricted Voice And Video Messages
     *
     * Optional. True, if the privacy settings of the other party restrict sending voice and video note messages in the private chat. Returned only in getChat.
     * @var bool|null
     */
    protected ?bool $hasRestrictedVoiceAndVideoMessages = null;

    /**
     * Join To Send Messages
     *
     * Optional. True, if users need to join the supergroup before they can send messages. Returned only in getChat.
     * @var bool|null
     */
    protected ?bool $joinToSendMessages = null;

    /**
     * Join By Request
     *
     * Optional. True, if all users directly joining the supergroup need to be approved by supergroup administrators. Returned only in getChat.
     * @var bool|null
     */
    protected ?bool $joinByRequest = null;

    /**
     * Description
     *
     * Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Invite Link
     *
     * Optional. Primary invite link, for groups, supergroups and channel chats. Returned only in getChat.
     * @var string|null
     */
    protected ?string $inviteLink = null;

    /**
     * Pinned Message
     *
     * Optional. The most recent pinned message (by sending date). Returned only in getChat.
     * @var Message|null
     */
    protected ?Message $pinnedMessage = null;

    /**
     * Permissions
     *
     * Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat.
     * @var ChatPermissions|null
     */
    protected ?ChatPermissions $permissions = null;

    /**
     * Slow Mode Delay
     *
     * Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user; in seconds. Returned only in getChat.
     * @var int|null
     */
    protected ?int $slowModeDelay = null;

    /**
     * Message Auto Delete Time
     *
     * Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat.
     * @var int|null
     */
    protected ?int $messageAutoDeleteTime = null;

    /**
     * Has Aggressive Anti Spam Enabled
     *
     * Optional. True, if aggressive anti-spam checks are enabled in the supergroup. The field is only available to chat administrators. Returned only in getChat.
     * @var bool|null
     */
    protected ?bool $hasAggressiveAntiSpamEnabled = null;

    /**
     * Has Hidden Members
     *
     * Optional. True, if non-administrators can only get the list of bots and administrators in the chat. Returned only in getChat.
     * @var bool|null
     */
    protected ?bool $hasHiddenMembers = null;

    /**
     * Has Protected Content
     *
     * Optional. True, if messages from the chat can't be forwarded to other chats. Returned only in getChat.
     * @var bool|null
     */
    protected ?bool $hasProtectedContent = null;

    /**
     * Sticker Set Name
     *
     * Optional. For supergroups, name of group sticker set. Returned only in getChat.
     * @var string|null
     */
    protected ?string $stickerSetName = null;

    /**
     * Can Set Sticker Set
     *
     * Optional. True, if the bot can change the group sticker set. Returned only in getChat.
     * @var bool|null
     */
    protected ?bool $canSetStickerSet = null;

    /**
     * Linked Chat Id
     *
     * Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat.
     * @var int|null
     */
    protected ?int $linkedChatId = null;

    /**
     * Location
     *
     * Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat.
     * @var ChatLocation|null
     */
    protected ?ChatLocation $location = null;

    public function __construct(
        ?int             $id = null,
        ?string          $type = null,
        ?string          $title = null,
        ?string          $username = null,
        ?string          $firstName = null,
        ?string          $lastName = null,
        ?bool            $isForum = null,
        ?ChatPhoto       $photo = null,
        ?array           $activeUsernames = null,
        ?string          $emojiStatusCustomEmojiId = null,
        ?string          $bio = null,
        ?bool            $hasPrivateForwards = null,
        ?bool            $hasRestrictedVoiceAndVideoMessages = null,
        ?bool            $joinToSendMessages = null,
        ?bool            $joinByRequest = null,
        ?string          $description = null,
        ?string          $inviteLink = null,
        ?Message         $pinnedMessage = null,
        ?ChatPermissions $permissions = null,
        ?int             $slowModeDelay = null,
        ?int             $messageAutoDeleteTime = null,
        ?bool            $hasAggressiveAntiSpamEnabled = null,
        ?bool            $hasHiddenMembers = null,
        ?bool            $hasProtectedContent = null,
        ?string          $stickerSetName = null,
        ?bool            $canSetStickerSet = null,
        ?int             $linkedChatId = null,
        ?ChatLocation    $location = null,
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->isForum = $isForum;
        $this->photo = $photo;
        $this->activeUsernames = $activeUsernames;
        $this->emojiStatusCustomEmojiId = $emojiStatusCustomEmojiId;
        $this->bio = $bio;
        $this->hasPrivateForwards = $hasPrivateForwards;
        $this->hasRestrictedVoiceAndVideoMessages = $hasRestrictedVoiceAndVideoMessages;
        $this->joinToSendMessages = $joinToSendMessages;
        $this->joinByRequest = $joinByRequest;
        $this->description = $description;
        $this->inviteLink = $inviteLink;
        $this->pinnedMessage = $pinnedMessage;
        $this->permissions = $permissions;
        $this->slowModeDelay = $slowModeDelay;
        $this->messageAutoDeleteTime = $messageAutoDeleteTime;
        $this->hasAggressiveAntiSpamEnabled = $hasAggressiveAntiSpamEnabled;
        $this->hasHiddenMembers = $hasHiddenMembers;
        $this->hasProtectedContent = $hasProtectedContent;
        $this->stickerSetName = $stickerSetName;
        $this->canSetStickerSet = $canSetStickerSet;
        $this->linkedChatId = $linkedChatId;
        $this->location = $location;
    }

    public static function fromArray(array $data): Chat {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['username'])) {
            $instance->username = $data['username'];
        }
        if (isset($data['first_name'])) {
            $instance->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $instance->lastName = $data['last_name'];
        }
        if (isset($data['is_forum'])) {
            $instance->isForum = $data['is_forum'];
        }
        if (isset($data['photo'])) {
            $instance->photo = ChatPhoto::fromArray($data['photo']);
        }
        if (isset($data['active_usernames'])) {
            $instance->activeUsernames = [];
            foreach ($data['active_usernames'] as $item) {
                $instance->activeUsernames[] = $item;
            }
        }
        if (isset($data['emoji_status_custom_emoji_id'])) {
            $instance->emojiStatusCustomEmojiId = $data['emoji_status_custom_emoji_id'];
        }
        if (isset($data['bio'])) {
            $instance->bio = $data['bio'];
        }
        if (isset($data['has_private_forwards'])) {
            $instance->hasPrivateForwards = $data['has_private_forwards'];
        }
        if (isset($data['has_restricted_voice_and_video_messages'])) {
            $instance->hasRestrictedVoiceAndVideoMessages = $data['has_restricted_voice_and_video_messages'];
        }
        if (isset($data['join_to_send_messages'])) {
            $instance->joinToSendMessages = $data['join_to_send_messages'];
        }
        if (isset($data['join_by_request'])) {
            $instance->joinByRequest = $data['join_by_request'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        if (isset($data['invite_link'])) {
            $instance->inviteLink = $data['invite_link'];
        }
        if (isset($data['pinned_message'])) {
            $instance->pinnedMessage = Message::fromArray($data['pinned_message']);
        }
        if (isset($data['permissions'])) {
            $instance->permissions = ChatPermissions::fromArray($data['permissions']);
        }
        if (isset($data['slow_mode_delay'])) {
            $instance->slowModeDelay = $data['slow_mode_delay'];
        }
        if (isset($data['message_auto_delete_time'])) {
            $instance->messageAutoDeleteTime = $data['message_auto_delete_time'];
        }
        if (isset($data['has_aggressive_anti_spam_enabled'])) {
            $instance->hasAggressiveAntiSpamEnabled = $data['has_aggressive_anti_spam_enabled'];
        }
        if (isset($data['has_hidden_members'])) {
            $instance->hasHiddenMembers = $data['has_hidden_members'];
        }
        if (isset($data['has_protected_content'])) {
            $instance->hasProtectedContent = $data['has_protected_content'];
        }
        if (isset($data['sticker_set_name'])) {
            $instance->stickerSetName = $data['sticker_set_name'];
        }
        if (isset($data['can_set_sticker_set'])) {
            $instance->canSetStickerSet = $data['can_set_sticker_set'];
        }
        if (isset($data['linked_chat_id'])) {
            $instance->linkedChatId = $data['linked_chat_id'];
        }
        if (isset($data['location'])) {
            $instance->location = ChatLocation::fromArray($data['location']);
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

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $value): self {
        $this->username = $value;
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

    public function getIsForum(): ?bool {
        return $this->isForum;
    }

    public function setIsForum(?bool $value): self {
        $this->isForum = $value;
        return $this;
    }

    public function getPhoto(): ?ChatPhoto {
        return $this->photo;
    }

    public function setPhoto(?ChatPhoto $value): self {
        $this->photo = $value;
        return $this;
    }

    public function getActiveUsernames(): ?array {
        return $this->activeUsernames;
    }

    public function setActiveUsernames(?array $value): self {
        $this->activeUsernames = $value;
        return $this;
    }

    public function getEmojiStatusCustomEmojiId(): ?string {
        return $this->emojiStatusCustomEmojiId;
    }

    public function setEmojiStatusCustomEmojiId(?string $value): self {
        $this->emojiStatusCustomEmojiId = $value;
        return $this;
    }

    public function getBio(): ?string {
        return $this->bio;
    }

    public function setBio(?string $value): self {
        $this->bio = $value;
        return $this;
    }

    public function getHasPrivateForwards(): ?bool {
        return $this->hasPrivateForwards;
    }

    public function setHasPrivateForwards(?bool $value): self {
        $this->hasPrivateForwards = $value;
        return $this;
    }

    public function getHasRestrictedVoiceAndVideoMessages(): ?bool {
        return $this->hasRestrictedVoiceAndVideoMessages;
    }

    public function setHasRestrictedVoiceAndVideoMessages(?bool $value): self {
        $this->hasRestrictedVoiceAndVideoMessages = $value;
        return $this;
    }

    public function getJoinToSendMessages(): ?bool {
        return $this->joinToSendMessages;
    }

    public function setJoinToSendMessages(?bool $value): self {
        $this->joinToSendMessages = $value;
        return $this;
    }

    public function getJoinByRequest(): ?bool {
        return $this->joinByRequest;
    }

    public function setJoinByRequest(?bool $value): self {
        $this->joinByRequest = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
        return $this;
    }

    public function getInviteLink(): ?string {
        return $this->inviteLink;
    }

    public function setInviteLink(?string $value): self {
        $this->inviteLink = $value;
        return $this;
    }

    public function getPinnedMessage(): ?Message {
        return $this->pinnedMessage;
    }

    public function setPinnedMessage(?Message $value): self {
        $this->pinnedMessage = $value;
        return $this;
    }

    public function getPermissions(): ?ChatPermissions {
        return $this->permissions;
    }

    public function setPermissions(?ChatPermissions $value): self {
        $this->permissions = $value;
        return $this;
    }

    public function getSlowModeDelay(): ?int {
        return $this->slowModeDelay;
    }

    public function setSlowModeDelay(?int $value): self {
        $this->slowModeDelay = $value;
        return $this;
    }

    public function getMessageAutoDeleteTime(): ?int {
        return $this->messageAutoDeleteTime;
    }

    public function setMessageAutoDeleteTime(?int $value): self {
        $this->messageAutoDeleteTime = $value;
        return $this;
    }

    public function getHasAggressiveAntiSpamEnabled(): ?bool {
        return $this->hasAggressiveAntiSpamEnabled;
    }

    public function setHasAggressiveAntiSpamEnabled(?bool $value): self {
        $this->hasAggressiveAntiSpamEnabled = $value;
        return $this;
    }

    public function getHasHiddenMembers(): ?bool {
        return $this->hasHiddenMembers;
    }

    public function setHasHiddenMembers(?bool $value): self {
        $this->hasHiddenMembers = $value;
        return $this;
    }

    public function getHasProtectedContent(): ?bool {
        return $this->hasProtectedContent;
    }

    public function setHasProtectedContent(?bool $value): self {
        $this->hasProtectedContent = $value;
        return $this;
    }

    public function getStickerSetName(): ?string {
        return $this->stickerSetName;
    }

    public function setStickerSetName(?string $value): self {
        $this->stickerSetName = $value;
        return $this;
    }

    public function getCanSetStickerSet(): ?bool {
        return $this->canSetStickerSet;
    }

    public function setCanSetStickerSet(?bool $value): self {
        $this->canSetStickerSet = $value;
        return $this;
    }

    public function getLinkedChatId(): ?int {
        return $this->linkedChatId;
    }

    public function setLinkedChatId(?int $value): self {
        $this->linkedChatId = $value;
        return $this;
    }

    public function getLocation(): ?ChatLocation {
        return $this->location;
    }

    public function setLocation(?ChatLocation $value): self {
        $this->location = $value;
        return $this;
    }

}
