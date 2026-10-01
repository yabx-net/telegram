<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Utils;

/**
 * This object represents a button in a RichMessage. Exactly one of the fields other than text and style must be used to specify the type of the button.
 * @link https://core.telegram.org/bots/api#richmessagebutton
 */
final class RichMessageButton extends AbstractObject {

    /**
     * Text
     *
     * Text of the button. May contain only plain text, RichTextCustomEmoji and RichTextDateTime entities.
     * @var RichText|string|array|null
     */
    protected mixed $text = null;

    /**
     * Style
     *
     * Optional. Style of the button. Must be one of "danger", "success", "primary", or "link" (the button is shown as a regular link without borders). Apps may use theme-specific colors for the button background and text based on the style. The style "link" is allowed only for callback buttons.
     * @var string|null
     */
    protected ?string $style = null;

    /**
     * Url
     *
     * Optional. HTTP or tg:// URL to be opened when the button is pressed. Links tg://user?id=<user_id> can be used to mention a user by their identifier without using a username, if this is allowed by their privacy settings.
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * Callback Data
     *
     * Optional. Data to be sent in a callback query to the bot when the button is pressed, 1-64 bytes
     * @var string|null
     */
    protected ?string $callbackData = null;

    /**
     * Web App
     *
     * Optional. Description of the Web App that will be launched when the user presses the button. Available only in private chats between a user and the bot. Not supported for messages sent on behalf of a business account.
     * @var WebAppInfo|null
     */
    protected ?WebAppInfo $webApp = null;

    /**
     * Login Url
     *
     * Optional. An HTTPS URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget. Not supported for ephemeral messages.
     * @var LoginUrl|null
     */
    protected ?LoginUrl $loginUrl = null;

    /**
     * Switch Inline Query
     *
     * Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. May be empty, in which case just the bot's username will be inserted.
     * @var string|null
     */
    protected ?string $switchInlineQuery = null;

    /**
     * Switch Inline Query Current Chat
     *
     * Optional. If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. May be empty, in which case only the bot's username will be inserted.
     * @var string|null
     */
    protected ?string $switchInlineQueryCurrentChat = null;

    /**
     * Switch Inline Query Chosen Chat
     *
     * Optional. If set, pressing the button will prompt the user to select one of their chats of the specified type, open that chat and insert the bot's username and the specified inline query in the input field.
     * @var SwitchInlineQueryChosenChat|null
     */
    protected ?SwitchInlineQueryChosenChat $switchInlineQueryChosenChat = null;

    /**
     * Copy Text
     *
     * Optional. A button that copies the specified text to the clipboard
     * @var CopyTextButton|null
     */
    protected ?CopyTextButton $copyText = null;

    /**
     * Disabled
     *
     * Optional. If set, then the button is disabled and does nothing
     * @var DisabledButton|null
     */
    protected ?DisabledButton $disabled = null;

    public function __construct(
        mixed $text = null,
        ?string $style = null,
        ?string $url = null,
        ?string $callbackData = null,
        ?WebAppInfo $webApp = null,
        ?LoginUrl $loginUrl = null,
        ?string $switchInlineQuery = null,
        ?string $switchInlineQueryCurrentChat = null,
        ?SwitchInlineQueryChosenChat $switchInlineQueryChosenChat = null,
        ?CopyTextButton $copyText = null,
        ?DisabledButton $disabled = null,
    ) {
        $this->text = $text;
        $this->style = $style;
        $this->url = $url;
        $this->callbackData = $callbackData;
        $this->webApp = $webApp;
        $this->loginUrl = $loginUrl;
        $this->switchInlineQuery = $switchInlineQuery;
        $this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
        $this->switchInlineQueryChosenChat = $switchInlineQueryChosenChat;
        $this->copyText = $copyText;
        $this->disabled = $disabled;
    }

    public static function fromArray(array $data): RichMessageButton {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = RichText::fromMixed($data['text']);
        }
        if (isset($data['style'])) {
            $instance->style = $data['style'];
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
        if (isset($data['switch_inline_query_chosen_chat'])) {
            $instance->switchInlineQueryChosenChat = SwitchInlineQueryChosenChat::fromArray($data['switch_inline_query_chosen_chat']);
        }
        if (isset($data['copy_text'])) {
            $instance->copyText = CopyTextButton::fromArray($data['copy_text']);
        }
        if (isset($data['disabled'])) {
            $instance->disabled = DisabledButton::fromArray($data['disabled']);
        }
        return $instance;
    }

    public function getText(): mixed {
        return $this->text;
    }

    public function setText(mixed $value): self {
        $this->text = $value;
        return $this;
    }

    public function getStyle(): ?string {
        return $this->style;
    }

    public function setStyle(?string $value): self {
        $this->style = $value;
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

    public function getSwitchInlineQueryChosenChat(): ?SwitchInlineQueryChosenChat {
        return $this->switchInlineQueryChosenChat;
    }

    public function setSwitchInlineQueryChosenChat(?SwitchInlineQueryChosenChat $value): self {
        $this->switchInlineQueryChosenChat = $value;
        return $this;
    }

    public function getCopyText(): ?CopyTextButton {
        return $this->copyText;
    }

    public function setCopyText(?CopyTextButton $value): self {
        $this->copyText = $value;
        return $this;
    }

    public function getDisabled(): ?DisabledButton {
        return $this->disabled;
    }

    public function setDisabled(?DisabledButton $value): self {
        $this->disabled = $value;
        return $this;
    }

    public function toArray(): array {
        $result = [];
        foreach (array_keys(get_object_vars($this)) as $key) {
            $value = $this->$key ?? null;
            if ($value === null) {
                continue;
            }
            if ($key === 'text') {
                $result['text'] = RichText::toMixed($value);
                continue;
            }
            if (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }
            $result[Utils::toSnakeCase($key)] = $value;
        }
        return $result;
    }
}
