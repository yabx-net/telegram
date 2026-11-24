<?php

namespace Yabx\Telegram\Objects;

/**
 * This object contains a list of backdrops, which can be used as the background of a theme of the screen for sharing a link to a user or a chat.
 * @link https://core.telegram.org/bots/api#chatsharethemebackdrops
 */
final class ChatShareThemeBackdrops extends AbstractObject {

    /**
     * Backdrops
     *
     * The list of backdrops
     * @var array|null
     */
    protected ?array $backdrops = null;

    public function __construct(
        ?array $backdrops = null
    ) {
        $this->backdrops = $backdrops;
    }

    public static function fromArray(array $data): ChatShareThemeBackdrops {
        $instance = new self();
        if (isset($data['backdrops'])) {
            $instance->backdrops = ChatShareThemeBackdrop::arrayOf($data['backdrops']);
        }
        return $instance;
    }

    public function getBackdrops(): ?array {
        return $this->backdrops;
    }

    public function setBackdrops(?array $value): self {
        $this->backdrops = $value;
        return $this;
    }

}
