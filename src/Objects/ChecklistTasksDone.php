<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about checklist tasks marked as done or not done.
 * @link https://core.telegram.org/bots/api#checklisttasksdone
 */
final class ChecklistTasksDone extends AbstractObject {

    /**
     * Checklist Message
     *
     * Optional. Message containing the checklist whose tasks were marked as done or not done. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $checklistMessage = null;

    /**
     * Marked As Done Task Ids
     *
     * Optional. Identifiers of the tasks that were marked as done
     * @var int[]|null
     */
    protected ?array $markedAsDoneTaskIds = null;

    /**
     * Marked As Not Done Task Ids
     *
     * Optional. Identifiers of the tasks that were marked as not done
     * @var int[]|null
     */
    protected ?array $markedAsNotDoneTaskIds = null;

    public static function fromArray(array $data): ChecklistTasksDone {
        $instance = new self();
        if (isset($data['checklist_message'])) {
            $instance->checklistMessage = Message::fromArray($data['checklist_message']);
        }
        if (isset($data['marked_as_done_task_ids'])) {
            $instance->markedAsDoneTaskIds = [];
            foreach ($data['marked_as_done_task_ids'] as $item) {
                $instance->markedAsDoneTaskIds[] = $item;
            }
        }
        if (isset($data['marked_as_not_done_task_ids'])) {
            $instance->markedAsNotDoneTaskIds = [];
            foreach ($data['marked_as_not_done_task_ids'] as $item) {
                $instance->markedAsNotDoneTaskIds[] = $item;
            }
        }
        return $instance;
    }

    public function __construct(
        ?Message $checklistMessage = null,
        ?array $markedAsDoneTaskIds = null,
        ?array $markedAsNotDoneTaskIds = null,
    ) {
        $this->checklistMessage = $checklistMessage;
        $this->markedAsDoneTaskIds = $markedAsDoneTaskIds;
        $this->markedAsNotDoneTaskIds = $markedAsNotDoneTaskIds;
    }

    public function getChecklistMessage(): ?Message {
        return $this->checklistMessage;
    }

    public function setChecklistMessage(?Message $value): self {
        $this->checklistMessage = $value;
        return $this;
    }

    public function getMarkedAsDoneTaskIds(): ?array {
        return $this->markedAsDoneTaskIds;
    }

    public function setMarkedAsDoneTaskIds(?array $value): self {
        $this->markedAsDoneTaskIds = $value;
        return $this;
    }

    public function getMarkedAsNotDoneTaskIds(): ?array {
        return $this->markedAsNotDoneTaskIds;
    }

    public function setMarkedAsNotDoneTaskIds(?array $value): self {
        $this->markedAsNotDoneTaskIds = $value;
        return $this;
    }

}
