<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a task to add to a checklist.
 * @link https://core.telegram.org/bots/api#inputchecklisttask
 */
final class InputChecklistTask extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier of the task; must be positive and unique among all task identifiers currently present in the checklist
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Text
     *
     * Text of the task; 1-100 characters after entities parsing
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Parse Mode
     *
     * Optional. Mode for parsing entities in the text. See formatting options for more details.
     * @var string|null
     */
    protected ?string $parseMode = null;

    /**
     * Text Entities
     *
     * Optional. List of special entities that appear in the text, which can be specified instead of parse_mode. Currently, only bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities are allowed.
     * @var MessageEntity[]|null
     */
    protected ?array $textEntities = null;

    public static function fromArray(array $data): InputChecklistTask {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['parse_mode'])) {
            $instance->parseMode = $data['parse_mode'];
        }
        if (isset($data['text_entities'])) {
            $instance->textEntities = [];
            foreach ($data['text_entities'] as $item) {
                $instance->textEntities[] = MessageEntity::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?int $id = null,
        ?string $text = null,
        ?string $parseMode = null,
        ?array $textEntities = null,
    ) {
        $this->id = $id;
        $this->text = $text;
        $this->parseMode = $parseMode;
        $this->textEntities = $textEntities;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $value): self {
        $this->id = $value;
        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $value): self {
        $this->text = $value;
        return $this;
    }

    public function getParseMode(): ?string {
        return $this->parseMode;
    }

    public function setParseMode(?string $value): self {
        $this->parseMode = $value;
        return $this;
    }

    public function getTextEntities(): ?array {
        return $this->textEntities;
    }

    public function setTextEntities(?array $value): self {
        $this->textEntities = $value;
        return $this;
    }

}
