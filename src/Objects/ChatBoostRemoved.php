<?php

namespace Yabx\Telegram\Objects;

final class ChatBoostRemoved extends AbstractObject {

    /**
     * Chat
     *
     * Chat which was boosted
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Boost Id
     *
     * Unique identifier of the boost
     * @var string|null
     */
    protected ?string $boostId = null;

    /**
     * Remove Date
     *
     * Point in time (Unix timestamp) when the boost was removed
     * @var int|null
     */
    protected ?int $removeDate = null;

    /**
     * Source
     *
     * Source of the removed boost
     * @var ChatBoostSource|null
     */
    protected ?ChatBoostSource $source = null;

    public function __construct(
        ?Chat            $chat = null,
        ?string          $boostId = null,
        ?int             $removeDate = null,
        ?ChatBoostSource $source = null,
    ) {
        $this->chat = $chat;
        $this->boostId = $boostId;
        $this->removeDate = $removeDate;
        $this->source = $source;
    }

    public static function fromArray(array $data): ChatBoostRemoved {
        $instance = new self();
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['boost_id'])) {
            $instance->boostId = $data['boost_id'];
        }
        if (isset($data['remove_date'])) {
            $instance->removeDate = $data['remove_date'];
        }
        if (isset($data['source'])) {
            $instance->source = ChatBoostSource::fromArray($data['source']);
        }
        return $instance;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getBoostId(): ?string {
        return $this->boostId;
    }

    public function setBoostId(?string $value): self {
        $this->boostId = $value;
        return $this;
    }

    public function getRemoveDate(): ?int {
        return $this->removeDate;
    }

    public function setRemoveDate(?int $value): self {
        $this->removeDate = $value;
        return $this;
    }

    public function getSource(): ?ChatBoostSource {
        return $this->source;
    }

    public function setSource(?ChatBoostSource $value): self {
        $this->source = $value;
        return $this;
    }

}
