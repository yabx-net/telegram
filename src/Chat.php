<?php

namespace Yabx\Telegram;

class Chat {

    private int $id;
    private ?string $firstName;
    private ?string $username;
    private string $type;
    private array $raw;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->firstName = $data['first_name'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->raw = $data;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getRaw(): array {
        return $this->raw;
    }

}
