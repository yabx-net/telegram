<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Support;

final class SampleData {

    public static function user(int $id = 1, string $firstName = 'Test'): array {
        return [
            'id' => $id,
            'is_bot' => false,
            'first_name' => $firstName,
        ];
    }

    public static function bot(int $id = 1): array {
        return [
            'id' => $id,
            'is_bot' => true,
            'first_name' => 'Bot',
            'username' => 'test_bot',
        ];
    }

    public static function chat(int $id = -1001234567890): array {
        return [
            'id' => $id,
            'type' => 'supergroup',
            'title' => 'Test Group',
        ];
    }

    public static function privateChat(int $id = 630692): array {
        return [
            'id' => $id,
            'type' => 'private',
            'first_name' => 'User',
        ];
    }

    public static function photoSize(): array {
        return [
            'file_id' => 'AgACAgIAAxkBAAI',
            'file_unique_id' => 'AQADAAI',
            'width' => 320,
            'height' => 240,
        ];
    }

    public static function sticker(): array {
        return [
            'file_id' => 'CAACAgIAAxkBAAI',
            'file_unique_id' => 'AgADAAI',
            'type' => 'regular',
            'width' => 512,
            'height' => 512,
            'is_animated' => false,
            'is_video' => false,
        ];
    }

    public static function animation(): array {
        return [
            'file_id' => 'CgACAgIAAxkBAAI',
            'file_unique_id' => 'AgADAAI',
            'width' => 320,
            'height' => 240,
            'duration' => 3,
        ];
    }

    public static function video(): array {
        return [
            'file_id' => 'BAACAgIAAxkBAAI',
            'file_unique_id' => 'AgADAAI',
            'width' => 320,
            'height' => 240,
            'duration' => 10,
        ];
    }

    public static function audio(): array {
        return [
            'file_id' => 'CQACAgIAAxkBAAI',
            'file_unique_id' => 'AgADAAI',
            'duration' => 120,
        ];
    }

    public static function voice(): array {
        return [
            'file_id' => 'AwACAgIAAxkBAAI',
            'file_unique_id' => 'AgADAAI',
            'duration' => 5,
        ];
    }

    public static function location(): array {
        return [
            'latitude' => 53.9,
            'longitude' => 27.56,
        ];
    }

    public static function message(int $messageId = 1): array {
        return [
            'message_id' => $messageId,
            'date' => 1681135130,
            'chat' => self::privateChat(),
            'from' => self::user(),
            'text' => 'Hello',
        ];
    }

}
