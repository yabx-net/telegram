<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MessageReactionUpdated {

    use ObjectTrait;

    /**
     * Chat
     *
     * The chat containing the message the user reacted to
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Message Id
     *
     * Unique identifier of the message inside the chat
     * @var int|null
     */
    protected ?int $messageId = null;

    /**
     * User
     *
     * Optional. The user that changed the reaction, if the user isn't anonymous
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Actor Chat
     *
     * Optional. The chat on behalf of which the reaction was changed, if the user is anonymous
     * @var Chat|null
     */
    protected ?Chat $actorChat = null;

    /**
     * Date
     *
     * Date of the change in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Old Reaction
     *
     * Previous list of reaction types that were set by the user
     * @var ReactionType[]|null
     */
    protected ?array $oldReaction = null;

    /**
     * New Reaction
     *
     * New list of reaction types that have been set by the user
     * @var ReactionType[]|null
     */
    protected ?array $newReaction = null;

    public static function fromArray(array $data): MessageReactionUpdated {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['actor_chat'])) {
            $instance->actorChat = Chat::fromArray($data['actor_chat']);
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['old_reaction'])) {
            $instance->oldReaction = [];
            foreach ($data['old_reaction'] as $item) {
                $instance->oldReaction[] = ReactionType::fromArray($item);
            }
        }
        if (isset($data['new_reaction'])) {
            $instance->newReaction = [];
            foreach ($data['new_reaction'] as $item) {
                $instance->newReaction[] = ReactionType::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?Chat  $chat = null,
        ?int   $messageId = null,
        ?User  $user = null,
        ?Chat  $actorChat = null,
        ?int   $date = null,
        ?array $oldReaction = null,
        ?array $newReaction = null,
    ) {
        $this->chat = $chat;
        $this->messageId = $messageId;
        $this->user = $user;
        $this->actorChat = $actorChat;
        $this->date = $date;
        $this->oldReaction = $oldReaction;
        $this->newReaction = $newReaction;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getMessageId(): ?int {
        return $this->messageId;
    }

    public function setMessageId(?int $value): self {
        $this->messageId = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

    public function getActorChat(): ?Chat {
        return $this->actorChat;
    }

    public function setActorChat(?Chat $value): self {
        $this->actorChat = $value;
        return $this;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

    public function getOldReaction(): ?array {
        return $this->oldReaction;
    }

    public function setOldReaction(?array $value): self {
        $this->oldReaction = $value;
        return $this;
    }

    public function getNewReaction(): ?array {
        return $this->newReaction;
    }

    public function setNewReaction(?array $value): self {
        $this->newReaction = $value;
        return $this;
    }

}
