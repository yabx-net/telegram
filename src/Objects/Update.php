<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Update {

    use ObjectTrait;

    /**
     * Update Id
     *
     * The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This identifier becomes especially handy if you're using webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     * @var int|null
     */
    protected ?int $updateId = null;

    /**
     * Message
     *
     * Optional. New incoming message of any kind - text, photo, sticker, etc.
     * @var Message|null
     */
    protected ?Message $message = null;

    /**
     * Edited Message
     *
     * Optional. New version of a message that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot.
     * @var Message|null
     */
    protected ?Message $editedMessage = null;

    /**
     * Channel Post
     *
     * Optional. New incoming channel post of any kind - text, photo, sticker, etc.
     * @var Message|null
     */
    protected ?Message $channelPost = null;

    /**
     * Edited Channel Post
     *
     * Optional. New version of a channel post that is known to the bot and was edited. This update may at times be triggered by changes to message fields that are either unavailable or not actively used by your bot.
     * @var Message|null
     */
    protected ?Message $editedChannelPost = null;

    /**
     * Business Connection
     *
     * Optional. The bot was connected to or disconnected from a business account, or a user edited an existing connection with the bot
     * @var BusinessConnection|null
     */
    protected ?BusinessConnection $businessConnection = null;

    /**
     * Business Message
     *
     * Optional. New message from a connected business account
     * @var Message|null
     */
    protected ?Message $businessMessage = null;

    /**
     * Edited Business Message
     *
     * Optional. New version of a message from a connected business account
     * @var Message|null
     */
    protected ?Message $editedBusinessMessage = null;

    /**
     * Deleted Business Messages
     *
     * Optional. Messages were deleted from a connected business account
     * @var BusinessMessagesDeleted|null
     */
    protected ?BusinessMessagesDeleted $deletedBusinessMessages = null;

    /**
     * Message Reaction
     *
     * Optional. A reaction to a message was changed by a user. The bot must be an administrator in the chat and must explicitly specify "message_reaction" in the list of allowed_updates to receive these updates. The update isn't received for reactions set by bots.
     * @var MessageReactionUpdated|null
     */
    protected ?MessageReactionUpdated $messageReaction = null;

    /**
     * Message Reaction Count
     *
     * Optional. Reactions to a message with anonymous reactions were changed. The bot must be an administrator in the chat and must explicitly specify "message_reaction_count" in the list of allowed_updates to receive these updates. The updates are grouped and can be sent with delay up to a few minutes.
     * @var MessageReactionCountUpdated|null
     */
    protected ?MessageReactionCountUpdated $messageReactionCount = null;

    /**
     * Inline Query
     *
     * Optional. New incoming inline query
     * @var InlineQuery|null
     */
    protected ?InlineQuery $inlineQuery = null;

    /**
     * Chosen Inline Result
     *
     * Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
     * @var ChosenInlineResult|null
     */
    protected ?ChosenInlineResult $chosenInlineResult = null;

    /**
     * Callback Query
     *
     * Optional. New incoming callback query
     * @var CallbackQuery|null
     */
    protected ?CallbackQuery $callbackQuery = null;

    /**
     * Shipping Query
     *
     * Optional. New incoming shipping query. Only for invoices with flexible price
     * @var ShippingQuery|null
     */
    protected ?ShippingQuery $shippingQuery = null;

    /**
     * Pre Checkout Query
     *
     * Optional. New incoming pre-checkout query. Contains full information about checkout
     * @var PreCheckoutQuery|null
     */
    protected ?PreCheckoutQuery $preCheckoutQuery = null;

    /**
     * Purchased Paid Media
     *
     * Optional. A user purchased paid media with a non-empty payload sent by the bot in a non-channel chat
     * @var PaidMediaPurchased|null
     */
    protected ?PaidMediaPurchased $purchasedPaidMedia = null;

    /**
     * Poll
     *
     * Optional. New poll state. Bots receive only updates about manually stopped polls and polls, which are sent by the bot
     * @var Poll|null
     */
    protected ?Poll $poll = null;

    /**
     * Poll Answer
     *
     * Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
     * @var PollAnswer|null
     */
    protected ?PollAnswer $pollAnswer = null;

    /**
     * My Chat Member
     *
     * Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
     * @var ChatMemberUpdated|null
     */
    protected ?ChatMemberUpdated $myChatMember = null;

    /**
     * Chat Member
     *
     * Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify "chat_member" in the list of allowed_updates to receive these updates.
     * @var ChatMemberUpdated|null
     */
    protected ?ChatMemberUpdated $chatMember = null;

    /**
     * Chat Join Request
     *
     * Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates.
     * @var ChatJoinRequest|null
     */
    protected ?ChatJoinRequest $chatJoinRequest = null;

    /**
     * Chat Boost
     *
     * Optional. A chat boost was added or changed. The bot must be an administrator in the chat to receive these updates.
     * @var ChatBoostUpdated|null
     */
    protected ?ChatBoostUpdated $chatBoost = null;

    /**
     * Removed Chat Boost
     *
     * Optional. A boost was removed from a chat. The bot must be an administrator in the chat to receive these updates.
     * @var ChatBoostRemoved|null
     */
    protected ?ChatBoostRemoved $removedChatBoost = null;

    public function __construct(
        ?int                         $updateId = null,
        ?Message                     $message = null,
        ?Message                     $editedMessage = null,
        ?Message                     $channelPost = null,
        ?Message                     $editedChannelPost = null,
        ?BusinessConnection          $businessConnection = null,
        ?Message                     $businessMessage = null,
        ?Message                     $editedBusinessMessage = null,
        ?BusinessMessagesDeleted     $deletedBusinessMessages = null,
        ?MessageReactionUpdated      $messageReaction = null,
        ?MessageReactionCountUpdated $messageReactionCount = null,
        ?InlineQuery                 $inlineQuery = null,
        ?ChosenInlineResult          $chosenInlineResult = null,
        ?CallbackQuery               $callbackQuery = null,
        ?ShippingQuery               $shippingQuery = null,
        ?PreCheckoutQuery            $preCheckoutQuery = null,
        ?PaidMediaPurchased          $purchasedPaidMedia = null,
        ?Poll                        $poll = null,
        ?PollAnswer                  $pollAnswer = null,
        ?ChatMemberUpdated           $myChatMember = null,
        ?ChatMemberUpdated           $chatMember = null,
        ?ChatJoinRequest             $chatJoinRequest = null,
        ?ChatBoostUpdated            $chatBoost = null,
        ?ChatBoostRemoved            $removedChatBoost = null,
    ) {
        $this->updateId = $updateId;
        $this->message = $message;
        $this->editedMessage = $editedMessage;
        $this->channelPost = $channelPost;
        $this->editedChannelPost = $editedChannelPost;
        $this->businessConnection = $businessConnection;
        $this->businessMessage = $businessMessage;
        $this->editedBusinessMessage = $editedBusinessMessage;
        $this->deletedBusinessMessages = $deletedBusinessMessages;
        $this->messageReaction = $messageReaction;
        $this->messageReactionCount = $messageReactionCount;
        $this->inlineQuery = $inlineQuery;
        $this->chosenInlineResult = $chosenInlineResult;
        $this->callbackQuery = $callbackQuery;
        $this->shippingQuery = $shippingQuery;
        $this->preCheckoutQuery = $preCheckoutQuery;
        $this->purchasedPaidMedia = $purchasedPaidMedia;
        $this->poll = $poll;
        $this->pollAnswer = $pollAnswer;
        $this->myChatMember = $myChatMember;
        $this->chatMember = $chatMember;
        $this->chatJoinRequest = $chatJoinRequest;
        $this->chatBoost = $chatBoost;
        $this->removedChatBoost = $removedChatBoost;
    }

    public static function fromArray(array $data): Update {
        $instance = new self();
        if (isset($data['update_id'])) {
            $instance->updateId = $data['update_id'];
        }
        if (isset($data['message'])) {
            $instance->message = Message::fromArray($data['message']);
        }
        if (isset($data['edited_message'])) {
            $instance->editedMessage = Message::fromArray($data['edited_message']);
        }
        if (isset($data['channel_post'])) {
            $instance->channelPost = Message::fromArray($data['channel_post']);
        }
        if (isset($data['edited_channel_post'])) {
            $instance->editedChannelPost = Message::fromArray($data['edited_channel_post']);
        }
        if (isset($data['business_connection'])) {
            $instance->businessConnection = BusinessConnection::fromArray($data['business_connection']);
        }
        if (isset($data['business_message'])) {
            $instance->businessMessage = Message::fromArray($data['business_message']);
        }
        if (isset($data['edited_business_message'])) {
            $instance->editedBusinessMessage = Message::fromArray($data['edited_business_message']);
        }
        if (isset($data['deleted_business_messages'])) {
            $instance->deletedBusinessMessages = BusinessMessagesDeleted::fromArray($data['deleted_business_messages']);
        }
        if (isset($data['message_reaction'])) {
            $instance->messageReaction = MessageReactionUpdated::fromArray($data['message_reaction']);
        }
        if (isset($data['message_reaction_count'])) {
            $instance->messageReactionCount = MessageReactionCountUpdated::fromArray($data['message_reaction_count']);
        }
        if (isset($data['inline_query'])) {
            $instance->inlineQuery = InlineQuery::fromArray($data['inline_query']);
        }
        if (isset($data['chosen_inline_result'])) {
            $instance->chosenInlineResult = ChosenInlineResult::fromArray($data['chosen_inline_result']);
        }
        if (isset($data['callback_query'])) {
            $instance->callbackQuery = CallbackQuery::fromArray($data['callback_query']);
        }
        if (isset($data['shipping_query'])) {
            $instance->shippingQuery = ShippingQuery::fromArray($data['shipping_query']);
        }
        if (isset($data['pre_checkout_query'])) {
            $instance->preCheckoutQuery = PreCheckoutQuery::fromArray($data['pre_checkout_query']);
        }
        if (isset($data['purchased_paid_media'])) {
            $instance->purchasedPaidMedia = PaidMediaPurchased::fromArray($data['purchased_paid_media']);
        }
        if (isset($data['poll'])) {
            $instance->poll = Poll::fromArray($data['poll']);
        }
        if (isset($data['poll_answer'])) {
            $instance->pollAnswer = PollAnswer::fromArray($data['poll_answer']);
        }
        if (isset($data['my_chat_member'])) {
            $instance->myChatMember = ChatMemberUpdated::fromArray($data['my_chat_member']);
        }
        if (isset($data['chat_member'])) {
            $instance->chatMember = ChatMemberUpdated::fromArray($data['chat_member']);
        }
        if (isset($data['chat_join_request'])) {
            $instance->chatJoinRequest = ChatJoinRequest::fromArray($data['chat_join_request']);
        }
        if (isset($data['chat_boost'])) {
            $instance->chatBoost = ChatBoostUpdated::fromArray($data['chat_boost']);
        }
        if (isset($data['removed_chat_boost'])) {
            $instance->removedChatBoost = ChatBoostRemoved::fromArray($data['removed_chat_boost']);
        }
        return $instance;
    }

    public function getUpdateId(): ?int {
        return $this->updateId;
    }

    public function setUpdateId(?int $value): self {
        $this->updateId = $value;
        return $this;
    }

    public function getMessage(): ?Message {
        return $this->message;
    }

    public function setMessage(?Message $value): self {
        $this->message = $value;
        return $this;
    }

    public function getEditedMessage(): ?Message {
        return $this->editedMessage;
    }

    public function setEditedMessage(?Message $value): self {
        $this->editedMessage = $value;
        return $this;
    }

    public function getChannelPost(): ?Message {
        return $this->channelPost;
    }

    public function setChannelPost(?Message $value): self {
        $this->channelPost = $value;
        return $this;
    }

    public function getEditedChannelPost(): ?Message {
        return $this->editedChannelPost;
    }

    public function setEditedChannelPost(?Message $value): self {
        $this->editedChannelPost = $value;
        return $this;
    }

    public function getBusinessConnection(): ?BusinessConnection {
        return $this->businessConnection;
    }

    public function setBusinessConnection(?BusinessConnection $value): self {
        $this->businessConnection = $value;
        return $this;
    }

    public function getBusinessMessage(): ?Message {
        return $this->businessMessage;
    }

    public function setBusinessMessage(?Message $value): self {
        $this->businessMessage = $value;
        return $this;
    }

    public function getEditedBusinessMessage(): ?Message {
        return $this->editedBusinessMessage;
    }

    public function setEditedBusinessMessage(?Message $value): self {
        $this->editedBusinessMessage = $value;
        return $this;
    }

    public function getDeletedBusinessMessages(): ?BusinessMessagesDeleted {
        return $this->deletedBusinessMessages;
    }

    public function setDeletedBusinessMessages(?BusinessMessagesDeleted $value): self {
        $this->deletedBusinessMessages = $value;
        return $this;
    }

    public function getMessageReaction(): ?MessageReactionUpdated {
        return $this->messageReaction;
    }

    public function setMessageReaction(?MessageReactionUpdated $value): self {
        $this->messageReaction = $value;
        return $this;
    }

    public function getMessageReactionCount(): ?MessageReactionCountUpdated {
        return $this->messageReactionCount;
    }

    public function setMessageReactionCount(?MessageReactionCountUpdated $value): self {
        $this->messageReactionCount = $value;
        return $this;
    }

    public function getInlineQuery(): ?InlineQuery {
        return $this->inlineQuery;
    }

    public function setInlineQuery(?InlineQuery $value): self {
        $this->inlineQuery = $value;
        return $this;
    }

    public function getChosenInlineResult(): ?ChosenInlineResult {
        return $this->chosenInlineResult;
    }

    public function setChosenInlineResult(?ChosenInlineResult $value): self {
        $this->chosenInlineResult = $value;
        return $this;
    }

    public function getCallbackQuery(): ?CallbackQuery {
        return $this->callbackQuery;
    }

    public function setCallbackQuery(?CallbackQuery $value): self {
        $this->callbackQuery = $value;
        return $this;
    }

    public function getShippingQuery(): ?ShippingQuery {
        return $this->shippingQuery;
    }

    public function setShippingQuery(?ShippingQuery $value): self {
        $this->shippingQuery = $value;
        return $this;
    }

    public function getPreCheckoutQuery(): ?PreCheckoutQuery {
        return $this->preCheckoutQuery;
    }

    public function setPreCheckoutQuery(?PreCheckoutQuery $value): self {
        $this->preCheckoutQuery = $value;
        return $this;
    }

    public function getPurchasedPaidMedia(): ?PaidMediaPurchased {
        return $this->purchasedPaidMedia;
    }

    public function setPurchasedPaidMedia(?PaidMediaPurchased $value): self {
        $this->purchasedPaidMedia = $value;
        return $this;
    }

    public function getPoll(): ?Poll {
        return $this->poll;
    }

    public function setPoll(?Poll $value): self {
        $this->poll = $value;
        return $this;
    }

    public function getPollAnswer(): ?PollAnswer {
        return $this->pollAnswer;
    }

    public function setPollAnswer(?PollAnswer $value): self {
        $this->pollAnswer = $value;
        return $this;
    }

    public function getMyChatMember(): ?ChatMemberUpdated {
        return $this->myChatMember;
    }

    public function setMyChatMember(?ChatMemberUpdated $value): self {
        $this->myChatMember = $value;
        return $this;
    }

    public function getChatMember(): ?ChatMemberUpdated {
        return $this->chatMember;
    }

    public function setChatMember(?ChatMemberUpdated $value): self {
        $this->chatMember = $value;
        return $this;
    }

    public function getChatJoinRequest(): ?ChatJoinRequest {
        return $this->chatJoinRequest;
    }

    public function setChatJoinRequest(?ChatJoinRequest $value): self {
        $this->chatJoinRequest = $value;
        return $this;
    }

    public function getChatBoost(): ?ChatBoostUpdated {
        return $this->chatBoost;
    }

    public function setChatBoost(?ChatBoostUpdated $value): self {
        $this->chatBoost = $value;
        return $this;
    }

    public function getRemovedChatBoost(): ?ChatBoostRemoved {
        return $this->removedChatBoost;
    }

    public function setRemovedChatBoost(?ChatBoostRemoved $value): self {
        $this->removedChatBoost = $value;
        return $this;
    }

}
