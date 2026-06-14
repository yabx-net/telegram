<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\MessageOriginUser;
use Yabx\Telegram\Objects\MessageOriginChannel;
use Yabx\Telegram\Tests\TestCase;

final class MessageVariantsTest extends TestCase {

    public function testParsesReplyWithParameters(): void {
        $message = Message::fromArray($this->loadFixture('message_with_reply.json'));

        $this->assertSame('This is a reply', $message->getText());
        $this->assertSame(19, $message->getReplyToMessage()->getMessageId());
        $this->assertSame('Original', $message->getReplyToMessage()->getText());
    }

    public function testParsesPaidMediaMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_paid_media.json'));

        $this->assertSame(10, $message->getPaidMedia()->getStarCount());
        $this->assertSame('photo', $message->getPaidMedia()->getPaidMedia()[0]->getType());
    }

    public function testParsesExternalReply(): void {
        $message = Message::fromArray([
            'message_id' => 40,
            'date' => 1681135130,
            'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            'text' => 'quoted',
            'external_reply' => $this->loadFixture('external_reply_with_sticker.json'),
        ]);

        $origin = $message->getExternalReply()->getOrigin();
        $this->assertInstanceOf(MessageOriginUser::class, $origin);
        $this->assertSame('Sender', $origin->getSenderUser()->getFirstName());
        $this->assertSame('regular', $message->getExternalReply()->getSticker()->getType());
        $this->assertTrue($message->getExternalReply()->getHasMediaSpoiler());
    }

    public function testReplyMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_reply.json'));
    }

    public function testPaidMediaMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_paid_media.json'));
    }

    public function testParsesForwardOrigin(): void {
        $message = Message::fromArray($this->loadFixture('message_with_forward.json'));

        $this->assertSame('Forwarded content', $message->getText());
        $origin = $message->getForwardOrigin();
        $this->assertInstanceOf(MessageOriginChannel::class, $origin);
        $this->assertSame(99, $origin->getMessageId());
        $this->assertSame('Source Channel', $origin->getChat()->getTitle());
    }

    public function testForwardMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_forward.json'));
    }

    public function testParsesQuoteEntitiesAndLinkPreview(): void {
        $message = Message::fromArray($this->loadFixture('message_with_quote.json'));

        $this->assertSame('Hello @bot', $message->getText());
        $this->assertSame('mention', $message->getEntities()[0]->getType());
        $this->assertSame('quoted part', $message->getQuote()->getText());
        $this->assertTrue($message->getLinkPreviewOptions()->getIsDisabled());
    }

    public function testQuoteMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_quote.json'));
    }

    public function testParsesStoryReply(): void {
        $message = Message::fromArray($this->loadFixture('message_with_story_reply.json'));

        $this->assertSame('reply to story', $message->getText());
        $this->assertSame(42, $message->getReplyToStory()->getId());
        $this->assertSame('User', $message->getReplyToStory()->getChat()->getFirstName());
    }

    public function testStoryReplyRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_story_reply.json'));
    }

    public function testParsesRichMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_rich_message.json'));

        $this->assertSame('paragraph', $message->getRichMessage()->getBlocks()[0]->getType());
        $this->assertSame('Rich content', $message->getRichMessage()->getBlocks()[0]->getText());
        $this->assertFalse($message->getRichMessage()->getIsRtl());
    }

    public function testRichMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_rich_message.json'));
    }

    public function testParsesForumTopicCreated(): void {
        $message = Message::fromArray($this->loadFixture('message_with_forum_topic.json'));

        $this->assertTrue($message->getIsTopicMessage());
        $this->assertSame(42, $message->getMessageThreadId());
        $this->assertSame('General', $message->getForumTopicCreated()->getName());
        $this->assertSame(7322096, $message->getForumTopicCreated()->getIconColor());
    }

    public function testForumTopicMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_forum_topic.json'));
    }

    public function testParsesInvoiceMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_invoice.json'));

        $this->assertSame('Premium', $message->getInvoice()->getTitle());
        $this->assertSame('USD', $message->getInvoice()->getCurrency());
        $this->assertSame(1000, $message->getInvoice()->getTotalAmount());
    }

    public function testInvoiceMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_invoice.json'));
    }

    public function testParsesBoostAddedMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_boost.json'));

        $this->assertSame(2, $message->getBoostAdded()->getBoostCount());
    }

    public function testBoostMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_boost.json'));
    }

    public function testParsesSuccessfulPaymentMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_successful_payment.json'));

        $this->assertSame('order-42', $message->getSuccessfulPayment()->getInvoicePayload());
        $this->assertSame('tg-charge-1', $message->getSuccessfulPayment()->getTelegramPaymentChargeId());
    }

    public function testSuccessfulPaymentMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_successful_payment.json'));
    }

    public function testParsesMigrationMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_migration.json'));

        $this->assertSame(-1001234567890, $message->getMigrateToChatId());
        $this->assertSame('group', $message->getChat()->getType());
    }

    public function testMigrationMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_migration.json'));
    }

    public function testParsesNewChatMembersMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_new_members.json'));

        $this->assertCount(2, $message->getNewChatMembers());
        $this->assertSame('Alice', $message->getNewChatMembers()[0]->getFirstName());
        $this->assertTrue($message->getNewChatMembers()[1]->getIsBot());
    }

    public function testNewMembersMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_new_members.json'));
    }

    public function testParsesPinnedMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_pinned.json'));

        $pinned = $message->getPinnedMessage()->getMessage();
        $this->assertNotNull($pinned);
        $this->assertSame('Pinned rules', $pinned->getText());
        $this->assertSame(43, $pinned->getMessageId());
    }

    public function testPinnedMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_pinned.json'));
    }

    public function testParsesLeftChatMemberMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_left_member.json'));

        $this->assertSame('Bob', $message->getLeftChatMember()->getFirstName());
        $this->assertSame(5, $message->getLeftChatMember()->getId());
    }

    public function testLeftMemberMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_left_member.json'));
    }

    public function testParsesGroupChatCreatedMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_group_created.json'));

        $this->assertTrue($message->getGroupChatCreated());
        $this->assertSame('group', $message->getChat()->getType());
    }

    public function testGroupCreatedMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_group_created.json'));
    }

    public function testParsesSupergroupChatCreatedMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_supergroup_created.json'));

        $this->assertTrue($message->getSupergroupChatCreated());
        $this->assertSame('Upgraded', $message->getChat()->getTitle());
    }

    public function testSupergroupCreatedMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_supergroup_created.json'));
    }

    public function testParsesChannelChatCreatedMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_channel_created.json'));

        $this->assertTrue($message->getChannelChatCreated());
        $this->assertSame('channel', $message->getChat()->getType());
    }

    public function testChannelCreatedMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_channel_created.json'));
    }

    public function testParsesMigrateFromChatIdMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_migrate_from.json'));

        $this->assertSame(-123, $message->getMigrateFromChatId());
    }

    public function testMigrateFromMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_migrate_from.json'));
    }

    public function testParsesNewChatTitleMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_new_title.json'));

        $this->assertSame('Renamed Group', $message->getNewChatTitle());
    }

    public function testNewTitleMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_new_title.json'));
    }

    public function testParsesDeleteChatPhotoMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_delete_photo.json'));

        $this->assertTrue($message->getDeleteChatPhoto());
    }

    public function testDeletePhotoMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_delete_photo.json'));
    }

    public function testParsesNewChatPhotoMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_new_photo.json'));

        $this->assertCount(2, $message->getNewChatPhoto());
        $this->assertSame(640, $message->getNewChatPhoto()[1]->getWidth());
    }

    public function testNewPhotoMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_new_photo.json'));
    }

    public function testParsesForumTopicEditedMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_forum_topic_edited.json'));

        $this->assertSame('Renamed Topic', $message->getForumTopicEdited()->getName());
    }

    public function testForumTopicEditedRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_forum_topic_edited.json'));
    }

    public function testParsesProximityAlertMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_proximity_alert.json'));

        $this->assertSame(100, $message->getProximityAlertTriggered()->getDistance());
        $this->assertSame('Watcher', $message->getProximityAlertTriggered()->getWatcher()->getFirstName());
    }

    public function testProximityAlertRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_proximity_alert.json'));
    }

    public function testParsesUsersSharedMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_users_shared.json'));

        $this->assertSame(1, $message->getUsersShared()->getRequestId());
        $this->assertSame('Alice', $message->getUsersShared()->getUsers()[0]->getFirstName());
    }

    public function testUsersSharedRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_users_shared.json'));
    }

    public function testParsesAutoDeleteTimerMessage(): void {
        $message = Message::fromArray($this->loadFixture('message_with_auto_delete_timer.json'));

        $this->assertSame(86400, $message->getMessageAutoDeleteTimerChanged()->getMessageAutoDeleteTime());
    }

    public function testAutoDeleteTimerRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_auto_delete_timer.json'));
    }

    public function testParsesPhotoWithCaptionAndMarkup(): void {
        $message = Message::fromArray($this->loadFixture('message_with_photo_caption.json'));

        $this->assertSame('mg-1', $message->getMediaGroupId());
        $this->assertSame('effect-1', $message->getEffectId());
        $this->assertTrue($message->getHasProtectedContent());
        $this->assertTrue($message->getIsFromOffline());
        $this->assertCount(2, $message->getPhoto());
        $this->assertSame('Album *shot*', $message->getCaption());
        $this->assertTrue($message->getShowCaptionAboveMedia());
        $this->assertTrue($message->getHasMediaSpoiler());
        $this->assertSame('Open', $message->getReplyMarkup()->getInlineKeyboard()[0][0]->getText());
    }

    public function testParsesVideoPollAndGame(): void {
        $video = Message::fromArray($this->loadFixture('message_with_video.json'));
        $this->assertSame(30, $video->getVideo()->getDuration());
        $this->assertSame('Clip', $video->getCaption());

        $poll = Message::fromArray($this->loadFixture('message_with_poll.json'));
        $this->assertSame('Lunch?', $poll->getPoll()->getQuestion());

        $game = Message::fromArray($this->loadFixture('message_with_game.json'));
        $this->assertSame('My Game', $game->getGame()->getTitle());
        $this->assertSame(6, $game->getDice()->getValue());
    }

    public function testParsesLocationVenueAndContact(): void {
        $message = Message::fromArray($this->loadFixture('message_with_location.json'));

        $this->assertSame(53.9, $message->getLocation()->getLatitude());
        $this->assertSame('Office', $message->getVenue()->getTitle());
        $this->assertSame('John', $message->getContact()->getFirstName());
    }

    public function testParsesPassportWebAppAndRefundedPayment(): void {
        $passport = Message::fromArray($this->loadFixture('message_with_passport_webapp.json'));
        $this->assertSame('user@example.com', $passport->getPassportData()->getData()[0]->getEmail());
        $this->assertSame('Open', $passport->getWebAppData()->getButtonText());
        $this->assertSame('MyApp', $passport->getWriteAccessAllowed()->getWebAppName());
        $this->assertSame('https://example.com', $passport->getConnectedWebsite());

        $refund = Message::fromArray($this->loadFixture('message_with_refunded_payment.json'));
        $this->assertSame('order-42', $refund->getRefundedPayment()->getInvoicePayload());
    }

    public function testParsesChatSharedAndBackground(): void {
        $shared = Message::fromArray($this->loadFixture('message_with_chat_shared.json'));
        $this->assertSame('Shared Group', $shared->getChatShared()->getTitle());

        $background = Message::fromArray($this->loadFixture('message_with_background.json'));
        $this->assertSame('dark', $background->getChatBackgroundSet()->getType()->getThemeName());
    }

    public function testParsesGiveawayMessages(): void {
        $message = Message::fromArray($this->loadFixture('message_with_giveaway.json'));

        $this->assertSame(100, $message->getGiveawayCreated()->getPrizeStarCount());
        $this->assertSame(3, $message->getGiveaway()->getWinnerCount());
        $this->assertSame('Winner', $message->getGiveawayWinners()->getWinners()[0]->getFirstName());
        $this->assertTrue($message->getGiveawayCompleted()->getIsStarGiveaway());
    }

    public function testParsesVideoChatEvents(): void {
        $message = Message::fromArray($this->loadFixture('message_with_video_chat.json'));

        $this->assertSame(1681221530, $message->getVideoChatScheduled()->getStartDate());
        $this->assertNotNull($message->getVideoChatStarted());
        $this->assertSame(300, $message->getVideoChatEnded()->getDuration());
        $this->assertSame('Alice', $message->getVideoChatParticipantsInvited()->getUsers()[0]->getFirstName());
    }

    public function testParsesForumLifecycleEvents(): void {
        $message = Message::fromArray($this->loadFixture('message_with_forum_events.json'));

        $this->assertNotNull($message->getForumTopicClosed());
        $this->assertNotNull($message->getForumTopicReopened());
        $this->assertNotNull($message->getGeneralForumTopicHidden());
        $this->assertNotNull($message->getGeneralForumTopicUnhidden());
    }

    public function testParsesChannelMetadata(): void {
        $message = Message::fromArray($this->loadFixture('message_with_channel_metadata.json'));

        $this->assertSame('News', $message->getSenderChat()->getTitle());
        $this->assertTrue($message->getIsAutomaticForward());
        $this->assertSame('Editor', $message->getAuthorSignature());
        $this->assertSame('forward_bot', $message->getViaBot()->getUsername());
        $this->assertSame('bc-1', $message->getBusinessConnectionId());
        $this->assertSame(2, $message->getSenderBoostCount());
        $this->assertSame('biz_bot', $message->getSenderBusinessBot()->getUsername());
    }

    public function testParsesAudioBundle(): void {
        $message = Message::fromArray($this->loadFixture('message_with_audio_bundle.json'));

        $this->assertSame('Track', $message->getAudio()->getTitle());
        $this->assertSame(5, $message->getVoice()->getDuration());
        $this->assertSame('readme.pdf', $message->getDocument()->getFileName());
        $this->assertSame(3, $message->getAnimation()->getDuration());
        $this->assertSame(10, $message->getVideoNote()->getDuration());
        $this->assertSame('regular', $message->getSticker()->getType());
    }

    public function testParsesLivePhotoStoryAndGuestBot(): void {
        $live = Message::fromArray($this->loadFixture('message_with_live_photo.json'));
        $this->assertSame('live-1', $live->getLivePhoto()->getFileId());

        $story = Message::fromArray($this->loadFixture('message_with_story.json'));
        $this->assertSame(99, $story->getStory()->getId());

        $guest = Message::fromArray($this->loadFixture('message_with_guest_bot.json'));
        $this->assertSame('gq-42', $guest->getGuestQueryId());
        $this->assertSame('Guest', $guest->getGuestBotCallerUser()->getFirstName());
        $this->assertSame('Guest Chat', $guest->getGuestBotCallerChat()->getTitle());
    }

    public function testPhotoCaptionRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_photo_caption.json'));
    }

    public function testVideoMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_video.json'));
    }

    public function testPollMessageRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_poll.json'));
    }

    public function testChannelMetadataRoundTrip(): void {
        $this->assertRoundTrip(Message::class, $this->loadFixture('message_with_channel_metadata.json'));
    }

}
