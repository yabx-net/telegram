<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\ChatFullInfo;
use Yabx\Telegram\Tests\TestCase;

final class ChatFullInfoVariantsTest extends TestCase {

    public function testParsesSupergroupForum(): void {
        $chat = ChatFullInfo::fromArray($this->loadFixture('chat_full_info_supergroup.json'));

        $this->assertSame(-1001234567890, $chat->getId());
        $this->assertTrue($chat->getIsForum());
        $this->assertSame(10, $chat->getSlowModeDelay());
        $this->assertTrue($chat->getHasProtectedContent());
        $this->assertSame('dev_forum', $chat->getUsername());
        $this->assertSame('Rules', $chat->getPinnedMessage()->getText());
        $this->assertTrue($chat->getPermissions()->getCanSendMessages());
    }

    public function testParsesBusinessPrivateChat(): void {
        $chat = ChatFullInfo::fromArray($this->loadFixture('chat_full_info_business.json'));

        $this->assertSame('private', $chat->getType());
        $this->assertSame('Welcome', $chat->getBusinessIntro()->getTitle());
        $this->assertSame('123 Main St', $chat->getBusinessLocation()->getAddress());
        $this->assertSame('Europe/Moscow', $chat->getBusinessOpeningHours()->getTimeZoneName());
        $this->assertSame(15, $chat->getBirthdate()->getDay());
        $this->assertTrue($chat->getHasPrivateForwards());
    }

    public function testParsesChannel(): void {
        $chat = ChatFullInfo::fromArray($this->loadFixture('chat_full_info_channel.json'));

        $this->assertSame('channel', $chat->getType());
        $this->assertTrue($chat->getCanSendPaidMedia());
        $this->assertSame('Daily news', $chat->getDescription());
        $this->assertSame(-1001234567890, $chat->getLinkedChatId());
    }

    public function testSupergroupRoundTrip(): void {
        $this->assertRoundTrip(ChatFullInfo::class, $this->loadFixture('chat_full_info_supergroup.json'));
    }

    public function testBusinessPrivateRoundTrip(): void {
        $this->assertRoundTrip(ChatFullInfo::class, $this->loadFixture('chat_full_info_business.json'));
    }

    public function testChannelRoundTrip(): void {
        $this->assertRoundTrip(ChatFullInfo::class, $this->loadFixture('chat_full_info_channel.json'));
    }

    public function testParsesLocationAndGuardBot(): void {
        $chat = ChatFullInfo::fromArray($this->loadFixture('chat_full_info_location.json'));

        $this->assertTrue($chat->getJoinByRequest());
        $this->assertSame('guard_bot', $chat->getGuardBot()->getUsername());
        $this->assertSame('Minsk center', $chat->getLocation()->getAddress());
        $this->assertSame(2, $chat->getProfileAccentColorId());
        $this->assertSame('MyStickers', $chat->getStickerSetName());
        $this->assertSame(3, $chat->getUnrestrictBoostCount());
        $this->assertTrue($chat->getHasAggressiveAntiSpamEnabled());
    }

    public function testLocationRoundTrip(): void {
        $this->assertRoundTrip(ChatFullInfo::class, $this->loadFixture('chat_full_info_location.json'));
    }

    public function testParsesPrivateChatWithPersonalChannel(): void {
        $chat = ChatFullInfo::fromArray($this->loadFixture('chat_full_info_private.json'));

        $this->assertSame('private', $chat->getType());
        $this->assertSame('creator', $chat->getUsername());
        $this->assertSame(1681221530, $chat->getEmojiStatusExpirationDate());
        $this->assertSame('my_channel', $chat->getPersonalChat()->getUsername());
        $this->assertSame('99999', $chat->getBackgroundCustomEmojiId());
    }

    public function testPrivateChatRoundTrip(): void {
        $this->assertRoundTrip(ChatFullInfo::class, $this->loadFixture('chat_full_info_private.json'));
    }

    public function testParsesExtendedSupergroupFields(): void {
        $chat = ChatFullInfo::fromArray($this->loadFixture('chat_full_info_extended.json'));

        $this->assertSame('Group bio text', $chat->getBio());
        $this->assertSame('https://t.me/+extended', $chat->getInviteLink());
        $this->assertTrue($chat->getJoinToSendMessages());
        $this->assertTrue($chat->getHasHiddenMembers());
        $this->assertFalse($chat->getHasVisibleHistory());
        $this->assertTrue($chat->getHasRestrictedVoiceAndVideoMessages());
        $this->assertTrue($chat->getCanSetStickerSet());
        $this->assertSame('emoji_set_by_bot', $chat->getCustomEmojiStickerSetName());
        $this->assertSame(3600, $chat->getMessageAutoDeleteTime());
        $this->assertSame('88888', $chat->getEmojiStatusCustomEmojiId());
        $this->assertSame('77777', $chat->getProfileBackgroundCustomEmojiId());
        $this->assertSame(5, $chat->getMaxReactionCount());
        $this->assertNotNull($chat->getPhoto()->getBigFileId());
    }

    public function testExtendedSupergroupRoundTrip(): void {
        $this->assertRoundTrip(ChatFullInfo::class, $this->loadFixture('chat_full_info_extended.json'));
    }

}
