<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class InlineQueryResultsButton {

    use ObjectTrait;

    /**
     * Text
     *
     * Label text on the button
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Web App
     *
     * Optional. Description of the Web App that will be launched when the user presses the button. The Web App will be able to switch back to the inline mode using the method switchInlineQuery inside the Web App.
     * @var WebAppInfo|null
     */
    protected ?WebAppInfo $webApp = null;

    /**
     * Start Parameter
     *
     * Optional. Deep-linking parameter for the /start message sent to the bot when a user presses the button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to adapt search results accordingly. To do this, it displays a 'Connect your YouTube account' button above the results, or even before showing any. The user presses the button, switches to a private chat with the bot and, in doing so, passes a start parameter that instructs the bot to return an OAuth link. Once done, the bot can offer a switch_inline button so that the user can easily return to the chat where they wanted to use the bot's inline capabilities.
     * @var string|null
     */
    protected ?string $startParameter = null;

    public function __construct(
        ?string     $text = null,
        ?WebAppInfo $webApp = null,
        ?string     $startParameter = null,
    ) {
        $this->text = $text;
        $this->webApp = $webApp;
        $this->startParameter = $startParameter;
    }

    public static function fromArray(array $data): InlineQueryResultsButton {
        $instance = new self();
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['web_app'])) {
            $instance->webApp = WebAppInfo::fromArray($data['web_app']);
        }
        if (isset($data['start_parameter'])) {
            $instance->startParameter = $data['start_parameter'];
        }
        return $instance;
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

    public function getStartParameter(): ?string {
        return $this->startParameter;
    }

    public function setStartParameter(?string $value): self {
        $this->startParameter = $value;
        return $this;
    }

}
