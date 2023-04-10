<?php

namespace Yabx\Telegram\Objects;

class PollOption {

    /**
     * Text
     *
     * Option text, 1-100 characters
     * @var string
     */
    protected string $text;

    /**
     * Voter Count
     *
     * Number of users that voted for this option
     * @var int
     */
    protected int $voterCount;


    public function __construct(array $data) {
        if (isset($data['text'])) {
            $this->text = $data['text'];
        }
        if (isset($data['voter_count'])) {
            $this->voterCount = $data['voter_count'];
        }
    }

    public function getText(): string {
        return $this->text;
    }

    public function getVoterCount(): int {
        return $this->voterCount;
    }


}
