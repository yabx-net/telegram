<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with a video, corresponding to the HTML tag <video>.
 * @link https://core.telegram.org/bots/api#inputrichblockvideo
 */
final class InputRichBlockVideo extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "video"
     * @var string
     */
    protected string $type = 'video';

    /**
     * Video
     *
     * The video. Caption is ignored.
     * @var InputMediaVideo|null
     */
    protected ?InputMediaVideo $video = null;

    /**
     * Caption
     *
     * Optional. Caption of the block
     * @var RichBlockCaption|null
     */
    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?InputMediaVideo $video = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->video = $video;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): InputRichBlockVideo {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['video'])) {
            $instance->video = InputMediaVideo::fromArray($data['video']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getVideo(): ?InputMediaVideo {
        return $this->video;
    }

    public function setVideo(?InputMediaVideo $value): self {
        $this->video = $value;
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
