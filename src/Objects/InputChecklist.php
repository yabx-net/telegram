<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a checklist to create.
 * @link https://core.telegram.org/bots/api#inputchecklist
 */
final class InputChecklist extends AbstractObject {

    /**
     * Title
     *
     * Title of the checklist; 1-255 characters after entities parsing
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the title. See formatting options for more details.
     * @var string|null
     */
    protected ?string $parseMode = null;

    /**
     * Title Entities
     *
     * Optional. List of special entities that appear in the title, which can be specified instead of parse_mode. Currently, only bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities are allowed.
     * @var MessageEntity[]|null
     */
    protected ?array $titleEntities = null;

    /**
     * Tasks
     *
     * List of 1-30 tasks in the checklist
     * @var InputChecklistTask[]|null
     */
    protected ?array $tasks = null;

    /**
     * Others Can Add Tasks
     *
     * Optional. Pass True if other users can add tasks to the checklist
     * @var bool|null
     */
    protected ?bool $othersCanAddTasks = null;

    /**
     * Others Can Mark Tasks As Done
     *
     * Optional. Pass True if other users can mark tasks as done or not done in the checklist
     * @var bool|null
     */
    protected ?bool $othersCanMarkTasksAsDone = null;

    public static function fromArray(array $data): InputChecklist {
        $instance = new self();
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['parse_mode'])) {
            $instance->parseMode = $data['parse_mode'];
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
                $instance->tasks[] = InputChecklistTask::fromArray($item);
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
        ?string $parseMode = null,
        ?array $titleEntities = null,
        ?array $tasks = null,
        ?bool $othersCanAddTasks = null,
        ?bool $othersCanMarkTasksAsDone = null,
    ) {
        $this->title = $title;
        $this->parseMode = $parseMode;
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

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function setParseMode(?string $value): self {
        $this->parseMode = $value;
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
