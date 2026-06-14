<?php

namespace Yabx\Telegram\Objects;

final class InputMediaLink extends AbstractObject implements InputPollOptionMedia {

    protected string $type = 'link';

    protected ?string $url = null;

    public function __construct(?string $url = null) {
        $this->url = $url;
    }

    public static function fromArray(array $data): InputMediaLink {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

}
