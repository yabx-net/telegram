<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Integration;

use PHPUnit\Framework\Attributes\IgnoreDeprecations;
use Yabx\Telegram\BotApi;
use Yabx\Telegram\Exception;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Tests\Support\PhpInputStreamWrapper;
use Yabx\Telegram\Tests\TestCase;

#[IgnoreDeprecations]
final class BotApiStaticTest extends TestCase {

    public function testGetUpdateFromJsonParsesUpdate(): void {
        $json = file_get_contents(__DIR__ . '/../Fixtures/update_callback_query.json');
        $this->assertNotFalse($json);

        $update = BotApi::getUpdateFromJson($json);

        $this->assertInstanceOf(Update::class, $update);
        $this->assertSame(94181762, $update->getUpdateId());
        $this->assertSame('cq-1', $update->getCallbackQuery()->getId());
    }

    public function testGetUpdateFromJsonThrowsOnMalformedJson(): void {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Malformed JSON');

        BotApi::getUpdateFromJson('{not json');
    }

    public function testGetUpdateFromRequestParsesPhpInput(): void {
        $json = file_get_contents(__DIR__ . '/../Fixtures/update_callback_query.json');
        $this->assertNotFalse($json);

        $this->withPhpInput($json, function (): void {
            $update = BotApi::getUpdatefromRequest();

            $this->assertInstanceOf(Update::class, $update);
            $this->assertSame(94181762, $update->getUpdateId());
            $this->assertSame('cq-1', $update->getCallbackQuery()->getId());
        });
    }

    public function testGetUpdateFromRequestThrowsOnEmptyBody(): void {
        $this->withPhpInput('', function (): void {
            $this->expectException(Exception::class);
            $this->expectExceptionMessage('Empty body');

            BotApi::getUpdatefromRequest();
        });
    }

    /**
     * @param callable(): void $callback
     */
    private function withPhpInput(string $body, callable $callback): void {
        stream_wrapper_unregister('php');
        stream_wrapper_register('php', PhpInputStreamWrapper::class);
        PhpInputStreamWrapper::$body = $body;

        try {
            $callback();
        } finally {
            stream_wrapper_restore('php');
            PhpInputStreamWrapper::$body = '';
        }
    }

}
