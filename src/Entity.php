<?php

namespace Yabx\Telegram;

class Entity {

    const TYPE_COMMAND = 'bot_command';
    const TYPE_MENTION = 'mention';

    protected int $offset;
    protected int $length;
    protected string $type;
    protected array $raw;

    public function __construct(array $data) {
        $this->offset = $data['offset'];
        $this->length = $data['length'];
        $this->type = $data['type'];
        $this->raw = $data;
    }

    public function getOffset(): int {
        return $this->offset;
    }

    public function getLength(): int {
        return $this->length;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getRaw(): array {
        return $this->raw;
    }

}
