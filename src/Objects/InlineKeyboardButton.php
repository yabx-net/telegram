<?php

namespace Yabx\Telegram\Objects;

class InlineKeyboardButton {

    /**
     * Text
     *
     * Label text on the button
     * @var string
     */
    protected string $text;

    /**
     * Url
     *
     * Optional. HTTP or tg:// URL to be opened when the button is pressed. Links tg://user?id=<user_id> can be used to mention a user by their ID without using a username, if this is allowed by their privacy settings.
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * Callback Data
     *
     * Optional. Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     * @var string|null
     */
    protected ?string $callbackData = null;

    /**
     * Web App
     *
     * Optional. Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. Available only in private chats between a user and the bot.
     * @var WebAppInfo|null
     */
    protected ?WebAppInfo $webApp = null;

    /**
     * Login Url
     *
     * Optional. An HTTPS URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget.
     * @var LoginUrl|null
     */
    protected ?LoginUrl $loginUrl = null;

    /**
     * Switch Inline Query
     *
     * Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. May be empty, in which case just the bot's username will be inserted.Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a private chat with it. Especially useful when combined with switch_pm… actions - in this case the user will be automatically returned to the chat they switched from, skipping the chat selection screen.
     * @var string|null
     */
    protected ?string $switchInlineQuery = null;

    /**
     * Switch Inline Query Current Chat
     *
     * Optional. If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. May be empty, in which case only the bot's username will be inserted.This offers a quick way for the user to open your bot in inline mode in the same chat - good for selecting something from multiple options.
     * @var string|null
     */
    protected ?string $switchInlineQueryCurrentChat = null;

    /**
     * Callback Game
     *
     * Optional. Description of the game that will be launched when the user presses the button.NOTE: This type of button must always be the first button in the first row.
     * @var CallbackGame|null
     */
    protected ?CallbackGame $callbackGame = null;

    /**
     * Pay
     *
     * Optional. Specify True, to send a Pay button.NOTE: This type of button must always be the first button in the first row and can only be used in invoice messages.
     * @var bool|null
     */
    protected ?bool $pay = null;


    public function __construct(array $data) {
        if (isset($data['text'])) {
            $this->text = $data['text'];
        }
        if (isset($data['url'])) {
            $this->url = $data['url'];
        }
        if (isset($data['callback_data'])) {
            $this->callbackData = $data['callback_data'];
        }
        if (isset($data['web_app'])) {
            $this->webApp = new WebAppInfo($data['web_app']);
        }
        if (isset($data['login_url'])) {
            $this->loginUrl = new LoginUrl($data['login_url']);
        }
        if (isset($data['switch_inline_query'])) {
            $this->switchInlineQuery = $data['switch_inline_query'];
        }
        if (isset($data['switch_inline_query_current_chat'])) {
            $this->switchInlineQueryCurrentChat = $data['switch_inline_query_current_chat'];
        }
        if (isset($data['callback_game'])) {
            $this->callbackGame = new CallbackGame($data['callback_game']);
        }
        if (isset($data['pay'])) {
            $this->pay = $data['pay'];
        }
    }

    public function getText(): string {
        return $this->text;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function getCallbackData(): ?string {
        return $this->callbackData;
    }

    public function getWebApp(): ?WebAppInfo {
        return $this->webApp;
    }

    public function getLoginUrl(): ?LoginUrl {
        return $this->loginUrl;
    }

    public function getSwitchInlineQuery(): ?string {
        return $this->switchInlineQuery;
    }

    public function getSwitchInlineQueryCurrentChat(): ?string {
        return $this->switchInlineQueryCurrentChat;
    }

    public function getCallbackGame(): ?CallbackGame {
        return $this->callbackGame;
    }

    public function getPay(): ?bool {
        return $this->pay;
    }


}
