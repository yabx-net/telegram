<?php

namespace Yabx\Telegram\Objects;

class ProximityAlertTriggered {

    /**
     * Traveler
     *
     * User that triggered the alert
     * @var User
     */
    protected User $traveler;

    /**
     * Watcher
     *
     * User that set the alert
     * @var User
     */
    protected User $watcher;

    /**
     * Distance
     *
     * The distance between the users
     * @var int
     */
    protected int $distance;


    public function __construct(array $data) {
        if (isset($data['traveler'])) {
            $this->traveler = new User($data['traveler']);
        }
        if (isset($data['watcher'])) {
            $this->watcher = new User($data['watcher']);
        }
        if (isset($data['distance'])) {
            $this->distance = $data['distance'];
        }
    }

    public function getTraveler(): User {
        return $this->traveler;
    }

    public function getWatcher(): User {
        return $this->watcher;
    }

    public function getDistance(): int {
        return $this->distance;
    }


}
