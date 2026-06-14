<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\Checklist;
use Yabx\Telegram\Objects\ChecklistTask;
use Yabx\Telegram\Objects\ChecklistTasksAdded;
use Yabx\Telegram\Objects\ChecklistTasksDone;
use Yabx\Telegram\Objects\InputChecklist;
use Yabx\Telegram\Objects\InputChecklistTask;

return [
    ChecklistTask::class => [
        'id' => 1,
        'text' => 'Buy milk',
    ],
    Checklist::class => [
        'title' => 'Shopping',
        'tasks' => [['id' => 1, 'text' => 'Buy milk']],
    ],
    InputChecklistTask::class => [
        'id' => 1,
        'text' => 'Buy milk',
    ],
    InputChecklist::class => [
        'title' => 'Shopping',
        'tasks' => [['id' => 1, 'text' => 'Buy milk']],
    ],
    ChecklistTasksAdded::class => [
        'tasks' => [['id' => 2, 'text' => 'Buy bread']],
    ],
    ChecklistTasksDone::class => [
        'marked_as_done_task_ids' => [1],
    ],
];
