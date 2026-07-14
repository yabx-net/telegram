<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with an animation, corresponding to the HTML tag <video>.
 * @link https://core.telegram.org/bots/api#inputrichblockanimation
 */
final class InputRichBlockAnimation extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "animation"
     * @var string
     */
    protected string $type = 'animation';

    /**
     * Animation
     *
     * The animation. Caption is ignored.
     * @var InputMediaAnimation|null
     */
    protected ?InputMediaAnimation $animation = null;

    /**
     * Caption
     *
     * Optional. Caption of the block
     * @var RichBlockCaption|null
     */
    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?InputMediaAnimation $animation = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->animation = $animation;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): InputRichBlockAnimation {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['animation'])) {
            $instance->animation = InputMediaAnimation::fromArray($data['animation']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getAnimation(): ?InputMediaAnimation {
        return $this->animation;
    }

    public function setAnimation(?InputMediaAnimation $value): self {
        $this->animation = $value;
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
