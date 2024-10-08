<?php

namespace Yabx\Telegram\Objects;

final class MenuButtonWebApp extends MenuButton {

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
     * Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. Alternatively, a t.me link to a Web App of the bot can be specified in the object instead of the Web App's URL, in which case the Web App will be opened as if the user pressed the link.
     * @var WebAppInfo|null
     */
    protected ?WebAppInfo $webApp = null;

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

    public function __construct(
        ?string     $type = null,
        ?string     $text = null,
        ?WebAppInfo $webApp = null,
    ) {
        $this->type = $type;
        $this->text = $text;
        $this->webApp = $webApp;
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
