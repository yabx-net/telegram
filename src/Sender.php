<?php

namespace Yabx\Telegram;

class Sender {

    private int $id;
    private bool $isBot;
    private ?string $firstName;
    private ?string $username;
    private string $languageCode;
    private array $raw;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->isBot = $data['is_bot'];
        $this->firstName = $data['first_name'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->languageCode = $data['language_code'];
        $this->raw = $data;
    }

    public function getId(): int {
        return $this->id;
    }

    public function isBot(): bool {
        return $this->isBot;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function getLanguageCode(): string {
        return $this->languageCode;
    }

    public function getRaw(): array {
        return $this->raw;
    }

}
