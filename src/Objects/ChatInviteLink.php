<?php

namespace Yabx\Telegram\Objects;

final class ChatInviteLink extends AbstractObject {

    /**
     * Invite Link
     *
     * The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with “…”.
     * @var string|null
     */
    protected ?string $inviteLink = null;

    /**
     * Creator
     *
     * Creator of the link
     * @var User|null
     */
    protected ?User $creator = null;

    /**
     * Creates Join Request
     *
     * True, if users joining the chat via the link need to be approved by chat administrators
     * @var bool|null
     */
    protected ?bool $createsJoinRequest = null;

    /**
     * Is Primary
     *
     * True, if the link is primary
     * @var bool|null
     */
    protected ?bool $isPrimary = null;

    /**
     * Is Revoked
     *
     * True, if the link is revoked
     * @var bool|null
     */
    protected ?bool $isRevoked = null;

    /**
     * Name
     *
     * Optional. Invite link name
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Expire Date
     *
     * Optional. Point in time (Unix timestamp) when the link will expire or has been expired
     * @var int|null
     */
    protected ?int $expireDate = null;

    /**
     * Member Limit
     *
     * Optional. The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
     * @var int|null
     */
    protected ?int $memberLimit = null;

    /**
     * Pending Join Request Count
     *
     * Optional. Number of pending join requests created using this link
     * @var int|null
     */
    protected ?int $pendingJoinRequestCount = null;

    /**
     * Subscription Period
     *
     * Optional. The number of seconds the subscription will be active for before the next payment
     * @var int|null
     */
    protected ?int $subscriptionPeriod = null;

    /**
     * Subscription Price
     *
     * Optional. The amount of Telegram Stars a user must pay initially and after each subsequent subscription period to be a member of the chat using the link
     * @var int|null
     */
    protected ?int $subscriptionPrice = null;

    public function __construct(
        ?string $inviteLink = null,
        ?User   $creator = null,
        ?bool   $createsJoinRequest = null,
        ?bool   $isPrimary = null,
        ?bool   $isRevoked = null,
        ?string $name = null,
        ?int    $expireDate = null,
        ?int    $memberLimit = null,
        ?int    $pendingJoinRequestCount = null,
        ?int    $subscriptionPeriod = null,
        ?int    $subscriptionPrice = null,
    ) {
        $this->inviteLink = $inviteLink;
        $this->creator = $creator;
        $this->createsJoinRequest = $createsJoinRequest;
        $this->isPrimary = $isPrimary;
        $this->isRevoked = $isRevoked;
        $this->name = $name;
        $this->expireDate = $expireDate;
        $this->memberLimit = $memberLimit;
        $this->pendingJoinRequestCount = $pendingJoinRequestCount;
        $this->subscriptionPeriod = $subscriptionPeriod;
        $this->subscriptionPrice = $subscriptionPrice;
    }

    public static function fromArray(array $data): ChatInviteLink {
        $instance = new self();
        if (isset($data['invite_link'])) {
            $instance->inviteLink = $data['invite_link'];
        }
        if (isset($data['creator'])) {
            $instance->creator = User::fromArray($data['creator']);
        }
        if (isset($data['creates_join_request'])) {
            $instance->createsJoinRequest = $data['creates_join_request'];
        }
        if (isset($data['is_primary'])) {
            $instance->isPrimary = $data['is_primary'];
        }
        if (isset($data['is_revoked'])) {
            $instance->isRevoked = $data['is_revoked'];
        }
        if (isset($data['name'])) {
            $instance->name = $data['name'];
        }
        if (isset($data['expire_date'])) {
            $instance->expireDate = $data['expire_date'];
        }
        if (isset($data['member_limit'])) {
            $instance->memberLimit = $data['member_limit'];
        }
        if (isset($data['pending_join_request_count'])) {
            $instance->pendingJoinRequestCount = $data['pending_join_request_count'];
        }
        if (isset($data['subscription_period'])) {
            $instance->subscriptionPeriod = $data['subscription_period'];
        }
        if (isset($data['subscription_price'])) {
            $instance->subscriptionPrice = $data['subscription_price'];
        }
        return $instance;
    }

    public function getInviteLink(): ?string {
        return $this->inviteLink;
    }

    public function setInviteLink(?string $value): self {
        $this->inviteLink = $value;
        return $this;
    }

    public function getCreator(): ?User {
        return $this->creator;
    }

    public function setCreator(?User $value): self {
        $this->creator = $value;
        return $this;
    }

    public function getCreatesJoinRequest(): ?bool {
        return $this->createsJoinRequest;
    }

    public function setCreatesJoinRequest(?bool $value): self {
        $this->createsJoinRequest = $value;
        return $this;
    }

    public function getIsPrimary(): ?bool {
        return $this->isPrimary;
    }

    public function setIsPrimary(?bool $value): self {
        $this->isPrimary = $value;
        return $this;
    }

    public function getIsRevoked(): ?bool {
        return $this->isRevoked;
    }

    public function setIsRevoked(?bool $value): self {
        $this->isRevoked = $value;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $value): self {
        $this->name = $value;
        return $this;
    }

    public function getExpireDate(): ?int {
        return $this->expireDate;
    }

    public function setExpireDate(?int $value): self {
        $this->expireDate = $value;
        return $this;
    }

    public function getMemberLimit(): ?int {
        return $this->memberLimit;
    }

    public function setMemberLimit(?int $value): self {
        $this->memberLimit = $value;
        return $this;
    }

    public function getPendingJoinRequestCount(): ?int {
        return $this->pendingJoinRequestCount;
    }

    public function setPendingJoinRequestCount(?int $value): self {
        $this->pendingJoinRequestCount = $value;
        return $this;
    }

    public function getSubscriptionPeriod(): ?int {
        return $this->subscriptionPeriod;
    }

    public function setSubscriptionPeriod(?int $value): self {
        $this->subscriptionPeriod = $value;
        return $this;
    }

    public function getSubscriptionPrice(): ?int {
        return $this->subscriptionPrice;
    }

    public function setSubscriptionPrice(?int $value): self {
        $this->subscriptionPrice = $value;
        return $this;
    }

}
