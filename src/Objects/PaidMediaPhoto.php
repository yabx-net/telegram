<?php

namespace Yabx\Telegram\Objects;

final class PaidMediaPhoto extends PaidMedia {

    /**
     * Type
     *
     * Type of the paid media, always “photo”
     * @var string
     */
    protected string $type = 'photo';

    /**
     * Photo
     *
     * The photo
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    public function __construct(
        ?array  $photo = null,
    ) {
        $this->photo = $photo;
    }

    public static function fromArray(array $data): PaidMediaPhoto {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['photo'])) {
            $instance->photo = [];
            foreach ($data['photo'] as $item) {
                $instance->photo[] = PhotoSize::fromArray($item);
            }
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

}
