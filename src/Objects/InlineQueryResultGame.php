<?php

namespace Yabx\Telegram\Objects;

final class InlineQueryResultGame extends InlineQueryResult {

    /**
     * Type
     *
     * Type of the result, must be game
     * @var string
     */
    protected string $type = 'game';

    /**
     * Id
     *
     * Unique identifier for this result, 1-64 bytes
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Game Short Name
     *
     * Short name of the game
     * @var string|null
     */
    protected ?string $gameShortName = null;

    /**
     * Reply Markup
     *
     * Optional. Inline keyboard attached to the message
     * @var InlineKeyboardMarkup|null
     */
    protected ?InlineKeyboardMarkup $replyMarkup = null;

    public function __construct(
        ?string               $id = null,
        ?string               $gameShortName = null,
        ?InlineKeyboardMarkup $replyMarkup = null,
    ) {
        $this->id = $id;
        $this->gameShortName = $gameShortName;
        $this->replyMarkup = $replyMarkup;
    }

    public static function fromArray(array $data): InlineQueryResultGame {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['game_short_name'])) {
            $instance->gameShortName = $data['game_short_name'];
        }
        if (isset($data['reply_markup'])) {
            $instance->replyMarkup = InlineKeyboardMarkup::fromArray($data['reply_markup']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getGameShortName(): ?string {
        return $this->gameShortName;
    }

    public function setGameShortName(?string $value): self {
        $this->gameShortName = $value;
        return $this;
    }

    public function getReplyMarkup(): ?InlineKeyboardMarkup {
        return $this->replyMarkup;
    }

    public function setReplyMarkup(?InlineKeyboardMarkup $value): self {
        $this->replyMarkup = $value;
        return $this;
    }

}
