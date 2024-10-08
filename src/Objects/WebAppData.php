<?php

namespace Yabx\Telegram\Objects;

final class WebAppData extends AbstractObject {

    /**
     * Data
     *
     * The data. Be aware that a bad client can send arbitrary data in this field.
     * @var string|null
     */
    protected ?string $data = null;

    /**
     * Button Text
     *
     * Text of the web_app keyboard button from which the Web App was opened. Be aware that a bad client can send arbitrary data in this field.
     * @var string|null
     */
    protected ?string $buttonText = null;

    public function __construct(
        ?string $data = null,
        ?string $buttonText = null,
    ) {
        $this->data = $data;
        $this->buttonText = $buttonText;
    }

    public static function fromArray(array $data): WebAppData {
        $instance = new self();
        if (isset($data['data'])) {
            $instance->data = $data['data'];
        }
        if (isset($data['button_text'])) {
            $instance->buttonText = $data['button_text'];
        }
        return $instance;
    }

    public function getData(): ?string {
        return $this->data;
    }

    public function setData(?string $value): self {
        $this->data = $value;
        return $this;
    }

    public function getButtonText(): ?string {
        return $this->buttonText;
    }

    public function setButtonText(?string $value): self {
        $this->buttonText = $value;
        return $this;
    }

}
