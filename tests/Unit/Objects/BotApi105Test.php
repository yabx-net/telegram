<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\AreaPosition;
use Yabx\Telegram\Objects\BotFullInfo;
use Yabx\Telegram\Objects\ChatShareThemeEmoji;
use Yabx\Telegram\Objects\EmojiTypeCustomEmoji;
use Yabx\Telegram\Objects\EmojiTypeEmoji;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\PaidMessagesWaived;
use Yabx\Telegram\Objects\RichTextTonAddress;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Objects\WidgetQueryTypeData;
use Yabx\Telegram\Objects\WidgetQueryTypeSignData;
use Yabx\Telegram\Objects\WriteAccessAllowed;
use Yabx\Telegram\Tests\TestCase;

final class BotApi105Test extends TestCase {

    public function testBotFullInfoParsesGetMeFields(): void {
        $bot = BotFullInfo::fromArray([
            'id' => 1,
            'is_bot' => true,
            'first_name' => 'Bot',
            'username' => 'test_bot',
            'active_usernames' => ['test_bot', 'test_bot_ai'],
            'supports_inline_queries' => true,
            'inline_query_placeholder' => 'Search',
            'needs_inline_query_location' => false,
            'has_topic_sidebar' => true,
        ]);

        $this->assertSame(['test_bot', 'test_bot_ai'], $bot->getActiveUsernames());
        $this->assertSame('Search', $bot->getInlineQueryPlaceholder());
        $this->assertFalse($bot->getNeedsInlineQueryLocation());
        $this->assertTrue($bot->getHasTopicSidebar());
    }

    public function testWriteAccessAllowedInviterAndPaidWaiver(): void {
        $allowed = WriteAccessAllowed::fromArray([
            'inviter' => ['id' => 5, 'is_bot' => false, 'first_name' => 'Owner'],
        ]);
        $this->assertSame(5, $allowed->getInviter()->getId());

        $message = Message::fromArray([
            'message_id' => 1,
            'date' => 1710000000,
            'chat' => ['id' => 1, 'type' => 'private'],
            'paid_messages_waived' => [],
        ]);
        $this->assertInstanceOf(PaidMessagesWaived::class, $message->getPaidMessagesWaived());
    }

    public function testWidgetQueryAndShareTheme(): void {
        $update = Update::fromArray([
            'update_id' => 1,
            'widget_query' => [
                'id' => 'q1',
                'from' => ['id' => 2, 'is_bot' => false, 'first_name' => 'Ann'],
                'chat_instance' => 'ci',
                'type' => ['type' => 'data'],
                'data' => 'ping',
            ],
        ]);
        $this->assertInstanceOf(WidgetQueryTypeData::class, $update->getWidgetQuery()->getType());

        $signed = WidgetQueryTypeSignData::fromArray([
            'type' => 'sign_data',
            'wallet' => ['address' => 'EQ', 'amount' => '1'],
            'sign_data' => '{}',
        ]);
        $this->assertSame('EQ', $signed->getWallet()->getAddress());

        $theme = ChatShareThemeEmoji::fromArray([
            'type' => 'emoji',
            'emojis' => [
                ['type' => 'emoji', 'emoji' => '⭐'],
                ['type' => 'custom_emoji', 'custom_emoji_id' => '99'],
            ],
        ]);
        $this->assertInstanceOf(EmojiTypeEmoji::class, $theme->getEmojis()[0]);
        $this->assertInstanceOf(EmojiTypeCustomEmoji::class, $theme->getEmojis()[1]);
    }

    public function testTonAddressAndAreaPosition(): void {
        $text = RichTextTonAddress::fromArray([
            'type' => 'ton_address',
            'text' => 'wallet',
            'address' => 'EQ',
        ]);
        $this->assertSame('EQ', $text->getAddress());
        $this->assertSame([
            'type' => 'ton_address',
            'text' => 'wallet',
            'address' => 'EQ',
        ], $text->toArray());

        $position = AreaPosition::fromArray([
            'x_percentage' => 10.0,
            'y_percentage' => 20.0,
            'width_percentage' => 30.0,
            'height_percentage' => 40.0,
            'rotation_angle' => 0.0,
            'corner_radius_percentage' => 5.0,
        ]);
        $this->assertSame(5.0, $position->getCornerRadiusPercentage());
    }
}
