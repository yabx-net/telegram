<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Support;

/**
 * Replaces php:// stream wrapper so BotApi::getUpdatefromRequest() can be tested.
 */
final class PhpInputStreamWrapper {

    public static string $body = '';

    private int $position = 0;

    public function stream_open(string $path, string $mode, int $options, ?string &$opened_path): bool {
        if ($path !== 'php://input') {
            return false;
        }
        $this->position = 0;

        return true;
    }

    public function stream_read(int $count): string {
        $chunk = substr(self::$body, $this->position, $count);
        $this->position += strlen($chunk);

        return $chunk;
    }

    public function stream_eof(): bool {
        return $this->position >= strlen(self::$body);
    }

    /**
     * @return array<string, int>
     */
    public function stream_stat(): array {
        return [];
    }

    public function stream_close(): void {
    }

}
