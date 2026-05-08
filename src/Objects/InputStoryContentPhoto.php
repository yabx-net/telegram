<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a photo to post as a story.
 * @link https://core.telegram.org/bots/api#inputstorycontentphoto
 */
final class InputStoryContentPhoto extends InputStoryContent {

    /**
     * Type
     *
     * Type of the content, must be photo
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Photo
     *
     * The photo to post as a story. The photo must be of the size 1080x1920 and must not exceed 10 MB. The photo can't be reused and can only be uploaded as a new file, so you can pass “attach://<file_attach_name>” if the photo was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files »
     * @var string|null
     */
    protected ?string $photo = null;

    public static function fromArray(array $data): InputStoryContentPhoto {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['photo'])) {
            $instance->photo = $data['photo'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?string $photo = null,
    ) {
        $this->type = $type;
        $this->photo = $photo;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getPhoto(): ?string {
        return $this->photo;
    }

    public function setPhoto(?string $value): self {
        $this->photo = $value;
        return $this;
    }

}
