<?php

namespace Yabx\Telegram\Objects;

class ChosenInlineResult {

    /**
     * Result Id
     *
     * The unique identifier for the result that was chosen
     * @var string
     */
    protected string $resultId;

    /**
     * From
     *
     * The user that chose the result
     * @var User
     */
    protected User $from;

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
     * @var string
     */
    protected string $query;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['result_id'])) {
            $this->resultId = $data['result_id'];
        }
        if (isset($data['from'])) {
            $this->from = new User($data['from']);
        }
        if (isset($data['location'])) {
            $this->location = new Location($data['location']);
        }
        if (isset($data['inline_message_id'])) {
            $this->inlineMessageId = $data['inline_message_id'];
        }
        if (isset($data['query'])) {
            $this->query = $data['query'];
        }
    }

    public function getResultId(): string {
        return $this->resultId;
    }

    public function getFrom(): User {
        return $this->from;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function getInlineMessageId(): ?string {
        return $this->inlineMessageId;
    }

    public function getQuery(): string {
        return $this->query;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
