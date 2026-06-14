<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit;

use Yabx\Telegram\Exception;
use Yabx\Telegram\Tests\TestCase;

final class ExceptionTest extends TestCase {

    public function testTokenIsMaskedInMessage(): void {
        $message = 'Request failed: https://api.telegram.org/bot1234567890:ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij/getMe';

        $exception = new Exception($message);

        $this->assertStringNotContainsString('bot1234567890:ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghij', $exception->getMessage());
        $this->assertStringContainsString('***token***', $exception->getMessage());
    }

    public function testPreservesErrorCode(): void {
        $exception = new Exception('Bad Request', 400);

        $this->assertSame(400, $exception->getCode());
    }

}
