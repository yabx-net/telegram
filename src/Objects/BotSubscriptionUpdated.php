<?php

namespace Yabx\Telegram\Objects;

/**
 * This object contains information about changes to a user payment subscription toward the current bot.
 * @link https://core.telegram.org/bots/api#botsubscriptionupdated
 */
final class BotSubscriptionUpdated extends AbstractObject {

    /**
     * User
     *
     * User who subscribed for payments toward the bot
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Invoice Payload
     *
     * Bot-specified invoice payload
     * @var string|null
     */
    protected ?string $invoicePayload = null;

    /**
     * State
     *
     * The new state of the subscription. Currently, it can be one of "canceled" if the user canceled the subscription, "active" if the user re-enabled a previously canceled subscription, or "failed" if payment for the subscription failed.
     * @var string|null
     */
    protected ?string $state = null;

    public function __construct(
        ?User $user = null,
        ?string $invoicePayload = null,
        ?string $state = null
    ) {
        $this->user = $user;
        $this->invoicePayload = $invoicePayload;
        $this->state = $state;
    }

    public static function fromArray(array $data): BotSubscriptionUpdated {
        $instance = new self();
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['invoice_payload'])) {
            $instance->invoicePayload = $data['invoice_payload'];
        }
        if (isset($data['state'])) {
            $instance->state = $data['state'];
        }
        return $instance;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

    public function getInvoicePayload(): ?string {
        return $this->invoicePayload;
    }

    public function setInvoicePayload(?string $value): self {
        $this->invoicePayload = $value;
        return $this;
    }

    public function getState(): ?string {
        return $this->state;
    }

    public function setState(?string $value): self {
        $this->state = $value;
        return $this;
    }
}
