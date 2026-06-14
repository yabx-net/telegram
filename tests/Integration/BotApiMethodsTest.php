<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Yabx\Telegram\BotApi;
use Yabx\Telegram\Enum\ChatAction;
use Yabx\Telegram\Objects\BotCommand;
use Yabx\Telegram\Objects\BotCommandScopeDefault;
use Yabx\Telegram\Objects\BotDescription;
use Yabx\Telegram\Objects\BotName;
use Yabx\Telegram\Objects\BotShortDescription;
use Yabx\Telegram\Objects\ChatInviteLink;
use Yabx\Telegram\Objects\ChatPermissions;
use Yabx\Telegram\Objects\ForumTopic;
use Yabx\Telegram\Objects\InputSticker;
use Yabx\Telegram\Objects\GameHighScore;
use Yabx\Telegram\Objects\InlineKeyboardButton;
use Yabx\Telegram\Objects\InlineKeyboardMarkup;
use Yabx\Telegram\Objects\InputMediaPhoto;
use Yabx\Telegram\Objects\InputPaidMediaPhoto;
use Yabx\Telegram\Objects\LinkPreviewOptions;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\MessageEntity;
use Yabx\Telegram\Objects\MessageId;
use Yabx\Telegram\Objects\MenuButtonCommands;
use Yabx\Telegram\Objects\Poll;
use Yabx\Telegram\Objects\ReactionTypeEmoji;
use Yabx\Telegram\Objects\ReplyParameters;
use Yabx\Telegram\Objects\Sticker;
use Yabx\Telegram\Objects\ShippingOption;
use Yabx\Telegram\Objects\UserProfilePhotos;
use Yabx\Telegram\Tests\Support\MocksBotApi;
use Yabx\Telegram\Tests\TestCase;

final class BotApiMethodsTest extends TestCase {

    use MocksBotApi;

    public function testEditMessageTextSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 7,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'text' => 'Updated',
            ])),
        ]);

        $message = $bot->editMessageText(
            text: 'Updated',
            chatId: 1,
            messageId: 7,
            parseMode: 'HTML',
            entities: [new MessageEntity(type: 'bold', offset: 0, length: 7)],
            linkPreviewOptions: new LinkPreviewOptions(isDisabled: true),
            replyMarkup: new InlineKeyboardMarkup(inlineKeyboard: []),
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame(7, $body['message_id']);
        $this->assertSame('Updated', $body['text']);
        $this->assertSame('HTML', $body['parse_mode']);
        $this->assertSame([['type' => 'bold', 'offset' => 0, 'length' => 7]], $body['entities']);
        $this->assertSame(['is_disabled' => true], $body['link_preview_options']);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testCopyMessageSerializesParametersAndReturnsMessageId(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(['message_id' => 99])),
        ]);

        $result = $bot->copyMessage(
            chatId: 1,
            fromChatId: -1001234567890,
            messageId: 10,
            messageThreadId: 42,
            caption: 'Copied',
            replyParameters: new ReplyParameters(messageId: 5),
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame(-1001234567890, $body['from_chat_id']);
        $this->assertSame(10, $body['message_id']);
        $this->assertSame(42, $body['message_thread_id']);
        $this->assertSame('Copied', $body['caption']);
        $this->assertSame(['message_id' => 5], $body['reply_parameters']);
        $this->assertInstanceOf(MessageId::class, $result);
        $this->assertSame(99, $result->getMessageId());
    }

    public function testForwardMessageSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 8,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'text' => 'Forwarded',
            ])),
        ]);

        $message = $bot->forwardMessage(
            chatId: 1,
            fromChatId: -1001234567890,
            messageId: 10,
            messageThreadId: 3,
            protectContent: true,
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame([
            'chat_id' => 1,
            'message_thread_id' => 3,
            'from_chat_id' => -1001234567890,
            'protect_content' => true,
            'message_id' => 10,
        ], $body);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testBanChatMemberSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->banChatMember(-1001234567890, 42, untilDate: 1681221530, revokeMessages: true));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'user_id' => 42,
            'until_date' => 1681221530,
            'revoke_messages' => true,
        ], $this->decodeLastRequest($mock));
    }

    public function testRestrictChatMemberSerializesPermissions(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->restrictChatMember(
            -1001234567890,
            42,
            new ChatPermissions(canSendMessages: false, canSendPhotos: true),
            useIndependentChatPermissions: true,
            untilDate: 1681221530,
        );

        $this->assertSame([
            'chat_id' => -1001234567890,
            'user_id' => 42,
            'permissions' => [
                'can_send_messages' => false,
                'can_send_photos' => true,
            ],
            'use_independent_chat_permissions' => true,
            'until_date' => 1681221530,
        ], $this->decodeLastRequest($mock));
    }

    public function testSetChatPermissionsSerializesPermissions(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->setChatPermissions(
            -1001234567890,
            new ChatPermissions(canSendMessages: true, canInviteUsers: true),
            useIndependentChatPermissions: false,
        );

        $this->assertSame([
            'chat_id' => -1001234567890,
            'permissions' => [
                'can_send_messages' => true,
                'can_invite_users' => true,
            ],
            'use_independent_chat_permissions' => false,
        ], $this->decodeLastRequest($mock));
    }

    public function testDeleteMessageSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->deleteMessage(-1001234567890, 15));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_id' => 15,
        ], $this->decodeLastRequest($mock));
    }

    public function testGetUserProfilePhotosParsesResult(): void {
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse([
                'total_count' => 2,
                'photos' => [[
                    'file_id' => 'AgACAgIAAxkBAAI',
                    'file_unique_id' => 'AQADAAI',
                    'width' => 160,
                    'height' => 160,
                ]],
            ])),
        ]);

        $photos = $bot->getUserProfilePhotos(1, offset: 0, limit: 1);

        $this->assertInstanceOf(UserProfilePhotos::class, $photos);
        $this->assertSame(2, $photos->getTotalCount());
        $this->assertCount(1, $photos->getPhotos());
    }

    public function testRequestUsesCorrectEndpoint(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->request('deleteWebhook');

        $request = $mock->getLastRequest();
        $this->assertNotNull($request);
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('http://test/bottest-token/deleteWebhook', (string) $request->getUri());
    }

    public function testEditMessageCaptionSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 7,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'caption' => 'New caption',
            ])),
        ]);

        $message = $bot->editMessageCaption(
            chatId: 1,
            messageId: 7,
            caption: 'New caption',
            parseMode: 'HTML',
            captionEntities: [new MessageEntity(type: 'bold', offset: 0, length: 3)],
            showCaptionAboveMedia: true,
            replyMarkup: new InlineKeyboardMarkup(inlineKeyboard: []),
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame(7, $body['message_id']);
        $this->assertSame('New caption', $body['caption']);
        $this->assertSame('HTML', $body['parse_mode']);
        $this->assertSame([['type' => 'bold', 'offset' => 0, 'length' => 3]], $body['caption_entities']);
        $this->assertTrue($body['show_caption_above_media']);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testEditMessageReplyMarkupSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 7,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'text' => 'Hello',
            ])),
        ]);

        $bot->editMessageReplyMarkup(
            chatId: 1,
            messageId: 7,
            replyMarkup: new InlineKeyboardMarkup(inlineKeyboard: [
                [new InlineKeyboardButton(text: 'OK', callbackData: 'ok')],
            ]),
        );

        $this->assertSame([
            'chat_id' => 1,
            'message_id' => 7,
            'reply_markup' => [
                'inline_keyboard' => [[['text' => 'OK', 'callback_data' => 'ok']]],
            ],
        ], $this->decodeLastRequest($mock));
    }

    public function testEditMessageMediaSerializesInputMedia(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 7,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'photo' => [[
                    'file_id' => 'AgACAgIAAxkBAAI',
                    'file_unique_id' => 'AQADAAI',
                    'width' => 320,
                    'height' => 240,
                ]],
            ])),
        ]);

        $bot->editMessageMedia(
            new InputMediaPhoto(media: 'file_id_abc', caption: 'Updated photo'),
            chatId: 1,
            messageId: 7,
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame(7, $body['message_id']);
        $this->assertSame([
            'type' => 'photo',
            'media' => 'file_id_abc',
            'caption' => 'Updated photo',
        ], $body['media']);
    }

    public function testSendPhotoSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 8,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->sendPhoto(
            chatId: 1,
            photo: 'file_id_photo',
            caption: 'Photo',
            hasSpoiler: true,
            replyParameters: new ReplyParameters(messageId: 3),
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame('file_id_photo', $body['photo']);
        $this->assertSame('Photo', $body['caption']);
        $this->assertTrue($body['has_spoiler']);
        $this->assertSame(['message_id' => 3], $body['reply_parameters']);
    }

    public function testPromoteChatMemberSerializesRights(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->promoteChatMember(
            -1001234567890,
            42,
            canManageChat: true,
            canDeleteMessages: true,
            canManageTopics: true,
            isAnonymous: false,
        );

        $this->assertSame([
            'chat_id' => -1001234567890,
            'user_id' => 42,
            'is_anonymous' => false,
            'can_manage_chat' => true,
            'can_delete_messages' => true,
            'can_manage_topics' => true,
        ], $this->decodeLastRequest($mock));
    }

    public function testExportChatInviteLinkReturnsString(): void {
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse('https://t.me/+invite')),
        ]);

        $this->assertSame('https://t.me/+invite', $bot->exportChatInviteLink(-1001234567890));
    }

    public function testStopPollSerializesParametersAndParsesPoll(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'id' => 'poll-1',
                'question' => 'Done?',
                'options' => [
                    ['text' => 'Yes', 'voter_count' => 1],
                    ['text' => 'No', 'voter_count' => 0],
                ],
                'total_voter_count' => 1,
                'is_closed' => true,
                'is_anonymous' => true,
                'type' => 'regular',
                'allows_multiple_answers' => false,
            ])),
        ]);

        $poll = $bot->stopPoll(-1001234567890, 15);

        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_id' => 15,
        ], $this->decodeLastRequest($mock));
        $this->assertInstanceOf(Poll::class, $poll);
        $this->assertTrue($poll->getIsClosed());
    }

    public function testSendDocumentSerializesFileId(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 9,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'document' => [
                    'file_id' => 'doc-1',
                    'file_unique_id' => 'doc-u',
                    'file_name' => 'readme.pdf',
                ],
            ])),
        ]);

        $message = $bot->sendDocument(
            chatId: 1,
            document: 'file_id_doc',
            caption: 'PDF',
            disableContentTypeDetection: true,
            protectContent: true,
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame('file_id_doc', $body['document']);
        $this->assertSame('PDF', $body['caption']);
        $this->assertTrue($body['disable_content_type_detection']);
        $this->assertTrue($body['protect_content']);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendDocumentUsesMultipartForLocalFile(): void {
        $tmp = tempnam(sys_get_temp_dir(), 'doc');
        $this->assertNotFalse($tmp);
        file_put_contents($tmp, 'fake-pdf');

        try {
            [$bot, $mock] = $this->createBotWithMock([
                new Response(200, [], $this->apiResponse([
                    'message_id' => 9,
                    'date' => 1681135130,
                    'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                ])),
            ]);

            $bot->sendDocument(chatId: 1, document: $tmp, caption: 'Upload');

            $request = $mock->getLastRequest();
            $this->assertNotNull($request);
            $this->assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
        } finally {
            @unlink($tmp);
        }
    }

    public function testSendVideoSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 10,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'video' => [
                    'file_id' => 'vid-1',
                    'file_unique_id' => 'vid-u',
                    'width' => 1280,
                    'height' => 720,
                    'duration' => 30,
                ],
            ])),
        ]);

        $message = $bot->sendVideo(
            chatId: 1,
            video: 'file_id_video',
            caption: 'Clip',
            width: 1280,
            height: 720,
            duration: 30,
            supportsStreaming: true,
            hasSpoiler: true,
            messageThreadId: 5,
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame([
            'chat_id' => 1,
            'message_thread_id' => 5,
            'video' => 'file_id_video',
            'duration' => 30,
            'width' => 1280,
            'height' => 720,
            'caption' => 'Clip',
            'has_spoiler' => true,
            'supports_streaming' => true,
        ], $body);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testEditMessageMediaUsesMultipartForLocalFilePath(): void {
        $tmp = tempnam(sys_get_temp_dir(), 'photo');
        $this->assertNotFalse($tmp);
        file_put_contents($tmp, 'fake-image');

        try {
            [$bot, $mock] = $this->createBotWithMock([
                new Response(200, [], $this->apiResponse([
                    'message_id' => 7,
                    'date' => 1681135130,
                    'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                ])),
            ]);

            $bot->editMessageMedia($tmp, chatId: 1, messageId: 7);

            $request = $mock->getLastRequest();
            $this->assertNotNull($request);
            $this->assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
        } finally {
            @unlink($tmp);
        }
    }

    public function testSendAudioSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 11,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'audio' => [
                    'file_id' => 'aud-1',
                    'file_unique_id' => 'aud-u',
                    'duration' => 180,
                    'performer' => 'Artist',
                    'title' => 'Track',
                ],
            ])),
        ]);

        $message = $bot->sendAudio(
            chatId: 1,
            audio: 'file_id_audio',
            caption: 'Listen',
            duration: 180,
            performer: 'Artist',
            title: 'Track',
            messageThreadId: 2,
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame([
            'chat_id' => 1,
            'message_thread_id' => 2,
            'audio' => 'file_id_audio',
            'caption' => 'Listen',
            'duration' => 180,
            'performer' => 'Artist',
            'title' => 'Track',
        ], $body);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendVoiceSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 12,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->sendVoice(
            chatId: 1,
            voice: 'file_id_voice',
            caption: 'Note',
            duration: 5,
            protectContent: true,
        );

        $this->assertSame([
            'chat_id' => 1,
            'voice' => 'file_id_voice',
            'caption' => 'Note',
            'duration' => 5,
            'protect_content' => true,
        ], $this->decodeLastRequest($mock));
    }

    public function testSendVoiceUsesMultipartForLocalFile(): void {
        $tmp = tempnam(sys_get_temp_dir(), 'voice');
        $this->assertNotFalse($tmp);
        file_put_contents($tmp, 'fake-ogg');

        try {
            [$bot, $mock] = $this->createBotWithMock([
                new Response(200, [], $this->apiResponse([
                    'message_id' => 12,
                    'date' => 1681135130,
                    'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                ])),
            ]);

            $bot->sendVoice(chatId: 1, voice: $tmp);

            $request = $mock->getLastRequest();
            $this->assertNotNull($request);
            $this->assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
        } finally {
            @unlink($tmp);
        }
    }

    public function testSendAnimationSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 13,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->sendAnimation(
            chatId: 1,
            animation: 'file_id_gif',
            caption: 'GIF',
            width: 480,
            height: 270,
            duration: 3,
            hasSpoiler: true,
        );

        $this->assertSame([
            'chat_id' => 1,
            'animation' => 'file_id_gif',
            'duration' => 3,
            'width' => 480,
            'height' => 270,
            'caption' => 'GIF',
            'has_spoiler' => true,
        ], $this->decodeLastRequest($mock));
    }

    public function testAnswerPreCheckoutQuerySerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->answerPreCheckoutQuery('pcq-1', ok: false, errorMessage: 'Out of stock'));

        $this->assertSame([
            'pre_checkout_query_id' => 'pcq-1',
            'ok' => false,
            'error_message' => 'Out of stock',
        ], $this->decodeLastRequest($mock));
    }

    public function testSendLocationSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 14,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'location' => ['latitude' => 53.9, 'longitude' => 27.56],
            ])),
        ]);

        $message = $bot->sendLocation(
            chatId: 1,
            latitude: 53.9,
            longitude: 27.56,
            livePeriod: 3600,
            heading: 90,
            proximityAlertRadius: 100,
        );

        $this->assertSame([
            'chat_id' => 1,
            'latitude' => 53.9,
            'longitude' => 27.56,
            'live_period' => 3600,
            'heading' => 90,
            'proximity_alert_radius' => 100,
        ], $this->decodeLastRequest($mock));
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendVenueSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 15,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->sendVenue(
            chatId: 1,
            latitude: 53.9,
            longitude: 27.56,
            title: 'Office',
            address: '123 Main St',
            googlePlaceId: 'place-1',
        );

        $this->assertSame([
            'chat_id' => 1,
            'latitude' => 53.9,
            'longitude' => 27.56,
            'title' => 'Office',
            'address' => '123 Main St',
            'google_place_id' => 'place-1',
        ], $this->decodeLastRequest($mock));
    }

    public function testSendContactSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 16,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->sendContact(
            chatId: 1,
            phoneNumber: '+10000000000',
            firstName: 'John',
            lastName: 'Doe',
            vcard: 'BEGIN:VCARD',
        );

        $this->assertSame([
            'chat_id' => 1,
            'phone_number' => '+10000000000',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'vcard' => 'BEGIN:VCARD',
        ], $this->decodeLastRequest($mock));
    }

    public function testSendVideoNoteSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 17,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->sendVideoNote(
            chatId: 1,
            videoNote: 'file_id_note',
            duration: 10,
            length: 240,
        );

        $this->assertSame([
            'chat_id' => 1,
            'video_note' => 'file_id_note',
            'duration' => 10,
            'length' => 240,
        ], $this->decodeLastRequest($mock));
    }

    public function testSendVideoNoteUsesMultipartForLocalFile(): void {
        $tmp = tempnam(sys_get_temp_dir(), 'note');
        $this->assertNotFalse($tmp);
        file_put_contents($tmp, 'fake-mp4');

        try {
            [$bot, $mock] = $this->createBotWithMock([
                new Response(200, [], $this->apiResponse([
                    'message_id' => 17,
                    'date' => 1681135130,
                    'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                ])),
            ]);

            $bot->sendVideoNote(chatId: 1, videoNote: $tmp);

            $request = $mock->getLastRequest();
            $this->assertNotNull($request);
            $this->assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
        } finally {
            @unlink($tmp);
        }
    }

    public function testForwardMessagesSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                ['message_id' => 20],
                ['message_id' => 21],
            ])),
        ]);

        $ids = $bot->forwardMessages(
            chatId: 1,
            fromChatId: -1001234567890,
            messageIds: [10, 11],
            protectContent: true,
        );

        $this->assertSame([
            'chat_id' => 1,
            'from_chat_id' => -1001234567890,
            'message_ids' => [10, 11],
            'protect_content' => true,
        ], $this->decodeLastRequest($mock));
        $this->assertCount(2, $ids);
        $this->assertInstanceOf(MessageId::class, $ids[0]);
        $this->assertSame(20, $ids[0]->getMessageId());
    }

    public function testUnbanChatMemberSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->unbanChatMember(-1001234567890, 42, onlyIfBanned: true));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'user_id' => 42,
            'only_if_banned' => true,
        ], $this->decodeLastRequest($mock));
    }

    public function testSendPaidMediaSerializesInputMedia(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 18,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'paid_media' => ['star_count' => 5],
            ])),
        ]);

        $message = $bot->sendPaidMedia(
            chatId: 1,
            starCount: 5,
            media: [new InputPaidMediaPhoto(media: 'file_id_photo')],
            caption: 'Paid content',
            payload: 'order-1',
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame(5, $body['star_count']);
        $this->assertSame('Paid content', $body['caption']);
        $this->assertSame('order-1', $body['payload']);
        $this->assertSame([
            ['type' => 'photo', 'media' => 'file_id_photo'],
        ], $body['media']);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testDeleteMessagesSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->deleteMessages(-1001234567890, [10, 11, 12]));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_ids' => [10, 11, 12],
        ], $this->decodeLastRequest($mock));
    }

    public function testCopyMessagesSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                ['message_id' => 30],
                ['message_id' => 31],
            ])),
        ]);

        $ids = $bot->copyMessages(
            chatId: 1,
            fromChatId: -1001234567890,
            messageIds: [20, 21],
            removeCaption: true,
        );

        $this->assertSame([
            'chat_id' => 1,
            'from_chat_id' => -1001234567890,
            'message_ids' => [20, 21],
            'remove_caption' => true,
        ], $this->decodeLastRequest($mock));
        $this->assertCount(2, $ids);
        $this->assertSame(30, $ids[0]->getMessageId());
    }

    public function testSendDiceSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 19,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'dice' => ['emoji' => '🎲', 'value' => 4],
            ])),
        ]);

        $message = $bot->sendDice(chatId: 1, emoji: '🎯', messageThreadId: 3);

        $this->assertSame([
            'chat_id' => 1,
            'message_thread_id' => 3,
            'emoji' => '🎯',
        ], $this->decodeLastRequest($mock));
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testSendStickerSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 20,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->sendSticker(chatId: 1, sticker: 'file_id_sticker', emoji: '👍');

        $this->assertSame([
            'chat_id' => 1,
            'sticker' => 'file_id_sticker',
            'emoji' => '👍',
        ], $this->decodeLastRequest($mock));
    }

    public function testAnswerShippingQuerySerializesShippingOptions(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->answerShippingQuery(
            'sq-1',
            ok: true,
            shippingOptions: [
                new ShippingOption(
                    id: 'standard',
                    title: 'Standard',
                    prices: [['label' => 'Shipping', 'amount' => 500]],
                ),
            ],
        );

        $this->assertSame([
            'shipping_query_id' => 'sq-1',
            'ok' => true,
            'shipping_options' => [[
                'id' => 'standard',
                'title' => 'Standard',
                'prices' => [['label' => 'Shipping', 'amount' => 500]],
            ]],
        ], $this->decodeLastRequest($mock));
    }

    public function testSendChatActionSerializesEnum(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->sendChatAction(1, ChatAction::Typing, messageThreadId: 4));

        $this->assertSame([
            'chat_id' => 1,
            'message_thread_id' => 4,
            'action' => 'typing',
        ], $this->decodeLastRequest($mock));
    }

    public function testSetMessageReactionSerializesReactionTypes(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->setMessageReaction(
            -1001234567890,
            15,
            reaction: [new ReactionTypeEmoji(emoji: '👍'), new ReactionTypeEmoji(emoji: '🔥')],
            isBig: true,
        );

        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_id' => 15,
            'reaction' => [
                ['type' => 'emoji', 'emoji' => '👍'],
                ['type' => 'emoji', 'emoji' => '🔥'],
            ],
            'is_big' => true,
        ], $this->decodeLastRequest($mock));
    }

    public function testApproveChatJoinRequestSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->approveChatJoinRequest(-1001234567890, 42));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'user_id' => 42,
        ], $this->decodeLastRequest($mock));
    }

    public function testDeclineChatJoinRequestSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->declineChatJoinRequest(-1001234567890, 42));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'user_id' => 42,
        ], $this->decodeLastRequest($mock));
    }

    public function testEditMessageLiveLocationSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 21,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'location' => ['latitude' => 53.91, 'longitude' => 27.57],
            ])),
        ]);

        $message = $bot->editMessageLiveLocation(
            latitude: 53.91,
            longitude: 27.57,
            chatId: 1,
            messageId: 21,
            livePeriod: 3600,
            heading: 180,
        );

        $this->assertSame([
            'chat_id' => 1,
            'message_id' => 21,
            'latitude' => 53.91,
            'longitude' => 27.57,
            'live_period' => 3600,
            'heading' => 180,
        ], $this->decodeLastRequest($mock));
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testStopMessageLiveLocationSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 21,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->stopMessageLiveLocation(chatId: 1, messageId: 21);

        $this->assertSame([
            'chat_id' => 1,
            'message_id' => 21,
        ], $this->decodeLastRequest($mock));
    }

    public function testGetCustomEmojiStickersParsesStickers(): void {
        $fixture = $this->loadFixture('api_responses/custom_emoji_stickers.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $stickers = $bot->getCustomEmojiStickers(['123456789']);

        $this->assertCount(1, $stickers);
        $this->assertInstanceOf(Sticker::class, $stickers[0]);
        $this->assertSame('custom_emoji', $stickers[0]->getType());
        $this->assertSame('123456789', $stickers[0]->getCustomEmojiId());
    }

    public function testSetChatMenuButtonSerializesMenuButton(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->setChatMenuButton(chatId: 1, menuButton: new MenuButtonCommands()));

        $this->assertSame([
            'chat_id' => 1,
            'menu_button' => ['type' => 'commands'],
        ], $this->decodeLastRequest($mock));
    }

    public function testGetChatMenuButtonParsesMenuButton(): void {
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse(['type' => 'commands'])),
        ]);

        $button = $bot->getChatMenuButton(1);

        $this->assertInstanceOf(MenuButtonCommands::class, $button);
    }

    public function testSendLivePhotoSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 22,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            ])),
        ]);

        $bot->sendLivePhoto(
            chatId: 1,
            livePhoto: 'file_id_live',
            photo: 'file_id_photo',
            caption: 'Live moment',
            hasSpoiler: true,
        );

        $this->assertSame([
            'chat_id' => 1,
            'live_photo' => 'file_id_live',
            'photo' => 'file_id_photo',
            'caption' => 'Live moment',
            'has_spoiler' => true,
        ], $this->decodeLastRequest($mock));
    }

    public function testDeleteMessageReactionSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->deleteMessageReaction(-1001234567890, 15, userId: 42));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_id' => 15,
            'user_id' => 42,
        ], $this->decodeLastRequest($mock));
    }

    public function testCreateForumTopicSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_thread_id' => 42,
                'name' => 'Support',
                'icon_color' => 7322096,
            ])),
        ]);

        $topic = $bot->createForumTopic(-1001234567890, 'Support', iconColor: 7322096);

        $this->assertSame([
            'chat_id' => -1001234567890,
            'name' => 'Support',
            'icon_color' => 7322096,
        ], $this->decodeLastRequest($mock));
        $this->assertInstanceOf(ForumTopic::class, $topic);
        $this->assertSame('Support', $topic->getName());
    }

    public function testEditChatInviteLinkSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'invite_link' => 'https://t.me/+AbCdEf',
                'creator' => ['id' => 1, 'is_bot' => true, 'first_name' => 'Bot'],
                'creates_join_request' => false,
                'is_primary' => false,
                'is_revoked' => false,
                'name' => 'VIP',
            ])),
        ]);

        $link = $bot->editChatInviteLink(
            -1001234567890,
            'https://t.me/+AbCdEf',
            name: 'VIP',
            memberLimit: 50,
        );

        $this->assertSame([
            'chat_id' => -1001234567890,
            'invite_link' => 'https://t.me/+AbCdEf',
            'name' => 'VIP',
            'member_limit' => 50,
        ], $this->decodeLastRequest($mock));
        $this->assertSame('VIP', $link->getName());
    }

    public function testSendGameSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 23,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'game' => ['title' => 'My Game', 'description' => 'Fun', 'photo' => []],
            ])),
        ]);

        $message = $bot->sendGame(chatId: 1, gameShortName: 'my_game', protectContent: true);

        $body = $this->decodeLastRequest($mock);
        $this->assertSame([
            'chat_id' => 1,
            'game_short_name' => 'my_game',
            'protect_content' => true,
        ], $body);
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testGetGameHighScoresParsesScores(): void {
        $fixture = $this->loadFixture('api_responses/game_high_scores.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $scores = $bot->getGameHighScores(1, chatId: 1, messageId: 23);

        $this->assertCount(1, $scores);
        $this->assertInstanceOf(GameHighScore::class, $scores[0]);
        $this->assertSame(9000, $scores[0]->getScore());
        $this->assertSame('Player', $scores[0]->getUser()->getFirstName());
    }

    public function testDeleteWebhookSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->deleteWebhook(dropPendingUpdates: true));

        $this->assertSame(['drop_pending_updates' => true], $this->decodeLastRequest($mock));
    }

    public function testLogOutAndCloseCallApi(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->logOut());
        $this->assertSame('http://test/bottest-token/logOut', (string) $mock->getLastRequest()->getUri());

        $this->assertTrue($bot->close());
        $this->assertSame('http://test/bottest-token/close', (string) $mock->getLastRequest()->getUri());
    }

    public function testSetChatAdministratorCustomTitleSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->setChatAdministratorCustomTitle(-1001234567890, 42, 'Moderator'));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'user_id' => 42,
            'custom_title' => 'Moderator',
        ], $this->decodeLastRequest($mock));
    }

    public function testRevokeChatInviteLinkParsesResponse(): void {
        $fixture = $this->loadFixture('api_responses/create_chat_invite_link.json');
        $fixture['is_revoked'] = true;
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $link = $bot->revokeChatInviteLink(-1001234567890, 'https://t.me/+AbCdEf');

        $this->assertSame([
            'chat_id' => -1001234567890,
            'invite_link' => 'https://t.me/+AbCdEf',
        ], $this->decodeLastRequest($mock));
        $this->assertInstanceOf(ChatInviteLink::class, $link);
        $this->assertTrue($link->getIsRevoked());
    }

    public function testSetChatTitleAndDescriptionSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->setChatTitle(-1001234567890, 'New title'));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'title' => 'New title',
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->setChatDescription(-1001234567890, 'About us'));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'description' => 'About us',
        ], $this->decodeLastRequest($mock));
    }

    public function testDeleteChatPhotoSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->deleteChatPhoto(-1001234567890));

        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));
    }

    public function testSetChatPhotoUsesMultipartForLocalFile(): void {
        $tmp = tempnam(sys_get_temp_dir(), 'photo');
        $this->assertNotFalse($tmp);
        file_put_contents($tmp, 'fake-jpg');

        try {
            [$bot, $mock] = $this->createBotWithMock([
                new Response(200, [], $this->apiResponse(true)),
            ]);

            $this->assertTrue($bot->setChatPhoto(-1001234567890, $tmp));

            $request = $mock->getLastRequest();
            $this->assertNotNull($request);
            $this->assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
        } finally {
            @unlink($tmp);
        }
    }

    public function testPinAndUnpinChatMessageSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->pinChatMessage(-1001234567890, 15, disableNotification: true));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_id' => 15,
            'disable_notification' => true,
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->unpinChatMessage(-1001234567890, messageId: 15));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_id' => 15,
        ], $this->decodeLastRequest($mock));
    }

    public function testUnpinAllChatMessagesAndLeaveChat(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->unpinAllChatMessages(-1001234567890));
        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->leaveChat(-1001234567890));
        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));
    }

    public function testGetChatMemberCountReturnsInteger(): void {
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse(128)),
        ]);

        $this->assertSame(128, $bot->getChatMemberCount(-1001234567890));
    }

    public function testBanAndUnbanChatSenderChat(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->banChatSenderChat(-1001234567890, -1009876543210));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'sender_chat_id' => -1009876543210,
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->unbanChatSenderChat(-1001234567890, -1009876543210));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'sender_chat_id' => -1009876543210,
        ], $this->decodeLastRequest($mock));
    }

    public function testDeleteAllMessageReactionsSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->deleteAllMessageReactions(-1001234567890, userId: 42));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'user_id' => 42,
        ], $this->decodeLastRequest($mock));
    }

    public function testEditForumTopicSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->editForumTopic(-1001234567890, 7, name: 'Renamed', iconCustomEmojiId: '123456789'));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_thread_id' => 7,
            'name' => 'Renamed',
            'icon_custom_emoji_id' => '123456789',
        ], $this->decodeLastRequest($mock));
    }

    public function testCloseReopenAndDeleteForumTopic(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->closeForumTopic(-1001234567890, 7));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_thread_id' => 7,
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->reopenForumTopic(-1001234567890, 7));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_thread_id' => 7,
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->deleteForumTopic(-1001234567890, 7));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_thread_id' => 7,
        ], $this->decodeLastRequest($mock));
    }

    public function testGetForumTopicIconStickersParsesStickers(): void {
        $fixture = $this->loadFixture('api_responses/custom_emoji_stickers.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $stickers = $bot->getForumTopicIconStickers();

        $this->assertCount(1, $stickers);
        $this->assertInstanceOf(Sticker::class, $stickers[0]);
        $this->assertSame('123456789', $stickers[0]->getCustomEmojiId());
    }

    public function testGeneralForumTopicMethods(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->editGeneralForumTopic(-1001234567890, 'General'));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'name' => 'General',
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->closeGeneralForumTopic(-1001234567890));
        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->reopenGeneralForumTopic(-1001234567890));
        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->hideGeneralForumTopic(-1001234567890));
        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->unhideGeneralForumTopic(-1001234567890));
        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->unpinAllGeneralForumTopicMessages(-1001234567890));
        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));
    }

    public function testUnpinAllForumTopicMessages(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->unpinAllForumTopicMessages(-1001234567890, 7));

        $this->assertSame([
            'chat_id' => -1001234567890,
            'message_thread_id' => 7,
        ], $this->decodeLastRequest($mock));
    }

    public function testSetChatStickerSetAndDeleteChatStickerSet(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->setChatStickerSet(-1001234567890, 'my_set_by_bot'));
        $this->assertSame([
            'chat_id' => -1001234567890,
            'sticker_set_name' => 'my_set_by_bot',
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->deleteChatStickerSet(-1001234567890));
        $this->assertSame(['chat_id' => -1001234567890], $this->decodeLastRequest($mock));
    }

    public function testSubscriptionInviteLinks(): void {
        $fixture = $this->loadFixture('api_responses/create_chat_invite_link.json');
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse($fixture)),
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $link = $bot->createChatSubscriptionInviteLink(
            -1001234567890,
            subscriptionPeriod: 2592000,
            subscriptionPrice: 100,
            name: 'Premium',
        );
        $body = $this->decodeLastRequest($mock);
        $this->assertSame(-1001234567890, $body['chat_id']);
        $this->assertSame(2592000, $body['subscription_period']);
        $this->assertSame(100, $body['subscription_price']);
        $this->assertSame('Premium', $body['name']);
        $this->assertInstanceOf(ChatInviteLink::class, $link);

        $edited = $bot->editChatSubscriptionInviteLink(-1001234567890, 'https://t.me/+AbCdEf', name: 'VIP');
        $this->assertSame([
            'chat_id' => -1001234567890,
            'invite_link' => 'https://t.me/+AbCdEf',
            'name' => 'VIP',
        ], $this->decodeLastRequest($mock));
        $this->assertInstanceOf(ChatInviteLink::class, $edited);
    }

    public function testStickerSetManagement(): void {
        $sticker = new InputSticker(sticker: 'file_id_sticker', format: 'static', emojiList: ['👍']);
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->createNewStickerSet(
            1,
            'my_set_by_bot',
            'My Set',
            [$sticker],
            stickerType: 'regular',
            needsRepainting: true,
        ));
        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['user_id']);
        $this->assertSame('my_set_by_bot', $body['name']);
        $this->assertSame('regular', $body['sticker_type']);
        $this->assertTrue($body['needs_repainting']);
        $this->assertSame('static', $body['stickers'][0]['format']);

        $this->assertTrue($bot->addStickerToSet(1, 'my_set_by_bot', $sticker));
        $this->assertSame('static', $this->decodeLastRequest($mock)['sticker']['format']);

        $this->assertTrue($bot->setStickerSetThumbnail('my_set_by_bot', 1, 'static', thumbnail: 'thumb_file_id'));
        $this->assertSame([
            'name' => 'my_set_by_bot',
            'user_id' => 1,
            'thumbnail' => 'thumb_file_id',
            'format' => 'static',
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->setStickerEmojiList('file_id_sticker', ['👍', '🙂']));
        $this->assertSame([
            'sticker' => 'file_id_sticker',
            'emoji_list' => ['👍', '🙂'],
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->setStickerKeywords('file_id_sticker', ['happy', 'like']));
        $this->assertSame([
            'sticker' => 'file_id_sticker',
            'keywords' => ['happy', 'like'],
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->setStickerPositionInSet('file_id_sticker', 0));
        $this->assertSame([
            'sticker' => 'file_id_sticker',
            'position' => 0,
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->replaceStickerInSet(1, 'my_set_by_bot', 'old_file_id', $sticker));
        $this->assertSame('old_file_id', $this->decodeLastRequest($mock)['old_sticker']);

        $this->assertTrue($bot->deleteStickerSet('my_set_by_bot'));
        $this->assertSame(['name' => 'my_set_by_bot'], $this->decodeLastRequest($mock));
    }

    public function testSetGameScoreSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 23,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'game' => ['title' => 'My Game', 'description' => 'Fun', 'photo' => []],
            ])),
        ]);

        $message = $bot->setGameScore(1, 9000, chatId: 1, messageId: 23, force: true, disableEditMessage: true);

        $this->assertSame([
            'user_id' => 1,
            'score' => 9000,
            'force' => true,
            'disable_edit_message' => true,
            'chat_id' => 1,
            'message_id' => 23,
        ], $this->decodeLastRequest($mock));
        $this->assertInstanceOf(Message::class, $message);
    }

    public function testMyCommandsRoundTrip(): void {
        $commands = [new BotCommand('start', 'Start the bot')];
        $scope = new BotCommandScopeDefault();
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse([
                ['command' => 'start', 'description' => 'Start the bot'],
            ])),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->setMyCommands($commands, scope: $scope, languageCode: 'en'));
        $body = $this->decodeLastRequest($mock);
        $this->assertSame('start', $body['commands'][0]['command']);
        $this->assertSame('default', $body['scope']['type']);
        $this->assertSame('en', $body['language_code']);

        $loaded = $bot->getMyCommands(scope: $scope, languageCode: 'en');
        $this->assertCount(1, $loaded);
        $this->assertInstanceOf(BotCommand::class, $loaded[0]);
        $this->assertSame('start', $loaded[0]->getCommand());

        $this->assertTrue($bot->deleteMyCommands(scope: $scope, languageCode: 'en'));
        $this->assertSame([
            'scope' => ['type' => 'default'],
            'language_code' => 'en',
        ], $this->decodeLastRequest($mock));
    }

    public function testMyNameDescriptionAndShortDescription(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(['name' => 'Test Bot'])),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(['description' => 'Long text'])),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(['short_description' => 'Short'])),
        ]);

        $this->assertTrue($bot->setMyName('Test Bot', languageCode: 'en'));
        $this->assertSame(['name' => 'Test Bot', 'language_code' => 'en'], $this->decodeLastRequest($mock));

        $name = $bot->getMyName('en');
        $this->assertInstanceOf(BotName::class, $name);
        $this->assertSame('Test Bot', $name->getName());

        $this->assertTrue($bot->setMyDescription('Long text', languageCode: 'en'));
        $this->assertSame(['description' => 'Long text', 'language_code' => 'en'], $this->decodeLastRequest($mock));

        $description = $bot->getMyDescription('en');
        $this->assertInstanceOf(BotDescription::class, $description);
        $this->assertSame('Long text', $description->getDescription());

        $this->assertTrue($bot->setMyShortDescription('Short', languageCode: 'en'));
        $this->assertSame(['short_description' => 'Short', 'language_code' => 'en'], $this->decodeLastRequest($mock));

        $short = $bot->getMyShortDescription('en');
        $this->assertInstanceOf(BotShortDescription::class, $short);
        $this->assertSame('Short', $short->getShortDescription());
    }

    public function testAnswerChatJoinRequestQueryAndWebApp(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->answerChatJoinRequestQuery('cjr-query-1', 'approved'));
        $this->assertSame([
            'chat_join_request_query_id' => 'cjr-query-1',
            'result' => 'approved',
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->sendChatJoinRequestWebApp('cjr-query-2', 'https://example.com/app'));
        $this->assertSame([
            'chat_join_request_query_id' => 'cjr-query-2',
            'web_app_url' => 'https://example.com/app',
        ], $this->decodeLastRequest($mock));
    }

}
