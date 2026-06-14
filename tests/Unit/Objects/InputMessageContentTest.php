<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use PHPUnit\Framework\Attributes\DataProvider;
use Yabx\Telegram\Objects\InputContactMessageContent;
use Yabx\Telegram\Objects\InputInvoiceMessageContent;
use Yabx\Telegram\Objects\InputLocationMessageContent;
use Yabx\Telegram\Objects\InputMessageContent;
use Yabx\Telegram\Objects\InputRichMessageContent;
use Yabx\Telegram\Objects\InputTextMessageContent;
use Yabx\Telegram\Objects\InputVenueMessageContent;
use Yabx\Telegram\Tests\TestCase;

final class InputMessageContentTest extends TestCase {

    #[DataProvider('inputMessageContentProvider')]
    public function testDispatchesToExpectedClass(array $data, string $expectedClass): void {
        $content = InputMessageContent::fromArray($data);

        $this->assertInstanceOf($expectedClass, $content);
        $this->assertSame($data, $content->toArray());
    }

    public static function inputMessageContentProvider(): array {
        return [
            'text' => [
                ['message_text' => 'Hello', 'parse_mode' => 'HTML'],
                InputTextMessageContent::class,
            ],
            'location' => [
                ['latitude' => 53.9, 'longitude' => 27.56],
                InputLocationMessageContent::class,
            ],
            'venue' => [
                ['latitude' => 53.9, 'longitude' => 27.56, 'title' => 'Place', 'address' => 'Street 1'],
                InputVenueMessageContent::class,
            ],
            'contact' => [
                ['phone_number' => '+100', 'first_name' => 'John'],
                InputContactMessageContent::class,
            ],
            'invoice' => [
                ['title' => 'Item', 'description' => 'Desc', 'payload' => 'p', 'currency' => 'USD', 'prices' => [['label' => 'Total', 'amount' => 100]]],
                InputInvoiceMessageContent::class,
            ],
            'rich_message' => [
                ['rich_message' => ['html' => '<b>Hi</b>']],
                InputRichMessageContent::class,
            ],
        ];
    }

}
