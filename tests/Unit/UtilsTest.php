<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit;

use Yabx\Telegram\Exception;
use Yabx\Telegram\Tests\TestCase;
use Yabx\Telegram\Utils;

final class UtilsTest extends TestCase {

    public function testToSnakeCase(): void {
        $this->assertSame('update_id', Utils::toSnakeCase('updateId'));
        $this->assertSame('can_delete_stories', Utils::toSnakeCase('canDeleteStories'));
        $this->assertSame('first_name', Utils::toSnakeCase('firstName'));
    }

    public function testToCamelCase(): void {
        $this->assertSame('updateId', Utils::toCamelCase('update_id'));
        $this->assertSame('canDeleteStories', Utils::toCamelCase('can_delete_stories'));
        $this->assertSame('firstName', Utils::toCamelCase('first_name'));
    }

    public function testCheckAuthorizationWithValidHash(): void {
        $token = 'test-bot-token';
        $authDate = time();
        $authData = [
            'id' => 123456,
            'first_name' => 'Test',
            'auth_date' => $authDate,
        ];
        $authData['hash'] = $this->computeTelegramHash($authData, $token);

        $result = Utils::checkAuthorization($authData, $token);

        $this->assertSame(123456, $result['id']);
        $this->assertSame('Test', $result['first_name']);
        $this->assertSame($authDate, $result['auth_date']);
        $this->assertArrayNotHasKey('hash', $result);
    }

    public function testCheckAuthorizationWithInvalidHash(): void {
        $authData = [
            'id' => 123456,
            'first_name' => 'Test',
            'auth_date' => time(),
            'hash' => 'invalid',
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Data is NOT from Telegram');

        Utils::checkAuthorization($authData, 'test-bot-token');
    }

    public function testCheckAuthorizationWithOutdatedData(): void {
        $token = 'test-bot-token';
        $authData = [
            'id' => 123456,
            'first_name' => 'Test',
            'auth_date' => time() - 90000,
        ];
        $authData['hash'] = $this->computeTelegramHash($authData, $token);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Data is outdated');

        Utils::checkAuthorization($authData, $token);
    }

    private function computeTelegramHash(array $authData, string $token): string {
        $dataCheckArr = [];
        foreach ($authData as $key => $value) {
            $dataCheckArr[] = $key . '=' . $value;
        }
        sort($dataCheckArr);
        $dataCheckString = implode("\n", $dataCheckArr);
        $secretKey = hash('sha256', $token, true);

        return hash_hmac('sha256', $dataCheckString, $secretKey);
    }

}
