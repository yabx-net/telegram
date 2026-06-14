<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use PHPUnit\Framework\Attributes\DataProvider;
use Yabx\Telegram\Tests\TestCase;

final class RoundTripTest extends TestCase {

    #[DataProvider('roundTripCasesProvider')]
    public function testFromArrayToArrayRoundTrip(string $class, array $expected): void {
        $this->assertRoundTrip($class, $expected);
    }

    public static function roundTripCasesProvider(): array {
        /** @var array<class-string, array> $cases */
        $cases = require __DIR__ . '/../../Fixtures/roundtrip.php';
        $provider = [];
        foreach ($cases as $class => $data) {
            $provider[(new \ReflectionClass($class))->getShortName()] = [$class, $data];
        }

        return $provider;
    }

}
