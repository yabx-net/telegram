<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BusinessOpeningHoursInterval {

    use ObjectTrait;

    /**
     * Opening Minute
     *
     * The minute's sequence number in a week, starting on Monday, marking the start of the time interval during which the business is open; 0 - 7 * 24 * 60
     * @var int|null
     */
    protected ?int $openingMinute = null;

    /**
     * Closing Minute
     *
     * The minute's sequence number in a week, starting on Monday, marking the end of the time interval during which the business is open; 0 - 8 * 24 * 60
     * @var int|null
     */
    protected ?int $closingMinute = null;

    public static function fromArray(array $data): BusinessOpeningHoursInterval {
        $instance = new self();
        if (isset($data['opening_minute'])) {
            $instance->openingMinute = $data['opening_minute'];
        }
        if (isset($data['closing_minute'])) {
            $instance->closingMinute = $data['closing_minute'];
        }
        return $instance;
    }

    public function __construct(
        ?int $openingMinute = null,
        ?int $closingMinute = null,
    ) {
        $this->openingMinute = $openingMinute;
        $this->closingMinute = $closingMinute;
    }

    public function getOpeningMinute(): ?int {
        return $this->openingMinute;
    }

    public function setOpeningMinute(?int $value): self {
        $this->openingMinute = $value;
        return $this;
    }

    public function getClosingMinute(): ?int {
        return $this->closingMinute;
    }

    public function setClosingMinute(?int $value): self {
        $this->closingMinute = $value;
        return $this;
    }

}
