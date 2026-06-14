<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use PHPUnit\Framework\Attributes\DataProvider;
use Yabx\Telegram\Objects\RichBlock;
use Yabx\Telegram\Objects\RichBlockAnchor;
use Yabx\Telegram\Objects\RichBlockAnimation;
use Yabx\Telegram\Objects\RichBlockAudio;
use Yabx\Telegram\Objects\RichBlockBlockQuotation;
use Yabx\Telegram\Objects\RichBlockCollage;
use Yabx\Telegram\Objects\RichBlockDetails;
use Yabx\Telegram\Objects\RichBlockDivider;
use Yabx\Telegram\Objects\RichBlockFooter;
use Yabx\Telegram\Objects\RichBlockList;
use Yabx\Telegram\Objects\RichBlockMap;
use Yabx\Telegram\Objects\RichBlockMathematicalExpression;
use Yabx\Telegram\Objects\RichBlockParagraph;
use Yabx\Telegram\Objects\RichBlockPhoto;
use Yabx\Telegram\Objects\RichBlockPreformatted;
use Yabx\Telegram\Objects\RichBlockPullQuotation;
use Yabx\Telegram\Objects\RichBlockSectionHeading;
use Yabx\Telegram\Objects\RichBlockSlideshow;
use Yabx\Telegram\Objects\RichBlockTable;
use Yabx\Telegram\Objects\RichBlockThinking;
use Yabx\Telegram\Objects\RichBlockVideo;
use Yabx\Telegram\Objects\RichBlockVoiceNote;
use Yabx\Telegram\Tests\Support\SampleData;
use Yabx\Telegram\Tests\TestCase;

final class RichBlockAllTypesTest extends TestCase {

    #[DataProvider('richBlockTypesProvider')]
    public function testFromArrayParsesType(array $data, string $expectedClass): void {
        $block = RichBlock::fromArray($data);

        $this->assertInstanceOf($expectedClass, $block);
        $this->assertSame($data, $block->toArray());
    }

    public static function richBlockTypesProvider(): array {
        $photo = SampleData::photoSize();
        $paragraph = ['type' => 'paragraph', 'text' => 'inner'];

        return [
            'paragraph' => [['type' => 'paragraph', 'text' => 'Hello'], RichBlockParagraph::class],
            'heading' => [['type' => 'heading', 'text' => 'Title', 'size' => 1], RichBlockSectionHeading::class],
            'pre' => [['type' => 'pre', 'text' => 'code', 'language' => 'php'], RichBlockPreformatted::class],
            'footer' => [['type' => 'footer', 'text' => 'footer'], RichBlockFooter::class],
            'divider' => [['type' => 'divider'], RichBlockDivider::class],
            'mathematical_expression' => [['type' => 'mathematical_expression', 'expression' => 'a+b'], RichBlockMathematicalExpression::class],
            'anchor' => [['type' => 'anchor', 'name' => 'top'], RichBlockAnchor::class],
            'list' => [['type' => 'list', 'items' => [['label' => 'Item', 'blocks' => [$paragraph]]]], RichBlockList::class],
            'blockquote' => [['type' => 'blockquote', 'blocks' => [$paragraph]], RichBlockBlockQuotation::class],
            'pullquote' => [['type' => 'pullquote', 'text' => 'quote'], RichBlockPullQuotation::class],
            'collage' => [['type' => 'collage', 'blocks' => [$paragraph]], RichBlockCollage::class],
            'slideshow' => [['type' => 'slideshow', 'blocks' => [$paragraph]], RichBlockSlideshow::class],
            'table' => [['type' => 'table', 'cells' => [[['text' => 'A']]]], RichBlockTable::class],
            'details' => [['type' => 'details', 'summary' => 'More', 'blocks' => [$paragraph]], RichBlockDetails::class],
            'map' => [['type' => 'map', 'location' => SampleData::location(), 'zoom' => 10, 'width' => 400, 'height' => 300], RichBlockMap::class],
            'animation' => [['type' => 'animation', 'animation' => SampleData::animation()], RichBlockAnimation::class],
            'audio' => [['type' => 'audio', 'audio' => SampleData::audio()], RichBlockAudio::class],
            'photo' => [['type' => 'photo', 'photo' => [$photo]], RichBlockPhoto::class],
            'video' => [['type' => 'video', 'video' => SampleData::video()], RichBlockVideo::class],
            'voice_note' => [['type' => 'voice_note', 'voice_note' => SampleData::voice()], RichBlockVoiceNote::class],
            'thinking' => [['type' => 'thinking', 'text' => 'hmm'], RichBlockThinking::class],
        ];
    }

}
