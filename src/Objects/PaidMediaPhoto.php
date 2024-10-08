<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class PaidMediaPhoto extends PaidMedia {

    use ObjectTrait;

    /**
     * Type
     *
     * Type of the paid media, always “photo”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Photo
     *
     * The photo
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    public function __construct(
        ?string $type = null,
        ?array  $photo = null,
    ) {
        $this->type = $type;
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

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

}
