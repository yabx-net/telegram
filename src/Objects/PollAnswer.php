<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PollAnswer {

    use ObjectTrait;

    /**
     * Poll Id
     *
     * Unique poll identifier
     * @var string|null
     */
    protected ?string $pollId = null;

    /**
     * User
     *
     * The user, who changed the answer to the poll
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Option Ids
     *
     * 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.
     * @var int[]|null
     */
    protected ?array $optionIds = null;

    public function __construct(
        ?string $pollId = null,
        ?User   $user = null,
        ?array  $optionIds = null,
    ) {
        $this->pollId = $pollId;
        $this->user = $user;
        $this->optionIds = $optionIds;
    }

    public static function fromArray(array $data): PollAnswer {
        $instance = new self();
        if (isset($data['poll_id'])) {
            $instance->pollId = $data['poll_id'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['option_ids'])) {
            $instance->optionIds = [];
            foreach ($data['option_ids'] as $item) {
                $instance->optionIds[] = $item;
            }
        }
        return $instance;
    }

    public function getPollId(): ?string {
        return $this->pollId;
    }

    public function setPollId(?string $value): self {
        $this->pollId = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

    public function getOptionIds(): ?array {
        return $this->optionIds;
    }

    public function setOptionIds(?array $value): self {
        $this->optionIds = $value;
        return $this;
    }

}
