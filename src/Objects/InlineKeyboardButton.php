<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InlineKeyboardButton {

    use ObjectTrait;

    /**
     * Text
     *
     * Label text on the button
     * @var string|null
     */
    protected ?string $text = null;

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

    public function __construct(
        ?string       $text = null,
        ?string       $url = null,
        ?string       $callbackData = null,
        ?WebAppInfo   $webApp = null,
        ?LoginUrl     $loginUrl = null,
        ?string       $switchInlineQuery = null,
        ?string       $switchInlineQueryCurrentChat = null,
        ?CallbackGame $callbackGame = null,
        ?bool         $pay = null,
    ) {
        $this->text = $text;
        $this->url = $url;
        $this->callbackData = $callbackData;
        $this->webApp = $webApp;
        $this->loginUrl = $loginUrl;
        $this->switchInlineQuery = $switchInlineQuery;
        $this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
        $this->callbackGame = $callbackGame;
        $this->pay = $pay;
    }

    public static function fromArray(array $data): InlineKeyboardButton {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        if (isset($data['callback_data'])) {
            $instance->callbackData = $data['callback_data'];
        }
        if (isset($data['web_app'])) {
            $instance->webApp = WebAppInfo::fromArray($data['web_app']);
        }
        if (isset($data['login_url'])) {
            $instance->loginUrl = LoginUrl::fromArray($data['login_url']);
        }
        if (isset($data['switch_inline_query'])) {
            $instance->switchInlineQuery = $data['switch_inline_query'];
        }
        if (isset($data['switch_inline_query_current_chat'])) {
            $instance->switchInlineQueryCurrentChat = $data['switch_inline_query_current_chat'];
        }
        if (isset($data['callback_game'])) {
            $instance->callbackGame = CallbackGame::fromArray($data['callback_game']);
        }
        if (isset($data['pay'])) {
            $instance->pay = $data['pay'];
        }
        return $instance;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $value): self {
        $this->text = $value;
        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

    public function getCallbackData(): ?string {
        return $this->callbackData;
    }

    public function setCallbackData(?string $value): self {
        $this->callbackData = $value;
        return $this;
    }

    public function getWebApp(): ?WebAppInfo {
        return $this->webApp;
    }

    public function setWebApp(?WebAppInfo $value): self {
        $this->webApp = $value;
        return $this;
    }

    public function getLoginUrl(): ?LoginUrl {
        return $this->loginUrl;
    }

    public function setLoginUrl(?LoginUrl $value): self {
        $this->loginUrl = $value;
        return $this;
    }

    public function getSwitchInlineQuery(): ?string {
        return $this->switchInlineQuery;
    }

    public function setSwitchInlineQuery(?string $value): self {
        $this->switchInlineQuery = $value;
        return $this;
    }

    public function getSwitchInlineQueryCurrentChat(): ?string {
        return $this->switchInlineQueryCurrentChat;
    }

    public function setSwitchInlineQueryCurrentChat(?string $value): self {
        $this->switchInlineQueryCurrentChat = $value;
        return $this;
    }

    public function getCallbackGame(): ?CallbackGame {
        return $this->callbackGame;
    }

    public function setCallbackGame(?CallbackGame $value): self {
        $this->callbackGame = $value;
        return $this;
    }

    public function getPay(): ?bool {
        return $this->pay;
    }

    public function setPay(?bool $value): self {
        $this->pay = $value;
        return $this;
    }

}
