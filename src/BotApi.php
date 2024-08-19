<?php

namespace Yabx\Telegram;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Log\NullLogger;
use Yabx\Telegram\Enum\ChatAction;
use Yabx\Telegram\Objects\Chat;
use Yabx\Telegram\Objects\File;
use Yabx\Telegram\Objects\Invoice;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\ReplyMarkup;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Objects\User;
use Yabx\Telegram\Objects\UserProfilePhotos;
use Yabx\Telegram\Objects\WebhookInfo;
use Psr\Log\LoggerInterface;

class BotApi {

    protected ?LoggerInterface $logger;
    private Client $client;
    private string $apiBaseUri;
    private string $fileBaseUri;

    public static function getUpdatefromRequest(): Update {
        if ($body = file_get_contents('php://input')) {
            return self::getUpdateFromJson($body);
        } else {
            throw new Exception('Empty body');
        }
    }

    /**
     * @throws Exception
     */
    public static function getUpdateFromJson(string $json): Update {
        if ($data = json_decode($json, true)) {
            return Update::fromArray($data);
        } else {
            throw new Exception('Malformed JSON: ' . json_last_error_msg());
        }
    }

    public function __construct(string $token, array $guzzleOptions = [], LoggerInterface $logger = null, string $apiUrl = 'https://api.telegram.org') {
        $this->apiBaseUri = sprintf('%s/bot%s/', $apiUrl, $token);
        $this->fileBaseUri = sprintf('%s/file/bot%s/', $apiUrl, $token);
        $this->client = new Client([
            'base_uri' => $this->apiBaseUri,
            'http_errors' => false,
            ...$guzzleOptions
        ]);
        $this->logger = $logger ?? new NullLogger;
    }

    /**
     * Direct call Telegram Bot Api
     * @link https://core.telegram.org/bots/api#available-methods
     * @param string $method
     * @param array $params
     * @param bool $multipart
     * @return mixed
     * @throws Exception
     * @throws GuzzleException
     */

    public function request(string $method, array $params = [], bool $multipart = false): mixed {
        $this->logger->debug('REQUEST: ' . $method, $params);
        if ($multipart) {
            $multipart = [];
            foreach ($params as $key => $value) {
                $multipart[] = ['name' => $key, 'contents' => $value];
            }
            $res = $this->client->post($method, [RequestOptions::MULTIPART => $multipart]);
        } else {
            $res = $this->client->post($method, [RequestOptions::JSON => $params]);
        }
        $json = json_decode($res->getBody()->__toString(), true);
        if ($json['ok'] ?? false) {
            $this->logger->debug('RESPONSE', $json);
            return $json['result'];
        } else {
            $this->logger->debug('ERROR', $json);
            throw new Exception($json['description'] ?? 'Unknown error', $json['code'] ?? 500);
        }
    }

    /**
     * A simple method for testing your bot's authentication token. Requires no parameters.
     * Returns basic information about the bot in form of a User object.
     * @link https://core.telegram.org/bots/api#getme
     * @return User
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMe(): User {
        return User::fromArray($this->request('getMe'));
    }

    /**
     * Use this method to get the current bot name for the given user language. Returns BotName on success.
     * @link https://core.telegram.org/bots/api#getmyname
     * @param string|null $languageCode
     * @return string
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyName(?string $languageCode = null): string {
        $params = [];
        if($languageCode) $params['language_code'] = $languageCode;
        return $this->request('getMyName', $params)['name'];
    }

    /**
     * Use this method to change the bot's name. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmyname
     * @param string $name
     * @param string|null $languageCode
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyName(string $name, ?string $languageCode = null): bool {
        $params = ['name' => $name];
        if($languageCode) $params['language_code'] = $languageCode;
        return $this->request('setMyName', $params);
    }

    /**
     * Use this method to get the current bot description for the given user language. Returns BotDescription on success.
     * @link https://core.telegram.org/bots/api#getmydescription
     * @param string|null $languageCode
     * @return string
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyDescription(?string $languageCode = null): string {
        $params = [];
        if($languageCode) $params['language_code'] = $languageCode;
        return $this->request('getMyDescription', $params)['description'];
    }

    /**
     * Use this method to change the bot's description, which is shown in the chat with the bot if the chat is empty.
     * Returns True on success.
     * @link https://core.telegram.org/bots/api#setmydescription
     * @param string $description
     * @param string|null $languageCode
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyDescription(string $description, ?string $languageCode = null): bool {
        $params = ['description' => $description];
        if($languageCode) $params['language_code'] = $languageCode;
        return $this->request('setMyDescription', $params);
    }

    /**
     * Use this method to get the current bot short description for the given user language. Returns BotShortDescription on success.
     * @link https://core.telegram.org/bots/api#getmyshortdescription
     * @param string|null $languageCode
     * @return string
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyShortDescription(?string $languageCode = null): string {
        $params = [];
        if($languageCode) $params['language_code'] = $languageCode;
        return $this->request('getMyShortDescription', $params)['short_description'];
    }

    /**
     * Use this method to change the bot's short description, which is shown on the bot's profile page and is sent
     * together with the link when users share the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmyshortdescription
     * @param string $description
     * @param string|null $languageCode
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyShortDescription(string $description, ?string $languageCode = null): bool {
        $params = ['short_description' => $description];
        if($languageCode) $params['language_code'] = $languageCode;
        return $this->request('setMyShortDescription', $params);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one
     * conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
     * @link https://core.telegram.org/bots/api#getchat
     * @param int|string $chatId
     * @return Chat
     * @throws Exception
     * @throws GuzzleException
     */
    public function getChat(int|string $chatId): Chat {
        return Chat::fromArray($this->request('getChat', [
            'chat_id' => $chatId
        ]));
    }

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendmessage
     * @param int|string $chatId
     * @param string $text
     * @param ReplyMarkup|null $replyMarkup
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendMessage(int|string $chatId, string $text, ?ReplyMarkup $replyMarkup = null, array $options = []): Message {
        $text = str_replace('\n', "\n", $text);
        $params = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'html',
            'disable_web_page_preview' => 1,
            ...$options
        ];
        if($replyMarkup) $params['reply_markup'] = $replyMarkup->toArray();
        $data = self::request('sendMessage', $params);
        return Message::fromArray($data);
    }

    /**
     * Use this method to forward messages of any kind. Service messages can't be forwarded.
     * On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#forwardmessage
     * @param int $messageId
     * @param int|string $fromChatId
     * @param int|string $chatId
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function forwardMessage(int|string $chatId, int|string $fromChatId, int $messageId, array $options = []): Message {
        $data = $this->request('forwardMessage', [
            'chat_id' => $chatId,
            'from_chat_id' => $fromChatId,
            'message_id' => $messageId,
            ...$options
        ]);
        return Message::fromArray($data);
    }

    /**
     * Use this method to copy messages of any kind. Service messages and invoice messages can't be copied.
     * A quiz poll can be copied only if the value of the field correct_option_id is known to the bot.
     * The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the
     * original message. Returns the MessageId of the sent message on success.
     * @link https://core.telegram.org/bots/api#copymessage
     * @param int $messageId
     * @param int|string $fromChatId
     * @param int|string $chatId
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function copyMessage(int|string $chatId, int|string $fromChatId, int $messageId, array $options = []): Message {
        $data = $this->request('copyMessage', [
            'chat_id' => $chatId,
            'from_chat_id' => $fromChatId,
            'message_id' => $messageId,
            ...$options
        ]);
        return Message::fromArray($data);
    }

    /**
     * Use this method to send photos. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendphoto
     * @param int|string $chatId
     * @param string $photo file_id, url or path to local file
     * @param string|null $caption
     * @param array $options
     * @return Message
     */
    public function sendPhoto(int|string $chatId, string $photo, ?string $caption = null, array $options = []): Message {
        return $this->sendAttachment('sendPhoto', 'photo', $chatId, $photo, $caption, null, $options);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     * For sending voice messages, use the sendVoice method instead.
     * @link https://core.telegram.org/bots/api#sendaudio
     * @param int|string $chatId
     * @param string $audio file_id, url or path to local file
     * @param string|null $caption
     * @param string|null $thumbnail
     * @param array $options
     * @return Message
     */
    public function sendAudio(int|string $chatId, string $audio, ?string $caption = null, ?string $thumbnail = null, array $options = []): Message {
        return $this->sendAttachment('sendAudio', 'audio', $chatId, $audio, $caption, $thumbnail, $options);
    }

    /**
     * Use this method to send general files. On success, the sent Message is returned. Bots can currently send files
     * of any type of up to 50 MB in size, this limit may be changed in the future.
     * @link https://core.telegram.org/bots/api#senddocument
     * @param int|string $chatId
     * @param string $document file_id, url or path to local file
     * @param string|null $caption
     * @param string|null $thumbnail
     * @param array $options
     * @return Message
     */
    public function sendDocument(int|string $chatId, string $document, ?string $caption = null, ?string $thumbnail = null, array $options = []): Message {
        return $this->sendAttachment('sendDocument', 'document', $chatId, $document, $caption, $thumbnail, $options);
    }

    /**
     * Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be sent as
     * Document). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size,
     * this limit may be changed in the future.
     * @link https://core.telegram.org/bots/api#sendvideo
     * @param int|string $chatId
     * @param string $video file_id, url or path to local file
     * @param string|null $caption
     * @param string|null $thumbnail
     * @param array $options
     * @return Message
     */
    public function sendVideo(int|string $chatId, string $video, ?string $caption = null, ?string $thumbnail = null, array $options = []): Message {
        return $this->sendAttachment('sendVideo', 'video', $chatId, $video, $caption, $thumbnail, $options);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent
     * Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed
     * in the future.
     * @link https://core.telegram.org/bots/api#sendanimation
     * @param int|string $chatId
     * @param string $animation file_id, url or path to local file
     * @param string|null $caption
     * @param string|null $thumbnail
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendAnimation(int|string $chatId, string $animation, ?string $caption = null, ?string $thumbnail = null, array $options = []): Message {
        return $this->sendAttachment('sendAnimation', 'animation', $chatId, $animation, $caption, $thumbnail, $options);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice
     * message. For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as
     * Audio or Document). On success, the sent Message is returned. Bots can currently send voice messages of up to
     * 50 MB in size, this limit may be changed in the future.
     * @link https://core.telegram.org/bots/api#sendvoice
     * @param int|string $chatId
     * @param string $voice file_id, url or path to local file
     * @param string|null $caption
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendVoice(int|string $chatId, string $voice, ?string $caption = null, array $options = []): Message {
        return $this->sendAttachment('sendVoice', 'voice', $chatId, $voice, $caption, null, $options);
    }

    /**
     * As of v.4.0, Telegram clients support rounded square MPEG4 videos of up to 1 minute long. Use this method to
     * send video messages. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendvideonote
     * @param int|string $chatId
     * @param string $voice
     * @param string|null $thumbnail
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendVideoNote(int|string $chatId, string $voice, ?string $thumbnail = null, array $options = []): Message {
        return $this->sendAttachment('sendVideoNote', 'video_note', $chatId, $voice, null, $thumbnail, $options);
    }

    /**
     * Use this method to send point on the map. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendlocation
     * @param int|string $chatId
     * @param float $latitude
     * @param float $longitude
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendLocation(int|string $chatId, float $latitude, float $longitude, array $options = []): Message {
        $data = $this->request('sendLocation', [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            ...$options
        ]);
        return Message::fromArray($data);
    }

    /**
     * Use this method to send information about a venue. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendvenue
     * @param int|string $chatId
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @param string $address
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendVenue(int|string $chatId, float $latitude, float $longitude, string $title, string $address, array $options = []): Message {
        $data = $this->request('sendVenue', [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address,
            ...$options
        ]);
        return Message::fromArray($data);
    }

    /**
     * Use this method to send phone contacts. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendcontact
     * @link https://en.wikipedia.org/wiki/VCard
     * @param int|string $chatId
     * @param string $phoneNumber
     * @param string $firstName
     * @param string $lastName
     * @param string|null $vcard
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendContact(int|string $chatId, string $phoneNumber, string $firstName, string $lastName, ?string $vcard = null, array $options = []): Message {
        $data = $this->request('sendContact', [
            'chat_id' => $chatId,
            'phone_number' => $phoneNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'vcard' => $vcard,
            ...$options
        ]);
        return Message::fromArray($data);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status is set
     * for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     * Returns True on success.
     * @param int|string $chatId
     * @param ChatAction $action
     * @param array $options
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendChatAction(int|string $chatId, ChatAction $action, array $options = []): bool {
        return $this->request('sendChatAction', [
            'chat_id' => $chatId,
            'action' => $action->value,
            ...$options
        ]);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:
     * - A message can only be deleted if it was sent less than 48 hours ago.
     * - Service messages about a supergroup, channel, or forum topic creation can't be deleted.
     * - A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.
     * - Bots can delete outgoing messages in private chats, groups, and supergroups.
     * - Bots can delete incoming messages in private chats.
     * - Bots granted can_post_messages permissions can delete outgoing messages in channels.
     * - If the bot is an administrator of a group, it can delete any message there.
     * - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
     * Returns True on success.
     * @link https://core.telegram.org/bots/api#deletemessage
     * @param int|string $chatId
     * @param int $messageId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteMessage(int|string $chatId, int $messageId): bool {
        return $this->request('deleteMessage', [
            'chat_id' => $chatId,
            'message_id' => $messageId
        ]);
    }

    /**
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     * @param int $userId
     * @param int $offset
     * @param int $limit
     * @return UserProfilePhotos
     * @throws Exception
     * @throws GuzzleException
     */
    public function getUserProfilePhotos(int $userId, int $offset = 0, int $limit = 100): UserProfilePhotos {
        $data = $this->request('getUserProfilePhotos', [
            'user_id' => $userId,
            'offset' => $offset,
            'limit' => $limit
        ]);
        return UserProfilePhotos::fromArray($data);
    }

    /**
     * @param string $method
     * @param string $key
     * @param int|string $chatId
     * @param string $attachment
     * @param string|null $caption
     * @param string|null $thumbnail
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    protected function sendAttachment(string $method, string $key, int|string $chatId, string $attachment, ?string $caption = null, ?string $thumbnail = null, array $options = []): Message {
        if (file_exists($attachment)) $attachment = fopen($attachment, 'r');
        if ($thumbnail && file_exists($thumbnail)) $thumbnail = fopen($thumbnail, 'r');
        $data = $this->request($method, [
            'chat_id' => $chatId,
            $key => $attachment,
            'caption' => $caption,
            'thumbnail' => $thumbnail,
            ...$options
        ], multipart: is_resource($attachment) || is_resource($thumbnail));
        if (is_resource($attachment)) fclose($attachment);
        if (is_resource($thumbnail)) fclose($thumbnail);
        return Message::fromArray($data);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed
     * to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
     * Alternatively, the user can be redirected to the specified Game URL. For this option to work, you must first
     * create a game for your bot via @BotFather and accept the terms. Otherwise, you may use links like
     * t.me/your_bot?start=XXXX that open your bot with a parameter.
     * @link https://core.telegram.org/bots/api#answercallbackquery
     * @param int $callbackQueryId
     * @param string|null $text
     * @param bool|null $showAlert
     * @param string|null $url
     * @param int $cacheTime
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function answerCallbackQuery(int $callbackQueryId, ?string $text = null, ?bool $showAlert = false, ?string $url = null, int $cacheTime = 0): bool {
        $params = [
            'callback_query_id' => $callbackQueryId,
            'show_alert' => $showAlert,
            'cache_time' => $cacheTime
        ];
        if($text) $params['text'] = $text;
        if($url) $params['url'] = $url;
        return $this->request('answerCallbackQuery', $params);
    }

    public function getFile(string $fileId, string $savePath): void {
        $data = $this->request('getFile', ['file_id' => $fileId]);
        $file = File::fromArray($data);
        $tmpPath = '/tmp/' . uniqid($fileId) . '.tmp';
        $res = $this->client->get($this->fileBaseUri . $file->getFilePath(), ['sink' => $tmpPath]);
        $code = $res->getStatusCode();
        if ($code === 200) {
            if (!@rename($tmpPath, $savePath)) {
                @unlink($tmpPath);
                throw new Exception('Failed to save file to ' . $savePath);
            }
        } else {
            @unlink($tmpPath);
            throw new Exception('Failed to download file', $code);
        }
    }

    /**
     * Use this method to edit text and game messages. On success, if the edited message is not an inline message,
     * the edited Message is returned, otherwise True is returned.
     * @link https://core.telegram.org/bots/api#editmessagetext
     * @param int|string $chatId
     * @param int $messageId
     * @param string $text
     * @param ReplyMarkup|null $replyMarkup
     * @param array $options
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function editMessageText(int|string $chatId, int $messageId, string $text, ?ReplyMarkup $replyMarkup = null, array $options = []): Message {
        $text = str_replace('\n', "\n", $text);
        $params = [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
            'parse_mode' => 'html',
            'disable_web_page_preview' => 1,
            ...$options
        ];
        if($replyMarkup) $params['reply_markup'] = $replyMarkup->toArray();
        $data = self::request('editMessageText', $params);
        return Message::fromArray($data);
    }

    /**
     * Use this method to send invoices. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendinvoice
     * @param int|string $chatId
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param array $prices
     * @param string $currency
     * @param array $options
     * @return Invoice
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendInvoice(int|string $chatId, string $title, string $description, string $payload, array $prices = [], string $currency = 'XTR', array $options = []): Invoice {
        $data = $this->request('sendInvoice', [
            'chat_id' => $chatId,
            'title' => $title,
            'description' => $description,
            'payload' => $payload,
            'prices' => $prices,
            'currency' => $currency,
            ...$options
        ]);
        return Invoice::fromArray($data);
    }

    public function answerPreCheckoutQuery(string $preCheckoutQueryId, bool $ok, ?string $errorMessage = null): bool {
        $params = ['pre_checkout_query_id' => $preCheckoutQueryId, 'ok' => $ok,];
        if($errorMessage) $params['error_message'] = $errorMessage;
        return $this->request('answerPreCheckoutQuery', $params);
    }

    public function setWebhook(string $url, array $options = []): void {
        self::request('setWebhook', [
            'url' => $url,
            ...$options
        ]);
    }

    public function getWebhookInfo(): WebhookInfo {
        $data = self::request('getWebhookInfo');
        return WebhookInfo::fromArray($data);
    }

}
