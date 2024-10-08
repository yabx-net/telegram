<?php

namespace Yabx\Telegram\Objects;

final class PollAnswer extends AbstractObject {

    /**
     * Poll Id
     *
     * Unique poll identifier
     * @var string|null
     */
    protected ?string $pollId = null;

    /**
     * Voter Chat
     *
     * Optional. The chat that changed the answer to the poll, if the voter is anonymous
     * @var Chat|null
     */
    protected ?Chat $voterChat = null;

    /**
     * User
     *
     * Optional. The user that changed the answer to the poll, if the voter isn't anonymous
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Option Ids
     *
     * 0-based identifiers of chosen answer options. May be empty if the vote was retracted.
     * @var int[]|null
     */
    protected ?array $optionIds = null;

    public function __construct(
        ?string $pollId = null,
        ?Chat   $voterChat = null,
        ?User   $user = null,
        ?array  $optionIds = null,
    ) {
        $this->pollId = $pollId;
        $this->voterChat = $voterChat;
        $this->user = $user;
        $this->optionIds = $optionIds;
    }

    public static function fromArray(array $data): PollAnswer {
        $instance = new self();
        if (isset($data['poll_id'])) {
            $instance->pollId = $data['poll_id'];
        }
        if (isset($data['voter_chat'])) {
            $instance->voterChat = Chat::fromArray($data['voter_chat']);
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

    public function getVoterChat(): ?Chat {
        return $this->voterChat;
    }

    public function setVoterChat(?Chat $value): self {
        $this->voterChat = $value;
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
