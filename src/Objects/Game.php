<?php

namespace Yabx\Telegram\Objects;

class Game {

    /**
     * Title
     *
     * Title of the game
     * @var string
     */
    protected string $title;

    /**
     * Description
     *
     * Description of the game
     * @var string
     */
    protected string $description;

    /**
     * Photo
     *
     * Photo that will be displayed in the game message in chats.
     * @var PhotoSize[]
     */
    protected array $photo;

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


    public function __construct(array $data) {
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['photo'])) {
            $this->photo = [];
            foreach ($data['photo'] as $item) {
                $this->photo[] = new PhotoSize($item);
            }
        }
        if (isset($data['text'])) {
            $this->text = $data['text'];
        }
        if (isset($data['text_entities'])) {
            $this->textEntities = [];
            foreach ($data['text_entities'] as $item) {
                $this->textEntities[] = new MessageEntity($item);
            }
        }
        if (isset($data['animation'])) {
            $this->animation = new Animation($data['animation']);
        }
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPhoto(): array {
        return $this->photo;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function getTextEntities(): ?array {
        return $this->textEntities;
    }

    public function getAnimation(): ?Animation {
        return $this->animation;
    }


}
