<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Story {

    use ObjectTrait;

    /**
     * Chat
     *
     * Chat that posted the story
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Id
     *
     * Unique identifier for the story in the chat
     * @var int|null
     */
    protected ?int $id = null;

    public static function fromArray(array $data): Story {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        return $instance;
    }

    public function __construct(
        ?Chat $chat = null,
        ?int  $id = null,
    ) {
        $this->chat = $chat;
        $this->id = $id;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $value): self {
        $this->id = $value;
        return $this;
    }

}
