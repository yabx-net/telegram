<?php

namespace Yabx\Telegram\Objects;

final class BackgroundTypeChatTheme extends BackgroundType {

    /**
     * Type
     *
     * Type of the background, always “chat_theme”
     * @var string
     */
    protected string $type = 'chat_theme';

    /**
     * Theme Name
     *
     * Name of the chat theme, which is usually an emoji
     * @var string|null
     */
    protected ?string $themeName = null;

    public function __construct(
        ?string $themeName = null,
    ) {
        $this->themeName = $themeName;
    }

    public static function fromArray(array $data): BackgroundTypeChatTheme {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['theme_name'])) {
            $instance->themeName = $data['theme_name'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getThemeName(): ?string {
        return $this->themeName;
    }

    public function setThemeName(?string $value): self {
        $this->themeName = $value;
        return $this;
    }

}
