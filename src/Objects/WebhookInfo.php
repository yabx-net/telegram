<?php

namespace Yabx\Telegram\Objects;

class WebhookInfo {

    /**
     * Url
     *
     * Webhook URL, may be empty if webhook is not set up
     * @var string
     */
    protected string $url;

    /**
     * Has Custom Certificate
     *
     * True, if a custom certificate was provided for webhook certificate checks
     * @var bool
     */
    protected bool $hasCustomCertificate;

    /**
     * Pending Update Count
     *
     * Number of updates awaiting delivery
     * @var int
     */
    protected int $pendingUpdateCount;

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


    public function __construct(array $data) {
        if (isset($data['url'])) {
            $this->url = $data['url'];
        }
        if (isset($data['has_custom_certificate'])) {
            $this->hasCustomCertificate = $data['has_custom_certificate'];
        }
        if (isset($data['pending_update_count'])) {
            $this->pendingUpdateCount = $data['pending_update_count'];
        }
        if (isset($data['ip_address'])) {
            $this->ipAddress = $data['ip_address'];
        }
        if (isset($data['last_error_date'])) {
            $this->lastErrorDate = $data['last_error_date'];
        }
        if (isset($data['last_error_message'])) {
            $this->lastErrorMessage = $data['last_error_message'];
        }
        if (isset($data['last_synchronization_error_date'])) {
            $this->lastSynchronizationErrorDate = $data['last_synchronization_error_date'];
        }
        if (isset($data['max_connections'])) {
            $this->maxConnections = $data['max_connections'];
        }
        if (isset($data['allowed_updates'])) {
            $this->allowedUpdates = [];
            foreach ($data['allowed_updates'] as $item) {
                $this->allowedUpdates[] = $item;
            }
        }
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getHasCustomCertificate(): bool {
        return $this->hasCustomCertificate;
    }

    public function getPendingUpdateCount(): int {
        return $this->pendingUpdateCount;
    }

    public function getIpAddress(): ?string {
        return $this->ipAddress;
    }

    public function getLastErrorDate(): ?int {
        return $this->lastErrorDate;
    }

    public function getLastErrorMessage(): ?string {
        return $this->lastErrorMessage;
    }

    public function getLastSynchronizationErrorDate(): ?int {
        return $this->lastSynchronizationErrorDate;
    }

    public function getMaxConnections(): ?int {
        return $this->maxConnections;
    }

    public function getAllowedUpdates(): ?array {
        return $this->allowedUpdates;
    }


}
