<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Poll {

    use ObjectTrait;

    /**
     * Id
     *
     * Unique poll identifier
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Question
     *
     * Poll question, 1-300 characters
     * @var string|null
     */
    protected ?string $question = null;

    /**
     * Question Entities
     *
     * Optional. Special entities that appear in the question. Currently, only custom emoji entities are allowed in poll questions
     * @var MessageEntity[]|null
     */
    protected ?array $questionEntities = null;

    /**
     * Options
     *
     * List of poll options
     * @var PollOption[]|null
     */
    protected ?array $options = null;

    /**
     * Total Voter Count
     *
     * Total number of users that voted in the poll
     * @var int|null
     */
    protected ?int $totalVoterCount = null;

    /**
     * Is Closed
     *
     * True, if the poll is closed
     * @var bool|null
     */
    protected ?bool $isClosed = null;

    /**
     * Is Anonymous
     *
     * True, if the poll is anonymous
     * @var bool|null
     */
    protected ?bool $isAnonymous = null;

    /**
     * Type
     *
     * Poll type, currently can be “regular” or “quiz”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Allows Multiple Answers
     *
     * True, if the poll allows multiple answers
     * @var bool|null
     */
    protected ?bool $allowsMultipleAnswers = null;

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

    public function __construct(
        ?string $id = null,
        ?string $question = null,
        ?array  $questionEntities = null,
        ?array  $options = null,
        ?int    $totalVoterCount = null,
        ?bool   $isClosed = null,
        ?bool   $isAnonymous = null,
        ?string $type = null,
        ?bool   $allowsMultipleAnswers = null,
        ?int    $correctOptionId = null,
        ?string $explanation = null,
        ?array  $explanationEntities = null,
        ?int    $openPeriod = null,
        ?int    $closeDate = null,
    ) {
        $this->id = $id;
        $this->question = $question;
        $this->questionEntities = $questionEntities;
        $this->options = $options;
        $this->totalVoterCount = $totalVoterCount;
        $this->isClosed = $isClosed;
        $this->isAnonymous = $isAnonymous;
        $this->type = $type;
        $this->allowsMultipleAnswers = $allowsMultipleAnswers;
        $this->correctOptionId = $correctOptionId;
        $this->explanation = $explanation;
        $this->explanationEntities = $explanationEntities;
        $this->openPeriod = $openPeriod;
        $this->closeDate = $closeDate;
    }

    public static function fromArray(array $data): Poll {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['question'])) {
            $instance->question = $data['question'];
        }
        if (isset($data['question_entities'])) {
            $instance->questionEntities = [];
            foreach ($data['question_entities'] as $item) {
                $instance->questionEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['options'])) {
            $instance->options = [];
            foreach ($data['options'] as $item) {
                $instance->options[] = PollOption::fromArray($item);
            }
        }
        if (isset($data['total_voter_count'])) {
            $instance->totalVoterCount = $data['total_voter_count'];
        }
        if (isset($data['is_closed'])) {
            $instance->isClosed = $data['is_closed'];
        }
        if (isset($data['is_anonymous'])) {
            $instance->isAnonymous = $data['is_anonymous'];
        }
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['allows_multiple_answers'])) {
            $instance->allowsMultipleAnswers = $data['allows_multiple_answers'];
        }
        if (isset($data['correct_option_id'])) {
            $instance->correctOptionId = $data['correct_option_id'];
        }
        if (isset($data['explanation'])) {
            $instance->explanation = $data['explanation'];
        }
        if (isset($data['explanation_entities'])) {
            $instance->explanationEntities = [];
            foreach ($data['explanation_entities'] as $item) {
                $instance->explanationEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['open_period'])) {
            $instance->openPeriod = $data['open_period'];
        }
        if (isset($data['close_date'])) {
            $instance->closeDate = $data['close_date'];
        }
        return $instance;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getQuestion(): ?string {
        return $this->question;
    }

    public function setQuestion(?string $value): self {
        $this->question = $value;
        return $this;
    }

    public function getQuestionEntities(): ?array {
        return $this->questionEntities;
    }

    public function setQuestionEntities(?array $value): self {
        $this->questionEntities = $value;
        return $this;
    }

    public function getOptions(): ?array {
        return $this->options;
    }

    public function setOptions(?array $value): self {
        $this->options = $value;
        return $this;
    }

    public function getTotalVoterCount(): ?int {
        return $this->totalVoterCount;
    }

    public function setTotalVoterCount(?int $value): self {
        $this->totalVoterCount = $value;
        return $this;
    }

    public function getIsClosed(): ?bool {
        return $this->isClosed;
    }

    public function setIsClosed(?bool $value): self {
        $this->isClosed = $value;
        return $this;
    }

    public function getIsAnonymous(): ?bool {
        return $this->isAnonymous;
    }

    public function setIsAnonymous(?bool $value): self {
        $this->isAnonymous = $value;
        return $this;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getAllowsMultipleAnswers(): ?bool {
        return $this->allowsMultipleAnswers;
    }

    public function setAllowsMultipleAnswers(?bool $value): self {
        $this->allowsMultipleAnswers = $value;
        return $this;
    }

    public function getCorrectOptionId(): ?int {
        return $this->correctOptionId;
    }

    public function setCorrectOptionId(?int $value): self {
        $this->correctOptionId = $value;
        return $this;
    }

    public function getExplanation(): ?string {
        return $this->explanation;
    }

    public function setExplanation(?string $value): self {
        $this->explanation = $value;
        return $this;
    }

    public function getExplanationEntities(): ?array {
        return $this->explanationEntities;
    }

    public function setExplanationEntities(?array $value): self {
        $this->explanationEntities = $value;
        return $this;
    }

    public function getOpenPeriod(): ?int {
        return $this->openPeriod;
    }

    public function setOpenPeriod(?int $value): self {
        $this->openPeriod = $value;
        return $this;
    }

    public function getCloseDate(): ?int {
        return $this->closeDate;
    }

    public function setCloseDate(?int $value): self {
        $this->closeDate = $value;
        return $this;
    }

}
