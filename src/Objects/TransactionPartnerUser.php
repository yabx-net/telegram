<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class TransactionPartnerUser extends TransactionPartner {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the transaction partner, always “user”
     * @var string|null
     */
    protected ?string $type = null;

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
     * Paid Media
     *
     * Optional. Information about the paid media bought by the user
     * @var PaidMedia[]|null
     */
    protected ?array $paidMedia = null;

    public function __construct(
        ?string $type = null,
        ?User   $user = null,
        ?string $invoicePayload = null,
        ?array  $paidMedia = null,
    ) {
        $this->type = $type;
        $this->user = $user;
        $this->invoicePayload = $invoicePayload;
        $this->paidMedia = $paidMedia;
    }

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
        if (isset($data['paid_media'])) {
            $instance->paidMedia = [];
            foreach ($data['paid_media'] as $item) {
                $instance->paidMedia[] = PaidMedia::fromArray($item);
            }
        }
        return $instance;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
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

    public function getPaidMedia(): ?array {
        return $this->paidMedia;
    }

    public function setPaidMedia(?array $value): self {
        $this->paidMedia = $value;
        return $this;
    }

}
