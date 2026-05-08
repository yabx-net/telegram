<?php

namespace Yabx\Telegram\Objects;

/**
 * Describes a service message about an option added to a poll.
 * @link https://core.telegram.org/bots/api#polloptionadded
 */
final class PollOptionAdded extends AbstractObject {

    /**
     * Poll Message
     *
     * Optional. Message containing the poll to which the option was added, if known. Note that the Message object in this field will not contain the reply_to_message field even if it itself is a reply.
     * @var MaybeInaccessibleMessage|null
     */
    protected ?MaybeInaccessibleMessage $pollMessage = null;

    /**
     * Option Persistent Id
     *
     * Unique identifier of the added option
     * @var string|null
     */
    protected ?string $optionPersistentId = null;

    /**
     * Option Text
     *
     * Option text
     * @var string|null
     */
    protected ?string $optionText = null;

    /**
     * Option Text Entities
     *
     * Optional. Special entities that appear in the option_text
     * @var MessageEntity[]|null
     */
    protected ?array $optionTextEntities = null;

    public static function fromArray(array $data): PollOptionAdded {
        $instance = new self();
        if (isset($data['poll_message'])) {
            $instance->pollMessage = MaybeInaccessibleMessage::fromArray($data['poll_message']);
        }
        if (isset($data['option_persistent_id'])) {
            $instance->optionPersistentId = $data['option_persistent_id'];
        }
        if (isset($data['option_text'])) {
            $instance->optionText = $data['option_text'];
        }
        if (isset($data['option_text_entities'])) {
            $instance->optionTextEntities = [];
            foreach ($data['option_text_entities'] as $item) {
                $instance->optionTextEntities[] = MessageEntity::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?MaybeInaccessibleMessage $pollMessage = null,
        ?string $optionPersistentId = null,
        ?string $optionText = null,
        ?array $optionTextEntities = null,
    ) {
        $this->pollMessage = $pollMessage;
        $this->optionPersistentId = $optionPersistentId;
        $this->optionText = $optionText;
        $this->optionTextEntities = $optionTextEntities;
    }

    public function getPollMessage(): ?MaybeInaccessibleMessage {
        return $this->pollMessage;
    }

    public function setPollMessage(?MaybeInaccessibleMessage $value): self {
        $this->pollMessage = $value;
        return $this;
    }

    public function getOptionPersistentId(): ?string {
        return $this->optionPersistentId;
    }

    public function setOptionPersistentId(?string $value): self {
        $this->optionPersistentId = $value;
        return $this;
    }

    public function getOptionText(): ?string {
        return $this->optionText;
    }

    public function setOptionText(?string $value): self {
        $this->optionText = $value;
        return $this;
    }

    public function getOptionTextEntities(): ?array {
        return $this->optionTextEntities;
    }

    public function setOptionTextEntities(?array $value): self {
        $this->optionTextEntities = $value;
        return $this;
    }

}
