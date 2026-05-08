<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a topic of a direct messages chat.
 * @link https://core.telegram.org/bots/api#directmessagestopic
 */
final class DirectMessagesTopic extends AbstractObject {

    /**
     * Topic Id
     *
     * Unique identifier of the topic. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $topicId = null;

    /**
     * User
     *
     * Optional. Information about the user that created the topic. Currently, it is always present
     * @var User|null
     */
    protected ?User $user = null;

    public static function fromArray(array $data): DirectMessagesTopic {
        $instance = new self();
        if (isset($data['topic_id'])) {
            $instance->topicId = $data['topic_id'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        return $instance;
    }

    public function __construct(
        ?int $topicId = null,
        ?User $user = null,
    ) {
        $this->topicId = $topicId;
        $this->user = $user;
    }

    public function getTopicId(): ?int {
        return $this->topicId;
    }

    public function setTopicId(?int $value): self {
        $this->topicId = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

}
