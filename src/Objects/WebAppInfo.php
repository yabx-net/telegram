<?php

namespace Yabx\Telegram\Objects;

class WebAppInfo {

    /**
     * Url
     *
     * An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
     * @var string
     */
    protected string $url;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['url'])) {
            $this->url = $data['url'];
        }
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
