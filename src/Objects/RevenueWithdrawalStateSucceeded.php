<?php

namespace Yabx\Telegram\Objects;

final class RevenueWithdrawalStateSucceeded extends RevenueWithdrawalState {

    /**
     * Type
     *
     * Type of the state, always “succeeded”
     * @var string
     */
    protected string $type = 'succeeded';

    /**
     * Date
     *
     * Date the withdrawal was completed in Unix time
     * @var int|null
     */
    protected ?int $date = null;

    /**
     * Url
     *
     * An HTTPS URL that can be used to see transaction details
     * @var string|null
     */
    protected ?string $url = null;

    public static function fromArray(array $data): RevenueWithdrawalStateSucceeded {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['date'])) {
            $instance->date = $data['date'];
        }
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        return $instance;
    }

    public function __construct(
        ?int    $date = null,
        ?string $url = null,
    ) {
        $this->date = $date;
        $this->url = $url;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getDate(): ?int {
        return $this->date;
    }

    public function setDate(?int $value): self {
        $this->date = $value;
        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

}
