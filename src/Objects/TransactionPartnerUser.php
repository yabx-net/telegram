<?php

namespace Yabx\Telegram\Objects;

final class TransactionPartnerUser extends TransactionPartner {

    /**
     * Type
     *
     * Type of the transaction partner, always “user”
     * @var string
     */
    protected string $type = 'user';

    /**
     * User
     *
     * Information about the user
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Invoice Payload
     *
     * Optional. Bot-specified invoice payload
     * @var string|null
     */
    protected ?string $invoicePayload = null;

    /**
     * Subscription Period
     *
     * Optional. The duration of the paid subscription
     * @var int|null
     */
    protected ?int $subscriptionPeriod = null;

    /**
     * Paid Media
     *
     * Optional. Information about the paid media bought by the user
     * @var PaidMedia[]|null
     */
    protected ?array $paidMedia = null;

    /**
     * Paid Media Payload
     *
     * Optional. Bot-specified paid media payload
     * @var string|null
     */
    protected ?string $paidMediaPayload = null;

    /**
     * Gift
     *
     * Optional. The gift sent to the user by the bot
     * @var string|null
     */
    protected ?string $gift = null;

    public static function fromArray(array $data): TransactionPartnerUser {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['invoice_payload'])) {
            $instance->invoicePayload = $data['invoice_payload'];
        }
        if (isset($data['subscription_period'])) {
            $instance->subscriptionPeriod = $data['subscription_period'];
        }
        if (isset($data['paid_media'])) {
            $instance->paidMedia = [];
            foreach ($data['paid_media'] as $item) {
                $instance->paidMedia[] = PaidMedia::fromArray($item);
            }
        }
        if (isset($data['paid_media_payload'])) {
            $instance->paidMediaPayload = $data['paid_media_payload'];
        }
        if (isset($data['gift'])) {
            $instance->gift = $data['gift'];
        }
        return $instance;
    }

    public function __construct(
        ?User   $user = null,
        ?string $invoicePayload = null,
        ?int    $subscriptionPeriod = null,
        ?array  $paidMedia = null,
        ?string $paidMediaPayload = null,
        ?string $gift = null,
    ) {
        $this->user = $user;
        $this->invoicePayload = $invoicePayload;
        $this->subscriptionPeriod = $subscriptionPeriod;
        $this->paidMedia = $paidMedia;
        $this->paidMediaPayload = $paidMediaPayload;
        $this->gift = $gift;
    }

    public function getType(): string {
        return $this->type;
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

    public function getSubscriptionPeriod(): ?int {
        return $this->subscriptionPeriod;
    }

    public function setSubscriptionPeriod(?int $value): self {
        $this->subscriptionPeriod = $value;
        return $this;
    }

    public function getPaidMedia(): ?array {
        return $this->paidMedia;
    }

    public function setPaidMedia(?array $value): self {
        $this->paidMedia = $value;
        return $this;
    }

    public function getPaidMediaPayload(): ?string {
        return $this->paidMediaPayload;
    }

    public function setPaidMediaPayload(?string $value): self {
        $this->paidMediaPayload = $value;
        return $this;
    }

    public function getGift(): ?string {
        return $this->gift;
    }

    public function setGift(?string $value): self {
        $this->gift = $value;
        return $this;
    }

}
