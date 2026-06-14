<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Yabx\Telegram\BotApi;
use Yabx\Telegram\Exception;
use Yabx\Telegram\Objects\ChatFullInfo;
use Yabx\Telegram\Objects\ChatInviteLink;
use Yabx\Telegram\Objects\ChatMemberAdministrator;
use Yabx\Telegram\Objects\File;
use Yabx\Telegram\Objects\InlineKeyboardButton;
use Yabx\Telegram\Objects\InlineKeyboardMarkup;
use Yabx\Telegram\Objects\InlineQueryResultArticle;
use Yabx\Telegram\Objects\InlineQueryResultsButton;
use Yabx\Telegram\Objects\InputMediaPhoto;
use Yabx\Telegram\Objects\InputPollOption;
use Yabx\Telegram\Objects\InputTextMessageContent;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\Poll;
use Yabx\Telegram\Objects\ReplyParameters;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Objects\User;
use Yabx\Telegram\Objects\WebhookInfo;
use Yabx\Telegram\Tests\Support\MocksBotApi;
use Yabx\Telegram\Tests\TestCase;

final class BotApiTest extends TestCase {

    use MocksBotApi;

    public function testGetMeReturnsUser(): void {
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse([
                'id' => 1,
                'is_bot' => true,
                'first_name' => 'TestBot',
                'username' => 'test_bot',
            ])),
        ]);

        $user = $bot->getMe();

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame(1, $user->getId());
        $this->assertTrue($user->getIsBot());
        $this->assertSame('test_bot', $user->getUsername());
    }

    public function testGetUpdatesParsesUpdateArray(): void {
        $fixture = $this->loadFixture('update_callback_query.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse([$fixture])),
        ]);

        $updates = $bot->getUpdates(offset: 1, limit: 10);

        $this->assertCount(1, $updates);
        $this->assertInstanceOf(Update::class, $updates[0]);
        $this->assertSame(94181762, $updates[0]->getUpdateId());
        $this->assertSame('cq-1', $updates[0]->getCallbackQuery()->getId());
    }

    public function testGetChatParsesChatFullInfo(): void {
        $fixture = $this->loadFixture('chat_full_info_supergroup.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $chat = $bot->getChat(-1001234567890);

        $this->assertInstanceOf(ChatFullInfo::class, $chat);
        $this->assertSame('supergroup', $chat->getType());
        $this->assertTrue($chat->getIsForum());
        $this->assertSame('Rules', $chat->getPinnedMessage()->getText());
        $this->assertCount(2, $chat->getAvailableReactions());
    }

    public function testGetChatMemberParsesAdministrator(): void {
        $fixture = $this->loadFixture('chat_member_administrator.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse($fixture)),
        ]);

        $member = $bot->getChatMember(-1001234567890, 1);

        $this->assertInstanceOf(ChatMemberAdministrator::class, $member);
        $this->assertTrue($member->getCanManageChat());
    }

    public function testAnswerCallbackQuerySerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->answerCallbackQuery('cq-1', text: 'Done', showAlert: true, cacheTime: 60);

        $body = $this->decodeLastRequest($mock);
        $this->assertSame([
            'callback_query_id' => 'cq-1',
            'text' => 'Done',
            'show_alert' => true,
            'cache_time' => 60,
        ], $body);
    }

    public function testSendMessageSerializesNestedObjects(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 10,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'text' => 'reply',
            ])),
        ]);

        $bot->sendMessage(
            chatId: 1,
            text: 'reply',
            replyParameters: new ReplyParameters(messageId: 5, chatId: 1),
            replyMarkup: new InlineKeyboardMarkup(inlineKeyboard: [
                [new InlineKeyboardButton(text: 'OK', callbackData: 'ok')],
            ]),
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame('reply', $body['text']);
        $this->assertSame(['message_id' => 5, 'chat_id' => 1], $body['reply_parameters']);
        $this->assertSame([
            'inline_keyboard' => [[['text' => 'OK', 'callback_data' => 'ok']]],
        ], $body['reply_markup']);
    }

    public function testSendMediaGroupSerializesInputMediaArray(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                [
                    'message_id' => 11,
                    'date' => 1681135130,
                    'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                    'photo' => [['file_id' => 'f', 'file_unique_id' => 'u', 'width' => 1, 'height' => 1]],
                ],
            ])),
        ]);

        $bot->sendMediaGroup(1, [
            new InputMediaPhoto(media: 'attach://photo.jpg', caption: 'One'),
        ]);

        $body = $this->decodeLastRequest($mock);
        $this->assertSame(1, $body['chat_id']);
        $this->assertSame([
            ['type' => 'photo', 'media' => 'attach://photo.jpg', 'caption' => 'One'],
        ], $body['media']);
    }

    public function testUploadStickerFileUsesMultipart(): void {
        $tmp = tempnam(sys_get_temp_dir(), 'sticker');
        $this->assertNotFalse($tmp);
        file_put_contents($tmp, 'fake-sticker');

        try {
            [$bot, $mock] = $this->createBotWithMock([
                new Response(200, [], $this->apiResponse([
                    'file_id' => 'f-1',
                    'file_unique_id' => 'u-1',
                    'file_size' => 128,
                ])),
            ]);

            $file = $bot->uploadStickerFile(1, $tmp, 'static');

            $this->assertInstanceOf(File::class, $file);
            $this->assertSame('f-1', $file->getFileId());
            $request = $mock->getLastRequest();
            $this->assertNotNull($request);
            $this->assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
        } finally {
            @unlink($tmp);
        }
    }

    public function testRequestThrowsOnApiError(): void {
        $bot = $this->createBot([
            new Response(200, [], json_encode([
                'ok' => false,
                'error_code' => 400,
                'description' => 'Bad Request: chat not found',
            ], JSON_THROW_ON_ERROR)),
        ]);

        try {
            $bot->request('sendMessage', ['chat_id' => 1, 'text' => 'hi']);
            $this->fail('Expected Exception was not thrown');
        } catch (Exception $e) {
            $this->assertSame(400, $e->getCode());
            $this->assertStringContainsString('chat not found', $e->getMessage());
        }
    }

    public function testRequestThrowsOnRateLimit(): void {
        $bot = $this->createBot([
            new Response(200, [], json_encode([
                'ok' => false,
                'error_code' => 429,
                'description' => 'Too Many Requests: retry after 30',
                'parameters' => ['retry_after' => 30],
            ], JSON_THROW_ON_ERROR)),
        ]);

        try {
            $bot->request('sendMessage', ['chat_id' => 1, 'text' => 'hi']);
            $this->fail('Expected Exception was not thrown');
        } catch (Exception $e) {
            $this->assertSame(429, $e->getCode());
            $this->assertStringContainsString('retry after 30', $e->getMessage());
        }
    }

    public function testRequestSerializesObjectParameters(): void {
        $bot = $this->createBot([
            new Response(200, [], json_encode([
                'ok' => true,
                'result' => [
                    'message_id' => 10,
                    'date' => 1681135130,
                    'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                    'text' => 'reply',
                ],
            ], JSON_THROW_ON_ERROR)),
        ]);

        $message = $bot->sendMessage(
            chatId: 1,
            text: 'reply',
            replyParameters: new ReplyParameters(messageId: 5),
        );

        $this->assertInstanceOf(Message::class, $message);
        $this->assertSame(10, $message->getMessageId());
    }

    public function testGetLastResponseReturnsEnvelope(): void {
        $bot = $this->createBot([
            new Response(200, [], json_encode([
                'ok' => true,
                'result' => true,
            ], JSON_THROW_ON_ERROR)),
        ]);

        $bot->request('deleteWebhook');

        $this->assertSame([
            'ok' => true,
            'result' => true,
        ], $bot->getLastResponse());
    }

    public function testGetWebhookInfoParsesResult(): void {
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse([
                'url' => 'https://example.com/hook',
                'has_custom_certificate' => false,
                'pending_update_count' => 2,
                'allowed_updates' => ['message', 'callback_query'],
            ])),
        ]);

        $info = $bot->getWebhookInfo();

        $this->assertInstanceOf(WebhookInfo::class, $info);
        $this->assertSame('https://example.com/hook', $info->getUrl());
        $this->assertSame(2, $info->getPendingUpdateCount());
        $this->assertSame(['message', 'callback_query'], $info->getAllowedUpdates());
    }

    public function testSetWebhookSerializesParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->setWebhook(
            'https://example.com/hook',
            maxConnections: 40,
            allowedUpdates: ['message'],
            dropPendingUpdates: true,
            secretToken: 'secret',
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame('https://example.com/hook', $body['url']);
        $this->assertSame(40, $body['max_connections']);
        $this->assertSame(['message'], $body['allowed_updates']);
        $this->assertTrue($body['drop_pending_updates']);
        $this->assertSame('secret', $body['secret_token']);
    }

    public function testAnswerInlineQuerySerializesNestedResults(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $bot->answerInlineQuery(
            'iq-1',
            [
                new InlineQueryResultArticle(
                    id: 'art1',
                    title: 'Result',
                    inputMessageContent: new InputTextMessageContent(messageText: 'Text'),
                ),
            ],
            cacheTime: 300,
            isPersonal: true,
            button: new InlineQueryResultsButton(text: 'Open', startParameter: 'start'),
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame('iq-1', $body['inline_query_id']);
        $this->assertSame(300, $body['cache_time']);
        $this->assertTrue($body['is_personal']);
        $this->assertSame([
            [
                'type' => 'article',
                'id' => 'art1',
                'title' => 'Result',
                'input_message_content' => ['message_text' => 'Text'],
            ],
        ], $body['results']);
        $this->assertSame([
            'text' => 'Open',
            'start_parameter' => 'start',
        ], $body['button']);
    }

    public function testGetFileParsesResult(): void {
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse([
                'file_id' => 'AAQACAgIAAxkBAAI',
                'file_unique_id' => 'AgADAAI',
                'file_size' => 512,
                'file_path' => 'photos/file.jpg',
            ])),
        ]);

        $file = $bot->getFile('AAQACAgIAAxkBAAI');

        $this->assertInstanceOf(File::class, $file);
        $this->assertSame('photos/file.jpg', $file->getFilePath());
    }

    public function testSendPollSerializesOptionsAndReturnsMessage(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 12,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'poll' => [
                    'id' => 'poll-1',
                    'question' => 'Lunch?',
                    'options' => [
                        ['text' => 'Pizza', 'voter_count' => 0],
                        ['text' => 'Salad', 'voter_count' => 0],
                    ],
                    'total_voter_count' => 0,
                    'is_closed' => false,
                    'is_anonymous' => true,
                    'type' => 'regular',
                    'allows_multiple_answers' => false,
                ],
            ])),
        ]);

        $message = $bot->sendPoll(
            1,
            'Lunch?',
            [new InputPollOption(text: 'Pizza'), new InputPollOption(text: 'Salad')],
            type: 'quiz',
            correctOptionId: 0,
            media: new InputMediaPhoto(media: 'attach://photo.jpg'),
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame('Lunch?', $body['question']);
        $this->assertSame('quiz', $body['type']);
        $this->assertSame(0, $body['correct_option_id']);
        $this->assertSame([
            ['text' => 'Pizza'],
            ['text' => 'Salad'],
        ], $body['options']);
        $this->assertSame([
            'type' => 'photo',
            'media' => 'attach://photo.jpg',
        ], $body['media']);

        $this->assertInstanceOf(Message::class, $message);
        $this->assertInstanceOf(Poll::class, $message->getPoll());
        $this->assertSame('Lunch?', $message->getPoll()->getQuestion());
    }

    public function testCreateChatInviteLinkParsesResult(): void {
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse([
                'invite_link' => 'https://t.me/+invite',
                'creator' => ['id' => 1, 'is_bot' => true, 'first_name' => 'Bot'],
                'creates_join_request' => true,
                'is_primary' => false,
                'is_revoked' => false,
                'name' => 'Guests',
            ])),
        ]);

        $link = $bot->createChatInviteLink(-1001234567890, name: 'Guests', createsJoinRequest: true);

        $this->assertInstanceOf(ChatInviteLink::class, $link);
        $this->assertSame('Guests', $link->getName());
        $this->assertTrue($link->getCreatesJoinRequest());
    }

    public function testGetChatAdministratorsParsesMembers(): void {
        $fixture = $this->loadFixture('chat_member_administrator.json');
        $bot = $this->createBot([
            new Response(200, [], $this->apiResponse([$fixture])),
        ]);

        $members = $bot->getChatAdministrators(-1001234567890);

        $this->assertCount(1, $members);
        $this->assertInstanceOf(ChatMemberAdministrator::class, $members[0]);
    }

    public function testLastResponseContainsParametersOnMigrateError(): void {
        $bot = $this->createBot([
            new Response(200, [], json_encode([
                'ok' => false,
                'error_code' => 400,
                'description' => 'Bad Request: group chat was upgraded to a supergroup chat',
                'parameters' => ['migrate_to_chat_id' => -1001234567890],
            ], JSON_THROW_ON_ERROR)),
        ]);

        try {
            $bot->request('sendMessage', ['chat_id' => -123, 'text' => 'hi']);
            $this->fail('Expected Exception was not thrown');
        } catch (Exception $e) {
            $this->assertSame(400, $e->getCode());
        }

        $this->assertSame([
            'ok' => false,
            'error_code' => 400,
            'description' => 'Bad Request: group chat was upgraded to a supergroup chat',
            'parameters' => ['migrate_to_chat_id' => -1001234567890],
        ], $bot->getLastResponse());
    }

    public function testGetApiUrlAndSetApiUrl(): void {
        $bot = new BotApi('test-token', apiUrl: 'http://custom');

        $this->assertSame('http://custom', $bot->getApiUrl());

        $bot->setApiUrl('http://local');
        $this->assertSame('http://local', $bot->getApiUrl());
    }

}
