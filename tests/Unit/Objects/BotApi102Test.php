<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use InvalidArgumentException;
use Yabx\Telegram\Objects\BotCommand;
use Yabx\Telegram\Objects\BotSubscriptionUpdated;
use Yabx\Telegram\Objects\ChatFullInfo;
use Yabx\Telegram\Objects\Community;
use Yabx\Telegram\Objects\CommunityChatAdded;
use Yabx\Telegram\Objects\CommunityChatRemoved;
use Yabx\Telegram\Objects\InputMediaPhoto;
use Yabx\Telegram\Objects\InputMediaVoiceNote;
use Yabx\Telegram\Objects\InputRichBlock;
use Yabx\Telegram\Objects\InputRichBlockList;
use Yabx\Telegram\Objects\InputRichBlockListItem;
use Yabx\Telegram\Objects\InputRichBlockParagraph;
use Yabx\Telegram\Objects\InputRichBlockPhoto;
use Yabx\Telegram\Objects\InputRichMessage;
use Yabx\Telegram\Objects\InputRichMessageMedia;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\ReplyParameters;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Objects\User;
use Yabx\Telegram\Tests\TestCase;

final class BotApi102Test extends TestCase {

    public function testInputRichMessageWithBlocksAndMedia(): void {
        $input = InputRichMessage::fromArray([
            'blocks' => [
                ['type' => 'paragraph', 'text' => 'Hello'],
                [
                    'type' => 'list',
                    'items' => [
                        ['blocks' => [['type' => 'paragraph', 'text' => 'Item']], 'has_checkbox' => true],
                    ],
                ],
            ],
            'media' => [
                [
                    'id' => 'photo1',
                    'media' => ['type' => 'photo', 'media' => 'AgACAg'],
                ],
            ],
            'is_rtl' => false,
        ]);

        $this->assertCount(2, $input->getBlocks());
        $this->assertInstanceOf(InputRichBlockParagraph::class, $input->getBlocks()[0]);
        $this->assertInstanceOf(InputRichBlockList::class, $input->getBlocks()[1]);
        $this->assertInstanceOf(InputRichBlockListItem::class, $input->getBlocks()[1]->getItems()[0]);
        $this->assertTrue($input->getBlocks()[1]->getItems()[0]->getHasCheckbox());
        $this->assertInstanceOf(InputRichMessageMedia::class, $input->getMedia()[0]);
        $this->assertSame('photo1', $input->getMedia()[0]->getId());
        $this->assertInstanceOf(InputMediaPhoto::class, $input->getMedia()[0]->getMedia());
        $this->assertFalse($input->getIsRtl());
    }

    public function testInputRichBlockPhotoAndVoiceNote(): void {
        $block = InputRichBlock::fromArray([
            'type' => 'photo',
            'photo' => ['type' => 'photo', 'media' => 'file-id'],
        ]);
        $this->assertInstanceOf(InputRichBlockPhoto::class, $block);
        $this->assertSame('file-id', $block->getPhoto()->getMedia());

        $voice = InputMediaVoiceNote::fromArray([
            'type' => 'voice_note',
            'media' => 'voice-id',
            'duration' => 12,
        ]);
        $this->assertSame('voice_note', $voice->getType());
        $this->assertSame(12, $voice->getDuration());
    }

    public function testInputRichBlockThrowsOnInvalidType(): void {
        $this->expectException(InvalidArgumentException::class);
        InputRichBlock::fromArray(['type' => 'unknown']);
    }

    public function testEphemeralMessageFields(): void {
        $message = Message::fromArray([
            'message_id' => 0,
            'ephemeral_message_id' => 42,
            'date' => 1710000000,
            'chat' => ['id' => -100, 'type' => 'supergroup'],
            'receiver_user' => [
                'id' => 7,
                'is_bot' => false,
                'first_name' => 'Alice',
            ],
            'text' => 'secret',
        ]);

        $this->assertSame(0, $message->getMessageId());
        $this->assertSame(42, $message->getEphemeralMessageId());
        $this->assertInstanceOf(User::class, $message->getReceiverUser());
        $this->assertSame(7, $message->getReceiverUser()->getId());
    }

    public function testCommunityServiceMessages(): void {
        $added = Message::fromArray([
            'message_id' => 1,
            'date' => 1710000000,
            'chat' => ['id' => -100, 'type' => 'supergroup'],
            'community_chat_added' => [
                'community' => ['id' => 55, 'name' => 'Devs'],
            ],
        ]);
        $this->assertInstanceOf(CommunityChatAdded::class, $added->getCommunityChatAdded());
        $this->assertSame('Devs', $added->getCommunityChatAdded()->getCommunity()->getName());

        $removed = Message::fromArray([
            'message_id' => 2,
            'date' => 1710000000,
            'chat' => ['id' => -100, 'type' => 'supergroup'],
            'community_chat_removed' => [],
        ]);
        $this->assertInstanceOf(CommunityChatRemoved::class, $removed->getCommunityChatRemoved());
    }

    public function testChatFullInfoCommunity(): void {
        $chat = ChatFullInfo::fromArray([
            'id' => -100,
            'type' => 'supergroup',
            'title' => 'Group',
            'community' => ['id' => 9, 'name' => 'Community'],
        ]);
        $this->assertInstanceOf(Community::class, $chat->getCommunity());
        $this->assertSame(9, $chat->getCommunity()->getId());
    }

    public function testBotCommandIsEphemeral(): void {
        $command = BotCommand::fromArray([
            'command' => 'help',
            'description' => 'Help',
            'is_ephemeral' => true,
        ]);
        $this->assertTrue($command->getIsEphemeral());
        $this->assertSame([
            'command' => 'help',
            'description' => 'Help',
            'is_ephemeral' => true,
        ], $command->toArray());
    }

    public function testReplyParametersEphemeralMessageId(): void {
        $params = ReplyParameters::fromArray([
            'ephemeral_message_id' => 99,
        ]);
        $this->assertNull($params->getMessageId());
        $this->assertSame(99, $params->getEphemeralMessageId());
    }

    public function testUpdateSubscription(): void {
        $update = Update::fromArray([
            'update_id' => 1,
            'subscription' => [
                'user' => ['id' => 1, 'is_bot' => false, 'first_name' => 'Bob'],
                'invoice_payload' => 'plan-pro',
                'state' => 'active',
            ],
        ]);
        $this->assertInstanceOf(BotSubscriptionUpdated::class, $update->getSubscription());
        $this->assertSame('active', $update->getSubscription()->getState());
        $this->assertSame('plan-pro', $update->getSubscription()->getInvoicePayload());
    }
}
