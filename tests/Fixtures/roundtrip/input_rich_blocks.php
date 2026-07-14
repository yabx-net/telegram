<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\BotSubscriptionUpdated;
use Yabx\Telegram\Objects\Community;
use Yabx\Telegram\Objects\CommunityChatAdded;
use Yabx\Telegram\Objects\CommunityChatRemoved;
use Yabx\Telegram\Objects\InputMediaVoiceNote;
use Yabx\Telegram\Objects\InputRichBlockAnchor;
use Yabx\Telegram\Objects\InputRichBlockAnimation;
use Yabx\Telegram\Objects\InputRichBlockAudio;
use Yabx\Telegram\Objects\InputRichBlockBlockQuotation;
use Yabx\Telegram\Objects\InputRichBlockCollage;
use Yabx\Telegram\Objects\InputRichBlockDetails;
use Yabx\Telegram\Objects\InputRichBlockDivider;
use Yabx\Telegram\Objects\InputRichBlockFooter;
use Yabx\Telegram\Objects\InputRichBlockList;
use Yabx\Telegram\Objects\InputRichBlockListItem;
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

$paragraph = ['type' => 'paragraph', 'text' => 'inner'];
$photoMedia = ['type' => 'photo', 'media' => 'AgACAgIAAxk'];
$animationMedia = ['type' => 'animation', 'media' => 'CgACAg'];
$audioMedia = ['type' => 'audio', 'media' => 'CQACAg'];
$videoMedia = ['type' => 'video', 'media' => 'BAACAg'];
$voiceMedia = ['type' => 'voice_note', 'media' => 'AwACAg', 'duration' => 5];

return [
    Community::class => ['id' => 55, 'name' => 'Devs'],
    CommunityChatAdded::class => ['community' => ['id' => 55, 'name' => 'Devs']],
    CommunityChatRemoved::class => [],
    BotSubscriptionUpdated::class => [
        'user' => SampleData::user(),
        'invoice_payload' => 'plan-pro',
        'state' => 'active',
    ],
    InputMediaVoiceNote::class => [
        'type' => 'voice_note',
        'media' => 'AwACAg',
        'duration' => 5,
    ],
    InputRichMessageMedia::class => [
        'id' => 'photo1',
        'media' => $photoMedia,
    ],
    InputRichBlockListItem::class => [
        'blocks' => [$paragraph],
        'has_checkbox' => true,
        'is_checked' => false,
    ],
    InputRichBlockParagraph::class => ['type' => 'paragraph', 'text' => 'Hello'],
    InputRichBlockSectionHeading::class => ['type' => 'heading', 'text' => 'Title', 'size' => 1],
    InputRichBlockPreformatted::class => ['type' => 'pre', 'text' => 'code', 'language' => 'php'],
    InputRichBlockFooter::class => ['type' => 'footer', 'text' => 'footer'],
    InputRichBlockDivider::class => ['type' => 'divider'],
    InputRichBlockMathematicalExpression::class => ['type' => 'mathematical_expression', 'expression' => 'a+b'],
    InputRichBlockAnchor::class => ['type' => 'anchor', 'name' => 'top'],
    InputRichBlockList::class => [
        'type' => 'list',
        'items' => [['blocks' => [$paragraph], 'has_checkbox' => true]],
    ],
    InputRichBlockBlockQuotation::class => ['type' => 'blockquote', 'blocks' => [$paragraph]],
    InputRichBlockPullQuotation::class => ['type' => 'pullquote', 'text' => 'quote'],
    InputRichBlockCollage::class => ['type' => 'collage', 'blocks' => [$paragraph]],
    InputRichBlockSlideshow::class => ['type' => 'slideshow', 'blocks' => [$paragraph]],
    InputRichBlockTable::class => ['type' => 'table', 'cells' => [[['text' => 'A']]]],
    InputRichBlockDetails::class => ['type' => 'details', 'summary' => 'More', 'blocks' => [$paragraph]],
    InputRichBlockMap::class => [
        'type' => 'map',
        'location' => SampleData::location(),
        'zoom' => 10,
        'width' => 400,
        'height' => 300,
    ],
    InputRichBlockAnimation::class => ['type' => 'animation', 'animation' => $animationMedia],
    InputRichBlockAudio::class => ['type' => 'audio', 'audio' => $audioMedia],
    InputRichBlockPhoto::class => ['type' => 'photo', 'photo' => $photoMedia],
    InputRichBlockVideo::class => ['type' => 'video', 'video' => $videoMedia],
    InputRichBlockVoiceNote::class => ['type' => 'voice_note', 'voice_note' => $voiceMedia],
    InputRichBlockThinking::class => ['type' => 'thinking', 'text' => 'hmm'],
];
