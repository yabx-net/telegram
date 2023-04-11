<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class Game {

    use ObjectTrait;

    /**
     * Title
     *
     * Title of the game
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Description
     *
     * Description of the game
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Photo
     *
     * Photo that will be displayed in the game message in chats.
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    /**
     * Text
     *
     * Optional. Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * Text Entities
     *
     * Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc.
     * @var MessageEntity[]|null
     */
    protected ?array $textEntities = null;

    /**
     * Animation
     *
     * Optional. Animation that will be displayed in the game message in chats. Upload via BotFather
     * @var Animation|null
     */
    protected ?Animation $animation = null;

    public function __construct(
        ?string    $title = null,
        ?string    $description = null,
        ?array     $photo = null,
        ?string    $text = null,
        ?array     $textEntities = null,
        ?Animation $animation = null,
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->photo = $photo;
        $this->text = $text;
        $this->textEntities = $textEntities;
        $this->animation = $animation;
    }

    public static function fromArray(array $data): Game {
        $instance = new self();
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        if (isset($data['photo'])) {
            $instance->photo = [];
            foreach ($data['photo'] as $item) {
                $instance->photo[] = PhotoSize::fromArray($item);
            }
        }
        if (isset($data['text'])) {
            $instance->text = $data['text'];
        }
        if (isset($data['text_entities'])) {
            $instance->textEntities = [];
            foreach ($data['text_entities'] as $item) {
                $instance->textEntities[] = MessageEntity::fromArray($item);
            }
        }
        if (isset($data['animation'])) {
            $instance->animation = Animation::fromArray($data['animation']);
        }
        return $instance;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
        return $this;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(?string $value): self {
        $this->text = $value;
        return $this;
    }

    public function getTextEntities(): ?array {
        return $this->textEntities;
    }

    public function setTextEntities(?array $value): self {
        $this->textEntities = $value;
        return $this;
    }

    public function getAnimation(): ?Animation {
        return $this->animation;
    }

    public function setAnimation(?Animation $value): self {
        $this->animation = $value;
        return $this;
    }

}
