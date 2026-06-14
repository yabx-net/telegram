<?php

declare(strict_types=1);

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

$paragraph = ['type' => 'paragraph', 'text' => 'inner'];
$photo = SampleData::photoSize();

return [
    RichBlockParagraph::class => ['type' => 'paragraph', 'text' => 'Hello'],
    RichBlockSectionHeading::class => ['type' => 'heading', 'text' => 'Title', 'size' => 1],
    RichBlockPreformatted::class => ['type' => 'pre', 'text' => 'code', 'language' => 'php'],
    RichBlockFooter::class => ['type' => 'footer', 'text' => 'footer'],
    RichBlockDivider::class => ['type' => 'divider'],
    RichBlockMathematicalExpression::class => ['type' => 'mathematical_expression', 'expression' => 'a+b'],
    RichBlockAnchor::class => ['type' => 'anchor', 'name' => 'top'],
    RichBlockList::class => ['type' => 'list', 'items' => [['label' => 'Item', 'blocks' => [$paragraph]]]],
    RichBlockBlockQuotation::class => ['type' => 'blockquote', 'blocks' => [$paragraph]],
    RichBlockPullQuotation::class => ['type' => 'pullquote', 'text' => 'quote'],
    RichBlockCollage::class => ['type' => 'collage', 'blocks' => [$paragraph]],
    RichBlockSlideshow::class => ['type' => 'slideshow', 'blocks' => [$paragraph]],
    RichBlockTable::class => ['type' => 'table', 'cells' => [[['text' => 'A']]]],
    RichBlockDetails::class => ['type' => 'details', 'summary' => 'More', 'blocks' => [$paragraph]],
    RichBlockMap::class => [
        'type' => 'map',
        'location' => SampleData::location(),
        'zoom' => 10,
        'width' => 400,
        'height' => 300,
    ],
    RichBlockAnimation::class => ['type' => 'animation', 'animation' => SampleData::animation()],
    RichBlockAudio::class => ['type' => 'audio', 'audio' => SampleData::audio()],
    RichBlockPhoto::class => ['type' => 'photo', 'photo' => [$photo]],
    RichBlockVideo::class => ['type' => 'video', 'video' => SampleData::video()],
    RichBlockVoiceNote::class => ['type' => 'voice_note', 'voice_note' => SampleData::voice()],
    RichBlockThinking::class => ['type' => 'thinking', 'text' => 'hmm'],
];
