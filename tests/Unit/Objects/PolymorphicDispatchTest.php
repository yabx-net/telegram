<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use PHPUnit\Framework\Attributes\DataProvider;
use Yabx\Telegram\Objects\BackgroundFill;
use Yabx\Telegram\Objects\BackgroundFillSolid;
use Yabx\Telegram\Objects\BackgroundType;
use Yabx\Telegram\Objects\BackgroundTypeFill;
use Yabx\Telegram\Objects\BotCommandScope;
use Yabx\Telegram\Objects\BotCommandScopeDefault;
use Yabx\Telegram\Objects\ChatBoostSource;
use Yabx\Telegram\Objects\ChatBoostSourceGiftCode;
use Yabx\Telegram\Objects\ChatBoostSourceGiveaway;
use Yabx\Telegram\Objects\ChatBoostSourcePremium;
use Yabx\Telegram\Objects\InlineQueryResult;
use Yabx\Telegram\Objects\InlineQueryResultArticle;
use Yabx\Telegram\Objects\InputPaidMedia;
use Yabx\Telegram\Objects\InputPaidMediaPhoto;
use Yabx\Telegram\Objects\InputProfilePhoto;
use Yabx\Telegram\Objects\InputProfilePhotoStatic;
use Yabx\Telegram\Objects\InputStoryContent;
use Yabx\Telegram\Objects\InputStoryContentPhoto;
use Yabx\Telegram\Objects\MenuButton;
use Yabx\Telegram\Objects\MenuButtonCommands;
use Yabx\Telegram\Objects\MessageOrigin;
use Yabx\Telegram\Objects\MessageOriginUser;
use Yabx\Telegram\Objects\OwnedGift;
use Yabx\Telegram\Objects\OwnedGiftRegular;
use Yabx\Telegram\Objects\PaidMedia;
use Yabx\Telegram\Objects\PaidMediaPhoto;
use Yabx\Telegram\Objects\PassportElementError;
use Yabx\Telegram\Objects\PassportElementErrorDataField;
use Yabx\Telegram\Objects\ReactionType;
use Yabx\Telegram\Objects\ReactionTypeEmoji;
use Yabx\Telegram\Objects\RevenueWithdrawalState;
use Yabx\Telegram\Objects\RevenueWithdrawalStateSucceeded;
use Yabx\Telegram\Objects\StoryAreaType;
use Yabx\Telegram\Objects\StoryAreaTypeLink;
use Yabx\Telegram\Objects\TransactionPartner;
use Yabx\Telegram\Objects\TransactionPartnerUser;
use Yabx\Telegram\Tests\Support\SampleData;
use Yabx\Telegram\Tests\TestCase;

final class PolymorphicDispatchTest extends TestCase {

    #[DataProvider('polymorphicCasesProvider')]
    public function testDispatchesToExpectedClass(string $factoryClass, array $data, string $expectedClass): void {
        $object = $factoryClass::fromArray($data);

        $this->assertInstanceOf($expectedClass, $object);
        $this->assertSame($data, $object->toArray());
    }

    public static function polymorphicCasesProvider(): array {
        $base = require __DIR__ . '/../../Fixtures/polymorphic.php';

        $user = SampleData::user();
        $photo = SampleData::photoSize();
        $sticker = SampleData::sticker();

        return array_merge($base, [
            'MessageOrigin user' => [MessageOrigin::class, [
                'type' => 'user',
                'date' => 1681135130,
                'sender_user' => $user,
            ], MessageOriginUser::class],

            'ReactionType emoji' => [ReactionType::class, [
                'type' => 'emoji',
                'emoji' => '👍',
            ], ReactionTypeEmoji::class],

            'MenuButton commands' => [MenuButton::class, [
                'type' => 'commands',
            ], MenuButtonCommands::class],

            'BotCommandScope default' => [BotCommandScope::class, [
                'type' => 'default',
            ], BotCommandScopeDefault::class],

            'PaidMedia photo' => [PaidMedia::class, [
                'type' => 'photo',
                'photo' => [$photo],
            ], PaidMediaPhoto::class],

            'InputPaidMedia photo' => [InputPaidMedia::class, [
                'type' => 'photo',
                'media' => 'attach://photo.jpg',
            ], InputPaidMediaPhoto::class],

            'StoryAreaType link' => [StoryAreaType::class, [
                'type' => 'link',
                'url' => 'https://example.com',
            ], StoryAreaTypeLink::class],

            'InputProfilePhoto static' => [InputProfilePhoto::class, [
                'type' => 'static',
                'photo' => 'attach://photo.jpg',
            ], InputProfilePhotoStatic::class],

            'InputStoryContent photo' => [InputStoryContent::class, [
                'type' => 'photo',
                'photo' => 'attach://story.jpg',
            ], InputStoryContentPhoto::class],

            'OwnedGift regular' => [OwnedGift::class, [
                'type' => 'regular',
                'gift' => [
                    'id' => 'gift-1',
                    'sticker' => $sticker,
                    'star_count' => 15,
                ],
            ], OwnedGiftRegular::class],

            'TransactionPartner user' => [TransactionPartner::class, [
                'type' => 'user',
                'user' => $user,
            ], TransactionPartnerUser::class],

            'BackgroundFill solid' => [BackgroundFill::class, [
                'type' => 'solid',
                'color' => 16711680,
            ], BackgroundFillSolid::class],

            'BackgroundType fill' => [BackgroundType::class, [
                'type' => 'fill',
                'fill' => ['type' => 'solid', 'color' => 16711680],
                'dark_theme_dimming' => 20,
            ], BackgroundTypeFill::class],

            'PassportElementError data' => [PassportElementError::class, [
                'source' => 'data',
                'type' => 'passport',
                'field_name' => 'number',
                'data_hash' => 'abc',
                'message' => 'Invalid',
            ], PassportElementErrorDataField::class],

            'RevenueWithdrawalState succeeded' => [RevenueWithdrawalState::class, [
                'type' => 'succeeded',
                'date' => 1681135130,
                'url' => 'https://example.com/tx',
            ], RevenueWithdrawalStateSucceeded::class],

            'InlineQueryResult article' => [InlineQueryResult::class, [
                'type' => 'article',
                'id' => 'article-1',
                'title' => 'Result',
                'input_message_content' => [
                    'message_text' => 'Text',
                ],
            ], InlineQueryResultArticle::class],

            'ChatBoostSource premium' => [ChatBoostSource::class, [
                'source' => 'premium',
                'user' => $user,
            ], ChatBoostSourcePremium::class],

            'ChatBoostSource gift_code' => [ChatBoostSource::class, [
                'source' => 'gift_code',
                'user' => $user,
            ], ChatBoostSourceGiftCode::class],

            'ChatBoostSource giveaway' => [ChatBoostSource::class, [
                'source' => 'giveaway',
                'giveaway_message_id' => 10,
                'is_unclaimed' => false,
            ], ChatBoostSourceGiveaway::class],
        ]);
    }

}
