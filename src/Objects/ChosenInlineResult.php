<?php

namespace Yabx\Telegram\Objects;

final class ChosenInlineResult extends AbstractObject {

    /**
     * Result Id
     *
     * The unique identifier for the result that was chosen
     * @var string|null
     */
    protected ?string $resultId = null;

    /**
     * From
     *
     * The user that chose the result
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * Location
     *
     * Optional. Sender location, only for bots that require user location
     * @var Location|null
     */
    protected ?Location $location = null;

    /**
     * Inline Message Id
     *
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
     * @var string|null
     */
    protected ?string $inlineMessageId = null;

    /**
     * Query
     *
     * The query that was used to obtain the result
     * @var string|null
     */
    protected ?string $query = null;

    public function __construct(
        ?string   $resultId = null,
        ?User     $from = null,
        ?Location $location = null,
        ?string   $inlineMessageId = null,
        ?string   $query = null,
    ) {
        $this->resultId = $resultId;
        $this->from = $from;
        $this->location = $location;
        $this->inlineMessageId = $inlineMessageId;
        $this->query = $query;
    }

    public static function fromArray(array $data): ChosenInlineResult {
        $instance = new self();
        if (isset($data['result_id'])) {
            $instance->resultId = $data['result_id'];
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
        }
        if (isset($data['inline_message_id'])) {
            $instance->inlineMessageId = $data['inline_message_id'];
        }
        if (isset($data['query'])) {
            $instance->query = $data['query'];
        }
        return $instance;
    }

    public function getResultId(): ?string {
        return $this->resultId;
    }

    public function setResultId(?string $value): self {
        $this->resultId = $value;
        return $this;
    }

    public function getFrom(): ?User {
        return $this->from;
    }

    public function setFrom(?User $value): self {
        $this->from = $value;
        return $this;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function setLocation(?Location $value): self {
        $this->location = $value;
        return $this;
    }

    public function getInlineMessageId(): ?string {
        return $this->inlineMessageId;
    }

    public function setInlineMessageId(?string $value): self {
        $this->inlineMessageId = $value;
        return $this;
    }

    public function getQuery(): ?string {
        return $this->query;
    }

    public function setQuery(?string $value): self {
        $this->query = $value;
        return $this;
    }

}
