<?php

namespace Yabx\Telegram\Objects;

final class WebAppInfo extends AbstractObject {

    /**
     * Url
     *
     * An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
     * @var string|null
     */
    protected ?string $url = null;

    public function __construct(
        ?string $url = null,
    ) {
        $this->url = $url;
    }

    public static function fromArray(array $data): WebAppInfo {
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
