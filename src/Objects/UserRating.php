<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes the rating of a user based on their Telegram Star spendings.
 * @link https://core.telegram.org/bots/api#userrating
 */
final class UserRating extends AbstractObject {

    /**
     * Level
     *
     * Current level of the user, indicating their reliability when purchasing digital goods and services. A higher level suggests a more trustworthy customer; a negative level is likely reason for concern.
     * @var int|null
     */
    protected ?int $level = null;

    /**
     * Rating
     *
     * Numerical value of the user's rating; the higher the rating, the better
     * @var int|null
     */
    protected ?int $rating = null;

    /**
     * Current Level Rating
     *
     * The rating value required to get the current level
     * @var int|null
     */
    protected ?int $currentLevelRating = null;

    /**
     * Next Level Rating
     *
     * Optional. The rating value required to get to the next level; omitted if the maximum level was reached
     * @var int|null
     */
    protected ?int $nextLevelRating = null;

    public static function fromArray(array $data): UserRating {
        $instance = new self();
        if (isset($data['level'])) {
            $instance->level = $data['level'];
        }
        if (isset($data['rating'])) {
            $instance->rating = $data['rating'];
        }
        if (isset($data['current_level_rating'])) {
            $instance->currentLevelRating = $data['current_level_rating'];
        }
        if (isset($data['next_level_rating'])) {
            $instance->nextLevelRating = $data['next_level_rating'];
        }
        return $instance;
    }

    public function __construct(
        ?int $level = null,
        ?int $rating = null,
        ?int $currentLevelRating = null,
        ?int $nextLevelRating = null,
    ) {
        $this->level = $level;
        $this->rating = $rating;
        $this->currentLevelRating = $currentLevelRating;
        $this->nextLevelRating = $nextLevelRating;
    }

    public function getLevel(): ?int {
        return $this->level;
    }

    public function setLevel(?int $value): self {
        $this->level = $value;
        return $this;
    }

    public function getRating(): ?int {
        return $this->rating;
    }

    public function setRating(?int $value): self {
        $this->rating = $value;
        return $this;
    }

    public function getCurrentLevelRating(): ?int {
        return $this->currentLevelRating;
    }

    public function setCurrentLevelRating(?int $value): self {
        $this->currentLevelRating = $value;
        return $this;
    }

    public function getNextLevelRating(): ?int {
        return $this->nextLevelRating;
    }

    public function setNextLevelRating(?int $value): self {
        $this->nextLevelRating = $value;
        return $this;
    }

}
