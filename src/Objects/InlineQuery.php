<?php

namespace Yabx\Telegram\Objects;

final class InlineQuery extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier for this query
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * From
     *
     * Sender
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * Query
     *
     * Text of the query (up to 256 characters)
     * @var string|null
     */
    protected ?string $query = null;

    /**
     * Offset
     *
     * Offset of the results to be returned, can be controlled by the bot
     * @var string|null
     */
    protected ?string $offset = null;

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

    public function __construct(
        ?string   $id = null,
        ?User     $from = null,
        ?string   $query = null,
        ?string   $offset = null,
        ?string   $chatType = null,
        ?Location $location = null,
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->query = $query;
        $this->offset = $offset;
        $this->chatType = $chatType;
        $this->location = $location;
    }

    public static function fromArray(array $data): InlineQuery {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['query'])) {
            $instance->query = $data['query'];
        }
        if (isset($data['offset'])) {
            $instance->offset = $data['offset'];
        }
        if (isset($data['chat_type'])) {
            $instance->chatType = $data['chat_type'];
        }
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
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

    public function getFrom(): ?User {
        return $this->from;
    }

    public function setFrom(?User $value): self {
        $this->from = $value;
        return $this;
    }

    public function getQuery(): ?string {
        return $this->query;
    }

    public function setQuery(?string $value): self {
        $this->query = $value;
        return $this;
    }

    public function getOffset(): ?string {
        return $this->offset;
    }

    public function setOffset(?string $value): self {
        $this->offset = $value;
        return $this;
    }

    public function getChatType(): ?string {
        return $this->chatType;
    }

    public function setChatType(?string $value): self {
        $this->chatType = $value;
        return $this;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function setLocation(?Location $value): self {
        $this->location = $value;
        return $this;
    }

}
