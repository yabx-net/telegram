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


    public function __construct(array $data) {
        if (isset($data['url'])) {
            $this->url = $data['url'];
        }
    }

    public function getUrl(): string {
        return $this->url;
    }


}
