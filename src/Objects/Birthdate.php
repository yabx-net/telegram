<?php

namespace Yabx\Telegram\Objects;

final class Birthdate extends AbstractObject {

    /**
     * Day
     *
     * Day of the user's birth; 1-31
     * @var int|null
     */
    protected ?int $day = null;

    /**
     * Month
     *
     * Month of the user's birth; 1-12
     * @var int|null
     */
    protected ?int $month = null;

    /**
     * Year
     *
     * Optional. Year of the user's birth
     * @var int|null
     */
    protected ?int $year = null;

    public function __construct(
        ?int $day = null,
        ?int $month = null,
        ?int $year = null,
    ) {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }

    public static function fromArray(array $data): Birthdate {
        $instance = new self();
        if (isset($data['day'])) {
            $instance->day = $data['day'];
        }
        if (isset($data['month'])) {
            $instance->month = $data['month'];
        }
        if (isset($data['year'])) {
            $instance->year = $data['year'];
        }
        return $instance;
    }

    public function getDay(): ?int {
        return $this->day;
    }

    public function setDay(?int $value): self {
        $this->day = $value;
        return $this;
    }

    public function getMonth(): ?int {
        return $this->month;
    }

    public function setMonth(?int $value): self {
        $this->month = $value;
        return $this;
    }

    public function getYear(): ?int {
        return $this->year;
    }

    public function setYear(?int $value): self {
        $this->year = $value;
        return $this;
    }

}
