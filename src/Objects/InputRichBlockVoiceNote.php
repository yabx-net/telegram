<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with a voice note, corresponding to the HTML tag <audio>.
 * @link https://core.telegram.org/bots/api#inputrichblockvoicenote
 */
final class InputRichBlockVoiceNote extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "voice_note"
     * @var string
     */
    protected string $type = 'voice_note';

    /**
     * Voice Note
     *
     * The voice note. Caption is ignored.
     * @var InputMediaVoiceNote|null
     */
    protected ?InputMediaVoiceNote $voiceNote = null;

    /**
     * Caption
     *
     * Optional. Caption of the block
     * @var RichBlockCaption|null
     */
    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?InputMediaVoiceNote $voiceNote = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->voiceNote = $voiceNote;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): InputRichBlockVoiceNote {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['voice_note'])) {
            $instance->voiceNote = InputMediaVoiceNote::fromArray($data['voice_note']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getVoiceNote(): ?InputMediaVoiceNote {
        return $this->voiceNote;
    }

    public function setVoiceNote(?InputMediaVoiceNote $value): self {
        $this->voiceNote = $value;
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
