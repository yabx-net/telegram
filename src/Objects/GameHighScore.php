<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class GameHighScore {

    use ObjectTrait;

    /**
     * Position
     *
     * Position in high score table for the game
     * @var int|null
     */
    protected ?int $position = null;

    /**
     * User
     *
     * User
     * @var User|null
     */
    protected ?User $user = null;

    /**
     * Score
     *
     * Score
     * @var int|null
     */
    protected ?int $score = null;

    public function __construct(
        ?int  $position = null,
        ?User $user = null,
        ?int  $score = null,
    ) {
        $this->position = $position;
        $this->user = $user;
        $this->score = $score;
    }

    public static function fromArray(array $data): GameHighScore {
        $instance = new self();
        if (isset($data['position'])) {
            $instance->position = $data['position'];
        }
        if (isset($data['user'])) {
            $instance->user = User::fromArray($data['user']);
        }
        if (isset($data['score'])) {
            $instance->score = $data['score'];
        }
        return $instance;
    }

    public function getPosition(): ?int {
        return $this->position;
    }

    public function setPosition(?int $value): self {
        $this->position = $value;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $value): self {
        $this->user = $value;
        return $this;
    }

    public function getScore(): ?int {
        return $this->score;
    }

    public function setScore(?int $value): self {
        $this->score = $value;
        return $this;
    }

}
