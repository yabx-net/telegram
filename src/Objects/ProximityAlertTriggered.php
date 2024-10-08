<?php

namespace Yabx\Telegram\Objects;

final class ProximityAlertTriggered extends AbstractObject {

    /**
     * Traveler
     *
     * User that triggered the alert
     * @var User|null
     */
    protected ?User $traveler = null;

    /**
     * Watcher
     *
     * User that set the alert
     * @var User|null
     */
    protected ?User $watcher = null;

    /**
     * Distance
     *
     * The distance between the users
     * @var int|null
     */
    protected ?int $distance = null;

    public static function fromArray(array $data): ProximityAlertTriggered {
        $instance = new self();
        if (isset($data['traveler'])) {
            $instance->traveler = User::fromArray($data['traveler']);
        }
        if (isset($data['watcher'])) {
            $instance->watcher = User::fromArray($data['watcher']);
        }
        if (isset($data['distance'])) {
            $instance->distance = $data['distance'];
        }
        return $instance;
    }

    public function __construct(
        ?User $traveler = null,
        ?User $watcher = null,
        ?int  $distance = null,
    ) {
        $this->traveler = $traveler;
        $this->watcher = $watcher;
        $this->distance = $distance;
    }

    public function getTraveler(): ?User {
        return $this->traveler;
    }

    public function setTraveler(?User $value): self {
        $this->traveler = $value;
        return $this;
    }

    public function getWatcher(): ?User {
        return $this->watcher;
    }

    public function setWatcher(?User $value): self {
        $this->watcher = $value;
        return $this;
    }

    public function getDistance(): ?int {
        return $this->distance;
    }

    public function setDistance(?int $value): self {
        $this->distance = $value;
        return $this;
    }

}
