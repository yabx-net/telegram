<?php

namespace Yabx\Telegram\Objects;

class PollAnswer {

    /**
     * Poll Id
     *
     * Unique poll identifier
     * @var string
     */
    protected string $pollId;

    /**
     * User
     *
     * The user, who changed the answer to the poll
     * @var User
     */
    protected User $user;

    /**
     * Option Ids
     *
     * 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.
     * @var int[]
     */
    protected array $optionIds;


    public function __construct(array $data) {
        if (isset($data['poll_id'])) {
            $this->pollId = $data['poll_id'];
        }
        if (isset($data['user'])) {
            $this->user = new User($data['user']);
        }
        if (isset($data['option_ids'])) {
            $this->optionIds = [];
            foreach ($data['option_ids'] as $item) {
                $this->optionIds[] = $item;
            }
        }
    }

    public function getPollId(): string {
        return $this->pollId;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getOptionIds(): array {
        return $this->optionIds;
    }


}
