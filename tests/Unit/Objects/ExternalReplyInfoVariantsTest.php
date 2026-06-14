<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\ExternalReplyInfo;
use Yabx\Telegram\Tests\TestCase;

final class ExternalReplyInfoVariantsTest extends TestCase {

    public function testParsesStickerReply(): void {
        $info = ExternalReplyInfo::fromArray($this->loadFixture('external_reply_with_sticker.json'));

        $this->assertSame('user', $info->getOrigin()->getType());
        $this->assertSame(15, $info->getMessageId());
        $this->assertSame('regular', $info->getSticker()->getType());
        $this->assertTrue($info->getHasMediaSpoiler());
    }

    public function testParsesPollReply(): void {
        $info = ExternalReplyInfo::fromArray($this->loadFixture('external_reply_with_poll.json'));

        $this->assertSame('channel', $info->getOrigin()->getType());
        $this->assertSame('Yes or no?', $info->getPoll()->getQuestion());
        $this->assertCount(2, $info->getPoll()->getOptions());
    }

    public function testStickerReplyRoundTrip(): void {
        $this->assertRoundTrip(ExternalReplyInfo::class, $this->loadFixture('external_reply_with_sticker.json'));
    }

    public function testPollReplyRoundTrip(): void {
        $this->assertRoundTrip(ExternalReplyInfo::class, $this->loadFixture('external_reply_with_poll.json'));
    }

    public function testParsesPhotoAndAnimationReply(): void {
        $info = ExternalReplyInfo::fromArray($this->loadFixture('external_reply_with_photo.json'));

        $this->assertCount(1, $info->getPhoto());
        $this->assertSame(320, $info->getPhoto()[0]->getWidth());
        $this->assertSame(3, $info->getAnimation()->getDuration());
    }

    public function testPhotoReplyRoundTrip(): void {
        $this->assertRoundTrip(ExternalReplyInfo::class, $this->loadFixture('external_reply_with_photo.json'));
    }

}
