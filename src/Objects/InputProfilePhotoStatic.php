<?php

namespace Yabx\Telegram\Objects;

/**
 * A static profile photo in the .JPG format.
 * @link https://core.telegram.org/bots/api#inputprofilephotostatic
 */
final class InputProfilePhotoStatic extends InputProfilePhoto {

    /**
     * Type
     *
     * Type of the profile photo, must be static
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Photo
     *
     * The static profile photo. Profile photos can't be reused and can only be uploaded as a new file, so you can pass “attach://<file_attach_name>” if the photo was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files »
     * @var string|null
     */
    protected ?string $photo = null;

    public static function fromArray(array $data): InputProfilePhotoStatic {
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
