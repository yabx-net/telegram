<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Integration;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Log\LoggerInterface;
use Yabx\Telegram\BotApi;
use Yabx\Telegram\Exception;
use Yabx\Telegram\Objects\InputMediaPhoto;
use Yabx\Telegram\Objects\InputPollOption;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\Poll;
use Yabx\Telegram\Tests\Support\MocksBotApi;
use Yabx\Telegram\Tests\TestCase;

final class BotApiEdgeCasesTest extends TestCase {

    use MocksBotApi;

    public function testDownloadFileByFileIdFetchesMetadataFirst(): void {
        $fileFixture = $this->loadFixture('api_responses/get_file.json');
        $savePath = tempnam(sys_get_temp_dir(), 'dl');
        $this->assertNotFalse($savePath);
        @unlink($savePath);

        try {
            [$bot, $mock] = $this->createBotWithMock([
                new Response(200, [], $this->apiResponse($fileFixture)),
                new Response(200, [], 'downloaded-by-id'),
            ]);

            $bot->downloadFile('AAQACAgIAAxkBAAI', $savePath);

            $this->assertFileExists($savePath);
            $this->assertSame('downloaded-by-id', file_get_contents($savePath));
        } finally {
            @unlink($savePath);
        }
    }

    public function testDownloadFileThrowsOnHttpError(): void {
        $fileFixture = $this->loadFixture('api_responses/get_file.json');
        $savePath = tempnam(sys_get_temp_dir(), 'dl');
        $this->assertNotFalse($savePath);
        @unlink($savePath);

        try {
            $bot = $this->createBot([
                new Response(200, [], $this->apiResponse($fileFixture)),
                new Response(404, [], 'not found'),
            ]);

            $this->expectException(Exception::class);
            $this->expectExceptionMessage('Failed to download file');
            $bot->downloadFile('AAQACAgIAAxkBAAI', $savePath);
        } finally {
            @unlink($savePath);
        }
    }

    public function testSendLivePhotoUsesMultipartForLocalFiles(): void {
        $live = tempnam(sys_get_temp_dir(), 'live');
        $photo = tempnam(sys_get_temp_dir(), 'photo');
        $this->assertNotFalse($live);
        $this->assertNotFalse($photo);
        file_put_contents($live, 'live-video');
        file_put_contents($photo, 'still-image');

        try {
            [$bot, $mock] = $this->createBotWithMock([
                new Response(200, [], $this->apiResponse([
                    'message_id' => 70,
                    'date' => 1681135130,
                    'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                ])),
            ]);

            $message = $bot->sendLivePhoto(1, $live, $photo, caption: 'Live');

            $request = $mock->getLastRequest();
            $this->assertNotNull($request);
            $this->assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
            $this->assertInstanceOf(Message::class, $message);
        } finally {
            @unlink($live);
            @unlink($photo);
        }
    }

    public function testRequestLogsDebugOnSuccess(): void {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->atLeastOnce())
            ->method('debug')
            ->with($this->logicalOr('REQUEST: getMe', 'RESPONSE'));

        $mock = new MockHandler([
            new Response(200, [], $this->apiResponse(['id' => 1, 'is_bot' => true, 'first_name' => 'Bot'])),
        ]);
        $bot = new BotApi('test-token', ['handler' => HandlerStack::create($mock)], $logger, 'http://test');

        $bot->getMe();
    }

    public function testRequestLogsErrorOnApiFailure(): void {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects($this->exactly(2))
            ->method('debug')
            ->willReturnCallback(function (string $message): void {
                static $calls = 0;
                $calls++;
                if ($calls === 1) {
                    $this->assertSame('REQUEST: getMe', $message);
                } else {
                    $this->assertSame('ERROR', $message);
                }
            });

        $mock = new MockHandler([
            new Response(200, [], json_encode(['ok' => false, 'error_code' => 400, 'description' => 'Bad Request'], JSON_THROW_ON_ERROR)),
        ]);
        $bot = new BotApi('test-token', ['handler' => HandlerStack::create($mock)], $logger, 'http://test');

        try {
            $bot->getMe();
            $this->fail('Expected Exception');
        } catch (Exception) {
        }
    }

    public function testRequestWrapsTransportException(): void {
        $mock = new MockHandler([
            new ConnectException('Connection refused', new Request('POST', 'http://test')),
        ]);
        $bot = new BotApi('test-token', ['handler' => HandlerStack::create($mock)], apiUrl: 'http://test');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Connection refused');
        $bot->getMe();
    }

    public function testGetUpdatesSerializesAllParameters(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([])),
        ]);

        $bot->getUpdates(offset: 10, limit: 5, timeout: 30, allowedUpdates: ['message', 'callback_query']);

        $this->assertSame([
            'offset' => 10,
            'limit' => 5,
            'timeout' => 30,
            'allowed_updates' => ['message', 'callback_query'],
        ], $this->decodeLastRequest($mock));
    }

    public function testSendPollSerializesInputPollMedia(): void {
        $media = new InputMediaPhoto(media: 'file_id_poll_photo');
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 90,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'poll' => [
                    'id' => 'poll-media',
                    'question' => 'Pick?',
                    'options' => [['text' => 'A', 'voter_count' => 0]],
                    'total_voter_count' => 0,
                    'is_closed' => false,
                    'is_anonymous' => true,
                    'type' => 'regular',
                    'allows_multiple_answers' => false,
                ],
            ])),
        ]);

        $message = $bot->sendPoll(
            chatId: 1,
            question: 'Pick?',
            options: [new InputPollOption(text: 'A')],
            media: $media,
            membersOnly: true,
            countryCodes: ['BY'],
        );

        $body = $this->decodeLastRequest($mock);
        $this->assertSame('photo', $body['media']['type']);
        $this->assertTrue($body['members_only']);
        $this->assertSame(['BY'], $body['country_codes']);
        $this->assertInstanceOf(Message::class, $message);
        $this->assertInstanceOf(Poll::class, $message->getPoll());
    }

}
