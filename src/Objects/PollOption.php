<?php

namespace Yabx\Telegram\Objects;

final class PollOption extends AbstractObject {

    /**
     * Text
     *
     * Option text, 1-100 characters
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Text Entities
     *
     * Optional. Special entities that appear in the option text. Currently, only custom emoji entities are allowed in poll option texts
     * @var MessageEntity[]|null
     */
    protected ?array $textEntities = null;

    /**
     * Voter Count
     *
     * Number of users that voted for this option
     * @var int|null
     */
    protected ?int $voterCount = null;

    public function __construct(
        ?string $text = null,
        ?array  $textEntities = null,
        ?int    $voterCount = null,
    ) {
        $this->text = $text;
        $this->textEntities = $textEntities;
        $this->voterCount = $voterCount;
    }

    public static function fromArray(array $data): PollOption {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['text_entities'])) {
            $instance->textEntities = [];
            foreach ($data['text_entities'] as $item) {
                $instance->textEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['voter_count'])) {
            $instance->voterCount = $data['voter_count'];
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

    public function getTextEntities(): ?array {
        return $this->textEntities;
    }

    public function setTextEntities(?array $value): self {
        $this->textEntities = $value;
        return $this;
    }

    public function getVoterCount(): ?int {
        return $this->voterCount;
    }

    public function setVoterCount(?int $value): self {
        $this->voterCount = $value;
        return $this;
    }

}
