<?php

namespace Yabx\Telegram\Objects;

class Message {

    /**
     * Message Id
     *
     * Unique message identifier inside this chat
     * @var int
     */
    protected int $messageId;

    /**
     * Message Thread Id
     *
     * Optional. Unique identifier of a message thread to which the message belongs; for supergroups only
     * @var int|null
     */
    protected ?int $messageThreadId = null;

    /**
     * From
     *
     * Optional. Sender of the message; empty for messages sent to channels. For backward compatibility, the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * Sender Chat
     *
     * Optional. Sender of the message, sent on behalf of a chat. For example, the channel itself for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel for messages automatically forwarded to the discussion group. For backward compatibility, the field from contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     * @var Chat|null
     */
    protected ?Chat $senderChat = null;

    /**
     * Date
     *
     * Date the message was sent in Unix time
     * @var int
     */
    protected int $date;

    /**
     * Chat
     *
     * Conversation the message belongs to
     * @var Chat
     */
    protected Chat $chat;

    /**
     * Forward From
     *
     * Optional. For forwarded messages, sender of the original message
     * @var User|null
     */
    protected ?User $forwardFrom = null;

    /**
     * Forward From Chat
     *
     * Optional. For messages forwarded from channels or from anonymous administrators, information about the original sender chat
     * @var Chat|null
     */
    protected ?Chat $forwardFromChat = null;

    /**
     * Forward From Message Id
     *
     * Optional. For messages forwarded from channels, identifier of the original message in the channel
     * @var int|null
     */
    protected ?int $forwardFromMessageId = null;

    /**
     * Forward Signature
     *
     * Optional. For forwarded messages that were originally sent in channels or by an anonymous chat administrator, signature of the message sender if present
     * @var string|null
     */
    protected ?string $forwardSignature = null;

    /**
     * Forward Sender Name
     *
     * Optional. Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
     * @var string|null
     */
    protected ?string $forwardSenderName = null;

    /**
     * Forward Date
     *
     * Optional. For forwarded messages, date the original message was sent in Unix time
     * @var int|null
     */
    protected ?int $forwardDate = null;

    /**
     * Is Topic Message
     *
     * Optional. True, if the message is sent to a forum topic
     * @var bool|null
     */
    protected ?bool $isTopicMessage = null;

    /**
     * Is Automatic Forward
     *
     * Optional. True, if the message is a channel post that was automatically forwarded to the connected discussion group
     * @var bool|null
     */
    protected ?bool $isAutomaticForward = null;

    /**
     * Reply To Message
     *
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $replyToMessage = null;

    /**
     * Via Bot
     *
     * Optional. Bot through which the message was sent
     * @var User|null
     */
    protected ?User $viaBot = null;

    /**
     * Edit Date
     *
     * Optional. Date the message was last edited in Unix time
     * @var int|null
     */
    protected ?int $editDate = null;

    /**
     * Has Protected Content
     *
     * Optional. True, if the message can't be forwarded
     * @var bool|null
     */
    protected ?bool $hasProtectedContent = null;

    /**
     * Media Group Id
     *
     * Optional. The unique identifier of a media message group this message belongs to
     * @var string|null
     */
    protected ?string $mediaGroupId = null;

    /**
     * Author Signature
     *
     * Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
     * @var string|null
     */
    protected ?string $authorSignature = null;

    /**
     * Text
     *
     * Optional. For text messages, the actual UTF-8 text of the message
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Entities
     *
     * Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
     * @var MessageEntity[]|null
     */
    protected ?array $entities = null;

    /**
     * Animation
     *
     * Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
     * @var Animation|null
     */
    protected ?Animation $animation = null;

    /**
     * Audio
     *
     * Optional. Message is an audio file, information about the file
     * @var Audio|null
     */
    protected ?Audio $audio = null;

    /**
     * Document
     *
     * Optional. Message is a general file, information about the file
     * @var Document|null
     */
    protected ?Document $document = null;

    /**
     * Photo
     *
     * Optional. Message is a photo, available sizes of the photo
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    /**
     * Sticker
     *
     * Optional. Message is a sticker, information about the sticker
     * @var Sticker|null
     */
    protected ?Sticker $sticker = null;

    /**
     * Video
     *
     * Optional. Message is a video, information about the video
     * @var Video|null
     */
    protected ?Video $video = null;

    /**
     * Video Note
     *
     * Optional. Message is a video note, information about the video message
     * @var VideoNote|null
     */
    protected ?VideoNote $videoNote = null;

    /**
     * Voice
     *
     * Optional. Message is a voice message, information about the file
     * @var Voice|null
     */
    protected ?Voice $voice = null;

    /**
     * Caption
     *
     * Optional. Caption for the animation, audio, document, photo, video or voice
     * @var string|null
     */
    protected ?string $caption = null;

    /**
     * Caption Entities
     *
     * Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
     * @var MessageEntity[]|null
     */
    protected ?array $captionEntities = null;

    /**
     * Has Media Spoiler
     *
     * Optional. True, if the message media is covered by a spoiler animation
     * @var bool|null
     */
    protected ?bool $hasMediaSpoiler = null;

    /**
     * Contact
     *
     * Optional. Message is a shared contact, information about the contact
     * @var Contact|null
     */
    protected ?Contact $contact = null;

    /**
     * Dice
     *
     * Optional. Message is a dice with random value
     * @var Dice|null
     */
    protected ?Dice $dice = null;

    /**
     * Game
     *
     * Optional. Message is a game, information about the game. More about games »
     * @var Game|null
     */
    protected ?Game $game = null;

    /**
     * Poll
     *
     * Optional. Message is a native poll, information about the poll
     * @var Poll|null
     */
    protected ?Poll $poll = null;

    /**
     * Venue
     *
     * Optional. Message is a venue, information about the venue. For backward compatibility, when this field is set, the location field will also be set
     * @var Venue|null
     */
    protected ?Venue $venue = null;

    /**
     * Location
     *
     * Optional. Message is a shared location, information about the location
     * @var Location|null
     */
    protected ?Location $location = null;

    /**
     * New Chat Members
     *
     * Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
     * @var User[]|null
     */
    protected ?array $newChatMembers = null;

    /**
     * Left Chat Member
     *
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     * @var User|null
     */
    protected ?User $leftChatMember = null;

    /**
     * New Chat Title
     *
     * Optional. A chat title was changed to this value
     * @var string|null
     */
    protected ?string $newChatTitle = null;

    /**
     * New Chat Photo
     *
     * Optional. A chat photo was change to this value
     * @var PhotoSize[]|null
     */
    protected ?array $newChatPhoto = null;

    /**
     * Delete Chat Photo
     *
     * Optional. Service message: the chat photo was deleted
     * @var bool|null
     */
    protected ?bool $deleteChatPhoto = null;

    /**
     * Group Chat Created
     *
     * Optional. Service message: the group has been created
     * @var bool|null
     */
    protected ?bool $groupChatCreated = null;

    /**
     * Supergroup Chat Created
     *
     * Optional. Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
     * @var bool|null
     */
    protected ?bool $supergroupChatCreated = null;

    /**
     * Channel Chat Created
     *
     * Optional. Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
     * @var bool|null
     */
    protected ?bool $channelChatCreated = null;

    /**
     * Message Auto Delete Timer Changed
     *
     * Optional. Service message: auto-delete timer settings changed in the chat
     * @var MessageAutoDeleteTimerChanged|null
     */
    protected ?MessageAutoDeleteTimerChanged $messageAutoDeleteTimerChanged = null;

    /**
     * Migrate To Chat Id
     *
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $migrateToChatId = null;

    /**
     * Migrate From Chat Id
     *
     * Optional. The supergroup has been migrated from a group with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $migrateFromChatId = null;

    /**
     * Pinned Message
     *
     * Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
     * @var Message|null
     */
    protected ?Message $pinnedMessage = null;

    /**
     * Invoice
     *
     * Optional. Message is an invoice for a payment, information about the invoice. More about payments »
     * @var Invoice|null
     */
    protected ?Invoice $invoice = null;

    /**
     * Successful Payment
     *
     * Optional. Message is a service message about a successful payment, information about the payment. More about payments »
     * @var SuccessfulPayment|null
     */
    protected ?SuccessfulPayment $successfulPayment = null;

    /**
     * User Shared
     *
     * Optional. Service message: a user was shared with the bot
     * @var UserShared|null
     */
    protected ?UserShared $userShared = null;

    /**
     * Chat Shared
     *
     * Optional. Service message: a chat was shared with the bot
     * @var ChatShared|null
     */
    protected ?ChatShared $chatShared = null;

    /**
     * Connected Website
     *
     * Optional. The domain name of the website on which the user has logged in. More about Telegram Login »
     * @var string|null
     */
    protected ?string $connectedWebsite = null;

    /**
     * Write Access Allowed
     *
     * Optional. Service message: the user allowed the bot added to the attachment menu to write messages
     * @var WriteAccessAllowed|null
     */
    protected ?WriteAccessAllowed $writeAccessAllowed = null;

    /**
     * Passport Data
     *
     * Optional. Telegram Passport data
     * @var PassportData|null
     */
    protected ?PassportData $passportData = null;

    /**
     * Proximity Alert Triggered
     *
     * Optional. Service message. A user in the chat triggered another user's proximity alert while sharing Live Location.
     * @var ProximityAlertTriggered|null
     */
    protected ?ProximityAlertTriggered $proximityAlertTriggered = null;

    /**
     * Forum Topic Created
     *
     * Optional. Service message: forum topic created
     * @var ForumTopicCreated|null
     */
    protected ?ForumTopicCreated $forumTopicCreated = null;

    /**
     * Forum Topic Edited
     *
     * Optional. Service message: forum topic edited
     * @var ForumTopicEdited|null
     */
    protected ?ForumTopicEdited $forumTopicEdited = null;

    /**
     * Forum Topic Closed
     *
     * Optional. Service message: forum topic closed
     * @var ForumTopicClosed|null
     */
    protected ?ForumTopicClosed $forumTopicClosed = null;

    /**
     * Forum Topic Reopened
     *
     * Optional. Service message: forum topic reopened
     * @var ForumTopicReopened|null
     */
    protected ?ForumTopicReopened $forumTopicReopened = null;

    /**
     * General Forum Topic Hidden
     *
     * Optional. Service message: the 'General' forum topic hidden
     * @var GeneralForumTopicHidden|null
     */
    protected ?GeneralForumTopicHidden $generalForumTopicHidden = null;

    /**
     * General Forum Topic Unhidden
     *
     * Optional. Service message: the 'General' forum topic unhidden
     * @var GeneralForumTopicUnhidden|null
     */
    protected ?GeneralForumTopicUnhidden $generalForumTopicUnhidden = null;

    /**
     * Video Chat Scheduled
     *
     * Optional. Service message: video chat scheduled
     * @var VideoChatScheduled|null
     */
    protected ?VideoChatScheduled $videoChatScheduled = null;

    /**
     * Video Chat Started
     *
     * Optional. Service message: video chat started
     * @var VideoChatStarted|null
     */
    protected ?VideoChatStarted $videoChatStarted = null;

    /**
     * Video Chat Ended
     *
     * Optional. Service message: video chat ended
     * @var VideoChatEnded|null
     */
    protected ?VideoChatEnded $videoChatEnded = null;

    /**
     * Video Chat Participants Invited
     *
     * Optional. Service message: new participants invited to a video chat
     * @var VideoChatParticipantsInvited|null
     */
    protected ?VideoChatParticipantsInvited $videoChatParticipantsInvited = null;

    /**
     * Web App Data
     *
     * Optional. Service message: data sent by a Web App
     * @var WebAppData|null
     */
    protected ?WebAppData $webAppData = null;

    /**
     * Reply Markup
     *
     * Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup = null;


    public function __construct(array $data) {
        if (isset($data['message_id'])) {
            $this->messageId = $data['message_id'];
        }
        if (isset($data['message_thread_id'])) {
            $this->messageThreadId = $data['message_thread_id'];
        }
        if (isset($data['from'])) {
            $this->from = new User($data['from']);
        }
        if (isset($data['sender_chat'])) {
            $this->senderChat = new Chat($data['sender_chat']);
        }
        if (isset($data['date'])) {
            $this->date = $data['date'];
        }
        if (isset($data['chat'])) {
            $this->chat = new Chat($data['chat']);
        }
        if (isset($data['forward_from'])) {
            $this->forwardFrom = new User($data['forward_from']);
        }
        if (isset($data['forward_from_chat'])) {
            $this->forwardFromChat = new Chat($data['forward_from_chat']);
        }
        if (isset($data['forward_from_message_id'])) {
            $this->forwardFromMessageId = $data['forward_from_message_id'];
        }
        if (isset($data['forward_signature'])) {
            $this->forwardSignature = $data['forward_signature'];
        }
        if (isset($data['forward_sender_name'])) {
            $this->forwardSenderName = $data['forward_sender_name'];
        }
        if (isset($data['forward_date'])) {
            $this->forwardDate = $data['forward_date'];
        }
        if (isset($data['is_topic_message'])) {
            $this->isTopicMessage = $data['is_topic_message'];
        }
        if (isset($data['is_automatic_forward'])) {
            $this->isAutomaticForward = $data['is_automatic_forward'];
        }
        if (isset($data['reply_to_message'])) {
            $this->replyToMessage = new Message($data['reply_to_message']);
        }
        if (isset($data['via_bot'])) {
            $this->viaBot = new User($data['via_bot']);
        }
        if (isset($data['edit_date'])) {
            $this->editDate = $data['edit_date'];
        }
        if (isset($data['has_protected_content'])) {
            $this->hasProtectedContent = $data['has_protected_content'];
        }
        if (isset($data['media_group_id'])) {
            $this->mediaGroupId = $data['media_group_id'];
        }
        if (isset($data['author_signature'])) {
            $this->authorSignature = $data['author_signature'];
        }
        if (isset($data['text'])) {
            $this->text = $data['text'];
        }
        if (isset($data['entities'])) {
            $this->entities = [];
            foreach ($data['entities'] as $item) {
                $this->entities[] = new MessageEntity($item);
            }
        }
        if (isset($data['animation'])) {
            $this->animation = new Animation($data['animation']);
        }
        if (isset($data['audio'])) {
            $this->audio = new Audio($data['audio']);
        }
        if (isset($data['document'])) {
            $this->document = new Document($data['document']);
        }
        if (isset($data['photo'])) {
            $this->photo = [];
            foreach ($data['photo'] as $item) {
                $this->photo[] = new PhotoSize($item);
            }
        }
        if (isset($data['sticker'])) {
            $this->sticker = new Sticker($data['sticker']);
        }
        if (isset($data['video'])) {
            $this->video = new Video($data['video']);
        }
        if (isset($data['video_note'])) {
            $this->videoNote = new VideoNote($data['video_note']);
        }
        if (isset($data['voice'])) {
            $this->voice = new Voice($data['voice']);
        }
        if (isset($data['caption'])) {
            $this->caption = $data['caption'];
        }
        if (isset($data['caption_entities'])) {
            $this->captionEntities = [];
            foreach ($data['caption_entities'] as $item) {
                $this->captionEntities[] = new MessageEntity($item);
            }
        }
        if (isset($data['has_media_spoiler'])) {
            $this->hasMediaSpoiler = $data['has_media_spoiler'];
        }
        if (isset($data['contact'])) {
            $this->contact = new Contact($data['contact']);
        }
        if (isset($data['dice'])) {
            $this->dice = new Dice($data['dice']);
        }
        if (isset($data['game'])) {
            $this->game = new Game($data['game']);
        }
        if (isset($data['poll'])) {
            $this->poll = new Poll($data['poll']);
        }
        if (isset($data['venue'])) {
            $this->venue = new Venue($data['venue']);
        }
        if (isset($data['location'])) {
            $this->location = new Location($data['location']);
        }
        if (isset($data['new_chat_members'])) {
            $this->newChatMembers = [];
            foreach ($data['new_chat_members'] as $item) {
                $this->newChatMembers[] = new User($item);
            }
        }
        if (isset($data['left_chat_member'])) {
            $this->leftChatMember = new User($data['left_chat_member']);
        }
        if (isset($data['new_chat_title'])) {
            $this->newChatTitle = $data['new_chat_title'];
        }
        if (isset($data['new_chat_photo'])) {
            $this->newChatPhoto = [];
            foreach ($data['new_chat_photo'] as $item) {
                $this->newChatPhoto[] = new PhotoSize($item);
            }
        }
        if (isset($data['delete_chat_photo'])) {
            $this->deleteChatPhoto = $data['delete_chat_photo'];
        }
        if (isset($data['group_chat_created'])) {
            $this->groupChatCreated = $data['group_chat_created'];
        }
        if (isset($data['supergroup_chat_created'])) {
            $this->supergroupChatCreated = $data['supergroup_chat_created'];
        }
        if (isset($data['channel_chat_created'])) {
            $this->channelChatCreated = $data['channel_chat_created'];
        }
        if (isset($data['message_auto_delete_timer_changed'])) {
            $this->messageAutoDeleteTimerChanged = new MessageAutoDeleteTimerChanged($data['message_auto_delete_timer_changed']);
        }
        if (isset($data['migrate_to_chat_id'])) {
            $this->migrateToChatId = $data['migrate_to_chat_id'];
        }
        if (isset($data['migrate_from_chat_id'])) {
            $this->migrateFromChatId = $data['migrate_from_chat_id'];
        }
        if (isset($data['pinned_message'])) {
            $this->pinnedMessage = new Message($data['pinned_message']);
        }
        if (isset($data['invoice'])) {
            $this->invoice = new Invoice($data['invoice']);
        }
        if (isset($data['successful_payment'])) {
            $this->successfulPayment = new SuccessfulPayment($data['successful_payment']);
        }
        if (isset($data['user_shared'])) {
            $this->userShared = new UserShared($data['user_shared']);
        }
        if (isset($data['chat_shared'])) {
            $this->chatShared = new ChatShared($data['chat_shared']);
        }
        if (isset($data['connected_website'])) {
            $this->connectedWebsite = $data['connected_website'];
        }
        if (isset($data['write_access_allowed'])) {
            $this->writeAccessAllowed = new WriteAccessAllowed($data['write_access_allowed']);
        }
        if (isset($data['passport_data'])) {
            $this->passportData = new PassportData($data['passport_data']);
        }
        if (isset($data['proximity_alert_triggered'])) {
            $this->proximityAlertTriggered = new ProximityAlertTriggered($data['proximity_alert_triggered']);
        }
        if (isset($data['forum_topic_created'])) {
            $this->forumTopicCreated = new ForumTopicCreated($data['forum_topic_created']);
        }
        if (isset($data['forum_topic_edited'])) {
            $this->forumTopicEdited = new ForumTopicEdited($data['forum_topic_edited']);
        }
        if (isset($data['forum_topic_closed'])) {
            $this->forumTopicClosed = new ForumTopicClosed($data['forum_topic_closed']);
        }
        if (isset($data['forum_topic_reopened'])) {
            $this->forumTopicReopened = new ForumTopicReopened($data['forum_topic_reopened']);
        }
        if (isset($data['general_forum_topic_hidden'])) {
            $this->generalForumTopicHidden = new GeneralForumTopicHidden($data['general_forum_topic_hidden']);
        }
        if (isset($data['general_forum_topic_unhidden'])) {
            $this->generalForumTopicUnhidden = new GeneralForumTopicUnhidden($data['general_forum_topic_unhidden']);
        }
        if (isset($data['video_chat_scheduled'])) {
            $this->videoChatScheduled = new VideoChatScheduled($data['video_chat_scheduled']);
        }
        if (isset($data['video_chat_started'])) {
            $this->videoChatStarted = new VideoChatStarted($data['video_chat_started']);
        }
        if (isset($data['video_chat_ended'])) {
            $this->videoChatEnded = new VideoChatEnded($data['video_chat_ended']);
        }
        if (isset($data['video_chat_participants_invited'])) {
            $this->videoChatParticipantsInvited = new VideoChatParticipantsInvited($data['video_chat_participants_invited']);
        }
        if (isset($data['web_app_data'])) {
            $this->webAppData = new WebAppData($data['web_app_data']);
        }
        if (isset($data['reply_markup'])) {
            $this->replyMarkup = new InlineKeyboardMarkup($data['reply_markup']);
        }
    }

    public function getMessageId(): int {
        return $this->messageId;
    }

    public function getMessageThreadId(): ?int {
        return $this->messageThreadId;
    }

    public function getFrom(): ?User {
        return $this->from;
    }

    public function getSenderChat(): ?Chat {
        return $this->senderChat;
    }

    public function getDate(): int {
        return $this->date;
    }

    public function getChat(): Chat {
        return $this->chat;
    }

    public function getForwardFrom(): ?User {
        return $this->forwardFrom;
    }

    public function getForwardFromChat(): ?Chat {
        return $this->forwardFromChat;
    }

    public function getForwardFromMessageId(): ?int {
        return $this->forwardFromMessageId;
    }

    public function getForwardSignature(): ?string {
        return $this->forwardSignature;
    }

    public function getForwardSenderName(): ?string {
        return $this->forwardSenderName;
    }

    public function getForwardDate(): ?int {
        return $this->forwardDate;
    }

    public function getIsTopicMessage(): ?bool {
        return $this->isTopicMessage;
    }

    public function getIsAutomaticForward(): ?bool {
        return $this->isAutomaticForward;
    }

    public function getReplyToMessage(): ?Message {
        return $this->replyToMessage;
    }

    public function getViaBot(): ?User {
        return $this->viaBot;
    }

    public function getEditDate(): ?int {
        return $this->editDate;
    }

    public function getHasProtectedContent(): ?bool {
        return $this->hasProtectedContent;
    }

    public function getMediaGroupId(): ?string {
        return $this->mediaGroupId;
    }

    public function getAuthorSignature(): ?string {
        return $this->authorSignature;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function getEntities(): ?array {
        return $this->entities;
    }

    public function getAnimation(): ?Animation {
        return $this->animation;
    }

    public function getAudio(): ?Audio {
        return $this->audio;
    }

    public function getDocument(): ?Document {
        return $this->document;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function getSticker(): ?Sticker {
        return $this->sticker;
    }

    public function getVideo(): ?Video {
        return $this->video;
    }

    public function getVideoNote(): ?VideoNote {
        return $this->videoNote;
    }

    public function getVoice(): ?Voice {
        return $this->voice;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function getCaptionEntities(): ?array {
        return $this->captionEntities;
    }

    public function getHasMediaSpoiler(): ?bool {
        return $this->hasMediaSpoiler;
    }

    public function getContact(): ?Contact {
        return $this->contact;
    }

    public function getDice(): ?Dice {
        return $this->dice;
    }

    public function getGame(): ?Game {
        return $this->game;
    }

    public function getPoll(): ?Poll {
        return $this->poll;
    }

    public function getVenue(): ?Venue {
        return $this->venue;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function getNewChatMembers(): ?array {
        return $this->newChatMembers;
    }

    public function getLeftChatMember(): ?User {
        return $this->leftChatMember;
    }

    public function getNewChatTitle(): ?string {
        return $this->newChatTitle;
    }

    public function getNewChatPhoto(): ?array {
        return $this->newChatPhoto;
    }

    public function getDeleteChatPhoto(): ?bool {
        return $this->deleteChatPhoto;
    }

    public function getGroupChatCreated(): ?bool {
        return $this->groupChatCreated;
    }

    public function getSupergroupChatCreated(): ?bool {
        return $this->supergroupChatCreated;
    }

    public function getChannelChatCreated(): ?bool {
        return $this->channelChatCreated;
    }

    public function getMessageAutoDeleteTimerChanged(): ?MessageAutoDeleteTimerChanged {
        return $this->messageAutoDeleteTimerChanged;
    }

    public function getMigrateToChatId(): ?int {
        return $this->migrateToChatId;
    }

    public function getMigrateFromChatId(): ?int {
        return $this->migrateFromChatId;
    }

    public function getPinnedMessage(): ?Message {
        return $this->pinnedMessage;
    }

    public function getInvoice(): ?Invoice {
        return $this->invoice;
    }

    public function getSuccessfulPayment(): ?SuccessfulPayment {
        return $this->successfulPayment;
    }

    public function getUserShared(): ?UserShared {
        return $this->userShared;
    }

    public function getChatShared(): ?ChatShared {
        return $this->chatShared;
    }

    public function getConnectedWebsite(): ?string {
        return $this->connectedWebsite;
    }

    public function getWriteAccessAllowed(): ?WriteAccessAllowed {
        return $this->writeAccessAllowed;
    }

    public function getPassportData(): ?PassportData {
        return $this->passportData;
    }

    public function getProximityAlertTriggered(): ?ProximityAlertTriggered {
        return $this->proximityAlertTriggered;
    }

    public function getForumTopicCreated(): ?ForumTopicCreated {
        return $this->forumTopicCreated;
    }

    public function getForumTopicEdited(): ?ForumTopicEdited {
        return $this->forumTopicEdited;
    }

    public function getForumTopicClosed(): ?ForumTopicClosed {
        return $this->forumTopicClosed;
    }

    public function getForumTopicReopened(): ?ForumTopicReopened {
        return $this->forumTopicReopened;
    }

    public function getGeneralForumTopicHidden(): ?GeneralForumTopicHidden {
        return $this->generalForumTopicHidden;
    }

    public function getGeneralForumTopicUnhidden(): ?GeneralForumTopicUnhidden {
        return $this->generalForumTopicUnhidden;
    }

    public function getVideoChatScheduled(): ?VideoChatScheduled {
        return $this->videoChatScheduled;
    }

    public function getVideoChatStarted(): ?VideoChatStarted {
        return $this->videoChatStarted;
    }

    public function getVideoChatEnded(): ?VideoChatEnded {
        return $this->videoChatEnded;
    }

    public function getVideoChatParticipantsInvited(): ?VideoChatParticipantsInvited {
        return $this->videoChatParticipantsInvited;
    }

    public function getWebAppData(): ?WebAppData {
        return $this->webAppData;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }


}
