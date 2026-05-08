<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about tasks added to a checklist.
 * @link https://core.telegram.org/bots/api#checklisttasksadded
 */
final class ChecklistTasksAdded extends AbstractObject {

    /**
     * Checklist Message
     *
     * Optional. Message containing the checklist to which the tasks were added. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     * @var Message|null
     */
    protected ?Message $checklistMessage = null;

    /**
     * Tasks
     *
     * List of tasks added to the checklist
     * @var ChecklistTask[]|null
     */
    protected ?array $tasks = null;

    public static function fromArray(array $data): ChecklistTasksAdded {
        $instance = new self();
        if (isset($data['checklist_message'])) {
            $instance->checklistMessage = Message::fromArray($data['checklist_message']);
        }
        if (isset($data['tasks'])) {
            $instance->tasks = [];
            foreach ($data['tasks'] as $item) {
                $instance->tasks[] = ChecklistTask::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?Message $checklistMessage = null,
        ?array $tasks = null,
    ) {
        $this->checklistMessage = $checklistMessage;
        $this->tasks = $tasks;
    }

    public function getChecklistMessage(): ?Message {
        return $this->checklistMessage;
    }

    public function setChecklistMessage(?Message $value): self {
        $this->checklistMessage = $value;
        return $this;
    }

    public function getTasks(): ?array {
        return $this->tasks;
    }

    public function setTasks(?array $value): self {
        $this->tasks = $value;
        return $this;
    }

}
