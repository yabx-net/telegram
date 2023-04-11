<?php

namespace Yabx\Telegram;

use GuzzleHttp\Client;
use Yabx\Telegram\Objects\File;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Objects\WebhookInfo;

class BotApi {

    private Client $client;
    private string $apiBaseUri;
    private string $fileBaseUri;

    public static function getUpdatefromRequest(): Update {
        if($body = file_get_contents('php://input')) {
            return self::getUpdateFromJson($body);
        } else {
            throw new Exception('Empty body');
        }
    }

    /**
     * @throws Exception
     */
    public static function getUpdateFromJson(string $json): Update {
        if($data = json_decode($json, true)) {
            return new Update($data);
        } else {
            throw new Exception('Malformed JSON: ' . json_last_error_msg());
        }
    }

    public function __construct(string $token, array $guzzleOptions = []) {
        $this->apiBaseUri = sprintf('https://api.telegram.org/bot%s/', $token);
        $this->fileBaseUri = sprintf('https://api.telegram.org/file/bot%s/', $token);
        $this->client = new Client([
			'base_uri' => $this->apiBaseUri,
            'http_errors' => false,
            ...$guzzleOptions
		]);
    }

	public function sendMessage(int|string $chatId, string $text, array $options = []): Message {
        $text = str_replace('\n', "\n", $text);
		$data = self::request('sendMessage', [
			'chat_id' => $chatId,
			'text' => $text,
			'parse_mode' => 'html',
			'disable_web_page_preview' => 1,
			...$options
		]);
        return new Message($data);
	}

    public function getFile(string $fileId, string $savePath): void {
        $data = $this->request('getFile', ['file_id' => $fileId]);
        $file = new File($data);
        $tmpPath = '/tmp/' . uniqid($fileId) . '.tmp';
        $res = $this->client->get($this->fileBaseUri . $file->getFilePath(), ['sink' => $tmpPath]);
        $code = $res->getStatusCode();
        if($code === 200) {
            if(!@rename($tmpPath, $savePath)) {
                @unlink($tmpPath);
                throw new Exception('Failed to save file to ' . $savePath);
            }
        } else {
            @unlink($tmpPath);
            throw new Exception('Failed to download file', $code);
        }
    }

	public function setWebhook(string $url, array $options = []): void {
        self::request('setWebhook', [
			'url' => $url,
            ...$options
		]);
	}

	public function getWebhookInfo(): WebhookInfo {
        $data = self::request('getWebhookInfo');
        return new WebhookInfo($data);
	}

	public function request(string $method, array $params = []): mixed {
        $res = $this->client->post($method, ['json' => $params]);
        $json = json_decode($res->getBody()->__toString(), true);
        if($json['ok'] ?? false) return $json['result'];
        throw new Exception($json['description'] ?? 'Unknown error', $json['code'] ?? 500);
	}

}
