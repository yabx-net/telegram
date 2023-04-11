<?php

namespace Yabx\Telegram\Objects;

class InlineQuery {

    /**
     * Id
     *
     * Unique identifier for this query
     * @var string
     */
    protected string $id;

    /**
     * From
     *
     * Sender
     * @var User
     */
    protected User $from;

    /**
     * Query
     *
     * Text of the query (up to 256 characters)
     * @var string
     */
    protected string $query;

    /**
     * Offset
     *
     * Offset of the results to be returned, can be controlled by the bot
     * @var string
     */
    protected string $offset;

    /**
     * Chat Type
     *
     * Optional. Type of the chat from which the inline query was sent. Can be either “sender” for a private chat with the inline query sender, “private”, “group”, “supergroup”, or “channel”. The chat type should be always known for requests sent from official clients and most third-party clients, unless the request was sent from a secret chat
     * @var string|null
     */
    protected ?string $chatType = null;

    /**
     * Location
     *
     * Optional. Sender location, only for bots that request user location
     * @var Location|null
     */
    protected ?Location $location = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['from'])) {
            $this->from = new User($data['from']);
        }
        if (isset($data['query'])) {
            $this->query = $data['query'];
        }
        if (isset($data['offset'])) {
            $this->offset = $data['offset'];
        }
        if (isset($data['chat_type'])) {
            $this->chatType = $data['chat_type'];
        }
        if (isset($data['location'])) {
            $this->location = new Location($data['location']);
        }
    }

    public function getId(): string {
        return $this->id;
    }

    public function getFrom(): User {
        return $this->from;
    }

    public function getQuery(): string {
        return $this->query;
    }

    public function getOffset(): string {
        return $this->offset;
    }

    public function getChatType(): ?string {
        return $this->chatType;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
