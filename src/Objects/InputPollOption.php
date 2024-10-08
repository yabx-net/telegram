<?php

namespace Yabx\Telegram\Objects;

final class InputPollOption extends AbstractObject {

    /**
     * Text
     *
     * Option text, 1-100 characters
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Text Parse Mode
     *
     * Optional. Mode for parsing entities in the text. See formatting options for more details. Currently, only custom emoji entities are allowed
     * @var string|null
     */
    protected ?string $textParseMode = null;

    /**
     * Text Entities
     *
     * Optional. A JSON-serialized list of special entities that appear in the poll option text. It can be specified instead of text_parse_mode
     * @var MessageEntity[]|null
     */
    protected ?array $textEntities = null;

    public function __construct(
        ?string $text = null,
        ?string $textParseMode = null,
        ?array  $textEntities = null,
    ) {
        $this->text = $text;
        $this->textParseMode = $textParseMode;
        $this->textEntities = $textEntities;
    }

    public static function fromArray(array $data): InputPollOption {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['text_parse_mode'])) {
            $instance->textParseMode = $data['text_parse_mode'];
        }
        if (isset($data['text_entities'])) {
            $instance->textEntities = [];
            foreach ($data['text_entities'] as $item) {
                $instance->textEntities[] = MessageEntity::fromArray($item);
            }
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

    public function getTextParseMode(): ?string {
        return $this->textParseMode;
    }

    public function setTextParseMode(?string $value): self {
        $this->textParseMode = $value;
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
