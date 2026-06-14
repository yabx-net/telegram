<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Tests\TestCase;

final class MessageTest extends TestCase {

    public function testParsesTextMessage(): void {
        $message = Message::fromArray([
            'message_id' => 1,
            'date' => 1681135130,
            'chat' => ['id' => 630692, 'type' => 'private', 'first_name' => 'User'],
            'from' => ['id' => 630692, 'is_bot' => false, 'first_name' => 'User'],
            'text' => 'Hello',
        ]);

        $this->assertSame(1, $message->getMessageId());
        $this->assertSame('Hello', $message->getText());
        $this->assertSame(630692, $message->getChat()->getId());
    }

    public function testParsesPhotoMessageFromUpdateFixture(): void {
        $update = $this->loadFixture('update_with_photo.json');
        $message = Message::fromArray($update['message']);

        $this->assertCount(4, $message->getPhoto());
        $this->assertNull($message->getText());
    }

    public function testTextMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, [
            'message_id' => 1,
            'date' => 1681135130,
            'chat' => ['id' => 630692, 'type' => 'private', 'first_name' => 'User'],
            'from' => ['id' => 630692, 'is_bot' => false, 'first_name' => 'User'],
            'text' => 'Hello',
        ]);
    }

}
