<?php

namespace Yabx\Telegram;

use DateTimeImmutable;
use Exception;

class Message {

    protected int $id;
    protected Sender $from;
    protected Chat $chat;
    protected DateTimeImmutable $date;
    protected ?array $photos;
    protected ?Document $document = null;
    protected ?Video $video = null;
    protected ?string $caption;
    protected ?string $text;
    protected ?string $mediaGroupId;
    protected ?array $entities;
    protected array $raw;

    /**
     * @throws Exception
     */
    public function __construct(array $data) {
        $this->id = $data['message_id'];
        $this->from = new Sender($data['from']);
        $this->chat = new Chat($data['chat']);
        $this->date = new DateTimeImmutable(date('c', $data['date']));
        $this->caption = $data['caption'] ?? null;
        $this->text = $data['text'] ?? null;
        $this->mediaGroupId = $data['media_group_id'] ?? null;
        if($photos = $data['photos'] ?? null) {
            $this->photos = [];
            foreach ($photos as $photo) {
                $this->photos[] = new Photo($photo);
            }
        }
        if($document = $data['document'] ?? null) {
            $this->document = new Document($document);
        }
        if($video = $data['video'] ?? null) {
            $this->video = new Video($video);
        }
        if($entities = $data['entities'] ?? false) {
            $this->entities = [];
            foreach ($entities as $entity) {
                $this->entities[] = new Entity($entity);
            }
        }
        $this->raw = $data;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFrom(): Sender {
        return $this->from;
    }

    public function getChat(): Chat {
        return $this->chat;
    }

    public function getDate(): DateTimeImmutable {
        return $this->date;
    }

    /**
     * @return Photo[]|null
     */
    public function getPhotos(): ?array {
        return $this->photos;
    }

    public function getDocument(): ?Document {
        return $this->document;
    }

    public function getVideo(): ?Video {
        return $this->video;
    }

    public function getCaption(): ?string {
        return $this->caption;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function getRaw(): array {
        return $this->raw;
    }

    public function getMediaGroupId(): ?string {
        return $this->mediaGroupId;
    }

    /**
     * @return Entity[]|null
     */
    public function getEntities(): ?array {
        return $this->entities;
    }

}
