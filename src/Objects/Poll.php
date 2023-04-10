<?php

namespace Yabx\Telegram\Objects;

class Poll {

    /**
     * Id
     *
     * Unique poll identifier
     * @var string
     */
    protected string $id;

    /**
     * Question
     *
     * Poll question, 1-300 characters
     * @var string
     */
    protected string $question;

    /**
     * Options
     *
     * List of poll options
     * @var PollOption[]
     */
    protected array $options;

    /**
     * Total Voter Count
     *
     * Total number of users that voted in the poll
     * @var int
     */
    protected int $totalVoterCount;

    /**
     * Is Closed
     *
     * True, if the poll is closed
     * @var bool
     */
    protected bool $isClosed;

    /**
     * Is Anonymous
     *
     * True, if the poll is anonymous
     * @var bool
     */
    protected bool $isAnonymous;

    /**
     * Type
     *
     * Poll type, currently can be “regular” or “quiz”
     * @var string
     */
    protected string $type;

    /**
     * Allows Multiple Answers
     *
     * True, if the poll allows multiple answers
     * @var bool
     */
    protected bool $allowsMultipleAnswers;

    /**
     * Correct Option Id
     *
     * Optional. 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
     * @var int|null
     */
    protected ?int $correctOptionId = null;

    /**
     * Explanation
     *
     * Optional. Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters
     * @var string|null
     */
    protected ?string $explanation = null;

    /**
     * Explanation Entities
     *
     * Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
     * @var MessageEntity[]|null
     */
    protected ?array $explanationEntities = null;

    /**
     * Open Period
     *
     * Optional. Amount of time in seconds the poll will be active after creation
     * @var int|null
     */
    protected ?int $openPeriod = null;

    /**
     * Close Date
     *
     * Optional. Point in time (Unix timestamp) when the poll will be automatically closed
     * @var int|null
     */
    protected ?int $closeDate = null;


    public function __construct(array $data) {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['question'])) {
            $this->question = $data['question'];
        }
        if (isset($data['options'])) {
            $this->options = [];
            foreach ($data['options'] as $item) {
                $this->options[] = new PollOption($item);
            }
        }
        if (isset($data['total_voter_count'])) {
            $this->totalVoterCount = $data['total_voter_count'];
        }
        if (isset($data['is_closed'])) {
            $this->isClosed = $data['is_closed'];
        }
        if (isset($data['is_anonymous'])) {
            $this->isAnonymous = $data['is_anonymous'];
        }
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['allows_multiple_answers'])) {
            $this->allowsMultipleAnswers = $data['allows_multiple_answers'];
        }
        if (isset($data['correct_option_id'])) {
            $this->correctOptionId = $data['correct_option_id'];
        }
        if (isset($data['explanation'])) {
            $this->explanation = $data['explanation'];
        }
        if (isset($data['explanation_entities'])) {
            $this->explanationEntities = [];
            foreach ($data['explanation_entities'] as $item) {
                $this->explanationEntities[] = new MessageEntity($item);
            }
        }
        if (isset($data['open_period'])) {
            $this->openPeriod = $data['open_period'];
        }
        if (isset($data['close_date'])) {
            $this->closeDate = $data['close_date'];
        }
    }

    public function getId(): string {
        return $this->id;
    }

    public function getQuestion(): string {
        return $this->question;
    }

    public function getOptions(): array {
        return $this->options;
    }

    public function getTotalVoterCount(): int {
        return $this->totalVoterCount;
    }

    public function getIsClosed(): bool {
        return $this->isClosed;
    }

    public function getIsAnonymous(): bool {
        return $this->isAnonymous;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getAllowsMultipleAnswers(): bool {
        return $this->allowsMultipleAnswers;
    }

    public function getCorrectOptionId(): ?int {
        return $this->correctOptionId;
    }

    public function getExplanation(): ?string {
        return $this->explanation;
    }

    public function getExplanationEntities(): ?array {
        return $this->explanationEntities;
    }

    public function getOpenPeriod(): ?int {
        return $this->openPeriod;
    }

    public function getCloseDate(): ?int {
        return $this->closeDate;
    }


}
