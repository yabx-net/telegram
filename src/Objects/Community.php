<?php

namespace Yabx\Telegram\Objects;

/**
 * Represents a community (a group of chats).
 * @link https://core.telegram.org/bots/api#community
 */
final class Community extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier for this community. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Name
     *
     * Name of the community
     * @var string|null
     */
    protected ?string $name = null;

    public function __construct(
        ?int $id = null,
        ?string $name = null
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function fromArray(array $data): Community {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        return $instance;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $value): self {
        $this->id = $value;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }
}
