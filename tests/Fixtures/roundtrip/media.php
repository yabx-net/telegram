<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\Animation;
use Yabx\Telegram\Objects\Audio;
use Yabx\Telegram\Objects\ChatBoost;
use Yabx\Telegram\Objects\ChatBoostRemoved;
use Yabx\Telegram\Objects\ChatBoostUpdated;
use Yabx\Telegram\Objects\ChatMemberUpdated;
use Yabx\Telegram\Objects\ChatPhoto;
use Yabx\Telegram\Objects\Contact;
use Yabx\Telegram\Objects\Dice;
use Yabx\Telegram\Objects\Document;
use Yabx\Telegram\Objects\File;
use Yabx\Telegram\Objects\LivePhoto;
use Yabx\Telegram\Objects\Location;
use Yabx\Telegram\Objects\MaskPosition;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\PaidMediaInfo;
use Yabx\Telegram\Objects\PaidMediaLivePhoto;
use Yabx\Telegram\Objects\PaidMediaPhoto;
use Yabx\Telegram\Objects\PaidMediaPreview;
use Yabx\Telegram\Objects\PaidMediaVideo;
use Yabx\Telegram\Objects\PollAnswer;
use Yabx\Telegram\Objects\PreCheckoutQuery;
use Yabx\Telegram\Objects\ShippingAddress;
use Yabx\Telegram\Objects\ShippingQuery;
use Yabx\Telegram\Objects\Sticker;
use Yabx\Telegram\Objects\StickerSet;
use Yabx\Telegram\Objects\Venue;
use Yabx\Telegram\Objects\Video;
use Yabx\Telegram\Objects\VideoNote;
use Yabx\Telegram\Objects\VideoQuality;
use Yabx\Telegram\Objects\Voice;
use Yabx\Telegram\Tests\Support\SampleData;

$photo = SampleData::photoSize();
$livePhoto = [
    'file_id' => 'live-1',
    'file_unique_id' => 'live-u',
    'width' => 320,
    'height' => 240,
    'duration' => 3,
];

return [
    Message::class => SampleData::message(),
    Sticker::class => SampleData::sticker(),
    Animation::class => SampleData::animation(),
    Video::class => SampleData::video(),
    Audio::class => SampleData::audio(),
    Voice::class => SampleData::voice(),
    Document::class => [
        'file_id' => 'BQACAgIAAxkBAAI',
        'file_unique_id' => 'AgADAAI',
        'file_name' => 'readme.pdf',
        'mime_type' => 'application/pdf',
        'file_size' => 1024,
    ],
    Location::class => SampleData::location(),
    Venue::class => [
        'location' => SampleData::location(),
        'title' => 'Central Park',
        'address' => 'New York, NY',
    ],
    Contact::class => [
        'phone_number' => '+10000000000',
        'first_name' => 'John',
        'last_name' => 'Doe',
    ],
    Dice::class => ['emoji' => '🎲', 'value' => 4],
    File::class => [
        'file_id' => 'AAQACAgIAAxkBAAI',
        'file_unique_id' => 'AgADAAI',
        'file_size' => 512,
        'file_path' => 'documents/file.pdf',
    ],
    ShippingAddress::class => [
        'country_code' => 'US',
        'state' => 'NY',
        'city' => 'New York',
        'street_line1' => '5th Avenue',
        'post_code' => '10001',
    ],
    ShippingQuery::class => [
        'id' => 'sq-1',
        'from' => SampleData::user(),
        'invoice_payload' => 'payload-1',
        'shipping_address' => [
            'country_code' => 'US',
            'state' => 'NY',
            'city' => 'New York',
            'street_line1' => '5th Avenue',
            'post_code' => '10001',
        ],
    ],
    PreCheckoutQuery::class => [
        'id' => 'pcq-1',
        'from' => SampleData::user(),
        'currency' => 'USD',
        'total_amount' => 1000,
        'invoice_payload' => 'payload-1',
    ],
    ChatBoost::class => [
        'boost_id' => 'boost-1',
        'add_date' => 1681135130,
        'expiration_date' => 1681221530,
    ],
    ChatBoostUpdated::class => [
        'chat' => SampleData::chat(),
        'boost' => [
            'boost_id' => 'boost-1',
            'add_date' => 1681135130,
            'expiration_date' => 1681221530,
        ],
    ],
    ChatBoostRemoved::class => [
        'chat' => SampleData::chat(),
        'boost_id' => 'boost-1',
        'remove_date' => 1681221530,
    ],
    ChatMemberUpdated::class => [
        'chat' => SampleData::chat(),
        'from' => SampleData::user(),
        'date' => 1681135130,
        'old_chat_member' => [
            'status' => 'left',
            'user' => SampleData::bot(),
        ],
        'new_chat_member' => [
            'status' => 'member',
            'user' => SampleData::bot(),
        ],
    ],
    VideoNote::class => [
        'file_id' => 'vn-1',
        'file_unique_id' => 'vn-u',
        'length' => 240,
        'duration' => 5,
    ],
    LivePhoto::class => $livePhoto,
    PaidMediaPhoto::class => [
        'type' => 'photo',
        'photo' => [$photo],
    ],
    PaidMediaLivePhoto::class => [
        'type' => 'live_photo',
        'live_photo' => $livePhoto,
    ],
    PaidMediaInfo::class => [
        'star_count' => 10,
        'paid_media' => [
            ['type' => 'photo', 'photo' => [$photo]],
        ],
    ],
    PaidMediaPreview::class => [
        'type' => 'preview',
        'width' => 100,
        'height' => 100,
        'duration' => 5,
    ],
    PaidMediaVideo::class => [
        'type' => 'video',
        'video' => SampleData::video(),
    ],
    PollAnswer::class => [
        'poll_id' => 'poll-1',
        'user' => SampleData::user(),
        'option_ids' => [0],
    ],
    StickerSet::class => [
        'name' => 'test_by_bot',
        'title' => 'Test Stickers',
        'sticker_type' => 'regular',
        'stickers' => [SampleData::sticker()],
    ],
    MaskPosition::class => [
        'point' => 'forehead',
        'x_shift' => 0.0,
        'y_shift' => 0.0,
        'scale' => 1.0,
    ],
    ChatPhoto::class => [
        'small_file_id' => 'small-1',
        'small_file_unique_id' => 'small-u',
        'big_file_id' => 'big-1',
        'big_file_unique_id' => 'big-u',
    ],
    VideoQuality::class => [
        'file_id' => 'vq-1',
        'file_unique_id' => 'vq-u',
        'width' => 1280,
        'height' => 720,
        'codec' => 'h264',
    ],
];
