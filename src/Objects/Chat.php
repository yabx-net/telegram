<?php

namespace Yabx\Telegram\Objects;

class Chat {

    /**
     * Id
     *
     * Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int
     */
    protected int $id;

    /**
     * Type
     *
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     * @var string
     */
    protected string $type;

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


    public function __construct(array $data) {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['username'])) {
            $this->username = $data['username'];
        }
        if (isset($data['first_name'])) {
            $this->firstName = $data['first_name'];
        }
        if (isset($data['last_name'])) {
            $this->lastName = $data['last_name'];
        }
        if (isset($data['is_forum'])) {
            $this->isForum = $data['is_forum'];
        }
        if (isset($data['photo'])) {
            $this->photo = new ChatPhoto($data['photo']);
        }
        if (isset($data['active_usernames'])) {
            $this->activeUsernames = [];
            foreach ($data['active_usernames'] as $item) {
                $this->activeUsernames[] = $item;
            }
        }
        if (isset($data['emoji_status_custom_emoji_id'])) {
            $this->emojiStatusCustomEmojiId = $data['emoji_status_custom_emoji_id'];
        }
        if (isset($data['bio'])) {
            $this->bio = $data['bio'];
        }
        if (isset($data['has_private_forwards'])) {
            $this->hasPrivateForwards = $data['has_private_forwards'];
        }
        if (isset($data['has_restricted_voice_and_video_messages'])) {
            $this->hasRestrictedVoiceAndVideoMessages = $data['has_restricted_voice_and_video_messages'];
        }
        if (isset($data['join_to_send_messages'])) {
            $this->joinToSendMessages = $data['join_to_send_messages'];
        }
        if (isset($data['join_by_request'])) {
            $this->joinByRequest = $data['join_by_request'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['invite_link'])) {
            $this->inviteLink = $data['invite_link'];
        }
        if (isset($data['pinned_message'])) {
            $this->pinnedMessage = new Message($data['pinned_message']);
        }
        if (isset($data['permissions'])) {
            $this->permissions = new ChatPermissions($data['permissions']);
        }
        if (isset($data['slow_mode_delay'])) {
            $this->slowModeDelay = $data['slow_mode_delay'];
        }
        if (isset($data['message_auto_delete_time'])) {
            $this->messageAutoDeleteTime = $data['message_auto_delete_time'];
        }
        if (isset($data['has_aggressive_anti_spam_enabled'])) {
            $this->hasAggressiveAntiSpamEnabled = $data['has_aggressive_anti_spam_enabled'];
        }
        if (isset($data['has_hidden_members'])) {
            $this->hasHiddenMembers = $data['has_hidden_members'];
        }
        if (isset($data['has_protected_content'])) {
            $this->hasProtectedContent = $data['has_protected_content'];
        }
        if (isset($data['sticker_set_name'])) {
            $this->stickerSetName = $data['sticker_set_name'];
        }
        if (isset($data['can_set_sticker_set'])) {
            $this->canSetStickerSet = $data['can_set_sticker_set'];
        }
        if (isset($data['linked_chat_id'])) {
            $this->linkedChatId = $data['linked_chat_id'];
        }
        if (isset($data['location'])) {
            $this->location = new ChatLocation($data['location']);
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function getIsForum(): ?bool {
        return $this->isForum;
    }

    public function getPhoto(): ?ChatPhoto {
        return $this->photo;
    }

    public function getActiveUsernames(): ?array {
        return $this->activeUsernames;
    }

    public function getEmojiStatusCustomEmojiId(): ?string {
        return $this->emojiStatusCustomEmojiId;
    }

    public function getBio(): ?string {
        return $this->bio;
    }

    public function getHasPrivateForwards(): ?bool {
        return $this->hasPrivateForwards;
    }

    public function getHasRestrictedVoiceAndVideoMessages(): ?bool {
        return $this->hasRestrictedVoiceAndVideoMessages;
    }

    public function getJoinToSendMessages(): ?bool {
        return $this->joinToSendMessages;
    }

    public function getJoinByRequest(): ?bool {
        return $this->joinByRequest;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getInviteLink(): ?string {
        return $this->inviteLink;
    }

    public function getPinnedMessage(): ?Message {
        return $this->pinnedMessage;
    }

    public function getPermissions(): ?ChatPermissions {
        return $this->permissions;
    }

    public function getSlowModeDelay(): ?int {
        return $this->slowModeDelay;
    }

    public function getMessageAutoDeleteTime(): ?int {
        return $this->messageAutoDeleteTime;
    }

    public function getHasAggressiveAntiSpamEnabled(): ?bool {
        return $this->hasAggressiveAntiSpamEnabled;
    }

    public function getHasHiddenMembers(): ?bool {
        return $this->hasHiddenMembers;
    }

    public function getHasProtectedContent(): ?bool {
        return $this->hasProtectedContent;
    }

    public function getStickerSetName(): ?string {
        return $this->stickerSetName;
    }

    public function getCanSetStickerSet(): ?bool {
        return $this->canSetStickerSet;
    }

    public function getLinkedChatId(): ?int {
        return $this->linkedChatId;
    }

    public function getLocation(): ?ChatLocation {
        return $this->location;
    }


}
