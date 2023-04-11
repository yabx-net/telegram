<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class WebhookInfo {

    use ObjectTrait;

    /**
     * Url
     *
     * Webhook URL, may be empty if webhook is not set up
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * Has Custom Certificate
     *
     * True, if a custom certificate was provided for webhook certificate checks
     * @var bool|null
     */
    protected ?bool $hasCustomCertificate = null;

    /**
     * Pending Update Count
     *
     * Number of updates awaiting delivery
     * @var int|null
     */
    protected ?int $pendingUpdateCount = null;

    /**
     * Ip Address
     *
     * Optional. Currently used webhook IP address
     * @var string|null
     */
    protected ?string $ipAddress = null;

    /**
     * Last Error Date
     *
     * Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook
     * @var int|null
     */
    protected ?int $lastErrorDate = null;

    /**
     * Last Error Message
     *
     * Optional. Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook
     * @var string|null
     */
    protected ?string $lastErrorMessage = null;

    /**
     * Last Synchronization Error Date
     *
     * Optional. Unix time of the most recent error that happened when trying to synchronize available updates with Telegram datacenters
     * @var int|null
     */
    protected ?int $lastSynchronizationErrorDate = null;

    /**
     * Max Connections
     *
     * Optional. The maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
     * @var int|null
     */
    protected ?int $maxConnections = null;

    /**
     * Allowed Updates
     *
     * Optional. A list of update types the bot is subscribed to. Defaults to all update types except chat_member
     * @var string[]|null
     */
    protected ?array $allowedUpdates = null;

    public function __construct(
        ?string $url = null,
        ?bool   $hasCustomCertificate = null,
        ?int    $pendingUpdateCount = null,
        ?string $ipAddress = null,
        ?int    $lastErrorDate = null,
        ?string $lastErrorMessage = null,
        ?int    $lastSynchronizationErrorDate = null,
        ?int    $maxConnections = null,
        ?array  $allowedUpdates = null,
    ) {
        $this->url = $url;
        $this->hasCustomCertificate = $hasCustomCertificate;
        $this->pendingUpdateCount = $pendingUpdateCount;
        $this->ipAddress = $ipAddress;
        $this->lastErrorDate = $lastErrorDate;
        $this->lastErrorMessage = $lastErrorMessage;
        $this->lastSynchronizationErrorDate = $lastSynchronizationErrorDate;
        $this->maxConnections = $maxConnections;
        $this->allowedUpdates = $allowedUpdates;
    }

    public static function fromArray(array $data): WebhookInfo {
        $instance = new self();
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        if (isset($data['has_custom_certificate'])) {
            $instance->hasCustomCertificate = $data['has_custom_certificate'];
        }
        if (isset($data['pending_update_count'])) {
            $instance->pendingUpdateCount = $data['pending_update_count'];
        }
        if (isset($data['ip_address'])) {
            $instance->ipAddress = $data['ip_address'];
        }
        if (isset($data['last_error_date'])) {
            $instance->lastErrorDate = $data['last_error_date'];
        }
        if (isset($data['last_error_message'])) {
            $instance->lastErrorMessage = $data['last_error_message'];
        }
        if (isset($data['last_synchronization_error_date'])) {
            $instance->lastSynchronizationErrorDate = $data['last_synchronization_error_date'];
        }
        if (isset($data['max_connections'])) {
            $instance->maxConnections = $data['max_connections'];
        }
        if (isset($data['allowed_updates'])) {
            $instance->allowedUpdates = [];
            foreach ($data['allowed_updates'] as $item) {
                $instance->allowedUpdates[] = $item;
            }
        }
        return $instance;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

    public function getHasCustomCertificate(): ?bool {
        return $this->hasCustomCertificate;
    }

    public function setHasCustomCertificate(?bool $value): self {
        $this->hasCustomCertificate = $value;
        return $this;
    }

    public function getPendingUpdateCount(): ?int {
        return $this->pendingUpdateCount;
    }

    public function setPendingUpdateCount(?int $value): self {
        $this->pendingUpdateCount = $value;
        return $this;
    }

    public function getIpAddress(): ?string {
        return $this->ipAddress;
    }

    public function setIpAddress(?string $value): self {
        $this->ipAddress = $value;
        return $this;
    }

    public function getLastErrorDate(): ?int {
        return $this->lastErrorDate;
    }

    public function setLastErrorDate(?int $value): self {
        $this->lastErrorDate = $value;
        return $this;
    }

    public function getLastErrorMessage(): ?string {
        return $this->lastErrorMessage;
    }

    public function setLastErrorMessage(?string $value): self {
        $this->lastErrorMessage = $value;
        return $this;
    }

    public function getLastSynchronizationErrorDate(): ?int {
        return $this->lastSynchronizationErrorDate;
    }

    public function setLastSynchronizationErrorDate(?int $value): self {
        $this->lastSynchronizationErrorDate = $value;
        return $this;
    }

    public function getMaxConnections(): ?int {
        return $this->maxConnections;
    }

    public function setMaxConnections(?int $value): self {
        $this->maxConnections = $value;
        return $this;
    }

    public function getAllowedUpdates(): ?array {
        return $this->allowedUpdates;
    }

    public function setAllowedUpdates(?array $value): self {
        $this->allowedUpdates = $value;
        return $this;
    }

}
