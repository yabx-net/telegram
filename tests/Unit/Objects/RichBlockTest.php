<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use InvalidArgumentException;
use Yabx\Telegram\Objects\InputRichMessage;
use Yabx\Telegram\Objects\RichBlock;
use Yabx\Telegram\Objects\RichBlockParagraph;
use Yabx\Telegram\Objects\RichBlockSectionHeading;
use Yabx\Telegram\Objects\RichMessage;
use Yabx\Telegram\Objects\RichTextBold;
use Yabx\Telegram\Tests\TestCase;

final class RichBlockTest extends TestCase {

    public function testParsesParagraphWithNestedRichText(): void {
        $block = RichBlock::fromArray([
            'type' => 'paragraph',
            'text' => [
                'Hello ',
                ['type' => 'bold', 'text' => 'world'],
            ],
        ]);

        $this->assertInstanceOf(RichBlockParagraph::class, $block);
        $this->assertIsArray($block->getText());
        $this->assertSame('Hello ', $block->getText()[0]);
        $this->assertInstanceOf(RichTextBold::class, $block->getText()[1]);
    }

    public function testParsesHeading(): void {
        $block = RichBlock::fromArray([
            'type' => 'heading',
            'text' => 'Section',
            'size' => 2,
        ]);

        $this->assertInstanceOf(RichBlockSectionHeading::class, $block);
        $this->assertSame('Section', $block->getText());
        $this->assertSame(2, $block->getSize());
    }

    public function testParsesRichMessageFromFixture(): void {
        $data = $this->loadFixture('rich_message_paragraph.json');

        $message = RichMessage::fromArray($data);

        $this->assertCount(2, $message->getBlocks());
        $this->assertInstanceOf(RichBlockParagraph::class, $message->getBlocks()[0]);
        $this->assertInstanceOf(RichBlockSectionHeading::class, $message->getBlocks()[1]);
        $this->assertFalse($message->getIsRtl());
    }

    public function testParagraphToArrayRoundTrip(): void {
        $original = [
            'type' => 'paragraph',
            'text' => [
                'Hello ',
                ['type' => 'bold', 'text' => 'world'],
            ],
        ];

        $block = RichBlock::fromArray($original);

        $this->assertSame($original, $block->toArray());
    }

    public function testInputRichMessageToArray(): void {
        $input = new InputRichMessage(
            html: '<b>Hello</b>',
            isRtl: false,
        );

        $this->assertSame([
            'html' => '<b>Hello</b>',
            'is_rtl' => false,
        ], $input->toArray());
    }

    public function testThrowsOnInvalidBlockType(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid RichBlock type');

        RichBlock::fromArray(['type' => 'unknown']);
    }

}
