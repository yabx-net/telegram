<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class MenuButtonWebApp {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the button, must be web_app
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Text
     *
     * Text on the button
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Web App
     *
     * Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery.
     * @var WebAppInfo|null
     */
    protected ?WebAppInfo $webApp = null;

    public function __construct(
        ?string     $type = null,
        ?string     $text = null,
        ?WebAppInfo $webApp = null,
    ) {
        $this->type = $type;
        $this->text = $text;
        $this->webApp = $webApp;
    }

    public static function fromArray(array $data): MenuButtonWebApp {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['web_app'])) {
            $instance->webApp = WebAppInfo::fromArray($data['web_app']);
        }
        return $instance;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $value): self {
        $this->text = $value;
        return $this;
    }

    public function getWebApp(): ?WebAppInfo {
        return $this->webApp;
    }

    public function setWebApp(?WebAppInfo $value): self {
        $this->webApp = $value;
        return $this;
    }

}
