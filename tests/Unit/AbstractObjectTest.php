<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit;

use Yabx\Telegram\Objects\AbstractObject;
use Yabx\Telegram\Tests\TestCase;

final class AbstractObjectTest extends TestCase {

    public function testToArrayOmitsNullFieldsAndUsesSnakeCase(): void {
        $object = new TestStubObject('hello', null);

        $this->assertSame(['first_name' => 'hello'], $object->toArray());
    }

    public function testToArraySerializesNestedObjects(): void {
        $nested = new TestStubObject('nested', 42);
        $object = new TestStubObject('parent', $nested);

        $this->assertSame([
            'first_name' => 'parent',
            'nested_value' => [
                'first_name' => 'nested',
                'nested_value' => 42,
            ],
        ], $object->toArray());
    }

    public function testArrayOfMapsItems(): void {
        $items = TestStubObject::arrayOf([
            ['first_name' => 'one'],
            ['first_name' => 'two', 'nested_value' => 2],
        ]);

        $this->assertCount(2, $items);
        $this->assertInstanceOf(TestStubObject::class, $items[0]);
        $this->assertSame('one', $items[0]->getFirstName());
        $this->assertSame(2, $items[1]->getNestedValue());
    }

    public function testToJsonAndToString(): void {
        $object = new TestStubObject('json', 1);

        $this->assertSame('{"first_name":"json","nested_value":1}', $object->toJson());
        $this->assertSame('{"first_name":"json","nested_value":1}', (string) $object);
    }

}

final class TestStubObject extends AbstractObject {

    protected ?string $firstName = null;
    protected mixed $nestedValue = null;

    public function __construct(?string $firstName = null, mixed $nestedValue = null) {
        $this->firstName = $firstName;
        $this->nestedValue = $nestedValue;
    }

    public static function fromArray(array $data): self {
        $instance = new self();
        if (isset($data['first_name'])) {
            $instance->firstName = $data['first_name'];
        }
        if (isset($data['nested_value'])) {
            $value = $data['nested_value'];
            $instance->nestedValue = is_array($value) ? self::fromArray($value) : $value;
        }

        return $instance;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function getNestedValue(): mixed {
        return $this->nestedValue;
    }

}
