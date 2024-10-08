<?php

namespace Yabx\Telegram\Objects;

final class Message extends AbstractObject {

    /**
     * Message Id
     *
     * Unique message identifier inside this chat
     * @var int|null
     */
    protected ?int $messageId = null;

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
     * Optional. Sender of the message; may be empty for messages sent to channels. For backward compatibility, if the message was sent on behalf of a chat, the field contains a fake sender user in non-channel chats
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * Sender Chat
     *
     * Optional. Sender of the message when sent on behalf of a chat. For example, the supergroup itself for messages sent by its anonymous administrators or a linked channel for messages automatically forwarded to the channel's discussion group. For backward compatibility, if the message was sent on behalf of a chat, the field from contains a fake sender user in non-channel chats.
     * @var Chat|null
     */
    protected ?Chat $senderChat = null;

    /**
     * Sender Boost Count
     *
     * Optional. If the sender of the message boosted the chat, the number of boosts added by the user
     * @var int|null
     */
    protected ?int $senderBoostCount = null;

    /**
     * Sender Business Bot
     *
     * Optional. The bot that actually sent the message on behalf of the business account. Available only for outgoing messages sent on behalf of the connected business account.
     * @var User|null
     */
    protected ?User $senderBusinessBot = null;

    /**
     * Date
     *
     * Date the message was sent in Unix time. It is always a positive number, representing a valid date.
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Business Connection Id
     *
     * Optional. Unique identifier of the business connection from which the message was received. If non-empty, the message belongs to a chat of the corresponding business account that is independent from any potential bot chat which might share the same identifier.
     * @var string|null
     */
    protected ?string $businessConnectionId = null;

    /**
     * Chat
     *
     * Chat the message belongs to
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Forward Origin
     *
     * Optional. Information about the original message for forwarded messages
     * @var MessageOrigin|null
     */
    protected ?MessageOrigin $forwardOrigin = null;

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
     * Optional. For replies in the same chat and message thread, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $replyToMessage = null;

    /**
     * External Reply
     *
     * Optional. Information about the message that is being replied to, which may come from another chat or forum topic
     * @var ExternalReplyInfo|null
     */
    protected ?ExternalReplyInfo $externalReply = null;

    /**
     * Quote
     *
     * Optional. For replies that quote part of the original message, the quoted part of the message
     * @var TextQuote|null
     */
    protected ?TextQuote $quote = null;

    /**
     * Reply To Story
     *
     * Optional. For replies to a story, the original story
     * @var Story|null
     */
    protected ?Story $replyToStory = null;

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
     * Is From Offline
     *
     * Optional. True, if the message was sent by an implicit action, for example, as an away or a greeting business message, or as a scheduled message
     * @var bool|null
     */
    protected ?bool $isFromOffline = null;

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
     * Link Preview Options
     *
     * Optional. Options used for link preview generation for the message, if it is a text message and link preview options were changed
     * @var LinkPreviewOptions|null
     */
    protected ?LinkPreviewOptions $linkPreviewOptions = null;

    /**
     * Effect Id
     *
     * Optional. Unique identifier of the message effect added to the message
     * @var string|null
     */
    protected ?string $effectId = null;

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
     * Paid Media
     *
     * Optional. Message contains paid media; information about the paid media
     * @var PaidMediaInfo|null
     */
    protected ?PaidMediaInfo $paidMedia = null;

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
     * Story
     *
     * Optional. Message is a forwarded story
     * @var Story|null
     */
    protected ?Story $story = null;

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
     * Optional. Caption for the animation, audio, document, paid media, photo, video or voice
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
     * Show Caption Above Media
     *
     * Optional. True, if the caption must be shown above the message media
     * @var bool|null
     */
    protected ?bool $showCaptionAboveMedia = null;

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
     * Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     * @var MaybeInaccessibleMessage|null
     */
    protected ?MaybeInaccessibleMessage $pinnedMessage = null;

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
     * Refunded Payment
     *
     * Optional. Message is a service message about a refunded payment, information about the payment. More about payments »
     * @var RefundedPayment|null
     */
    protected ?RefundedPayment $refundedPayment = null;

    /**
     * Users Shared
     *
     * Optional. Service message: users were shared with the bot
     * @var UsersShared|null
     */
    protected ?UsersShared $usersShared = null;

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
     * Optional. Service message: the user allowed the bot to write messages after adding it to the attachment or side menu, launching a Web App from a link, or accepting an explicit request from a Web App sent by the method requestWriteAccess
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
     * Boost Added
     *
     * Optional. Service message: user boosted the chat
     * @var ChatBoostAdded|null
     */
    protected ?ChatBoostAdded $boostAdded = null;

    /**
     * Chat Background Set
     *
     * Optional. Service message: chat background set
     * @var ChatBackground|null
     */
    protected ?ChatBackground $chatBackgroundSet = null;

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
     * Giveaway Created
     *
     * Optional. Service message: a scheduled giveaway was created
     * @var GiveawayCreated|null
     */
    protected ?GiveawayCreated $giveawayCreated = null;

    /**
     * Giveaway
     *
     * Optional. The message is a scheduled giveaway message
     * @var Giveaway|null
     */
    protected ?Giveaway $giveaway = null;

    /**
     * Giveaway Winners
     *
     * Optional. A giveaway with public winners was completed
     * @var GiveawayWinners|null
     */
    protected ?GiveawayWinners $giveawayWinners = null;

    /**
     * Giveaway Completed
     *
     * Optional. Service message: a giveaway without public winners was completed
     * @var GiveawayCompleted|null
     */
    protected ?GiveawayCompleted $giveawayCompleted = null;

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

    public function __construct(
        ?int                           $messageId = null,
        ?int                           $messageThreadId = null,
        ?User                          $from = null,
        ?Chat                          $senderChat = null,
        ?int                           $senderBoostCount = null,
        ?User                          $senderBusinessBot = null,
        ?int                           $date = null,
        ?string                        $businessConnectionId = null,
        ?Chat                          $chat = null,
        ?MessageOrigin                 $forwardOrigin = null,
        ?bool                          $isTopicMessage = null,
        ?bool                          $isAutomaticForward = null,
        ?Message                       $replyToMessage = null,
        ?ExternalReplyInfo             $externalReply = null,
        ?TextQuote                     $quote = null,
        ?Story                         $replyToStory = null,
        ?User                          $viaBot = null,
        ?int                           $editDate = null,
        ?bool                          $hasProtectedContent = null,
        ?bool                          $isFromOffline = null,
        ?string                        $mediaGroupId = null,
        ?string                        $authorSignature = null,
        ?string                        $text = null,
        ?array                         $entities = null,
        ?LinkPreviewOptions            $linkPreviewOptions = null,
        ?string                        $effectId = null,
        ?Animation                     $animation = null,
        ?Audio                         $audio = null,
        ?Document                      $document = null,
        ?PaidMediaInfo                 $paidMedia = null,
        ?array                         $photo = null,
        ?Sticker                       $sticker = null,
        ?Story                         $story = null,
        ?Video                         $video = null,
        ?VideoNote                     $videoNote = null,
        ?Voice                         $voice = null,
        ?string                        $caption = null,
        ?array                         $captionEntities = null,
        ?bool                          $showCaptionAboveMedia = null,
        ?bool                          $hasMediaSpoiler = null,
        ?Contact                       $contact = null,
        ?Dice                          $dice = null,
        ?Game                          $game = null,
        ?Poll                          $poll = null,
        ?Venue                         $venue = null,
        ?Location                      $location = null,
        ?array                         $newChatMembers = null,
        ?User                          $leftChatMember = null,
        ?string                        $newChatTitle = null,
        ?array                         $newChatPhoto = null,
        ?bool                          $deleteChatPhoto = null,
        ?bool                          $groupChatCreated = null,
        ?bool                          $supergroupChatCreated = null,
        ?bool                          $channelChatCreated = null,
        ?MessageAutoDeleteTimerChanged $messageAutoDeleteTimerChanged = null,
        ?int                           $migrateToChatId = null,
        ?int                           $migrateFromChatId = null,
        ?MaybeInaccessibleMessage      $pinnedMessage = null,
        ?Invoice                       $invoice = null,
        ?SuccessfulPayment             $successfulPayment = null,
        ?RefundedPayment               $refundedPayment = null,
        ?UsersShared                   $usersShared = null,
        ?ChatShared                    $chatShared = null,
        ?string                        $connectedWebsite = null,
        ?WriteAccessAllowed            $writeAccessAllowed = null,
        ?PassportData                  $passportData = null,
        ?ProximityAlertTriggered       $proximityAlertTriggered = null,
        ?ChatBoostAdded                $boostAdded = null,
        ?ChatBackground                $chatBackgroundSet = null,
        ?ForumTopicCreated             $forumTopicCreated = null,
        ?ForumTopicEdited              $forumTopicEdited = null,
        ?ForumTopicClosed              $forumTopicClosed = null,
        ?ForumTopicReopened            $forumTopicReopened = null,
        ?GeneralForumTopicHidden       $generalForumTopicHidden = null,
        ?GeneralForumTopicUnhidden     $generalForumTopicUnhidden = null,
        ?GiveawayCreated               $giveawayCreated = null,
        ?Giveaway                      $giveaway = null,
        ?GiveawayWinners               $giveawayWinners = null,
        ?GiveawayCompleted             $giveawayCompleted = null,
        ?VideoChatScheduled            $videoChatScheduled = null,
        ?VideoChatStarted              $videoChatStarted = null,
        ?VideoChatEnded                $videoChatEnded = null,
        ?VideoChatParticipantsInvited  $videoChatParticipantsInvited = null,
        ?WebAppData                    $webAppData = null,
        ?InlineKeyboardMarkup          $replyMarkup = null,
    ) {
        $this->messageId = $messageId;
        $this->messageThreadId = $messageThreadId;
        $this->from = $from;
        $this->senderChat = $senderChat;
        $this->senderBoostCount = $senderBoostCount;
        $this->senderBusinessBot = $senderBusinessBot;
        $this->date = $date;
        $this->businessConnectionId = $businessConnectionId;
        $this->chat = $chat;
        $this->forwardOrigin = $forwardOrigin;
        $this->isTopicMessage = $isTopicMessage;
        $this->isAutomaticForward = $isAutomaticForward;
        $this->replyToMessage = $replyToMessage;
        $this->externalReply = $externalReply;
        $this->quote = $quote;
        $this->replyToStory = $replyToStory;
        $this->viaBot = $viaBot;
        $this->editDate = $editDate;
        $this->hasProtectedContent = $hasProtectedContent;
        $this->isFromOffline = $isFromOffline;
        $this->mediaGroupId = $mediaGroupId;
        $this->authorSignature = $authorSignature;
        $this->text = $text;
        $this->entities = $entities;
        $this->linkPreviewOptions = $linkPreviewOptions;
        $this->effectId = $effectId;
        $this->animation = $animation;
        $this->audio = $audio;
        $this->document = $document;
        $this->paidMedia = $paidMedia;
        $this->photo = $photo;
        $this->sticker = $sticker;
        $this->story = $story;
        $this->video = $video;
        $this->videoNote = $videoNote;
        $this->voice = $voice;
        $this->caption = $caption;
        $this->captionEntities = $captionEntities;
        $this->showCaptionAboveMedia = $showCaptionAboveMedia;
        $this->hasMediaSpoiler = $hasMediaSpoiler;
        $this->contact = $contact;
        $this->dice = $dice;
        $this->game = $game;
        $this->poll = $poll;
        $this->venue = $venue;
        $this->location = $location;
        $this->newChatMembers = $newChatMembers;
        $this->leftChatMember = $leftChatMember;
        $this->newChatTitle = $newChatTitle;
        $this->newChatPhoto = $newChatPhoto;
        $this->deleteChatPhoto = $deleteChatPhoto;
        $this->groupChatCreated = $groupChatCreated;
        $this->supergroupChatCreated = $supergroupChatCreated;
        $this->channelChatCreated = $channelChatCreated;
        $this->messageAutoDeleteTimerChanged = $messageAutoDeleteTimerChanged;
        $this->migrateToChatId = $migrateToChatId;
        $this->migrateFromChatId = $migrateFromChatId;
        $this->pinnedMessage = $pinnedMessage;
        $this->invoice = $invoice;
        $this->successfulPayment = $successfulPayment;
        $this->refundedPayment = $refundedPayment;
        $this->usersShared = $usersShared;
        $this->chatShared = $chatShared;
        $this->connectedWebsite = $connectedWebsite;
        $this->writeAccessAllowed = $writeAccessAllowed;
        $this->passportData = $passportData;
        $this->proximityAlertTriggered = $proximityAlertTriggered;
        $this->boostAdded = $boostAdded;
        $this->chatBackgroundSet = $chatBackgroundSet;
        $this->forumTopicCreated = $forumTopicCreated;
        $this->forumTopicEdited = $forumTopicEdited;
        $this->forumTopicClosed = $forumTopicClosed;
        $this->forumTopicReopened = $forumTopicReopened;
        $this->generalForumTopicHidden = $generalForumTopicHidden;
        $this->generalForumTopicUnhidden = $generalForumTopicUnhidden;
        $this->giveawayCreated = $giveawayCreated;
        $this->giveaway = $giveaway;
        $this->giveawayWinners = $giveawayWinners;
        $this->giveawayCompleted = $giveawayCompleted;
        $this->videoChatScheduled = $videoChatScheduled;
        $this->videoChatStarted = $videoChatStarted;
        $this->videoChatEnded = $videoChatEnded;
        $this->videoChatParticipantsInvited = $videoChatParticipantsInvited;
        $this->webAppData = $webAppData;
        $this->replyMarkup = $replyMarkup;
    }

    public static function fromArray(array $data): Message {
        $instance = new self();
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        if (isset($data['message_thread_id'])) {
            $instance->messageThreadId = $data['message_thread_id'];
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['sender_chat'])) {
            $instance->senderChat = Chat::fromArray($data['sender_chat']);
        }
        if (isset($data['sender_boost_count'])) {
            $instance->senderBoostCount = $data['sender_boost_count'];
        }
        if (isset($data['sender_business_bot'])) {
            $instance->senderBusinessBot = User::fromArray($data['sender_business_bot']);
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['business_connection_id'])) {
            $instance->businessConnectionId = $data['business_connection_id'];
        }
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['forward_origin'])) {
            $instance->forwardOrigin = MessageOrigin::fromArray($data['forward_origin']);
        }
        if (isset($data['is_topic_message'])) {
            $instance->isTopicMessage = $data['is_topic_message'];
        }
        if (isset($data['is_automatic_forward'])) {
            $instance->isAutomaticForward = $data['is_automatic_forward'];
        }
        if (isset($data['reply_to_message'])) {
            $instance->replyToMessage = Message::fromArray($data['reply_to_message']);
        }
        if (isset($data['external_reply'])) {
            $instance->externalReply = ExternalReplyInfo::fromArray($data['external_reply']);
        }
        if (isset($data['quote'])) {
            $instance->quote = TextQuote::fromArray($data['quote']);
        }
        if (isset($data['reply_to_story'])) {
            $instance->replyToStory = Story::fromArray($data['reply_to_story']);
        }
        if (isset($data['via_bot'])) {
            $instance->viaBot = User::fromArray($data['via_bot']);
        }
        if (isset($data['edit_date'])) {
            $instance->editDate = $data['edit_date'];
        }
        if (isset($data['has_protected_content'])) {
            $instance->hasProtectedContent = $data['has_protected_content'];
        }
        if (isset($data['is_from_offline'])) {
            $instance->isFromOffline = $data['is_from_offline'];
        }
        if (isset($data['media_group_id'])) {
            $instance->mediaGroupId = $data['media_group_id'];
        }
        if (isset($data['author_signature'])) {
            $instance->authorSignature = $data['author_signature'];
        }
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['entities'])) {
            $instance->entities = [];
            foreach ($data['entities'] as $item) {
                $instance->entities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['link_preview_options'])) {
            $instance->linkPreviewOptions = LinkPreviewOptions::fromArray($data['link_preview_options']);
        }
        if (isset($data['effect_id'])) {
            $instance->effectId = $data['effect_id'];
        }
        if (isset($data['animation'])) {
            $instance->animation = Animation::fromArray($data['animation']);
        }
        if (isset($data['audio'])) {
            $instance->audio = Audio::fromArray($data['audio']);
        }
        if (isset($data['document'])) {
            $instance->document = Document::fromArray($data['document']);
        }
        if (isset($data['paid_media'])) {
            $instance->paidMedia = PaidMediaInfo::fromArray($data['paid_media']);
        }
        if (isset($data['photo'])) {
            $instance->photo = [];
            foreach ($data['photo'] as $item) {
                $instance->photo[] = PhotoSize::fromArray($item);
            }
        }
        if (isset($data['sticker'])) {
            $instance->sticker = Sticker::fromArray($data['sticker']);
        }
        if (isset($data['story'])) {
            $instance->story = Story::fromArray($data['story']);
        }
        if (isset($data['video'])) {
            $instance->video = Video::fromArray($data['video']);
        }
        if (isset($data['video_note'])) {
            $instance->videoNote = VideoNote::fromArray($data['video_note']);
        }
        if (isset($data['voice'])) {
            $instance->voice = Voice::fromArray($data['voice']);
        }
        if (isset($data['caption'])) {
            $instance->caption = $data['caption'];
        }
        if (isset($data['caption_entities'])) {
            $instance->captionEntities = [];
            foreach ($data['caption_entities'] as $item) {
                $instance->captionEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['show_caption_above_media'])) {
            $instance->showCaptionAboveMedia = $data['show_caption_above_media'];
        }
        if (isset($data['has_media_spoiler'])) {
            $instance->hasMediaSpoiler = $data['has_media_spoiler'];
        }
        if (isset($data['contact'])) {
            $instance->contact = Contact::fromArray($data['contact']);
        }
        if (isset($data['dice'])) {
            $instance->dice = Dice::fromArray($data['dice']);
        }
        if (isset($data['game'])) {
            $instance->game = Game::fromArray($data['game']);
        }
        if (isset($data['poll'])) {
            $instance->poll = Poll::fromArray($data['poll']);
        }
        if (isset($data['venue'])) {
            $instance->venue = Venue::fromArray($data['venue']);
        }
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
        }
        if (isset($data['new_chat_members'])) {
            $instance->newChatMembers = [];
            foreach ($data['new_chat_members'] as $item) {
                $instance->newChatMembers[] = User::fromArray($item);
            }
        }
        if (isset($data['left_chat_member'])) {
            $instance->leftChatMember = User::fromArray($data['left_chat_member']);
        }
        if (isset($data['new_chat_title'])) {
            $instance->newChatTitle = $data['new_chat_title'];
        }
        if (isset($data['new_chat_photo'])) {
            $instance->newChatPhoto = [];
            foreach ($data['new_chat_photo'] as $item) {
                $instance->newChatPhoto[] = PhotoSize::fromArray($item);
            }
        }
        if (isset($data['delete_chat_photo'])) {
            $instance->deleteChatPhoto = $data['delete_chat_photo'];
        }
        if (isset($data['group_chat_created'])) {
            $instance->groupChatCreated = $data['group_chat_created'];
        }
        if (isset($data['supergroup_chat_created'])) {
            $instance->supergroupChatCreated = $data['supergroup_chat_created'];
        }
        if (isset($data['channel_chat_created'])) {
            $instance->channelChatCreated = $data['channel_chat_created'];
        }
        if (isset($data['message_auto_delete_timer_changed'])) {
            $instance->messageAutoDeleteTimerChanged = MessageAutoDeleteTimerChanged::fromArray($data['message_auto_delete_timer_changed']);
        }
        if (isset($data['migrate_to_chat_id'])) {
            $instance->migrateToChatId = $data['migrate_to_chat_id'];
        }
        if (isset($data['migrate_from_chat_id'])) {
            $instance->migrateFromChatId = $data['migrate_from_chat_id'];
        }
        if (isset($data['pinned_message'])) {
            $instance->pinnedMessage = MaybeInaccessibleMessage::fromArray($data['pinned_message']);
        }
        if (isset($data['invoice'])) {
            $instance->invoice = Invoice::fromArray($data['invoice']);
        }
        if (isset($data['successful_payment'])) {
            $instance->successfulPayment = SuccessfulPayment::fromArray($data['successful_payment']);
        }
        if (isset($data['refunded_payment'])) {
            $instance->refundedPayment = RefundedPayment::fromArray($data['refunded_payment']);
        }
        if (isset($data['users_shared'])) {
            $instance->usersShared = UsersShared::fromArray($data['users_shared']);
        }
        if (isset($data['chat_shared'])) {
            $instance->chatShared = ChatShared::fromArray($data['chat_shared']);
        }
        if (isset($data['connected_website'])) {
            $instance->connectedWebsite = $data['connected_website'];
        }
        if (isset($data['write_access_allowed'])) {
            $instance->writeAccessAllowed = WriteAccessAllowed::fromArray($data['write_access_allowed']);
        }
        if (isset($data['passport_data'])) {
            $instance->passportData = PassportData::fromArray($data['passport_data']);
        }
        if (isset($data['proximity_alert_triggered'])) {
            $instance->proximityAlertTriggered = ProximityAlertTriggered::fromArray($data['proximity_alert_triggered']);
        }
        if (isset($data['boost_added'])) {
            $instance->boostAdded = ChatBoostAdded::fromArray($data['boost_added']);
        }
        if (isset($data['chat_background_set'])) {
            $instance->chatBackgroundSet = ChatBackground::fromArray($data['chat_background_set']);
        }
        if (isset($data['forum_topic_created'])) {
            $instance->forumTopicCreated = ForumTopicCreated::fromArray($data['forum_topic_created']);
        }
        if (isset($data['forum_topic_edited'])) {
            $instance->forumTopicEdited = ForumTopicEdited::fromArray($data['forum_topic_edited']);
        }
        if (isset($data['forum_topic_closed'])) {
            $instance->forumTopicClosed = ForumTopicClosed::fromArray($data['forum_topic_closed']);
        }
        if (isset($data['forum_topic_reopened'])) {
            $instance->forumTopicReopened = ForumTopicReopened::fromArray($data['forum_topic_reopened']);
        }
        if (isset($data['general_forum_topic_hidden'])) {
            $instance->generalForumTopicHidden = GeneralForumTopicHidden::fromArray($data['general_forum_topic_hidden']);
        }
        if (isset($data['general_forum_topic_unhidden'])) {
            $instance->generalForumTopicUnhidden = GeneralForumTopicUnhidden::fromArray($data['general_forum_topic_unhidden']);
        }
        if (isset($data['giveaway_created'])) {
            $instance->giveawayCreated = GiveawayCreated::fromArray($data['giveaway_created']);
        }
        if (isset($data['giveaway'])) {
            $instance->giveaway = Giveaway::fromArray($data['giveaway']);
        }
        if (isset($data['giveaway_winners'])) {
            $instance->giveawayWinners = GiveawayWinners::fromArray($data['giveaway_winners']);
        }
        if (isset($data['giveaway_completed'])) {
            $instance->giveawayCompleted = GiveawayCompleted::fromArray($data['giveaway_completed']);
        }
        if (isset($data['video_chat_scheduled'])) {
            $instance->videoChatScheduled = VideoChatScheduled::fromArray($data['video_chat_scheduled']);
        }
        if (isset($data['video_chat_started'])) {
            $instance->videoChatStarted = VideoChatStarted::fromArray($data['video_chat_started']);
        }
        if (isset($data['video_chat_ended'])) {
            $instance->videoChatEnded = VideoChatEnded::fromArray($data['video_chat_ended']);
        }
        if (isset($data['video_chat_participants_invited'])) {
            $instance->videoChatParticipantsInvited = VideoChatParticipantsInvited::fromArray($data['video_chat_participants_invited']);
        }
        if (isset($data['web_app_data'])) {
            $instance->webAppData = WebAppData::fromArray($data['web_app_data']);
        }
        if (isset($data['reply_markup'])) {
            $instance->replyMarkup = InlineKeyboardMarkup::fromArray($data['reply_markup']);
        }
        return $instance;
    }

    public function getMessageId(): ?int {
        return $this->messageId;
    }

    public function setMessageId(?int $value): self {
        $this->messageId = $value;
        return $this;
    }

    public function getMessageThreadId(): ?int {
        return $this->messageThreadId;
    }

    public function setMessageThreadId(?int $value): self {
        $this->messageThreadId = $value;
        return $this;
    }

    public function getFrom(): ?User {
        return $this->from;
    }

    public function setFrom(?User $value): self {
        $this->from = $value;
        return $this;
    }

    public function getSenderChat(): ?Chat {
        return $this->senderChat;
    }

    public function setSenderChat(?Chat $value): self {
        $this->senderChat = $value;
        return $this;
    }

    public function getSenderBoostCount(): ?int {
        return $this->senderBoostCount;
    }

    public function setSenderBoostCount(?int $value): self {
        $this->senderBoostCount = $value;
        return $this;
    }

    public function getSenderBusinessBot(): ?User {
        return $this->senderBusinessBot;
    }

    public function setSenderBusinessBot(?User $value): self {
        $this->senderBusinessBot = $value;
        return $this;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

    public function getBusinessConnectionId(): ?string {
        return $this->businessConnectionId;
    }

    public function setBusinessConnectionId(?string $value): self {
        $this->businessConnectionId = $value;
        return $this;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getForwardOrigin(): ?MessageOrigin {
        return $this->forwardOrigin;
    }

    public function setForwardOrigin(?MessageOrigin $value): self {
        $this->forwardOrigin = $value;
        return $this;
    }

    public function getIsTopicMessage(): ?bool {
        return $this->isTopicMessage;
    }

    public function setIsTopicMessage(?bool $value): self {
        $this->isTopicMessage = $value;
        return $this;
    }

    public function getIsAutomaticForward(): ?bool {
        return $this->isAutomaticForward;
    }

    public function setIsAutomaticForward(?bool $value): self {
        $this->isAutomaticForward = $value;
        return $this;
    }

    public function getReplyToMessage(): ?Message {
        return $this->replyToMessage;
    }

    public function setReplyToMessage(?Message $value): self {
        $this->replyToMessage = $value;
        return $this;
    }

    public function getExternalReply(): ?ExternalReplyInfo {
        return $this->externalReply;
    }

    public function setExternalReply(?ExternalReplyInfo $value): self {
        $this->externalReply = $value;
        return $this;
    }

    public function getQuote(): ?TextQuote {
        return $this->quote;
    }

    public function setQuote(?TextQuote $value): self {
        $this->quote = $value;
        return $this;
    }

    public function getReplyToStory(): ?Story {
        return $this->replyToStory;
    }

    public function setReplyToStory(?Story $value): self {
        $this->replyToStory = $value;
        return $this;
    }

    public function getViaBot(): ?User {
        return $this->viaBot;
    }

    public function setViaBot(?User $value): self {
        $this->viaBot = $value;
        return $this;
    }

    public function getEditDate(): ?int {
        return $this->editDate;
    }

    public function setEditDate(?int $value): self {
        $this->editDate = $value;
        return $this;
    }

    public function getHasProtectedContent(): ?bool {
        return $this->hasProtectedContent;
    }

    public function setHasProtectedContent(?bool $value): self {
        $this->hasProtectedContent = $value;
        return $this;
    }

    public function getIsFromOffline(): ?bool {
        return $this->isFromOffline;
    }

    public function setIsFromOffline(?bool $value): self {
        $this->isFromOffline = $value;
        return $this;
    }

    public function getMediaGroupId(): ?string {
        return $this->mediaGroupId;
    }

    public function setMediaGroupId(?string $value): self {
        $this->mediaGroupId = $value;
        return $this;
    }

    public function getAuthorSignature(): ?string {
        return $this->authorSignature;
    }

    public function setAuthorSignature(?string $value): self {
        $this->authorSignature = $value;
        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $value): self {
        $this->text = $value;
        return $this;
    }

    public function getEntities(): ?array {
        return $this->entities;
    }

    public function setEntities(?array $value): self {
        $this->entities = $value;
        return $this;
    }

    public function getLinkPreviewOptions(): ?LinkPreviewOptions {
        return $this->linkPreviewOptions;
    }

    public function setLinkPreviewOptions(?LinkPreviewOptions $value): self {
        $this->linkPreviewOptions = $value;
        return $this;
    }

    public function getEffectId(): ?string {
        return $this->effectId;
    }

    public function setEffectId(?string $value): self {
        $this->effectId = $value;
        return $this;
    }

    public function getAnimation(): ?Animation {
        return $this->animation;
    }

    public function setAnimation(?Animation $value): self {
        $this->animation = $value;
        return $this;
    }

    public function getAudio(): ?Audio {
        return $this->audio;
    }

    public function setAudio(?Audio $value): self {
        $this->audio = $value;
        return $this;
    }

    public function getDocument(): ?Document {
        return $this->document;
    }

    public function setDocument(?Document $value): self {
        $this->document = $value;
        return $this;
    }

    public function getPaidMedia(): ?PaidMediaInfo {
        return $this->paidMedia;
    }

    public function setPaidMedia(?PaidMediaInfo $value): self {
        $this->paidMedia = $value;
        return $this;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

    public function getSticker(): ?Sticker {
        return $this->sticker;
    }

    public function setSticker(?Sticker $value): self {
        $this->sticker = $value;
        return $this;
    }

    public function getStory(): ?Story {
        return $this->story;
    }

    public function setStory(?Story $value): self {
        $this->story = $value;
        return $this;
    }

    public function getVideo(): ?Video {
        return $this->video;
    }

    public function setVideo(?Video $value): self {
        $this->video = $value;
        return $this;
    }

    public function getVideoNote(): ?VideoNote {
        return $this->videoNote;
    }

    public function setVideoNote(?VideoNote $value): self {
        $this->videoNote = $value;
        return $this;
    }

    public function getVoice(): ?Voice {
        return $this->voice;
    }

    public function setVoice(?Voice $value): self {
        $this->voice = $value;
        return $this;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function setCaption(?string $value): self {
        $this->caption = $value;
        return $this;
    }

    public function getCaptionEntities(): ?array {
        return $this->captionEntities;
    }

    public function setCaptionEntities(?array $value): self {
        $this->captionEntities = $value;
        return $this;
    }

    public function getShowCaptionAboveMedia(): ?bool {
        return $this->showCaptionAboveMedia;
    }

    public function setShowCaptionAboveMedia(?bool $value): self {
        $this->showCaptionAboveMedia = $value;
        return $this;
    }

    public function getHasMediaSpoiler(): ?bool {
        return $this->hasMediaSpoiler;
    }

    public function setHasMediaSpoiler(?bool $value): self {
        $this->hasMediaSpoiler = $value;
        return $this;
    }

    public function getContact(): ?Contact {
        return $this->contact;
    }

    public function setContact(?Contact $value): self {
        $this->contact = $value;
        return $this;
    }

    public function getDice(): ?Dice {
        return $this->dice;
    }

    public function setDice(?Dice $value): self {
        $this->dice = $value;
        return $this;
    }

    public function getGame(): ?Game {
        return $this->game;
    }

    public function setGame(?Game $value): self {
        $this->game = $value;
        return $this;
    }

    public function getPoll(): ?Poll {
        return $this->poll;
    }

    public function setPoll(?Poll $value): self {
        $this->poll = $value;
        return $this;
    }

    public function getVenue(): ?Venue {
        return $this->venue;
    }

    public function setVenue(?Venue $value): self {
        $this->venue = $value;
        return $this;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function setLocation(?Location $value): self {
        $this->location = $value;
        return $this;
    }

    public function getNewChatMembers(): ?array {
        return $this->newChatMembers;
    }

    public function setNewChatMembers(?array $value): self {
        $this->newChatMembers = $value;
        return $this;
    }

    public function getLeftChatMember(): ?User {
        return $this->leftChatMember;
    }

    public function setLeftChatMember(?User $value): self {
        $this->leftChatMember = $value;
        return $this;
    }

    public function getNewChatTitle(): ?string {
        return $this->newChatTitle;
    }

    public function setNewChatTitle(?string $value): self {
        $this->newChatTitle = $value;
        return $this;
    }

    public function getNewChatPhoto(): ?array {
        return $this->newChatPhoto;
    }

    public function setNewChatPhoto(?array $value): self {
        $this->newChatPhoto = $value;
        return $this;
    }

    public function getDeleteChatPhoto(): ?bool {
        return $this->deleteChatPhoto;
    }

    public function setDeleteChatPhoto(?bool $value): self {
        $this->deleteChatPhoto = $value;
        return $this;
    }

    public function getGroupChatCreated(): ?bool {
        return $this->groupChatCreated;
    }

    public function setGroupChatCreated(?bool $value): self {
        $this->groupChatCreated = $value;
        return $this;
    }

    public function getSupergroupChatCreated(): ?bool {
        return $this->supergroupChatCreated;
    }

    public function setSupergroupChatCreated(?bool $value): self {
        $this->supergroupChatCreated = $value;
        return $this;
    }

    public function getChannelChatCreated(): ?bool {
        return $this->channelChatCreated;
    }

    public function setChannelChatCreated(?bool $value): self {
        $this->channelChatCreated = $value;
        return $this;
    }

    public function getMessageAutoDeleteTimerChanged(): ?MessageAutoDeleteTimerChanged {
        return $this->messageAutoDeleteTimerChanged;
    }

    public function setMessageAutoDeleteTimerChanged(?MessageAutoDeleteTimerChanged $value): self {
        $this->messageAutoDeleteTimerChanged = $value;
        return $this;
    }

    public function getMigrateToChatId(): ?int {
        return $this->migrateToChatId;
    }

    public function setMigrateToChatId(?int $value): self {
        $this->migrateToChatId = $value;
        return $this;
    }

    public function getMigrateFromChatId(): ?int {
        return $this->migrateFromChatId;
    }

    public function setMigrateFromChatId(?int $value): self {
        $this->migrateFromChatId = $value;
        return $this;
    }

    public function getPinnedMessage(): ?MaybeInaccessibleMessage {
        return $this->pinnedMessage;
    }

    public function setPinnedMessage(?MaybeInaccessibleMessage $value): self {
        $this->pinnedMessage = $value;
        return $this;
    }

    public function getInvoice(): ?Invoice {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $value): self {
        $this->invoice = $value;
        return $this;
    }

    public function getSuccessfulPayment(): ?SuccessfulPayment {
        return $this->successfulPayment;
    }

    public function setSuccessfulPayment(?SuccessfulPayment $value): self {
        $this->successfulPayment = $value;
        return $this;
    }

    public function getRefundedPayment(): ?RefundedPayment {
        return $this->refundedPayment;
    }

    public function setRefundedPayment(?RefundedPayment $value): self {
        $this->refundedPayment = $value;
        return $this;
    }

    public function getUsersShared(): ?UsersShared {
        return $this->usersShared;
    }

    public function setUsersShared(?UsersShared $value): self {
        $this->usersShared = $value;
        return $this;
    }

    public function getChatShared(): ?ChatShared {
        return $this->chatShared;
    }

    public function setChatShared(?ChatShared $value): self {
        $this->chatShared = $value;
        return $this;
    }

    public function getConnectedWebsite(): ?string {
        return $this->connectedWebsite;
    }

    public function setConnectedWebsite(?string $value): self {
        $this->connectedWebsite = $value;
        return $this;
    }

    public function getWriteAccessAllowed(): ?WriteAccessAllowed {
        return $this->writeAccessAllowed;
    }

    public function setWriteAccessAllowed(?WriteAccessAllowed $value): self {
        $this->writeAccessAllowed = $value;
        return $this;
    }

    public function getPassportData(): ?PassportData {
        return $this->passportData;
    }

    public function setPassportData(?PassportData $value): self {
        $this->passportData = $value;
        return $this;
    }

    public function getProximityAlertTriggered(): ?ProximityAlertTriggered {
        return $this->proximityAlertTriggered;
    }

    public function setProximityAlertTriggered(?ProximityAlertTriggered $value): self {
        $this->proximityAlertTriggered = $value;
        return $this;
    }

    public function getBoostAdded(): ?ChatBoostAdded {
        return $this->boostAdded;
    }

    public function setBoostAdded(?ChatBoostAdded $value): self {
        $this->boostAdded = $value;
        return $this;
    }

    public function getChatBackgroundSet(): ?ChatBackground {
        return $this->chatBackgroundSet;
    }

    public function setChatBackgroundSet(?ChatBackground $value): self {
        $this->chatBackgroundSet = $value;
        return $this;
    }

    public function getForumTopicCreated(): ?ForumTopicCreated {
        return $this->forumTopicCreated;
    }

    public function setForumTopicCreated(?ForumTopicCreated $value): self {
        $this->forumTopicCreated = $value;
        return $this;
    }

    public function getForumTopicEdited(): ?ForumTopicEdited {
        return $this->forumTopicEdited;
    }

    public function setForumTopicEdited(?ForumTopicEdited $value): self {
        $this->forumTopicEdited = $value;
        return $this;
    }

    public function getForumTopicClosed(): ?ForumTopicClosed {
        return $this->forumTopicClosed;
    }

    public function setForumTopicClosed(?ForumTopicClosed $value): self {
        $this->forumTopicClosed = $value;
        return $this;
    }

    public function getForumTopicReopened(): ?ForumTopicReopened {
        return $this->forumTopicReopened;
    }

    public function setForumTopicReopened(?ForumTopicReopened $value): self {
        $this->forumTopicReopened = $value;
        return $this;
    }

    public function getGeneralForumTopicHidden(): ?GeneralForumTopicHidden {
        return $this->generalForumTopicHidden;
    }

    public function setGeneralForumTopicHidden(?GeneralForumTopicHidden $value): self {
        $this->generalForumTopicHidden = $value;
        return $this;
    }

    public function getGeneralForumTopicUnhidden(): ?GeneralForumTopicUnhidden {
        return $this->generalForumTopicUnhidden;
    }

    public function setGeneralForumTopicUnhidden(?GeneralForumTopicUnhidden $value): self {
        $this->generalForumTopicUnhidden = $value;
        return $this;
    }

    public function getGiveawayCreated(): ?GiveawayCreated {
        return $this->giveawayCreated;
    }

    public function setGiveawayCreated(?GiveawayCreated $value): self {
        $this->giveawayCreated = $value;
        return $this;
    }

    public function getGiveaway(): ?Giveaway {
        return $this->giveaway;
    }

    public function setGiveaway(?Giveaway $value): self {
        $this->giveaway = $value;
        return $this;
    }

    public function getGiveawayWinners(): ?GiveawayWinners {
        return $this->giveawayWinners;
    }

    public function setGiveawayWinners(?GiveawayWinners $value): self {
        $this->giveawayWinners = $value;
        return $this;
    }

    public function getGiveawayCompleted(): ?GiveawayCompleted {
        return $this->giveawayCompleted;
    }

    public function setGiveawayCompleted(?GiveawayCompleted $value): self {
        $this->giveawayCompleted = $value;
        return $this;
    }

    public function getVideoChatScheduled(): ?VideoChatScheduled {
        return $this->videoChatScheduled;
    }

    public function setVideoChatScheduled(?VideoChatScheduled $value): self {
        $this->videoChatScheduled = $value;
        return $this;
    }

    public function getVideoChatStarted(): ?VideoChatStarted {
        return $this->videoChatStarted;
    }

    public function setVideoChatStarted(?VideoChatStarted $value): self {
        $this->videoChatStarted = $value;
        return $this;
    }

    public function getVideoChatEnded(): ?VideoChatEnded {
        return $this->videoChatEnded;
    }

    public function setVideoChatEnded(?VideoChatEnded $value): self {
        $this->videoChatEnded = $value;
        return $this;
    }

    public function getVideoChatParticipantsInvited(): ?VideoChatParticipantsInvited {
        return $this->videoChatParticipantsInvited;
    }

    public function setVideoChatParticipantsInvited(?VideoChatParticipantsInvited $value): self {
        $this->videoChatParticipantsInvited = $value;
        return $this;
    }

    public function getWebAppData(): ?WebAppData {
        return $this->webAppData;
    }

    public function setWebAppData(?WebAppData $value): self {
        $this->webAppData = $value;
        return $this;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function setReplyMarkup(?InlineKeyboardMarkup $value): self {
        $this->replyMarkup = $value;
        return $this;
    }

}
