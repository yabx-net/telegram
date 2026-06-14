<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Yabx\Telegram\Objects\AbstractObject;

abstract class TestCase extends BaseTestCase {

    protected function loadFixture(string $name): array {
        $path = __DIR__ . '/Fixtures/' . $name;
        $json = file_get_contents($path);
        $this->assertNotFalse($json, "Fixture not found: {$name}");

        return json_decode($json, true, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * @param class-string<AbstractObject> $class
     */
    protected function assertRoundTrip(string $class, array $expected): AbstractObject {
        /** @var AbstractObject $object */
        $object = $class::fromArray($expected);
        $this->assertSame(
            $this->normalizeArray($expected),
            $this->normalizeArray($object->toArray()),
        );

        return $object;
    }

    protected function normalizeArray(array $array): array {
        ksort($array);
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->normalizeArray($value);
            }
        }

        return $array;
    }

}

