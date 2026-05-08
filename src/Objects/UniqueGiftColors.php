<?php

namespace Yabx\Telegram\Objects;

/**
 * This object contains information about the color scheme for a user's name, message replies and link previews based on a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftcolors
 */
final class UniqueGiftColors extends AbstractObject {

    /**
     * Model Custom Emoji Id
     *
     * Custom emoji identifier of the unique gift's model
     * @var string|null
     */
    protected ?string $modelCustomEmojiId = null;

    /**
     * Symbol Custom Emoji Id
     *
     * Custom emoji identifier of the unique gift's symbol
     * @var string|null
     */
    protected ?string $symbolCustomEmojiId = null;

    /**
     * Light Theme Main Color
     *
     * Main color used in light themes; RGB format
     * @var int|null
     */
    protected ?int $lightThemeMainColor = null;

    /**
     * Light Theme Other Colors
     *
     * List of 1-3 additional colors used in light themes; RGB format
     * @var int[]|null
     */
    protected ?array $lightThemeOtherColors = null;

    /**
     * Dark Theme Main Color
     *
     * Main color used in dark themes; RGB format
     * @var int|null
     */
    protected ?int $darkThemeMainColor = null;

    /**
     * Dark Theme Other Colors
     *
     * List of 1-3 additional colors used in dark themes; RGB format
     * @var int[]|null
     */
    protected ?array $darkThemeOtherColors = null;

    public static function fromArray(array $data): UniqueGiftColors {
        $instance = new self();
        if (isset($data['model_custom_emoji_id'])) {
            $instance->modelCustomEmojiId = $data['model_custom_emoji_id'];
        }
        if (isset($data['symbol_custom_emoji_id'])) {
            $instance->symbolCustomEmojiId = $data['symbol_custom_emoji_id'];
        }
        if (isset($data['light_theme_main_color'])) {
            $instance->lightThemeMainColor = $data['light_theme_main_color'];
        }
        if (isset($data['light_theme_other_colors'])) {
            $instance->lightThemeOtherColors = [];
            foreach ($data['light_theme_other_colors'] as $item) {
                $instance->lightThemeOtherColors[] = $item;
            }
        }
        if (isset($data['dark_theme_main_color'])) {
            $instance->darkThemeMainColor = $data['dark_theme_main_color'];
        }
        if (isset($data['dark_theme_other_colors'])) {
            $instance->darkThemeOtherColors = [];
            foreach ($data['dark_theme_other_colors'] as $item) {
                $instance->darkThemeOtherColors[] = $item;
            }
        }
        return $instance;
    }

    public function __construct(
        ?string $modelCustomEmojiId = null,
        ?string $symbolCustomEmojiId = null,
        ?int $lightThemeMainColor = null,
        ?array $lightThemeOtherColors = null,
        ?int $darkThemeMainColor = null,
        ?array $darkThemeOtherColors = null,
    ) {
        $this->modelCustomEmojiId = $modelCustomEmojiId;
        $this->symbolCustomEmojiId = $symbolCustomEmojiId;
        $this->lightThemeMainColor = $lightThemeMainColor;
        $this->lightThemeOtherColors = $lightThemeOtherColors;
        $this->darkThemeMainColor = $darkThemeMainColor;
        $this->darkThemeOtherColors = $darkThemeOtherColors;
    }

    public function getModelCustomEmojiId(): ?string {
        return $this->modelCustomEmojiId;
    }

    public function setModelCustomEmojiId(?string $value): self {
        $this->modelCustomEmojiId = $value;
        return $this;
    }

    public function getSymbolCustomEmojiId(): ?string {
        return $this->symbolCustomEmojiId;
    }

    public function setSymbolCustomEmojiId(?string $value): self {
        $this->symbolCustomEmojiId = $value;
        return $this;
    }

    public function getLightThemeMainColor(): ?int {
        return $this->lightThemeMainColor;
    }

    public function setLightThemeMainColor(?int $value): self {
        $this->lightThemeMainColor = $value;
        return $this;
    }

    public function getLightThemeOtherColors(): ?array {
        return $this->lightThemeOtherColors;
    }

    public function setLightThemeOtherColors(?array $value): self {
        $this->lightThemeOtherColors = $value;
        return $this;
    }

    public function getDarkThemeMainColor(): ?int {
        return $this->darkThemeMainColor;
    }

    public function setDarkThemeMainColor(?int $value): self {
        $this->darkThemeMainColor = $value;
        return $this;
    }

    public function getDarkThemeOtherColors(): ?array {
        return $this->darkThemeOtherColors;
    }

    public function setDarkThemeOtherColors(?array $value): self {
        $this->darkThemeOtherColors = $value;
        return $this;
    }

}
