<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with a music file, corresponding to the HTML tag <audio>.
 * @link https://core.telegram.org/bots/api#inputrichblockaudio
 */
final class InputRichBlockAudio extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "audio"
     * @var string
     */
    protected string $type = 'audio';

    /**
     * Audio
     *
     * The audio. Caption is ignored.
     * @var InputMediaAudio|null
     */
    protected ?InputMediaAudio $audio = null;

    /**
     * Caption
     *
     * Optional. Caption of the block
     * @var RichBlockCaption|null
     */
    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?InputMediaAudio $audio = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->audio = $audio;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): InputRichBlockAudio {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['audio'])) {
            $instance->audio = InputMediaAudio::fromArray($data['audio']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getAudio(): ?InputMediaAudio {
        return $this->audio;
    }

    public function setAudio(?InputMediaAudio $value): self {
        $this->audio = $value;
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
