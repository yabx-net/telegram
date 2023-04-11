<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PollOption {

    use ObjectTrait;

    /**
     * Text
     *
     * Option text, 1-100 characters
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Voter Count
     *
     * Number of users that voted for this option
     * @var int|null
     */
    protected ?int $voterCount = null;

    public function __construct(
        ?string $text = null,
        ?int    $voterCount = null,
    ) {
        $this->text = $text;
        $this->voterCount = $voterCount;
    }

    public static function fromArray(array $data): PollOption {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = $data['text'];
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

    public function getVoterCount(): ?int {
        return $this->voterCount;
    }

    public function setVoterCount(?int $value): self {
        $this->voterCount = $value;
        return $this;
    }

}
