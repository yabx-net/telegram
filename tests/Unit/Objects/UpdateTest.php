<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\BotApi;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Tests\TestCase;

final class UpdateTest extends TestCase {

    public function testFromArrayParsesPhotoMessage(): void {
        $data = $this->loadFixture('update_with_photo.json');

        $update = Update::fromArray($data);

        $this->assertSame(94181761, $update->getUpdateId());
        $this->assertNotNull($update->getMessage());
        $this->assertSame(74, $update->getMessage()->getMessageId());
        $this->assertSame('aliaksandr_m', $update->getMessage()->getFrom()->getUsername());
        $this->assertCount(4, $update->getMessage()->getPhoto());
        $this->assertSame(1280, $update->getMessage()->getPhoto()[3]->getWidth());
    }

    public function testGetUpdateFromJson(): void {
        $json = file_get_contents(__DIR__ . '/../../Fixtures/update_with_photo.json');
        $this->assertNotFalse($json);

        $update = BotApi::getUpdateFromJson($json);

        $this->assertInstanceOf(Update::class, $update);
        $this->assertSame(94181761, $update->getUpdateId());
    }

    public function testGetUpdateFromJsonWithMalformedJson(): void {
        $this->expectException(\Yabx\Telegram\Exception::class);
        $this->expectExceptionMessage('Malformed JSON');

        BotApi::getUpdateFromJson('{invalid');
    }

    public function testCallbackQueryUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_callback_query.json'));
    }

}
