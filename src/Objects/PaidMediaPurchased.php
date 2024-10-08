<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PaidMediaPurchased {

    use ObjectTrait;

    /**
     * From
     *
     * User who purchased the media
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * Paid Media Payload
     *
     * Bot-specified paid media payload
     * @var string|null
     */
    protected ?string $paidMediaPayload = null;

    public static function fromArray(array $data): PaidMediaPurchased {
        $instance = new self();
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['paid_media_payload'])) {
            $instance->paidMediaPayload = $data['paid_media_payload'];
        }
        return $instance;
    }

    public function __construct(
        ?User   $from = null,
        ?string $paidMediaPayload = null,
    ) {
        $this->from = $from;
        $this->paidMediaPayload = $paidMediaPayload;
    }

    public function getFrom(): ?User {
        return $this->from;
    }

    public function setFrom(?User $value): self {
        $this->from = $value;
        return $this;
    }

    public function getPaidMediaPayload(): ?string {
        return $this->paidMediaPayload;
    }

    public function setPaidMediaPayload(?string $value): self {
        $this->paidMediaPayload = $value;
        return $this;
    }

}
