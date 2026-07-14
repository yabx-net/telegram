<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use Yabx\Telegram\Objects\InputMediaAnimation;
use Yabx\Telegram\Objects\InputMediaAudio;
use Yabx\Telegram\Objects\InputMediaPhoto;
use Yabx\Telegram\Objects\InputMediaVideo;
use Yabx\Telegram\Objects\InputMediaVoiceNote;
use Yabx\Telegram\Objects\InputRichBlock;
use Yabx\Telegram\Objects\InputRichBlockAnchor;
use Yabx\Telegram\Objects\InputRichBlockAnimation;
use Yabx\Telegram\Objects\InputRichBlockAudio;
use Yabx\Telegram\Objects\InputRichBlockBlockQuotation;
use Yabx\Telegram\Objects\InputRichBlockCollage;
use Yabx\Telegram\Objects\InputRichBlockDetails;
use Yabx\Telegram\Objects\InputRichBlockDivider;
use Yabx\Telegram\Objects\InputRichBlockFooter;
use Yabx\Telegram\Objects\InputRichBlockList;
use Yabx\Telegram\Objects\InputRichBlockMap;
use Yabx\Telegram\Objects\InputRichBlockMathematicalExpression;
use Yabx\Telegram\Objects\InputRichBlockParagraph;
use Yabx\Telegram\Objects\InputRichBlockPhoto;
use Yabx\Telegram\Objects\InputRichBlockPreformatted;
use Yabx\Telegram\Objects\InputRichBlockPullQuotation;
use Yabx\Telegram\Objects\InputRichBlockSectionHeading;
use Yabx\Telegram\Objects\InputRichBlockSlideshow;
use Yabx\Telegram\Objects\InputRichBlockTable;
use Yabx\Telegram\Objects\InputRichBlockThinking;
use Yabx\Telegram\Objects\InputRichBlockVideo;
use Yabx\Telegram\Objects\InputRichBlockVoiceNote;
use Yabx\Telegram\Objects\InputRichMessageMedia;
use Yabx\Telegram\Tests\Support\SampleData;
use Yabx\Telegram\Tests\TestCase;

final class InputRichBlockAllTypesTest extends TestCase {

    #[DataProvider('inputRichBlockTypesProvider')]
    public function testFromArrayParsesType(array $data, string $expectedClass): void {
        $block = InputRichBlock::fromArray($data);

        $this->assertInstanceOf($expectedClass, $block);
        $this->assertSame($data, $block->toArray());
    }

    public static function inputRichBlockTypesProvider(): array {
        $paragraph = ['type' => 'paragraph', 'text' => 'inner'];
        $photoMedia = ['type' => 'photo', 'media' => 'AgACAgIAAxk'];
        $animationMedia = ['type' => 'animation', 'media' => 'CgACAg'];
        $audioMedia = ['type' => 'audio', 'media' => 'CQACAg'];
        $videoMedia = ['type' => 'video', 'media' => 'BAACAg'];
        $voiceMedia = ['type' => 'voice_note', 'media' => 'AwACAg', 'duration' => 5];

        return [
            'paragraph' => [['type' => 'paragraph', 'text' => 'Hello'], InputRichBlockParagraph::class],
            'heading' => [['type' => 'heading', 'text' => 'Title', 'size' => 1], InputRichBlockSectionHeading::class],
            'pre' => [['type' => 'pre', 'text' => 'code', 'language' => 'php'], InputRichBlockPreformatted::class],
            'footer' => [['type' => 'footer', 'text' => 'footer'], InputRichBlockFooter::class],
            'divider' => [['type' => 'divider'], InputRichBlockDivider::class],
            'mathematical_expression' => [['type' => 'mathematical_expression', 'expression' => 'a+b'], InputRichBlockMathematicalExpression::class],
            'anchor' => [['type' => 'anchor', 'name' => 'top'], InputRichBlockAnchor::class],
            'list' => [['type' => 'list', 'items' => [['blocks' => [$paragraph], 'has_checkbox' => true]]], InputRichBlockList::class],
            'blockquote' => [['type' => 'blockquote', 'blocks' => [$paragraph]], InputRichBlockBlockQuotation::class],
            'pullquote' => [['type' => 'pullquote', 'text' => 'quote'], InputRichBlockPullQuotation::class],
            'collage' => [['type' => 'collage', 'blocks' => [$paragraph]], InputRichBlockCollage::class],
            'slideshow' => [['type' => 'slideshow', 'blocks' => [$paragraph]], InputRichBlockSlideshow::class],
            'table' => [['type' => 'table', 'cells' => [[['text' => 'A']]]], InputRichBlockTable::class],
            'details' => [['type' => 'details', 'summary' => 'More', 'blocks' => [$paragraph]], InputRichBlockDetails::class],
            'map' => [['type' => 'map', 'location' => SampleData::location(), 'zoom' => 10, 'width' => 400, 'height' => 300], InputRichBlockMap::class],
            'animation' => [['type' => 'animation', 'animation' => $animationMedia], InputRichBlockAnimation::class],
            'audio' => [['type' => 'audio', 'audio' => $audioMedia], InputRichBlockAudio::class],
            'photo' => [['type' => 'photo', 'photo' => $photoMedia], InputRichBlockPhoto::class],
            'video' => [['type' => 'video', 'video' => $videoMedia], InputRichBlockVideo::class],
            'voice_note' => [['type' => 'voice_note', 'voice_note' => $voiceMedia], InputRichBlockVoiceNote::class],
            'thinking' => [['type' => 'thinking', 'text' => 'hmm'], InputRichBlockThinking::class],
        ];
    }

    #[DataProvider('inputRichMessageMediaTypesProvider')]
    public function testInputRichMessageMediaParsesMediaType(array $media, string $expectedClass): void {
        $item = InputRichMessageMedia::fromArray([
            'id' => 'media1',
            'media' => $media,
        ]);

        $this->assertSame('media1', $item->getId());
        $this->assertInstanceOf($expectedClass, $item->getMedia());
        $this->assertSame([
            'id' => 'media1',
            'media' => $media,
        ], $item->toArray());
    }

    public static function inputRichMessageMediaTypesProvider(): array {
        return [
            'photo' => [['type' => 'photo', 'media' => 'AgACAg'], InputMediaPhoto::class],
            'video' => [['type' => 'video', 'media' => 'BAACAg'], InputMediaVideo::class],
            'audio' => [['type' => 'audio', 'media' => 'CQACAg'], InputMediaAudio::class],
            'animation' => [['type' => 'animation', 'media' => 'CgACAg'], InputMediaAnimation::class],
            'voice_note' => [['type' => 'voice_note', 'media' => 'AwACAg', 'duration' => 3], InputMediaVoiceNote::class],
        ];
    }

    public function testInputRichMessageMediaThrowsOnInvalidMediaType(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid InputRichMessageMedia media type');

        InputRichMessageMedia::fromArray([
            'id' => 'x',
            'media' => ['type' => 'document', 'media' => 'BQACAg'],
        ]);
    }
}
