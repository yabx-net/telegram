<?php

namespace Yabx\Telegram;

use Exception;

class Update {

    protected int $id;
    protected Message|EditedMessage $message;
    protected bool $isEdited = false;
    protected array $raw;

    /**
     * @throws Exception
     */
    public static function fromRequest(): self {
        if($body = file_get_contents('php://input')) {
            return self::fromJson($body);
        } else {
            throw new Exception('Empty body');
        }
    }

    /**
     * @throws Exception
     */
    public static function fromJson(string $json): self {
        if($data = json_decode($json, true)) {
            return new self($data);
        } else {
            throw new Exception('Malformed JSON: ' . json_last_error_msg());
        }
    }

    /**
     * @throws Exception
     */
    public function __construct(array $data) {
        $this->id = $data['update_id'];
        if($message = $data['message'] ?? null) {
            $this->message = new Message($message);
        } elseif ($message = $data['edited_message'] ?? null) {
            $this->message = new EditedMessage($message);
            $this->isEdited = true;
        } else {
            throw new Exception('Invalid structure');
        }
        $this->raw = $data;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getMessage(): EditedMessage|Message {
        return $this->message;
    }

    public function isEdited(): bool {
        return $this->isEdited;
    }

    public function getRaw(): array {
        return $this->raw;
    }

}
