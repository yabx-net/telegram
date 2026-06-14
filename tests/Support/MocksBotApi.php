<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Support;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Yabx\Telegram\BotApi;

trait MocksBotApi {

    /**
     * @param Response[] $responses
     * @return array{0: BotApi, 1: MockHandler}
     */
    protected function createBotWithMock(array $responses): array {
        $mock = new MockHandler($responses);
        $bot = new BotApi('test-token', ['handler' => HandlerStack::create($mock)], apiUrl: 'http://test');

        return [$bot, $mock];
    }

    /**
     * @param Response[] $responses
     */
    protected function createBot(array $responses): BotApi {
        return $this->createBotWithMock($responses)[0];
    }

    protected function decodeLastRequest(MockHandler $mock): array {
        $request = $mock->getLastRequest();
        $this->assertNotNull($request);

        return json_decode((string) $request->getBody(), true, flags: JSON_THROW_ON_ERROR);
    }

    protected function apiResponse(mixed $result): string {
        return json_encode(['ok' => true, 'result' => $result], JSON_THROW_ON_ERROR);
    }

}
