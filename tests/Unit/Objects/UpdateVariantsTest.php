<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Tests\TestCase;

final class UpdateVariantsTest extends TestCase {

    public function testParsesCallbackQueryUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_callback_query.json'));

        $this->assertSame(94181762, $update->getUpdateId());
        $this->assertSame('cq-1', $update->getCallbackQuery()->getId());
        $this->assertSame('yes', $update->getCallbackQuery()->getData());
    }

    public function testParsesInlineQueryUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_inline_query.json'));

        $this->assertSame('iq-1', $update->getInlineQuery()->getId());
        $this->assertSame('telegram', $update->getInlineQuery()->getQuery());
    }

    public function testParsesPollAnswerUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_poll_answer.json'));

        $this->assertSame('poll-1', $update->getPollAnswer()->getPollId());
        $this->assertSame([0], $update->getPollAnswer()->getOptionIds());
    }

    public function testParsesMyChatMemberUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_my_chat_member.json'));

        $this->assertSame('member', $update->getMyChatMember()->getNewChatMember()->getStatus());
        $this->assertSame('left', $update->getMyChatMember()->getOldChatMember()->getStatus());
    }

    public function testCallbackQueryUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_callback_query.json'));
    }

    public function testInlineQueryUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_inline_query.json'));
    }

    public function testParsesShippingQueryUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_shipping_query.json'));

        $this->assertSame('sq-1', $update->getShippingQuery()->getId());
        $this->assertSame('order-42', $update->getShippingQuery()->getInvoicePayload());
        $this->assertSame('US', $update->getShippingQuery()->getShippingAddress()->getCountryCode());
    }

    public function testParsesPreCheckoutQueryUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_pre_checkout_query.json'));

        $this->assertSame('pcq-1', $update->getPreCheckoutQuery()->getId());
        $this->assertSame('USD', $update->getPreCheckoutQuery()->getCurrency());
        $this->assertSame(1500, $update->getPreCheckoutQuery()->getTotalAmount());
    }

    public function testParsesChatBoostUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_chat_boost.json'));

        $this->assertSame('boost-1', $update->getChatBoost()->getBoost()->getBoostId());
        $this->assertSame('Boosted Group', $update->getChatBoost()->getChat()->getTitle());
    }

    public function testParsesEditedMessageUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_edited_message.json'));

        $this->assertSame('Edited text', $update->getEditedMessage()->getText());
        $this->assertSame(1681135200, $update->getEditedMessage()->getEditDate());
    }

    public function testShippingQueryUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_shipping_query.json'));
    }

    public function testPreCheckoutQueryUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_pre_checkout_query.json'));
    }

    public function testChatBoostUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_chat_boost.json'));
    }

    public function testEditedMessageUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_edited_message.json'));
    }

    public function testParsesChannelPostUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_channel_post.json'));

        $this->assertSame('Breaking news', $update->getChannelPost()->getText());
        $this->assertSame('channel', $update->getChannelPost()->getChat()->getType());
    }

    public function testParsesChosenInlineResultUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_chosen_inline_result.json'));

        $this->assertSame('article-1', $update->getChosenInlineResult()->getResultId());
        $this->assertSame('telegram bot', $update->getChosenInlineResult()->getQuery());
    }

    public function testParsesPurchasedPaidMediaUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_purchased_paid_media.json'));

        $this->assertSame('premium-content-1', $update->getPurchasedPaidMedia()->getPaidMediaPayload());
    }

    public function testParsesChatJoinRequestUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_chat_join_request.json'));

        $this->assertSame('Would like to join', $update->getChatJoinRequest()->getBio());
        $this->assertSame('Private Group', $update->getChatJoinRequest()->getChat()->getTitle());
    }

    public function testParsesBusinessConnectionUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_business_connection.json'));

        $this->assertSame('bc-1', $update->getBusinessConnection()->getId());
        $this->assertTrue($update->getBusinessConnection()->getIsEnabled());
    }

    public function testParsesMessageReactionUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_message_reaction.json'));

        $this->assertSame(50, $update->getMessageReaction()->getMessageId());
        $this->assertSame('👍', $update->getMessageReaction()->getNewReaction()[0]->getEmoji());
    }

    public function testParsesRemovedChatBoostUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_removed_chat_boost.json'));

        $this->assertSame('boost-1', $update->getRemovedChatBoost()->getBoostId());
    }

    public function testChannelPostUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_channel_post.json'));
    }

    public function testChosenInlineResultUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_chosen_inline_result.json'));
    }

    public function testPurchasedPaidMediaUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_purchased_paid_media.json'));
    }

    public function testChatJoinRequestUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_chat_join_request.json'));
    }

    public function testBusinessConnectionUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_business_connection.json'));
    }

    public function testMessageReactionUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_message_reaction.json'));
    }

    public function testRemovedChatBoostUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_removed_chat_boost.json'));
    }

    public function testParsesPollUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_poll.json'));

        $this->assertTrue($update->getPoll()->getIsClosed());
        $this->assertSame('Favorite color?', $update->getPoll()->getQuestion());
    }

    public function testParsesChatMemberUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_chat_member.json'));

        $this->assertSame('restricted', $update->getChatMember()->getNewChatMember()->getStatus());
    }

    public function testParsesEditedChannelPostUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_edited_channel_post.json'));

        $this->assertSame('Updated headline', $update->getEditedChannelPost()->getText());
        $this->assertSame(1681135200, $update->getEditedChannelPost()->getEditDate());
    }

    public function testParsesBusinessMessageUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_business_message.json'));

        $this->assertSame('bc-1', $update->getBusinessMessage()->getBusinessConnectionId());
        $this->assertSame('Order status?', $update->getBusinessMessage()->getText());
    }

    public function testParsesGuestMessageUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_guest_message.json'));

        $this->assertSame('Hello from guest', $update->getGuestMessage()->getText());
        $this->assertSame('Guest', $update->getGuestMessage()->getFrom()->getFirstName());
    }

    public function testParsesMessageReactionCountUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_message_reaction_count.json'));

        $this->assertSame(12, $update->getMessageReactionCount()->getReactions()[0]->getTotalCount());
    }

    public function testParsesDeletedBusinessMessagesUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_deleted_business_messages.json'));

        $this->assertSame([198, 199], $update->getDeletedBusinessMessages()->getMessageIds());
    }

    public function testPollUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_poll.json'));
    }

    public function testChatMemberUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_chat_member.json'));
    }

    public function testEditedChannelPostUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_edited_channel_post.json'));
    }

    public function testBusinessMessageUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_business_message.json'));
    }

    public function testGuestMessageUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_guest_message.json'));
    }

    public function testMessageReactionCountUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_message_reaction_count.json'));
    }

    public function testDeletedBusinessMessagesUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_deleted_business_messages.json'));
    }

    public function testParsesEditedBusinessMessageUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_edited_business_message.json'));

        $this->assertSame('Updated order status', $update->getEditedBusinessMessage()->getText());
        $this->assertSame(1681135200, $update->getEditedBusinessMessage()->getEditDate());
    }

    public function testPhotoMessageUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_with_photo.json'));
    }

    public function testEditedBusinessMessageUpdateRoundTrip(): void {
        $this->assertRoundTrip(Update::class, $this->loadFixture('update_edited_business_message.json'));
    }

    public function testParsesPhotoMessageUpdate(): void {
        $update = Update::fromArray($this->loadFixture('update_with_photo.json'));

        $this->assertSame(94181761, $update->getUpdateId());
        $this->assertCount(4, $update->getMessage()->getPhoto());
        $this->assertSame(1280, $update->getMessage()->getPhoto()[3]->getWidth());
        $this->assertSame('aliaksandr_m', $update->getMessage()->getFrom()->getUsername());
    }

}
