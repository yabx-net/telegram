<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ForceReply extends ReplyMarkup {

    use ObjectTrait;

    /**
     * Force Reply
     *
     * Shows reply interface to the user, as if they manually selected the bot's message and tapped 'Reply'
     * @var bool|null
     */
    protected ?bool $forceReply = null;

    /**
     * Input Field Placeholder
     *
     * Optional. The placeholder to be shown in the input field when the reply is active; 1-64 characters
     * @var string|null
     */
    protected ?string $inputFieldPlaceholder = null;

    /**
     * Selective
     *
     * Optional. Use this parameter if you want to force reply from specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply to a message in the same chat and forum topic, sender of the original message.
     * @var bool|null
     */
    protected ?bool $selective = null;

    public function __construct(
        ?bool   $forceReply = null,
        ?string $inputFieldPlaceholder = null,
        ?bool   $selective = null,
    ) {
        $this->forceReply = $forceReply;
        $this->inputFieldPlaceholder = $inputFieldPlaceholder;
        $this->selective = $selective;
    }

    public static function fromArray(array $data): ForceReply {
        $instance = new self();
        if (isset($data['force_reply'])) {
            $instance->forceReply = $data['force_reply'];
        }
        if (isset($data['input_field_placeholder'])) {
            $instance->inputFieldPlaceholder = $data['input_field_placeholder'];
        }
        if (isset($data['selective'])) {
            $instance->selective = $data['selective'];
        }
        return $instance;
    }

    public function getForceReply(): ?bool {
        return $this->forceReply;
    }

    public function setForceReply(?bool $value): self {
        $this->forceReply = $value;
        return $this;
    }

    public function getInputFieldPlaceholder(): ?string {
        return $this->inputFieldPlaceholder;
    }

    public function setInputFieldPlaceholder(?string $value): self {
        $this->inputFieldPlaceholder = $value;
        return $this;
    }

    public function getSelective(): ?bool {
        return $this->selective;
    }

    public function setSelective(?bool $value): self {
        $this->selective = $value;
        return $this;
    }

}
