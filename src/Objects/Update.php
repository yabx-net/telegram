<?php

namespace Yabx\Telegram\Objects;

class Update {

    /**
     * Update Id
     *
     * The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you're using webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     * @var int
     */
    protected int $updateId;

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
     * Optional. New version of a message that is known to the bot and was edited
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
     * Optional. New version of a channel post that is known to the bot and was edited
     * @var Message|null
     */
    protected ?Message $editedChannelPost = null;

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
     * Poll
     *
     * Optional. New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
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
     * Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
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

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['update_id'])) {
            $this->updateId = $data['update_id'];
        }
        if (isset($data['message'])) {
            $this->message = new Message($data['message']);
        }
        if (isset($data['edited_message'])) {
            $this->editedMessage = new Message($data['edited_message']);
        }
        if (isset($data['channel_post'])) {
            $this->channelPost = new Message($data['channel_post']);
        }
        if (isset($data['edited_channel_post'])) {
            $this->editedChannelPost = new Message($data['edited_channel_post']);
        }
        if (isset($data['inline_query'])) {
            $this->inlineQuery = new InlineQuery($data['inline_query']);
        }
        if (isset($data['chosen_inline_result'])) {
            $this->chosenInlineResult = new ChosenInlineResult($data['chosen_inline_result']);
        }
        if (isset($data['callback_query'])) {
            $this->callbackQuery = new CallbackQuery($data['callback_query']);
        }
        if (isset($data['shipping_query'])) {
            $this->shippingQuery = new ShippingQuery($data['shipping_query']);
        }
        if (isset($data['pre_checkout_query'])) {
            $this->preCheckoutQuery = new PreCheckoutQuery($data['pre_checkout_query']);
        }
        if (isset($data['poll'])) {
            $this->poll = new Poll($data['poll']);
        }
        if (isset($data['poll_answer'])) {
            $this->pollAnswer = new PollAnswer($data['poll_answer']);
        }
        if (isset($data['my_chat_member'])) {
            $this->myChatMember = new ChatMemberUpdated($data['my_chat_member']);
        }
        if (isset($data['chat_member'])) {
            $this->chatMember = new ChatMemberUpdated($data['chat_member']);
        }
        if (isset($data['chat_join_request'])) {
            $this->chatJoinRequest = new ChatJoinRequest($data['chat_join_request']);
        }
    }

    public function getUpdateId(): int {
        return $this->updateId;
    }

    public function getMessage(): ?Message {
        return $this->message;
    }

    public function getEditedMessage(): ?Message {
        return $this->editedMessage;
    }

    public function getChannelPost(): ?Message {
        return $this->channelPost;
    }

    public function getEditedChannelPost(): ?Message {
        return $this->editedChannelPost;
    }

    public function getInlineQuery(): ?InlineQuery {
        return $this->inlineQuery;
    }

    public function getChosenInlineResult(): ?ChosenInlineResult {
        return $this->chosenInlineResult;
    }

    public function getCallbackQuery(): ?CallbackQuery {
        return $this->callbackQuery;
    }

    public function getShippingQuery(): ?ShippingQuery {
        return $this->shippingQuery;
    }

    public function getPreCheckoutQuery(): ?PreCheckoutQuery {
        return $this->preCheckoutQuery;
    }

    public function getPoll(): ?Poll {
        return $this->poll;
    }

    public function getPollAnswer(): ?PollAnswer {
        return $this->pollAnswer;
    }

    public function getMyChatMember(): ?ChatMemberUpdated {
        return $this->myChatMember;
    }

    public function getChatMember(): ?ChatMemberUpdated {
        return $this->chatMember;
    }

    public function getChatJoinRequest(): ?ChatJoinRequest {
        return $this->chatJoinRequest;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
