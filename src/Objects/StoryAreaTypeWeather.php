<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a story area containing weather information. Currently, a story can have up to 3 weather areas.
 * @link https://core.telegram.org/bots/api#storyareatypeweather
 */
final class StoryAreaTypeWeather extends StoryAreaType {

    /**
     * Type
     *
     * Type of the area, always “weather”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Temperature
     *
     * Temperature, in degree Celsius
     * @var float|null
     */
    protected ?float $temperature = null;

    /**
     * Emoji
     *
     * Emoji representing the weather
     * @var string|null
     */
    protected ?string $emoji = null;

    /**
     * Background Color
     *
     * A color of the area background in the ARGB format
     * @var int|null
     */
    protected ?int $backgroundColor = null;

    public static function fromArray(array $data): StoryAreaTypeWeather {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['temperature'])) {
            $instance->temperature = $data['temperature'];
        }
        if (isset($data['emoji'])) {
            $instance->emoji = $data['emoji'];
        }
        if (isset($data['background_color'])) {
            $instance->backgroundColor = $data['background_color'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?float $temperature = null,
        ?string $emoji = null,
        ?int $backgroundColor = null,
    ) {
        $this->type = $type;
        $this->temperature = $temperature;
        $this->emoji = $emoji;
        $this->backgroundColor = $backgroundColor;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getTemperature(): ?float {
        return $this->temperature;
    }

    public function setTemperature(?float $value): self {
        $this->temperature = $value;
        return $this;
    }

    public function getEmoji(): ?string {
        return $this->emoji;
    }

    public function setEmoji(?string $value): self {
        $this->emoji = $value;
        return $this;
    }

    public function getBackgroundColor(): ?int {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?int $value): self {
        $this->backgroundColor = $value;
        return $this;
    }

}
