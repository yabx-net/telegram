<?php

namespace Yabx\Telegram\Objects;

class MenuButtonWebApp {

    /**
     * Type
     *
     * Type of the button, must be web_app
     * @var string
     */
    protected string $type;

    /**
     * Text
     *
     * Text on the button
     * @var string
     */
    protected string $text;

    /**
     * Web App
     *
     * Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery.
     * @var WebAppInfo
     */
    protected WebAppInfo $webApp;


    public function __construct(array $data) {
        if (isset($data['type'])) {
            $this->type = $data['type'];
        }
        if (isset($data['text'])) {
            $this->text = $data['text'];
        }
        if (isset($data['web_app'])) {
            $this->webApp = new WebAppInfo($data['web_app']);
        }
    }

    public function getType(): string {
        return $this->type;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getWebApp(): WebAppInfo {
        return $this->webApp;
    }


}
