<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use Yabx\Telegram\Objects\BusinessConnection;
use Yabx\Telegram\Objects\ChatFullInfo;
use Yabx\Telegram\Objects\ChatInviteLink;
use Yabx\Telegram\Objects\ChatMemberAdministrator;
use Yabx\Telegram\Objects\ForumTopic;
use Yabx\Telegram\Objects\File;
use Yabx\Telegram\Objects\Gifts;
use Yabx\Telegram\Objects\LabeledPrice;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\OwnedGifts;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Objects\User;
use Yabx\Telegram\Objects\UserChatBoosts;
use Yabx\Telegram\Objects\WebhookInfo;
use Yabx\Telegram\Objects\StarTransactions;
use Yabx\Telegram\Objects\StickerSet;
use Yabx\Telegram\Tests\Support\MocksBotApi;
use Yabx\Telegram\Tests\TestCase;

final class BotApiSnapshotsTest extends TestCase {

    use MocksBotApi;

    public function testGetMeSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/get_me.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $user = $bot->getMe();

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(1087968824, $user->getId());
        $this->assertTrue($user->getSupportsInlineQueries());
        $this->assertRoundTrip(User::class, $fixture);
    }

    public function testGetChatSupergroupSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('chat_full_info_supergroup.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $chat = $bot->getChat(-1001234567890);

        $this->assertInstanceOf(ChatFullInfo::class, $chat);
        $this->assertTrue($chat->getIsForum());
        $this->assertSame('paid', $chat->getAvailableReactions()[1]->getType());
        $this->assertRoundTrip(ChatFullInfo::class, $fixture);
    }

    public function testSendMessagePhotoSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/send_message_photo.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $message = $bot->sendMessage(chatId: -1001234567890, text: 'trigger');

        $this->assertInstanceOf(Message::class, $message);
        $this->assertSame(42, $message->getMessageId());
        $this->assertCount(2, $message->getPhoto());
        $this->assertSame(800, $message->getPhoto()[1]->getWidth());
        $this->assertTrue($message->getHasMediaSpoiler());
        $this->assertSame('Original', $message->getReplyToMessage()->getText());
        $this->assertRoundTrip(Message::class, $fixture);
    }

    public function testGetUpdatesSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/get_updates.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $updates = $bot->getUpdates();

        $this->assertCount(1, $updates);
        $this->assertInstanceOf(Update::class, $updates[0]);
        $this->assertSame(94181761, $updates[0]->getUpdateId());
        $this->assertSame('Hello', $updates[0]->getMessage()->getText());
        $this->assertRoundTrip(Update::class, $fixture[0]);
    }

    public function testGetChatMemberSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/get_chat_member.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $member = $bot->getChatMember(-1001234567890, 1);

        $this->assertInstanceOf(ChatMemberAdministrator::class, $member);
        $this->assertTrue($member->getCanManageTopics());
        $this->assertSame('group_admin', $member->getUser()->getUsername());
        $this->assertRoundTrip(ChatMemberAdministrator::class, $fixture);
    }

    public function testGetWebhookInfoSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/webhook_info.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $info = $bot->getWebhookInfo();

        $this->assertSame('https://example.com/hook', $info->getUrl());
        $this->assertSame(2, $info->getPendingUpdateCount());
        $this->assertSame(['message', 'callback_query'], $info->getAllowedUpdates());
        $this->assertRoundTrip(WebhookInfo::class, $fixture);
    }

    public function testGetStarTransactionsSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/star_transactions.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $transactions = $bot->getStarTransactions(offset: 0, limit: 10);

        $this->assertCount(2, $transactions->getTransactions());
        $this->assertSame('tx-1', $transactions->getTransactions()[0]->getId());
        $this->assertSame(500000000, $transactions->getTransactions()[0]->getNanostarAmount());
        $this->assertSame(-10, $transactions->getTransactions()[1]->getAmount());
        $this->assertRoundTrip(StarTransactions::class, $fixture);
    }

    public function testGetFileSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/get_file.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $file = $bot->getFile('AAQACAgIAAxkBAAI');

        $this->assertInstanceOf(File::class, $file);
        $this->assertSame('photos/file_42.jpg', $file->getFilePath());
        $this->assertSame(512000, $file->getFileSize());
        $this->assertRoundTrip(File::class, $fixture);
    }

    public function testGetStickerSetSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/sticker_set.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $set = $bot->getStickerSet('test_by_bot');

        $this->assertInstanceOf(StickerSet::class, $set);
        $this->assertSame('Test Stickers', $set->getTitle());
        $this->assertCount(1, $set->getStickers());
        $this->assertSame('😀', $set->getStickers()[0]->getEmoji());
        $this->assertRoundTrip(StickerSet::class, $fixture);
    }

    public function testCreateChatInviteLinkSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/create_chat_invite_link.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $link = $bot->createChatInviteLink(-1001234567890, name: 'Guests');

        $this->assertInstanceOf(ChatInviteLink::class, $link);
        $this->assertSame('Guests', $link->getName());
        $this->assertTrue($link->getCreatesJoinRequest());
        $this->assertSame(100, $link->getMemberLimit());
        $this->assertRoundTrip(ChatInviteLink::class, $fixture);
    }

    public function testCreateForumTopicSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/create_forum_topic.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $topic = $bot->createForumTopic(-1001234567890, 'Support');

        $this->assertInstanceOf(ForumTopic::class, $topic);
        $this->assertSame(42, $topic->getMessageThreadId());
        $this->assertSame('Support', $topic->getName());
        $this->assertRoundTrip(ForumTopic::class, $fixture);
    }

    public function testGetBusinessConnectionSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/get_business_connection.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $connection = $bot->getBusinessConnection('bc-1');

        $this->assertInstanceOf(BusinessConnection::class, $connection);
        $this->assertTrue($connection->getCanReply());
        $this->assertSame('biz_user', $connection->getUser()->getUsername());
        $this->assertRoundTrip(BusinessConnection::class, $fixture);
    }

    public function testGetAvailableGiftsSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/get_available_gifts.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $gifts = $bot->getAvailableGifts();

        $this->assertInstanceOf(Gifts::class, $gifts);
        $this->assertSame('gift-1', $gifts->getGifts()[0]->getId());
        $this->assertRoundTrip(Gifts::class, $fixture);
    }

    public function testGetUserGiftsSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/owned_gifts.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $owned = $bot->getUserGifts(1);

        $this->assertInstanceOf(OwnedGifts::class, $owned);
        $this->assertSame(1, $owned->getTotalCount());
        $this->assertRoundTrip(OwnedGifts::class, $fixture);
    }

    public function testGetUserChatBoostsSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/get_user_chat_boosts.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $boosts = $bot->getUserChatBoosts(-1001234567890, 1);

        $this->assertInstanceOf(UserChatBoosts::class, $boosts);
        $this->assertSame('boost-1', $boosts->getBoosts()[0]->getBoostId());
        $this->assertRoundTrip(UserChatBoosts::class, $fixture);
    }

    public function testSendInvoiceSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('api_responses/send_invoice.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $message = $bot->sendInvoice(
            chatId: 1,
            title: 'Premium',
            description: 'One month',
            payload: 'order-1',
            currency: 'XTR',
            prices: [new LabeledPrice('Premium', 100)],
        );

        $this->assertInstanceOf(Message::class, $message);
        $this->assertSame('Premium', $message->getInvoice()->getTitle());
        $this->assertRoundTrip(Message::class, $fixture);
    }

    public function testGetChatExtendedSnapshotParsesAndRoundTrips(): void {
        $fixture = $this->loadFixture('chat_full_info_extended.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $chat = $bot->getChat(-1005555555555);

        $this->assertInstanceOf(ChatFullInfo::class, $chat);
        $this->assertSame('emoji_set_by_bot', $chat->getCustomEmojiStickerSetName());
        $this->assertTrue($chat->getHasHiddenMembers());
        $this->assertRoundTrip(ChatFullInfo::class, $fixture);
    }

}
