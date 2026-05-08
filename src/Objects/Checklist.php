<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a checklist.
 * @link https://core.telegram.org/bots/api#checklist
 */
final class Checklist extends AbstractObject {

    /**
     * Title
     *
     * Title of the checklist
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Title Entities
     *
     * Optional. Special entities that appear in the checklist title
     * @var MessageEntity[]|null
     */
    protected ?array $titleEntities = null;

    /**
     * Tasks
     *
     * List of tasks in the checklist
     * @var ChecklistTask[]|null
     */
    protected ?array $tasks = null;

    /**
     * Others Can Add Tasks
     *
     * Optional. True, if users other than the creator of the list can add tasks to the list
     * @var bool|null
     */
    protected ?bool $othersCanAddTasks = null;

    /**
     * Others Can Mark Tasks As Done
     *
     * Optional. True, if users other than the creator of the list can mark tasks as done or not done
     * @var bool|null
     */
    protected ?bool $othersCanMarkTasksAsDone = null;

    public static function fromArray(array $data): Checklist {
        $instance = new self();
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['title_entities'])) {
            $instance->titleEntities = [];
            foreach ($data['title_entities'] as $item) {
                $instance->titleEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['tasks'])) {
            $instance->tasks = [];
            foreach ($data['tasks'] as $item) {
                $instance->tasks[] = ChecklistTask::fromArray($item);
            }
        }
        if (isset($data['others_can_add_tasks'])) {
            $instance->othersCanAddTasks = $data['others_can_add_tasks'];
        }
        if (isset($data['others_can_mark_tasks_as_done'])) {
            $instance->othersCanMarkTasksAsDone = $data['others_can_mark_tasks_as_done'];
        }
        return $instance;
    }

    public function __construct(
        ?string $title = null,
        ?array $titleEntities = null,
        ?array $tasks = null,
        ?bool $othersCanAddTasks = null,
        ?bool $othersCanMarkTasksAsDone = null,
    ) {
        $this->title = $title;
        $this->titleEntities = $titleEntities;
        $this->tasks = $tasks;
        $this->othersCanAddTasks = $othersCanAddTasks;
        $this->othersCanMarkTasksAsDone = $othersCanMarkTasksAsDone;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getTitleEntities(): ?array {
        return $this->titleEntities;
    }

    public function setTitleEntities(?array $value): self {
        $this->titleEntities = $value;
        return $this;
    }

    public function getTasks(): ?array {
        return $this->tasks;
    }

    public function setTasks(?array $value): self {
        $this->tasks = $value;
        return $this;
    }

    public function getOthersCanAddTasks(): ?bool {
        return $this->othersCanAddTasks;
    }

    public function setOthersCanAddTasks(?bool $value): self {
        $this->othersCanAddTasks = $value;
        return $this;
    }

    public function getOthersCanMarkTasksAsDone(): ?bool {
        return $this->othersCanMarkTasksAsDone;
    }

    public function setOthersCanMarkTasksAsDone(?bool $value): self {
        $this->othersCanMarkTasksAsDone = $value;
        return $this;
    }

}
