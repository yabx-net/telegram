<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\AcceptedGiftTypes;
use Yabx\Telegram\Objects\AffiliateInfo;
use Yabx\Telegram\Objects\Gift;
use Yabx\Telegram\Objects\GiftBackground;
use Yabx\Telegram\Objects\GiftInfo;
use Yabx\Telegram\Objects\Gifts;
use Yabx\Telegram\Objects\OwnedGiftRegular;
use Yabx\Telegram\Objects\OwnedGiftUnique;
use Yabx\Telegram\Objects\OwnedGifts;
use Yabx\Telegram\Objects\ReactionTypeCustomEmoji;
use Yabx\Telegram\Objects\ReactionTypePaid;
use Yabx\Telegram\Objects\RevenueWithdrawalStateFailed;
use Yabx\Telegram\Objects\RevenueWithdrawalStatePending;
use Yabx\Telegram\Objects\RevenueWithdrawalStateSucceeded;
use Yabx\Telegram\Objects\StarAmount;
use Yabx\Telegram\Objects\StarTransaction;
use Yabx\Telegram\Objects\TransactionPartnerAffiliateProgram;
use Yabx\Telegram\Objects\TransactionPartnerFragment;
use Yabx\Telegram\Objects\TransactionPartnerOther;
use Yabx\Telegram\Objects\TransactionPartnerTelegramAds;
use Yabx\Telegram\Objects\TransactionPartnerTelegramApi;
use Yabx\Telegram\Objects\TransactionPartnerUser;
use Yabx\Telegram\Objects\UniqueGift;
use Yabx\Telegram\Objects\UniqueGiftBackdrop;
use Yabx\Telegram\Objects\UniqueGiftBackdropColors;
use Yabx\Telegram\Objects\UniqueGiftColors;
use Yabx\Telegram\Objects\UniqueGiftInfo;
use Yabx\Telegram\Objects\UniqueGiftModel;
use Yabx\Telegram\Objects\UniqueGiftSymbol;
use Yabx\Telegram\Tests\Support\SampleData;

$sticker = SampleData::sticker();

$uniqueGift = [
    'gift_id' => 'gift-1',
    'base_name' => 'Rose',
    'name' => 'rose-42',
    'number' => 42,
    'model' => [
        'name' => 'model',
        'sticker' => $sticker,
        'rarity_per_mille' => 10,
    ],
    'symbol' => [
        'name' => 'symbol',
        'sticker' => $sticker,
        'rarity_per_mille' => 10,
    ],
    'backdrop' => [
        'name' => 'backdrop',
        'colors' => [
            'center_color' => 1,
            'edge_color' => 2,
            'symbol_color' => 3,
            'text_color' => 4,
        ],
        'rarity_per_mille' => 10,
    ],
];

return [
    StarAmount::class => [
        'amount' => 100,
        'nanostar_amount' => 500000000,
    ],
    StarTransaction::class => [
        'id' => 'tx-1',
        'amount' => 50,
        'date' => 1681135130,
    ],
    Gift::class => [
        'id' => 'gift-1',
        'sticker' => $sticker,
        'star_count' => 15,
    ],
    AffiliateInfo::class => [
        'affiliate_user' => SampleData::user(),
        'commission_per_mille' => 10,
        'amount' => 5,
    ],
    GiftInfo::class => [
        'gift' => [
            'id' => 'gift-1',
            'sticker' => $sticker,
            'star_count' => 15,
        ],
        'can_be_upgraded' => true,
    ],
    UniqueGiftModel::class => [
        'name' => 'model',
        'sticker' => $sticker,
        'rarity_per_mille' => 10,
    ],
    UniqueGiftSymbol::class => [
        'name' => 'symbol',
        'sticker' => $sticker,
        'rarity_per_mille' => 10,
    ],
    UniqueGiftBackdropColors::class => [
        'center_color' => 1,
        'edge_color' => 2,
        'symbol_color' => 3,
        'text_color' => 4,
    ],
    UniqueGiftBackdrop::class => [
        'name' => 'backdrop',
        'colors' => [
            'center_color' => 1,
            'edge_color' => 2,
            'symbol_color' => 3,
            'text_color' => 4,
        ],
        'rarity_per_mille' => 10,
    ],
    UniqueGift::class => $uniqueGift,
    UniqueGiftInfo::class => [
        'gift' => $uniqueGift,
        'origin' => 'upgrade',
    ],
    UniqueGiftColors::class => [
        'model_custom_emoji_id' => '1',
        'symbol_custom_emoji_id' => '2',
        'light_theme_main_color' => 16777215,
    ],
    GiftBackground::class => [
        'center_color' => 1,
        'edge_color' => 2,
        'text_color' => 3,
    ],
    Gifts::class => [
        'gifts' => [
            ['id' => 'gift-1', 'sticker' => $sticker, 'star_count' => 15],
        ],
    ],
    AcceptedGiftTypes::class => [
        'unlimited_gifts' => true,
        'limited_gifts' => true,
        'unique_gifts' => true,
    ],
    TransactionPartnerUser::class => [
        'type' => 'user',
        'user' => SampleData::user(),
    ],
    TransactionPartnerAffiliateProgram::class => [
        'type' => 'affiliate_program',
        'commission_per_mille' => 10,
    ],
    RevenueWithdrawalStateSucceeded::class => [
        'type' => 'succeeded',
        'date' => 1681135130,
        'url' => 'https://example.com/tx',
    ],
    RevenueWithdrawalStateFailed::class => [
        'type' => 'failed',
    ],
    RevenueWithdrawalStatePending::class => [
        'type' => 'pending',
    ],
    ReactionTypeCustomEmoji::class => [
        'type' => 'custom_emoji',
        'custom_emoji_id' => '1',
    ],
    ReactionTypePaid::class => [
        'type' => 'paid',
    ],
    TransactionPartnerFragment::class => ['type' => 'fragment'],
    TransactionPartnerOther::class => ['type' => 'other'],
    TransactionPartnerTelegramAds::class => ['type' => 'telegram_ads'],
    TransactionPartnerTelegramApi::class => ['type' => 'telegram_api'],
    OwnedGiftUnique::class => [
        'type' => 'unique',
        'gift' => $uniqueGift,
        'send_date' => 1681135130,
    ],
    OwnedGiftRegular::class => [
        'type' => 'regular',
        'gift' => [
            'id' => 'gift-1',
            'sticker' => $sticker,
            'star_count' => 15,
        ],
    ],
    OwnedGifts::class => [
        'total_count' => 1,
        'gifts' => [
            [
                'type' => 'regular',
                'gift' => [
                    'id' => 'gift-1',
                    'sticker' => $sticker,
                    'star_count' => 15,
                ],
            ],
        ],
    ],
];
