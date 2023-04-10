<?php

namespace Yabx\Telegram\Objects;

class ChatInviteLink {

    /**
     * Invite Link
     *
     * The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with “…”.
     * @var string
     */
    protected string $inviteLink;

    /**
     * Creator
     *
     * Creator of the link
     * @var User
     */
    protected User $creator;

    /**
     * Creates Join Request
     *
     * True, if users joining the chat via the link need to be approved by chat administrators
     * @var bool
     */
    protected bool $createsJoinRequest;

    /**
     * Is Primary
     *
     * True, if the link is primary
     * @var bool
     */
    protected bool $isPrimary;

    /**
     * Is Revoked
     *
     * True, if the link is revoked
     * @var bool
     */
    protected bool $isRevoked;

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


    public function __construct(array $data) {
        if (isset($data['invite_link'])) {
            $this->inviteLink = $data['invite_link'];
        }
        if (isset($data['creator'])) {
            $this->creator = new User($data['creator']);
        }
        if (isset($data['creates_join_request'])) {
            $this->createsJoinRequest = $data['creates_join_request'];
        }
        if (isset($data['is_primary'])) {
            $this->isPrimary = $data['is_primary'];
        }
        if (isset($data['is_revoked'])) {
            $this->isRevoked = $data['is_revoked'];
        }
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
        if (isset($data['expire_date'])) {
            $this->expireDate = $data['expire_date'];
        }
        if (isset($data['member_limit'])) {
            $this->memberLimit = $data['member_limit'];
        }
        if (isset($data['pending_join_request_count'])) {
            $this->pendingJoinRequestCount = $data['pending_join_request_count'];
        }
    }

    public function getInviteLink(): string {
        return $this->inviteLink;
    }

    public function getCreator(): User {
        return $this->creator;
    }

    public function getCreatesJoinRequest(): bool {
        return $this->createsJoinRequest;
    }

    public function getIsPrimary(): bool {
        return $this->isPrimary;
    }

    public function getIsRevoked(): bool {
        return $this->isRevoked;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getExpireDate(): ?int {
        return $this->expireDate;
    }

    public function getMemberLimit(): ?int {
        return $this->memberLimit;
    }

    public function getPendingJoinRequestCount(): ?int {
        return $this->pendingJoinRequestCount;
    }


}
