<?php

namespace Yabx\Telegram\Objects;

final class BusinessOpeningHours extends AbstractObject {

    /**
     * Time Zone Name
     *
     * Unique name of the time zone for which the opening hours are defined
     * @var string|null
     */
    protected ?string $timeZoneName = null;

    /**
     * Opening Hours
     *
     * List of time intervals describing business opening hours
     * @var BusinessOpeningHoursInterval[]|null
     */
    protected ?array $openingHours = null;

    public function __construct(
        ?string $timeZoneName = null,
        ?array  $openingHours = null,
    ) {
        $this->timeZoneName = $timeZoneName;
        $this->openingHours = $openingHours;
    }

    public static function fromArray(array $data): BusinessOpeningHours {
        $instance = new self();
        if (isset($data['time_zone_name'])) {
            $instance->timeZoneName = $data['time_zone_name'];
        }
        if (isset($data['opening_hours'])) {
            $instance->openingHours = [];
            foreach ($data['opening_hours'] as $item) {
                $instance->openingHours[] = BusinessOpeningHoursInterval::fromArray($item);
            }
        }
        return $instance;
    }

    public function getTimeZoneName(): ?string {
        return $this->timeZoneName;
    }

    public function setTimeZoneName(?string $value): self {
        $this->timeZoneName = $value;
        return $this;
    }

    public function getOpeningHours(): ?array {
        return $this->openingHours;
    }

    public function setOpeningHours(?array $value): self {
        $this->openingHours = $value;
        return $this;
    }

}
