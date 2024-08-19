<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class BackgroundTypeChatTheme extends BackgroundType {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the background, always “chat_theme”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Theme Name
     *
     * Name of the chat theme, which is usually an emoji
     * @var string|null
     */
    protected ?string $themeName = null;

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

    public function __construct(
        ?string $type = null,
        ?string $themeName = null,
    ) {
        $this->type = $type;
        $this->themeName = $themeName;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getThemeName(): ?string {
        return $this->themeName;
    }

    public function setThemeName(?string $value): self {
        $this->themeName = $value;
        return $this;
    }

}
