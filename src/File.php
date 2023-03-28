<?php

namespace Yabx\Telegram;

abstract class File {

    protected string $id;
    protected string $uniqueId;
    protected int $size;
    protected array $raw;

    public function __construct(array $data) {
        $this->id = $data['file_id'];
        $this->uniqueId = $data['file_unique_id'];
        $this->size = $data['file_size'];
        $this->raw = $data;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getUniqueId(): string {
        return $this->uniqueId;
    }

    public function getSize(): int {
        return $this->size;
    }

    public function getRaw(): array {
        return $this->raw;
    }

}
