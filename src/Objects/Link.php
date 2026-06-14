<?php

namespace Yabx\Telegram\Objects;

final class Link extends AbstractObject {

    protected ?string $url = null;

    public function __construct(
        ?string $url = null
    ) {
        $this->url = $url;
    }

    public static function fromArray(array $data): Link {
        $instance = new self();
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        return $instance;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }
}
