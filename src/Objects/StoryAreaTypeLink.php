<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a story area pointing to an HTTP or tg:// link. Currently, a story can have up to 3 link areas.
 * @link https://core.telegram.org/bots/api#storyareatypelink
 */
final class StoryAreaTypeLink extends StoryAreaType {

    /**
     * Type
     *
     * Type of the area, always “link”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Url
     *
     * HTTP or tg:// URL to be opened when the area is clicked
     * @var string|null
     */
    protected ?string $url = null;

    public static function fromArray(array $data): StoryAreaTypeLink {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?string $url = null,
    ) {
        $this->type = $type;
        $this->url = $url;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

}
