<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents the audios displayed on a user's profile.
 * @link https://core.telegram.org/bots/api#userprofileaudios
 */
final class UserProfileAudios extends AbstractObject {

    /**
     * Total Count
     *
     * Total number of profile audios for the target user
     * @var int|null
     */
    protected ?int $totalCount = null;

    /**
     * Audios
     *
     * Requested profile audios
     * @var Audio[]|null
     */
    protected ?array $audios = null;

    public static function fromArray(array $data): UserProfileAudios {
        $instance = new self();
        if (isset($data['total_count'])) {
            $instance->totalCount = $data['total_count'];
        }
        if (isset($data['audios'])) {
            $instance->audios = [];
            foreach ($data['audios'] as $item) {
                $instance->audios[] = Audio::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?int $totalCount = null,
        ?array $audios = null,
    ) {
        $this->totalCount = $totalCount;
        $this->audios = $audios;
    }

    public function getTotalCount(): ?int {
        return $this->totalCount;
    }

    public function setTotalCount(?int $value): self {
        $this->totalCount = $value;
        return $this;
    }

    public function getAudios(): ?array {
        return $this->audios;
    }

    public function setAudios(?array $value): self {
        $this->audios = $value;
        return $this;
    }

}
