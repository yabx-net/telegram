<?php

namespace Yabx\Telegram\Objects;

class ForceReply {

    /**
     * Force Reply
     *
     * Shows reply interface to the user, as if they manually selected the bot's message and tapped 'Reply'
     * @var bool
     */
    protected bool $forceReply;

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
     * Optional. Use this parameter if you want to force reply from specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * @var bool|null
     */
    protected ?bool $selective = null;

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['force_reply'])) {
            $this->forceReply = $data['force_reply'];
        }
        if (isset($data['input_field_placeholder'])) {
            $this->inputFieldPlaceholder = $data['input_field_placeholder'];
        }
        if (isset($data['selective'])) {
            $this->selective = $data['selective'];
        }
    }

    public function getForceReply(): bool {
        return $this->forceReply;
    }

    public function getInputFieldPlaceholder(): ?string {
        return $this->inputFieldPlaceholder;
    }

    public function getSelective(): ?bool {
        return $this->selective;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
