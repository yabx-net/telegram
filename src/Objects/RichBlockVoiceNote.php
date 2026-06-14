<?php

namespace Yabx\Telegram\Objects;

final class RichBlockVoiceNote extends RichBlock {

    protected string $type = 'voice_note';

    protected ?Voice $voiceNote = null;

    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?Voice $voiceNote = null,
        ?RichBlockCaption $caption = null
    ) {
        $this->voiceNote = $voiceNote;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockVoiceNote {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['voice_note'])) {
            $instance->voiceNote = Voice::fromArray($data['voice_note']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getVoiceNote(): ?Voice {
        return $this->voiceNote;
    }

    public function setVoiceNote(?Voice $value): self {
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
