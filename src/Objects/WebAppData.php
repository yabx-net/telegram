<?php

namespace Yabx\Telegram\Objects;

class WebAppData {

    /**
     * Data
     *
     * The data. Be aware that a bad client can send arbitrary data in this field.
     * @var string
     */
    protected string $data;

    /**
     * Button Text
     *
     * Text of the web_app keyboard button from which the Web App was opened. Be aware that a bad client can send arbitrary data in this field.
     * @var string
     */
    protected string $buttonText;


    public function __construct(array $data) {
        if (isset($data['data'])) {
            $this->data = $data['data'];
        }
        if (isset($data['button_text'])) {
            $this->buttonText = $data['button_text'];
        }
    }

    public function getData(): string {
        return $this->data;
    }

    public function getButtonText(): string {
        return $this->buttonText;
    }


}
