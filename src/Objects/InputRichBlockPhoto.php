<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with a photo, corresponding to the HTML tag <img>.
 * @link https://core.telegram.org/bots/api#inputrichblockphoto
 */
final class InputRichBlockPhoto extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "photo"
     * @var string
     */
    protected string $type = 'photo';

    /**
     * Photo
     *
     * The photo. Caption is ignored.
     * @var InputMediaPhoto|null
     */
    protected ?InputMediaPhoto $photo = null;

    /**
     * Caption
     *
     * Optional. Caption of the block
     * @var RichBlockCaption|null
     */
    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?InputMediaPhoto $photo = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->photo = $photo;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): InputRichBlockPhoto {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['photo'])) {
            $instance->photo = InputMediaPhoto::fromArray($data['photo']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getPhoto(): ?InputMediaPhoto {
        return $this->photo;
    }

    public function setPhoto(?InputMediaPhoto $value): self {
        $this->photo = $value;
        return $this;
    }

    public function getCaption(): ?RichBlockCaption {
        return $this->caption;
    }

    public function setCaption(?RichBlockCaption $value): self {
        $this->caption = $value;
        return $this;
    }
}
