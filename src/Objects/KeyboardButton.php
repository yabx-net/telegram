<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class KeyboardButton {

    use ObjectTrait;

    /**
     * Text
     *
     * Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Request User
     *
     * Optional. If specified, pressing the button will open a list of suitable users. Tapping on any user will send their identifier to the bot in a “user_shared” service message. Available in private chats only.
     * @var KeyboardButtonRequestUser|null
     */
    protected ?KeyboardButtonRequestUser $requestUser = null;

    /**
     * Request Chat
     *
     * Optional. If specified, pressing the button will open a list of suitable chats. Tapping on a chat will send its identifier to the bot in a “chat_shared” service message. Available in private chats only.
     * @var KeyboardButtonRequestChat|null
     */
    protected ?KeyboardButtonRequestChat $requestChat = null;

    /**
     * Request Contact
     *
     * Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
     * @var bool|null
     */
    protected ?bool $requestContact = null;

    /**
     * Request Location
     *
     * Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only.
     * @var bool|null
     */
    protected ?bool $requestLocation = null;

    /**
     * Request Poll
     *
     * Optional. If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only.
     * @var KeyboardButtonPollType|null
     */
    protected ?KeyboardButtonPollType $requestPoll = null;

    /**
     * Web App
     *
     * Optional. If specified, the described Web App will be launched when the button is pressed. The Web App will be able to send a “web_app_data” service message. Available in private chats only.
     * @var WebAppInfo|null
     */
    protected ?WebAppInfo $webApp = null;

    public function __construct(
        ?string                    $text = null,
        ?KeyboardButtonRequestUser $requestUser = null,
        ?KeyboardButtonRequestChat $requestChat = null,
        ?bool                      $requestContact = null,
        ?bool                      $requestLocation = null,
        ?KeyboardButtonPollType    $requestPoll = null,
        ?WebAppInfo                $webApp = null,
    ) {
        $this->text = $text;
        $this->requestUser = $requestUser;
        $this->requestChat = $requestChat;
        $this->requestContact = $requestContact;
        $this->requestLocation = $requestLocation;
        $this->requestPoll = $requestPoll;
        $this->webApp = $webApp;
    }

    public static function fromArray(array $data): KeyboardButton {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['request_user'])) {
            $instance->requestUser = KeyboardButtonRequestUser::fromArray($data['request_user']);
        }
        if (isset($data['request_chat'])) {
            $instance->requestChat = KeyboardButtonRequestChat::fromArray($data['request_chat']);
        }
        if (isset($data['request_contact'])) {
            $instance->requestContact = $data['request_contact'];
        }
        if (isset($data['request_location'])) {
            $instance->requestLocation = $data['request_location'];
        }
        if (isset($data['request_poll'])) {
            $instance->requestPoll = KeyboardButtonPollType::fromArray($data['request_poll']);
        }
        if (isset($data['web_app'])) {
            $instance->webApp = WebAppInfo::fromArray($data['web_app']);
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

    public function getRequestUser(): ?KeyboardButtonRequestUser {
        return $this->requestUser;
    }

    public function setRequestUser(?KeyboardButtonRequestUser $value): self {
        $this->requestUser = $value;
        return $this;
    }

    public function getRequestChat(): ?KeyboardButtonRequestChat {
        return $this->requestChat;
    }

    public function setRequestChat(?KeyboardButtonRequestChat $value): self {
        $this->requestChat = $value;
        return $this;
    }

    public function getRequestContact(): ?bool {
        return $this->requestContact;
    }

    public function setRequestContact(?bool $value): self {
        $this->requestContact = $value;
        return $this;
    }

    public function getRequestLocation(): ?bool {
        return $this->requestLocation;
    }

    public function setRequestLocation(?bool $value): self {
        $this->requestLocation = $value;
        return $this;
    }

    public function getRequestPoll(): ?KeyboardButtonPollType {
        return $this->requestPoll;
    }

    public function setRequestPoll(?KeyboardButtonPollType $value): self {
        $this->requestPoll = $value;
        return $this;
    }

    public function getWebApp(): ?WebAppInfo {
        return $this->webApp;
    }

    public function setWebApp(?WebAppInfo $value): self {
        $this->webApp = $value;
        return $this;
    }

}
