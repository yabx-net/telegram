<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatBoost {

    use ObjectTrait;

    /**
     * Boost Id
     *
     * Unique identifier of the boost
     * @var string|null
     */
    protected ?string $boostId = null;

    /**
     * Add Date
     *
     * Point in time (Unix timestamp) when the chat was boosted
     * @var int|null
     */
    protected ?int $addDate = null;

    /**
     * Expiration Date
     *
     * Point in time (Unix timestamp) when the boost will automatically expire, unless the booster's Telegram Premium subscription is prolonged
     * @var int|null
     */
    protected ?int $expirationDate = null;

    /**
     * Source
     *
     * Source of the added boost
     * @var ChatBoostSource|null
     */
    protected ?ChatBoostSource $source = null;

    public function __construct(
        ?string          $boostId = null,
        ?int             $addDate = null,
        ?int             $expirationDate = null,
        ?ChatBoostSource $source = null,
    ) {
        $this->boostId = $boostId;
        $this->addDate = $addDate;
        $this->expirationDate = $expirationDate;
        $this->source = $source;
    }

    public static function fromArray(array $data): ChatBoost {
        $instance = new self();
        if (isset($data['boost_id'])) {
            $instance->boostId = $data['boost_id'];
        }
        if (isset($data['add_date'])) {
            $instance->addDate = $data['add_date'];
        }
        if (isset($data['expiration_date'])) {
            $instance->expirationDate = $data['expiration_date'];
        }
        if (isset($data['source'])) {
            $instance->source = ChatBoostSource::fromArray($data['source']);
        }
        return $instance;
    }

    public function getBoostId(): ?string {
        return $this->boostId;
    }

    public function setBoostId(?string $value): self {
        $this->boostId = $value;
        return $this;
    }

    public function getAddDate(): ?int {
        return $this->addDate;
    }

    public function setAddDate(?int $value): self {
        $this->addDate = $value;
        return $this;
    }

    public function getExpirationDate(): ?int {
        return $this->expirationDate;
    }

    public function setExpirationDate(?int $value): self {
        $this->expirationDate = $value;
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
