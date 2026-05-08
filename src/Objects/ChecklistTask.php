<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a task in a checklist.
 * @link https://core.telegram.org/bots/api#checklisttask
 */
final class ChecklistTask extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier of the task
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Text
     *
     * Text of the task
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Text Entities
     *
     * Optional. Special entities that appear in the task text
     * @var MessageEntity[]|null
     */
    protected ?array $textEntities = null;

    /**
     * Completed By User
     *
     * Optional. User that completed the task; omitted if the task wasn't completed by a user
     * @var User|null
     */
    protected ?User $completedByUser = null;

    /**
     * Completed By Chat
     *
     * Optional. Chat that completed the task; omitted if the task wasn't completed by a chat
     * @var Chat|null
     */
    protected ?Chat $completedByChat = null;

    /**
     * Completion Date
     *
     * Optional. Point in time (Unix timestamp) when the task was completed; 0 if the task wasn't completed
     * @var int|null
     */
    protected ?int $completionDate = null;

    public static function fromArray(array $data): ChecklistTask {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['text_entities'])) {
            $instance->textEntities = [];
            foreach ($data['text_entities'] as $item) {
                $instance->textEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['completed_by_user'])) {
            $instance->completedByUser = User::fromArray($data['completed_by_user']);
        }
        if (isset($data['completed_by_chat'])) {
            $instance->completedByChat = Chat::fromArray($data['completed_by_chat']);
        }
        if (isset($data['completion_date'])) {
            $instance->completionDate = $data['completion_date'];
        }
        return $instance;
    }

    public function __construct(
        ?int $id = null,
        ?string $text = null,
        ?array $textEntities = null,
        ?User $completedByUser = null,
        ?Chat $completedByChat = null,
        ?int $completionDate = null,
    ) {
        $this->id = $id;
        $this->text = $text;
        $this->textEntities = $textEntities;
        $this->completedByUser = $completedByUser;
        $this->completedByChat = $completedByChat;
        $this->completionDate = $completionDate;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $value): self {
        $this->id = $value;
        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $value): self {
        $this->text = $value;
        return $this;
    }

    public function getTextEntities(): ?array {
        return $this->textEntities;
    }

    public function setTextEntities(?array $value): self {
        $this->textEntities = $value;
        return $this;
    }

    public function getCompletedByUser(): ?User {
        return $this->completedByUser;
    }

    public function setCompletedByUser(?User $value): self {
        $this->completedByUser = $value;
        return $this;
    }

    public function getCompletedByChat(): ?Chat {
        return $this->completedByChat;
    }

    public function setCompletedByChat(?Chat $value): self {
        $this->completedByChat = $value;
        return $this;
    }

    public function getCompletionDate(): ?int {
        return $this->completionDate;
    }

    public function setCompletionDate(?int $value): self {
        $this->completionDate = $value;
        return $this;
    }

}
