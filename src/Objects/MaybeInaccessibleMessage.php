<?php

namespace Yabx\Telegram\Objects;

final class MaybeInaccessibleMessage extends AbstractObject {

    protected ?Message $message = null;
    protected ?InaccessibleMessage $inaccessibleMessage = null;

    public static function fromArray(array $data): MaybeInaccessibleMessage {
        $entity = new MaybeInaccessibleMessage();
        if ($data['date'] === 0) {
            $entity->inaccessibleMessage = InaccessibleMessage::fromArray($data);
        } else {
            $entity->message = Message::fromArray($data);
        }
        return $entity;
    }

    public function getMessage(): ?Message {
        return $this->message;
    }

    public function getInaccessibleMessage(): ?InaccessibleMessage {
        return $this->inaccessibleMessage;
    }

    public function toArray(): array {
        if ($this->message !== null) {
            return $this->message->toArray();
        }
        if ($this->inaccessibleMessage !== null) {
            return $this->inaccessibleMessage->toArray();
        }

        return [];
    }

}
