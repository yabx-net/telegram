<?php

namespace Yabx\Telegram\Objects;

class GameHighScore {

    /**
     * Position
     *
     * Position in high score table for the game
     * @var int
     */
    protected int $position;

    /**
     * User
     *
     * User
     * @var User
     */
    protected User $user;

    /**
     * Score
     *
     * Score
     * @var int
     */
    protected int $score;


    public function __construct(array $data) {
        if (isset($data['position'])) {
            $this->position = $data['position'];
        }
        if (isset($data['user'])) {
            $this->user = new User($data['user']);
        }
        if (isset($data['score'])) {
            $this->score = $data['score'];
        }
    }

    public function getPosition(): int {
        return $this->position;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getScore(): int {
        return $this->score;
    }


}
