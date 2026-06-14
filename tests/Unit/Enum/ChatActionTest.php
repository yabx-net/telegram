<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Enum;

use Yabx\Telegram\Enum\ChatAction;
use Yabx\Telegram\Tests\TestCase;

final class ChatActionTest extends TestCase {

    public function testBackedValuesMatchTelegramApi(): void {
        $this->assertSame('typing', ChatAction::Typing->value);
        $this->assertSame('upload_photo', ChatAction::UploadPhoto->value);
        $this->assertSame('record_video_note', ChatAction::RecordVideoNote->value);
    }

}
