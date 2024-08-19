<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatShared {

    use ObjectTrait;

    /**
     * Request Id
     *
     * Identifier of the request
     * @var int|null
     */
    protected ?int $requestId = null;

    /**
     * Chat Id
     *
     * Identifier of the shared chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the chat and could be unable to use this identifier, unless the chat is already known to the bot by some other means.
     * @var int|null
     */
    protected ?int $chatId = null;

    /**
     * Title
     *
     * Optional. Title of the chat, if the title was requested by the bot.
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Username
     *
     * Optional. Username of the chat, if the username was requested by the bot and available.
     * @var string|null
     */
    protected ?string $username = null;

    /**
     * Photo
     *
     * Optional. Available sizes of the chat photo, if the photo was requested by the bot
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    public static function fromArray(array $data): ChatShared {
        $instance = new self();
        if (isset($data['request_id'])) {
            $instance->requestId = $data['request_id'];
        }
        if (isset($data['chat_id'])) {
            $instance->chatId = $data['chat_id'];
        }
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['username'])) {
            $instance->username = $data['username'];
        }
        if (isset($data['photo'])) {
            $instance->photo = [];
            foreach ($data['photo'] as $item) {
                $instance->photo[] = PhotoSize::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?int    $requestId = null,
        ?int    $chatId = null,
        ?string $title = null,
        ?string $username = null,
        ?array  $photo = null,
    ) {
        $this->requestId = $requestId;
        $this->chatId = $chatId;
        $this->title = $title;
        $this->username = $username;
        $this->photo = $photo;
    }

    public function getRequestId(): ?int {
        return $this->requestId;
    }

    public function setRequestId(?int $value): self {
        $this->requestId = $value;
        return $this;
    }

    public function getChatId(): ?int {
        return $this->chatId;
    }

    public function setChatId(?int $value): self {
        $this->chatId = $value;
        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $value): self {
        $this->username = $value;
        return $this;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

}
