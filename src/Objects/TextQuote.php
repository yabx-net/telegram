<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class TextQuote {

    use ObjectTrait;

    /**
     * Text
     *
     * Text of the quoted part of a message that is replied to by the given message
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Entities
     *
     * Optional. Special entities that appear in the quote. Currently, only bold, italic, underline, strikethrough, spoiler, and custom_emoji entities are kept in quotes.
     * @var MessageEntity[]|null
     */
    protected ?array $entities = null;

    /**
     * Position
     *
     * Approximate quote position in the original message in UTF-16 code units as specified by the sender
     * @var int|null
     */
    protected ?int $position = null;

    /**
     * Is Manual
     *
     * Optional. True, if the quote was chosen manually by the message sender. Otherwise, the quote was added automatically by the server.
     * @var bool|null
     */
    protected ?bool $isManual = null;

    public function __construct(
        ?string $text = null,
        ?array  $entities = null,
        ?int    $position = null,
        ?bool   $isManual = null,
    ) {
        $this->text = $text;
        $this->entities = $entities;
        $this->position = $position;
        $this->isManual = $isManual;
    }

    public static function fromArray(array $data): TextQuote {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['entities'])) {
            $instance->entities = [];
            foreach ($data['entities'] as $item) {
                $instance->entities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['position'])) {
            $instance->position = $data['position'];
        }
        if (isset($data['is_manual'])) {
            $instance->isManual = $data['is_manual'];
        }
        return $instance;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $value): self {
        $this->text = $value;
        return $this;
    }

    public function getEntities(): ?array {
        return $this->entities;
    }

    public function setEntities(?array $value): self {
        $this->entities = $value;
        return $this;
    }

    public function getPosition(): ?int {
        return $this->position;
    }

    public function setPosition(?int $value): self {
        $this->position = $value;
        return $this;
    }

    public function getIsManual(): ?bool {
        return $this->isManual;
    }

    public function setIsManual(?bool $value): self {
        $this->isManual = $value;
        return $this;
    }

}
