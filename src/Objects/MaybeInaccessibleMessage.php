<?php

namespace Yabx\Telegram\Objects;

final class MaybeInaccessibleMessage extends AbstractObject {

    private ?Message $message = null;
    private ?InaccessibleMessage $inaccessibleMessage = null;

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

}
