<?php

namespace Yabx\Telegram\Objects;

class KeyboardButton {

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

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['text'])) {
            $this->text = $data['text'];
        }
        if (isset($data['request_user'])) {
            $this->requestUser = new KeyboardButtonRequestUser($data['request_user']);
        }
        if (isset($data['request_chat'])) {
            $this->requestChat = new KeyboardButtonRequestChat($data['request_chat']);
        }
        if (isset($data['request_contact'])) {
            $this->requestContact = $data['request_contact'];
        }
        if (isset($data['request_location'])) {
            $this->requestLocation = $data['request_location'];
        }
        if (isset($data['request_poll'])) {
            $this->requestPoll = new KeyboardButtonPollType($data['request_poll']);
        }
        if (isset($data['web_app'])) {
            $this->webApp = new WebAppInfo($data['web_app']);
        }
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function getRequestUser(): ?KeyboardButtonRequestUser {
        return $this->requestUser;
    }

    public function getRequestChat(): ?KeyboardButtonRequestChat {
        return $this->requestChat;
    }

    public function getRequestContact(): ?bool {
        return $this->requestContact;
    }

    public function getRequestLocation(): ?bool {
        return $this->requestLocation;
    }

    public function getRequestPoll(): ?KeyboardButtonPollType {
        return $this->requestPoll;
    }

    public function getWebApp(): ?WebAppInfo {
        return $this->webApp;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
