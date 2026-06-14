<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\InaccessibleMessage;
use Yabx\Telegram\Objects\MaybeInaccessibleMessage;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Tests\TestCase;

final class MaybeInaccessibleMessageTest extends TestCase {

    public function testParsesInaccessibleMessageWhenDateIsZero(): void {
        $data = $this->loadFixture('inaccessible_message.json');

        $entity = MaybeInaccessibleMessage::fromArray($data);

        $this->assertNull($entity->getMessage());
        $this->assertInstanceOf(InaccessibleMessage::class, $entity->getInaccessibleMessage());
        $this->assertSame(42, $entity->getInaccessibleMessage()->getMessageId());
        $this->assertSame(0, $entity->getInaccessibleMessage()->getDate());
    }

    public function testParsesAccessibleMessageWhenDateIsNonZero(): void {
        $data = $this->loadFixture('accessible_message.json');

        $entity = MaybeInaccessibleMessage::fromArray($data);

        $this->assertNull($entity->getInaccessibleMessage());
        $this->assertInstanceOf(Message::class, $entity->getMessage());
        $this->assertSame('Accessible message', $entity->getMessage()->getText());
        $this->assertSame(1681135130, $entity->getMessage()->getDate());
    }

}
