<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class LoginUrl {

    use ObjectTrait;

    /**
     * Url
     *
     * An HTTPS URL to be opened with user authorization data added to the query string when the button is pressed. If the user refuses to provide authorization data, the original URL without information about the user will be opened. The data added is the same as described in Receiving authorization data.NOTE: You must always check the hash of the received data to verify the authentication and the integrity of the data as described in Checking authorization.
     * @var string|null
     */
    protected ?string $url = null;

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

    public static function fromArray(array $data): LoginUrl {
        $instance = new self();
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        if (isset($data['forward_text'])) {
            $instance->forwardText = $data['forward_text'];
        }
        if (isset($data['bot_username'])) {
            $instance->botUsername = $data['bot_username'];
        }
        if (isset($data['request_write_access'])) {
            $instance->requestWriteAccess = $data['request_write_access'];
        }
        return $instance;
    }

    public function __construct(
        ?string $url = null,
        ?string $forwardText = null,
        ?string $botUsername = null,
        ?bool   $requestWriteAccess = null,
    ) {
        $this->url = $url;
        $this->forwardText = $forwardText;
        $this->botUsername = $botUsername;
        $this->requestWriteAccess = $requestWriteAccess;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

    public function getForwardText(): ?string {
        return $this->forwardText;
    }

    public function setForwardText(?string $value): self {
        $this->forwardText = $value;
        return $this;
    }

    public function getBotUsername(): ?string {
        return $this->botUsername;
    }

    public function setBotUsername(?string $value): self {
        $this->botUsername = $value;
        return $this;
    }

    public function getRequestWriteAccess(): ?bool {
        return $this->requestWriteAccess;
    }

    public function setRequestWriteAccess(?bool $value): self {
        $this->requestWriteAccess = $value;
        return $this;
    }

}
