<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ReactionCount {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the reaction
     * @var ReactionType|null
     */
    protected ?ReactionType $type = null;

    /**
     * Total Count
     *
     * Number of times the reaction was added
     * @var int|null
     */
    protected ?int $totalCount = null;

    public function __construct(
        ?ReactionType $type = null,
        ?int          $totalCount = null,
    ) {
        $this->type = $type;
        $this->totalCount = $totalCount;
    }

    public static function fromArray(array $data): ReactionCount {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = ReactionType::fromArray($data['type']);
        }
        if (isset($data['total_count'])) {
            $instance->totalCount = $data['total_count'];
        }
        return $instance;
    }

    public function getType(): ?ReactionType {
        return $this->type;
    }

    public function setType(?ReactionType $value): self {
        $this->type = $value;
        return $this;
    }

    public function getTotalCount(): ?int {
        return $this->totalCount;
    }

    public function setTotalCount(?int $value): self {
        $this->totalCount = $value;
        return $this;
    }

}
