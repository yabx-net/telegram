<?php

namespace Yabx\Telegram\Objects;

class LoginUrl {

    /**
     * Url
     *
     * An HTTPS URL to be opened with user authorization data added to the query string when the button is pressed. If the user refuses to provide authorization data, the original URL without information about the user will be opened. The data added is the same as described in Receiving authorization data.NOTE: You must always check the hash of the received data to verify the authentication and the integrity of the data as described in Checking authorization.
     * @var string
     */
    protected string $url;

    /**
     * Forward Text
     *
     * Optional. New text of the button in forwarded messages.
     * @var string|null
     */
    protected ?string $forwardText = null;

    /**
     * Bot Username
     *
     * Optional. Username of a bot, which will be used for user authorization. See Setting up a bot for more details. If not specified, the current bot's username will be assumed. The url's domain must be the same as the domain linked with the bot. See Linking your domain to the bot for more details.
     * @var string|null
     */
    protected ?string $botUsername = null;

    /**
     * Request Write Access
     *
     * Optional. Pass True to request the permission for your bot to send messages to the user.
     * @var bool|null
     */
    protected ?bool $requestWriteAccess = null;


    public function __construct(array $data) {
        if (isset($data['url'])) {
            $this->url = $data['url'];
        }
        if (isset($data['forward_text'])) {
            $this->forwardText = $data['forward_text'];
        }
        if (isset($data['bot_username'])) {
            $this->botUsername = $data['bot_username'];
        }
        if (isset($data['request_write_access'])) {
            $this->requestWriteAccess = $data['request_write_access'];
        }
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getForwardText(): ?string {
        return $this->forwardText;
    }

    public function getBotUsername(): ?string {
        return $this->botUsername;
    }

    public function getRequestWriteAccess(): ?bool {
        return $this->requestWriteAccess;
    }


}
