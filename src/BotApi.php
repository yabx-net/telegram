<?php

namespace Yabx\Telegram;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Throwable;
use Yabx\Telegram\Enum\ChatAction;
use Yabx\Telegram\Objects\BotCommand;
use Yabx\Telegram\Objects\BotCommandScope;
use Yabx\Telegram\Objects\BotDescription;
use Yabx\Telegram\Objects\BotName;
use Yabx\Telegram\Objects\BotShortDescription;
use Yabx\Telegram\Objects\BusinessConnection;
use Yabx\Telegram\Objects\ChatAdministratorRights;
use Yabx\Telegram\Objects\ChatFullInfo;
use Yabx\Telegram\Objects\ChatInviteLink;
use Yabx\Telegram\Objects\ChatMember;
use Yabx\Telegram\Objects\ChatPermissions;
use Yabx\Telegram\Objects\File;
use Yabx\Telegram\Objects\ForceReply;
use Yabx\Telegram\Objects\ForumTopic;
use Yabx\Telegram\Objects\GameHighScore;
use Yabx\Telegram\Objects\Gifts;
use Yabx\Telegram\Objects\InlineKeyboardMarkup;
use Yabx\Telegram\Objects\InlineQueryResult;
use Yabx\Telegram\Objects\InlineQueryResultsButton;
use Yabx\Telegram\Objects\InputSticker;
use Yabx\Telegram\Objects\LinkPreviewOptions;
use Yabx\Telegram\Objects\MaskPosition;
use Yabx\Telegram\Objects\MenuButton;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\MessageId;
use Yabx\Telegram\Objects\Poll;
use Yabx\Telegram\Objects\PreparedInlineMessage;
use Yabx\Telegram\Objects\ReplyKeyboardMarkup;
use Yabx\Telegram\Objects\ReplyKeyboardRemove;
use Yabx\Telegram\Objects\ReplyParameters;
use Yabx\Telegram\Objects\SentWebAppMessage;
use Yabx\Telegram\Objects\StarTransactions;
use Yabx\Telegram\Objects\Sticker;
use Yabx\Telegram\Objects\StickerSet;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Objects\User;
use Yabx\Telegram\Objects\UserChatBoosts;
use Yabx\Telegram\Objects\UserProfilePhotos;
use Yabx\Telegram\Objects\WebhookInfo;

class BotApi {

    protected string $apiUrl;
    protected Client $client;
    protected string $token;
    protected ?LoggerInterface $logger;

    public function __construct(string $token, array $guzzleOptions = [], LoggerInterface $logger = null, string $apiUrl = 'https://api.telegram.org') {
        $this->client = new Client([
            'http_errors' => false,
            ...$guzzleOptions
        ]);
        $this->logger = $logger ?? new NullLogger;
        $this->apiUrl = $apiUrl;
        $this->token = $token;
    }

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

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param array|null $allowedUpdates
     * @return Update[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function getUpdates(?int $offset = null, ?int $limit = null, ?int $timeout = null, ?array $allowedUpdates = null): array {
        $params = [];
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        if (isset($timeout)) $params['timeout'] = $timeout;
        if (isset($allowedUpdates)) $params['allowed_updates'] = $allowedUpdates;
        return Update::arrayOf($this->request('getUpdates', $params));
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
        $params = array_map(fn(mixed $param) => is_object($param) && method_exists($param, 'toArray') ? call_user_func([$param, 'toArray']) : $param, $params);
        $this->logger->debug('REQUEST: ' . $method, $params);
        $endpoint = sprintf('%s/bot%s/', $this->apiUrl, $this->token);
        try {
            if ($multipart) {
                $multipart = [];
                foreach ($params as $key => $value) {
                    $multipart[] = ['name' => $key, 'contents' => is_array($value) ? json_encode($value) : $value];
                }
                $res = $this->client->post($endpoint . $method, [RequestOptions::MULTIPART => $multipart]);
            } else {
                $res = $this->client->post($endpoint . $method, [RequestOptions::JSON => $params]);
            }
            $json = json_decode($res->getBody()->__toString(), true);
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new Exception($e->getMessage());
        }
        if ($json['ok'] ?? false) {
            $this->logger->debug('RESPONSE', $json);
            return $json['result'];
        } else {
            $this->logger->debug('ERROR', $json);
            throw new Exception($json['description'] ?? 'Unknown error', $json['code'] ?? 500);
        }
    }

    public function setWebhook(string $url, ?string $ipAddress = null, ?int $maxConnections = null, ?array $allowedUpdates = null, ?bool $dropPendingUpdates = null, ?string $secretToken = null): bool {
        $params = [];
        $params['url'] = $url;
        if (isset($certificate)) $params['certificate'] = $certificate;
        if (isset($ipAddress)) $params['ip_address'] = $ipAddress;
        if (isset($maxConnections)) $params['max_connections'] = $maxConnections;
        if (isset($allowedUpdates)) $params['allowed_updates'] = $allowedUpdates;
        if (isset($dropPendingUpdates)) $params['drop_pending_updates'] = $dropPendingUpdates;
        if (isset($secretToken)) $params['secret_token'] = $secretToken;
        return $this->request('setWebhook', $params);
    }

    public function deleteWebhook(?bool $dropPendingUpdates = null): bool {
        $params = [];
        if (isset($dropPendingUpdates)) $params['drop_pending_updates'] = $dropPendingUpdates;
        return $this->request('deleteWebhook', $params);
    }

    public function getWebhookInfo(): WebhookInfo {
        $params = [];

        return WebhookInfo::fromArray($this->request('getWebhookInfo', $params));
    }

    public function getMe(): User {
        $params = [];

        return User::fromArray($this->request('getMe', $params));
    }

    public function logOut(): bool {
        $params = [];

        return $this->request('logOut', $params);
    }

    public function close(): bool {
        $params = [];

        return $this->request('close', $params);
    }

    public function sendMessage(int|string $chatId, string $text, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $parseMode = null, ?array $entities = null, ?LinkPreviewOptions $linkPreviewOptions = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['text'] = $text;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($entities)) $params['entities'] = $entities;
        if (isset($linkPreviewOptions)) $params['link_preview_options'] = $linkPreviewOptions;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendMessage', $params));
    }

    public function forwardMessage(int|string $chatId, int|string $fromChatId, int $messageId, ?int $messageThreadId = null, ?bool $disableNotification = null, ?bool $protectContent = null): Message {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['from_chat_id'] = $fromChatId;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        $params['message_id'] = $messageId;
        return Message::fromArray($this->request('forwardMessage', $params));
    }

    /**
     * @param int|string $chatId
     * @param int|string $fromChatId
     * @param array $messageIds
     * @param int|null $messageThreadId
     * @param bool|null $disableNotification
     * @param bool|null $protectContent
     * @return MessageId[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function forwardMessages(int|string $chatId, int|string $fromChatId, array $messageIds, ?int $messageThreadId = null, ?bool $disableNotification = null, ?bool $protectContent = null): array {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['from_chat_id'] = $fromChatId;
        $params['message_ids'] = $messageIds;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        return MessageId::arrayOf($this->request('forwardMessages', $params));
    }

    public function copyMessage(int|string $chatId, int|string $fromChatId, int $messageId, ?int $messageThreadId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): MessageId {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['from_chat_id'] = $fromChatId;
        $params['message_id'] = $messageId;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($showCaptionAboveMedia)) $params['show_caption_above_media'] = $showCaptionAboveMedia;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return MessageId::fromArray($this->request('copyMessage', $params));
    }

    /**
     * @param int|string $chatId
     * @param int|string $fromChatId
     * @param array $messageIds
     * @param int|null $messageThreadId
     * @param bool|null $disableNotification
     * @param bool|null $protectContent
     * @param bool|null $removeCaption
     * @return MessageId[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function copyMessages(int|string $chatId, int|string $fromChatId, array $messageIds, ?int $messageThreadId = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?bool $removeCaption = null): array {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['from_chat_id'] = $fromChatId;
        $params['message_ids'] = $messageIds;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($removeCaption)) $params['remove_caption'] = $removeCaption;
        return MessageId::arrayOf($this->request('copyMessages', $params));
    }

    public function sendPhoto(int|string $chatId, string $photo, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?bool $hasSpoiler = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        if (file_exists($photo)) $photo = fopen($photo, 'r');
        $params = [];
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['photo'] = $photo;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($showCaptionAboveMedia)) $params['show_caption_above_media'] = $showCaptionAboveMedia;
        if (isset($hasSpoiler)) $params['has_spoiler'] = $hasSpoiler;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendPhoto', $params, is_resource($photo)));
    }

    public function sendAudio(int|string $chatId, string $audio, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?int $duration = null, ?string $performer = null, ?string $title = null, ?string $thumbnail = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['audio'] = $audio;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($duration)) $params['duration'] = $duration;
        if (isset($performer)) $params['performer'] = $performer;
        if (isset($title)) $params['title'] = $title;
        if (isset($thumbnail)) $params['thumbnail'] = $thumbnail;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendAudio', $params));
    }

    public function sendDocument(int|string $chatId, string $document, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $thumbnail = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $disableContentTypeDetection = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        if (file_exists($document)) $document = fopen($document, 'r');
        $params['document'] = $document;
        if (isset($thumbnail)) {
            if (file_exists($thumbnail)) $thumbnail = fopen($thumbnail, 'r');
            $params['thumbnail'] = $thumbnail;
        }
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($disableContentTypeDetection)) $params['disable_content_type_detection'] = $disableContentTypeDetection;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendDocument', $params, is_resource($document) || is_resource($thumbnail)));
    }

    public function sendVideo(int|string $chatId, string $video, ?string $businessConnectionId = null, ?bool $showCaptionAboveMedia = null, ?ReplyParameters $replyParameters = null, ?string $messageEffectId = null, ?bool $protectContent = null, ?bool $disableNotification = null, ?bool $supportsStreaming = null, ?bool $hasSpoiler = null, ?string $parseMode = null, ?array $captionEntities = null, ?string $caption = null, ?string $thumbnail = null, ?int $height = null, ?int $width = null, ?int $duration = null, ?int $messageThreadId = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        if (file_exists($video)) $video = fopen($video, 'r');
        $params['video'] = $video;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($duration)) $params['duration'] = $duration;
        if (isset($width)) $params['width'] = $width;
        if (isset($height)) $params['height'] = $height;
        if (isset($thumbnail)) {
            if (file_exists($thumbnail)) $thumbnail = fopen($thumbnail, 'r');
            $params['thumbnail'] = $thumbnail;
        }
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($showCaptionAboveMedia)) $params['show_caption_above_media'] = $showCaptionAboveMedia;
        if (isset($hasSpoiler)) $params['has_spoiler'] = $hasSpoiler;
        if (isset($supportsStreaming)) $params['supports_streaming'] = $supportsStreaming;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendVideo', $params, is_resource($video) || is_resource($thumbnail)));
    }

    public function sendAnimation(int|string $chatId, string $animation, ?string $businessConnectionId = null, ?ReplyParameters $replyParameters = null, ?string $messageEffectId = null, ?bool $protectContent = null, ?bool $disableNotification = null, ?bool $hasSpoiler = null, ?bool $showCaptionAboveMedia = null, ?string $parseMode = null, ?array $captionEntities = null, ?string $caption = null, ?string $thumbnail = null, ?int $height = null, ?int $width = null, ?int $duration = null, ?int $messageThreadId = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        if (file_exists($animation)) $animation = fopen($animation, 'r');
        $params['animation'] = $animation;
        if (isset($duration)) $params['duration'] = $duration;
        if (isset($width)) $params['width'] = $width;
        if (isset($height)) $params['height'] = $height;
        if (isset($thumbnail)) {
            if (file_exists($thumbnail)) $thumbnail = fopen($thumbnail, 'r');
            $params['thumbnail'] = $thumbnail;
        }
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($showCaptionAboveMedia)) $params['show_caption_above_media'] = $showCaptionAboveMedia;
        if (isset($hasSpoiler)) $params['has_spoiler'] = $hasSpoiler;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendAnimation', $params, is_resource($animation) || is_resource($thumbnail)));
    }

    public function sendVoice(int|string $chatId, string $voice, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?int $duration = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        if (file_exists($voice)) $voice = fopen($voice, 'r');
        $params['voice'] = $voice;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($duration)) $params['duration'] = $duration;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendVoice', $params, is_resource($voice)));
    }

    public function sendVideoNote(int|string $chatId, string $videoNote, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?int $duration = null, ?int $length = null, ?string $thumbnail = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        if (file_exists($videoNote)) $videoNote = fopen($videoNote, 'r');
        $params['video_note'] = $videoNote;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($duration)) $params['duration'] = $duration;
        if (isset($length)) $params['length'] = $length;
        if (isset($thumbnail)) {
            if (file_exists($thumbnail)) $thumbnail = fopen($thumbnail, 'r');
            $params['thumbnail'] = $thumbnail;
        }
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendVideoNote', $params, is_resource($videoNote) || is_resource($thumbnail)));
    }

    public function sendPaidMedia(int|string $chatId, int $starCount, array $media, ?string $payload = null, ?string $businessConnectionId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        $params['star_count'] = $starCount;
        $params['media'] = $media;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($payload)) $params['payload'] = $payload;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($showCaptionAboveMedia)) $params['show_caption_above_media'] = $showCaptionAboveMedia;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendPaidMedia', $params));
    }

    /**
     * @param int|string $chatId
     * @param array $media
     * @param string|null $businessConnectionId
     * @param int|null $messageThreadId
     * @param bool|null $disableNotification
     * @param bool|null $protectContent
     * @param string|null $messageEffectId
     * @param ReplyParameters|null $replyParameters
     * @param bool|null $allowPaidBroadcast
     * @return Message[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendMediaGroup(int|string $chatId, array $media, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, ?bool $allowPaidBroadcast = null): array {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['media'] = $media;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        return Message::arrayOf($this->request('sendMediaGroup', $params));
    }

    public function sendLocation(int|string $chatId, float $latitude, float $longitude, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?float $horizontalAccuracy = null, ?int $livePeriod = null, ?int $heading = null, ?int $proximityAlertRadius = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['latitude'] = $latitude;
        $params['longitude'] = $longitude;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($horizontalAccuracy)) $params['horizontal_accuracy'] = $horizontalAccuracy;
        if (isset($livePeriod)) $params['live_period'] = $livePeriod;
        if (isset($heading)) $params['heading'] = $heading;
        if (isset($proximityAlertRadius)) $params['proximity_alert_radius'] = $proximityAlertRadius;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendLocation', $params));
    }

    public function sendVenue(int|string $chatId, float $latitude, float $longitude, string $title, string $address, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $foursquareId = null, ?string $foursquareType = null, ?string $googlePlaceId = null, ?string $googlePlaceType = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['latitude'] = $latitude;
        $params['longitude'] = $longitude;
        $params['title'] = $title;
        $params['address'] = $address;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($foursquareId)) $params['foursquare_id'] = $foursquareId;
        if (isset($foursquareType)) $params['foursquare_type'] = $foursquareType;
        if (isset($googlePlaceId)) $params['google_place_id'] = $googlePlaceId;
        if (isset($googlePlaceType)) $params['google_place_type'] = $googlePlaceType;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendVenue', $params));
    }

    public function sendContact(int|string $chatId, string $phoneNumber, string $firstName, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $lastName = null, ?string $vcard = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['phone_number'] = $phoneNumber;
        $params['first_name'] = $firstName;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($lastName)) $params['last_name'] = $lastName;
        if (isset($vcard)) $params['vcard'] = $vcard;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendContact', $params));
    }

    public function sendPoll(int|string $chatId, string $question, array $options, ?string $businessConnectionId = null, ?array $explanationEntities = null, ?ReplyParameters $replyParameters = null, ?string $messageEffectId = null, ?bool $protectContent = null, ?bool $disableNotification = null, ?bool $isClosed = null, ?int $closeDate = null, ?int $openPeriod = null, ?string $explanation = null, ?string $explanationParseMode = null, ?int $correctOptionId = null, ?bool $allowsMultipleAnswers = null, ?string $type = null, ?bool $isAnonymous = null, ?array $questionEntities = null, ?string $questionParseMode = null, ?int $messageThreadId = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['question'] = $question;
        if (isset($questionParseMode)) $params['question_parse_mode'] = $questionParseMode;
        if (isset($questionEntities)) $params['question_entities'] = $questionEntities;
        $params['options'] = $options;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($isAnonymous)) $params['is_anonymous'] = $isAnonymous;
        if (isset($type)) $params['type'] = $type;
        if (isset($allowsMultipleAnswers)) $params['allows_multiple_answers'] = $allowsMultipleAnswers;
        if (isset($correctOptionId)) $params['correct_option_id'] = $correctOptionId;
        if (isset($explanation)) $params['explanation'] = $explanation;
        if (isset($explanationParseMode)) $params['explanation_parse_mode'] = $explanationParseMode;
        if (isset($explanationEntities)) $params['explanation_entities'] = $explanationEntities;
        if (isset($openPeriod)) $params['open_period'] = $openPeriod;
        if (isset($closeDate)) $params['close_date'] = $closeDate;
        if (isset($isClosed)) $params['is_closed'] = $isClosed;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendPoll', $params));
    }

    public function sendDice(int|string $chatId, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $emoji = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        if (isset($emoji)) $params['emoji'] = $emoji;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendDice', $params));
    }

    public function sendChatAction(int|string $chatId, ChatAction $action, ?string $businessConnectionId = null, ?int $messageThreadId = null): bool {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['action'] = $action->value;
        return $this->request('sendChatAction', $params);
    }

    public function setMessageReaction(int|string $chatId, int $messageId, ?array $reaction = null, ?bool $isBig = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($reaction)) $params['reaction'] = $reaction;
        if (isset($isBig)) $params['is_big'] = $isBig;
        return $this->request('setMessageReaction', $params);
    }

    public function getUserProfilePhotos(int $userId, ?int $offset = null, ?int $limit = null): UserProfilePhotos {
        $params = [];
        $params['user_id'] = $userId;
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        return UserProfilePhotos::fromArray($this->request('getUserProfilePhotos', $params));
    }

    public function banChatMember(int|string $chatId, int $userId, ?int $untilDate = null, ?bool $revokeMessages = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        if (isset($untilDate)) $params['until_date'] = $untilDate;
        if (isset($revokeMessages)) $params['revoke_messages'] = $revokeMessages;
        return $this->request('banChatMember', $params);
    }

    public function unbanChatMember(int|string $chatId, int $userId, ?bool $onlyIfBanned = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        if (isset($onlyIfBanned)) $params['only_if_banned'] = $onlyIfBanned;
        return $this->request('unbanChatMember', $params);
    }

    public function restrictChatMember(int|string $chatId, int $userId, ChatPermissions $permissions, ?bool $useIndependentChatPermissions = null, ?int $untilDate = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        $params['permissions'] = $permissions;
        if (isset($useIndependentChatPermissions)) $params['use_independent_chat_permissions'] = $useIndependentChatPermissions;
        if (isset($untilDate)) $params['until_date'] = $untilDate;
        return $this->request('restrictChatMember', $params);
    }

    public function promoteChatMember(int|string $chatId, int $userId, ?bool $canPinMessages = null, ?bool $canEditMessages = null, ?bool $canPostMessages = null, ?bool $canDeleteStories = null, ?bool $canEditStories = null, ?bool $canPostStories = null, ?bool $canChangeInfo = null, ?bool $canInviteUsers = null, ?bool $canPromoteMembers = null, ?bool $canRestrictMembers = null, ?bool $canManageVideoChats = null, ?bool $canDeleteMessages = null, ?bool $canManageChat = null, ?bool $isAnonymous = null, ?bool $canManageTopics = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        if (isset($isAnonymous)) $params['is_anonymous'] = $isAnonymous;
        if (isset($canManageChat)) $params['can_manage_chat'] = $canManageChat;
        if (isset($canDeleteMessages)) $params['can_delete_messages'] = $canDeleteMessages;
        if (isset($canManageVideoChats)) $params['can_manage_video_chats'] = $canManageVideoChats;
        if (isset($canRestrictMembers)) $params['can_restrict_members'] = $canRestrictMembers;
        if (isset($canPromoteMembers)) $params['can_promote_members'] = $canPromoteMembers;
        if (isset($canChangeInfo)) $params['can_change_info'] = $canChangeInfo;
        if (isset($canInviteUsers)) $params['can_invite_users'] = $canInviteUsers;
        if (isset($canPostStories)) $params['can_post_stories'] = $canPostStories;
        if (isset($canEditStories)) $params['can_edit_stories'] = $canEditStories;
        if (isset($canDeleteStories)) $params['can_delete_stories'] = $canDeleteStories;
        if (isset($canPostMessages)) $params['can_post_messages'] = $canPostMessages;
        if (isset($canEditMessages)) $params['can_edit_messages'] = $canEditMessages;
        if (isset($canPinMessages)) $params['can_pin_messages'] = $canPinMessages;
        if (isset($canManageTopics)) $params['can_manage_topics'] = $canManageTopics;
        return $this->request('promoteChatMember', $params);
    }

    public function setChatAdministratorCustomTitle(int|string $chatId, int $userId, string $customTitle): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        $params['custom_title'] = $customTitle;
        return $this->request('setChatAdministratorCustomTitle', $params);
    }

    public function banChatSenderChat(int|string $chatId, int $senderChatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['sender_chat_id'] = $senderChatId;
        return $this->request('banChatSenderChat', $params);
    }

    public function unbanChatSenderChat(int|string $chatId, int $senderChatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['sender_chat_id'] = $senderChatId;
        return $this->request('unbanChatSenderChat', $params);
    }

    public function setChatPermissions(int|string $chatId, ChatPermissions $permissions, ?bool $useIndependentChatPermissions = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['permissions'] = $permissions;
        if (isset($useIndependentChatPermissions)) $params['use_independent_chat_permissions'] = $useIndependentChatPermissions;
        return $this->request('setChatPermissions', $params);
    }

    public function exportChatInviteLink(int|string $chatId): string {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('exportChatInviteLink', $params);
    }

    public function createChatInviteLink(int|string $chatId, ?string $name = null, ?int $expireDate = null, ?int $memberLimit = null, ?bool $createsJoinRequest = null): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($name)) $params['name'] = $name;
        if (isset($expireDate)) $params['expire_date'] = $expireDate;
        if (isset($memberLimit)) $params['member_limit'] = $memberLimit;
        if (isset($createsJoinRequest)) $params['creates_join_request'] = $createsJoinRequest;
        return ChatInviteLink::fromArray($this->request('createChatInviteLink', $params));
    }

    public function editChatInviteLink(int|string $chatId, string $inviteLink, ?string $name = null, ?int $expireDate = null, ?int $memberLimit = null, ?bool $createsJoinRequest = null): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['invite_link'] = $inviteLink;
        if (isset($name)) $params['name'] = $name;
        if (isset($expireDate)) $params['expire_date'] = $expireDate;
        if (isset($memberLimit)) $params['member_limit'] = $memberLimit;
        if (isset($createsJoinRequest)) $params['creates_join_request'] = $createsJoinRequest;
        return ChatInviteLink::fromArray($this->request('editChatInviteLink', $params));
    }

    public function createChatSubscriptionInviteLink(int|string $chatId, int $subscriptionPeriod, int $subscriptionPrice, ?string $name = null): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($name)) $params['name'] = $name;
        $params['subscription_period'] = $subscriptionPeriod;
        $params['subscription_price'] = $subscriptionPrice;
        return ChatInviteLink::fromArray($this->request('createChatSubscriptionInviteLink', $params));
    }

    public function editChatSubscriptionInviteLink(int|string $chatId, string $inviteLink, ?string $name = null): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['invite_link'] = $inviteLink;
        if (isset($name)) $params['name'] = $name;
        return ChatInviteLink::fromArray($this->request('editChatSubscriptionInviteLink', $params));
    }

    public function revokeChatInviteLink(int|string $chatId, string $inviteLink): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['invite_link'] = $inviteLink;
        return ChatInviteLink::fromArray($this->request('revokeChatInviteLink', $params));
    }

    public function approveChatJoinRequest(int|string $chatId, int $userId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return $this->request('approveChatJoinRequest', $params);
    }

    public function declineChatJoinRequest(int|string $chatId, int $userId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return $this->request('declineChatJoinRequest', $params);
    }

    public function setChatPhoto(int|string $chatId, $photo): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['photo'] = $photo;
        return $this->request('setChatPhoto', $params);
    }

    public function deleteChatPhoto(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('deleteChatPhoto', $params);
    }

    public function setChatTitle(int|string $chatId, string $title): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['title'] = $title;
        return $this->request('setChatTitle', $params);
    }

    public function setChatDescription(int|string $chatId, ?string $description = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($description)) $params['description'] = $description;
        return $this->request('setChatDescription', $params);
    }

    public function pinChatMessage(int|string $chatId, int $messageId, ?string $businessConnectionId = null, ?bool $disableNotification = null): bool {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        return $this->request('pinChatMessage', $params);
    }

    public function unpinChatMessage(int|string $chatId, ?string $businessConnectionId = null, ?int $messageId = null): bool {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        return $this->request('unpinChatMessage', $params);
    }

    public function unpinAllChatMessages(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('unpinAllChatMessages', $params);
    }

    public function leaveChat(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('leaveChat', $params);
    }

    public function getChat(int|string $chatId): ChatFullInfo {
        $params = [];
        $params['chat_id'] = $chatId;
        return ChatFullInfo::fromArray($this->request('getChat', $params));
    }

    /**
     * @param int|string $chatId
     * @return ChatMember[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function getChatAdministrators(int|string $chatId): array {
        $params = [];
        $params['chat_id'] = $chatId;
        return ChatMember::arrayOf($this->request('getChatAdministrators', $params));
    }

    public function getChatMemberCount(int|string $chatId): int {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('getChatMemberCount', $params);
    }

    public function getChatMember(int|string $chatId, int $userId): ChatMember {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return ChatMember::fromArray($this->request('getChatMember', $params));
    }

    public function setChatStickerSet(int|string $chatId, string $stickerSetName): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['sticker_set_name'] = $stickerSetName;
        return $this->request('setChatStickerSet', $params);
    }

    public function deleteChatStickerSet(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('deleteChatStickerSet', $params);
    }

    public function getForumTopicIconStickers(): array {
        $params = [];
        return Sticker::arrayOf($this->request('getForumTopicIconStickers', $params));
    }

    public function createForumTopic(int|string $chatId, string $name, ?int $iconColor = null, ?string $iconCustomEmojiId = null): ForumTopic {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['name'] = $name;
        if (isset($iconColor)) $params['icon_color'] = $iconColor;
        if (isset($iconCustomEmojiId)) $params['icon_custom_emoji_id'] = $iconCustomEmojiId;
        return ForumTopic::fromArray($this->request('createForumTopic', $params));
    }

    public function editForumTopic(int|string $chatId, int $messageThreadId, ?string $name = null, ?string $iconCustomEmojiId = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        if (isset($name)) $params['name'] = $name;
        if (isset($iconCustomEmojiId)) $params['icon_custom_emoji_id'] = $iconCustomEmojiId;
        return $this->request('editForumTopic', $params);
    }

    public function closeForumTopic(int|string $chatId, int $messageThreadId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        return $this->request('closeForumTopic', $params);
    }

    public function reopenForumTopic(int|string $chatId, int $messageThreadId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        return $this->request('reopenForumTopic', $params);
    }

    public function deleteForumTopic(int|string $chatId, int $messageThreadId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        return $this->request('deleteForumTopic', $params);
    }

    public function unpinAllForumTopicMessages(int|string $chatId, int $messageThreadId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        return $this->request('unpinAllForumTopicMessages', $params);
    }

    public function editGeneralForumTopic(int|string $chatId, string $name): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['name'] = $name;
        return $this->request('editGeneralForumTopic', $params);
    }

    public function closeGeneralForumTopic(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('closeGeneralForumTopic', $params);
    }

    public function reopenGeneralForumTopic(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('reopenGeneralForumTopic', $params);
    }

    public function hideGeneralForumTopic(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('hideGeneralForumTopic', $params);
    }

    public function unhideGeneralForumTopic(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('unhideGeneralForumTopic', $params);
    }

    public function unpinAllGeneralForumTopicMessages(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('unpinAllGeneralForumTopicMessages', $params);
    }

    public function answerCallbackQuery(string $callbackQueryId, ?string $text = null, ?bool $showAlert = null, ?string $url = null, ?int $cacheTime = null): bool {
        $params = [];
        $params['callback_query_id'] = $callbackQueryId;
        if (isset($text)) $params['text'] = $text;
        if (isset($showAlert)) $params['show_alert'] = $showAlert;
        if (isset($url)) $params['url'] = $url;
        if (isset($cacheTime)) $params['cache_time'] = $cacheTime;
        return $this->request('answerCallbackQuery', $params);
    }

    public function getUserChatBoosts(int|string $chatId, int $userId): UserChatBoosts {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return UserChatBoosts::fromArray($this->request('getUserChatBoosts', $params));
    }

    public function getBusinessConnection(string $businessConnectionId): BusinessConnection {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        return BusinessConnection::fromArray($this->request('getBusinessConnection', $params));
    }

    public function setMyCommands(array $commands, ?BotCommandScope $scope = null, ?string $languageCode = null): bool {
        $params = [];
        $params['commands'] = $commands;
        if (isset($scope)) $params['scope'] = $scope;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('setMyCommands', $params);
    }

    public function deleteMyCommands(?BotCommandScope $scope = null, ?string $languageCode = null): bool {
        $params = [];
        if (isset($scope)) $params['scope'] = $scope;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('deleteMyCommands', $params);
    }

    /**
     * @param BotCommandScope|null $scope
     * @param string|null $languageCode
     * @return BotCommand[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyCommands(?BotCommandScope $scope = null, ?string $languageCode = null): array {
        $params = [];
        if (isset($scope)) $params['scope'] = $scope;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return BotCommand::arrayOf($this->request('getMyCommands', $params));
    }

    public function setMyName(?string $name = null, ?string $languageCode = null): bool {
        $params = [];
        if (isset($name)) $params['name'] = $name;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('setMyName', $params);
    }

    public function getMyName(?string $languageCode = null): BotName {
        $params = [];
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return BotName::fromArray($this->request('getMyName', $params));
    }

    public function setMyDescription(?string $description = null, ?string $languageCode = null): bool {
        $params = [];
        if (isset($description)) $params['description'] = $description;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('setMyDescription', $params);
    }

    public function getMyDescription(?string $languageCode = null): BotDescription {
        $params = [];
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return BotDescription::fromArray($this->request('getMyDescription', $params));
    }

    public function setMyShortDescription(?string $shortDescription = null, ?string $languageCode = null): bool {
        $params = [];
        if (isset($shortDescription)) $params['short_description'] = $shortDescription;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('setMyShortDescription', $params);
    }

    public function getMyShortDescription(?string $languageCode = null): BotShortDescription {
        $params = [];
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return BotShortDescription::fromArray($this->request('getMyShortDescription', $params));
    }

    public function setChatMenuButton(?int $chatId = null, ?MenuButton $menuButton = null): bool {
        $params = [];
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($menuButton)) $params['menu_button'] = $menuButton;
        return $this->request('setChatMenuButton', $params);
    }

    public function getChatMenuButton(?int $chatId = null): MenuButton {
        $params = [];
        if (isset($chatId)) $params['chat_id'] = $chatId;
        return MenuButton::fromArray($this->request('getChatMenuButton', $params));
    }

    public function setMyDefaultAdministratorRights(?ChatAdministratorRights $rights = null, ?bool $forChannels = null): bool {
        $params = [];
        if (isset($rights)) $params['rights'] = $rights;
        if (isset($forChannels)) $params['for_channels'] = $forChannels;
        return $this->request('setMyDefaultAdministratorRights', $params);
    }

    public function getMyDefaultAdministratorRights(?bool $forChannels = null): ChatAdministratorRights {
        $params = [];
        if (isset($forChannels)) $params['for_channels'] = $forChannels;
        return ChatAdministratorRights::fromArray($this->request('getMyDefaultAdministratorRights', $params));
    }

    public function editMessageText(string $text, ?string $businessConnectionId = null, int|string $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?string $parseMode = null, ?array $entities = null, ?LinkPreviewOptions $linkPreviewOptions = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        $params['text'] = $text;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($entities)) $params['entities'] = $entities;
        if (isset($linkPreviewOptions)) $params['link_preview_options'] = $linkPreviewOptions;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('editMessageText', $params));
    }

    public function editMessageCaption(?string $businessConnectionId = null, int|string $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($showCaptionAboveMedia)) $params['show_caption_above_media'] = $showCaptionAboveMedia;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('editMessageCaption', $params));
    }

    public function editMessageMedia(string $media, ?string $businessConnectionId = null, int|string $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        if (file_exists($media)) $params['media'] = fopen($media, 'r');
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('editMessageMedia', $params, true));
    }

    public function editMessageLiveLocation(float $latitude, float $longitude, ?string $businessConnectionId = null, int|string $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?int $livePeriod = null, ?float $horizontalAccuracy = null, ?int $heading = null, ?int $proximityAlertRadius = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        $params['latitude'] = $latitude;
        $params['longitude'] = $longitude;
        if (isset($livePeriod)) $params['live_period'] = $livePeriod;
        if (isset($horizontalAccuracy)) $params['horizontal_accuracy'] = $horizontalAccuracy;
        if (isset($heading)) $params['heading'] = $heading;
        if (isset($proximityAlertRadius)) $params['proximity_alert_radius'] = $proximityAlertRadius;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('editMessageLiveLocation', $params));
    }

    public function stopMessageLiveLocation(?string $businessConnectionId = null, int|string $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('stopMessageLiveLocation', $params));
    }

    public function editMessageReplyMarkup(?string $businessConnectionId = null, int|string $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('editMessageReplyMarkup', $params));
    }

    public function stopPoll(int|string $chatId, int $messageId, ?string $businessConnectionId = null, ?InlineKeyboardMarkup $replyMarkup = null): Poll {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Poll::fromArray($this->request('stopPoll', $params));
    }

    public function deleteMessage(int|string $chatId, int $messageId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        return $this->request('deleteMessage', $params);
    }

    public function deleteMessages(int|string $chatId, array $messageIds): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_ids'] = $messageIds;
        return $this->request('deleteMessages', $params);
    }

    public function sendSticker(int|string $chatId, string $sticker, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $emoji = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['sticker'] = $sticker;
        if (isset($emoji)) $params['emoji'] = $emoji;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendSticker', $params));
    }

    public function getStickerSet(string $name): StickerSet {
        $params = [];
        $params['name'] = $name;
        return StickerSet::fromArray($this->request('getStickerSet', $params));
    }

    /**
     * @param array $customEmojiIds
     * @return Sticker[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function getCustomEmojiStickers(array $customEmojiIds): array {
        $params = [];
        $params['custom_emoji_ids'] = $customEmojiIds;
        return Sticker::arrayOf($this->request('getCustomEmojiStickers', $params));
    }

    public function uploadStickerFile(int $userId, string $sticker, string $stickerFormat): File {
        $params = [];
        $params['user_id'] = $userId;
        $params['sticker'] = fopen($sticker, 'r');
        $params['sticker_format'] = $stickerFormat;
        return File::fromArray($this->request('uploadStickerFile', $params, true));
    }

    public function createNewStickerSet(int $userId, string $name, string $title, array $stickers, ?string $stickerType = null, ?bool $needsRepainting = null): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['name'] = $name;
        $params['title'] = $title;
        $params['stickers'] = $stickers;
        if (isset($stickerType)) $params['sticker_type'] = $stickerType;
        if (isset($needsRepainting)) $params['needs_repainting'] = $needsRepainting;
        return $this->request('createNewStickerSet', $params);
    }

    public function addStickerToSet(int $userId, string $name, InputSticker $sticker): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['name'] = $name;
        $params['sticker'] = $sticker;
        return $this->request('addStickerToSet', $params);
    }

    public function setStickerPositionInSet(string $sticker, int $position): bool {
        $params = [];
        $params['sticker'] = $sticker;
        $params['position'] = $position;
        return $this->request('setStickerPositionInSet', $params);
    }

    public function deleteStickerFromSet(string $sticker): bool {
        $params = [];
        $params['sticker'] = $sticker;
        return $this->request('deleteStickerFromSet', $params);
    }

    public function replaceStickerInSet(int $userId, string $name, string $oldSticker, InputSticker $sticker): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['name'] = $name;
        $params['old_sticker'] = $oldSticker;
        $params['sticker'] = $sticker;
        return $this->request('replaceStickerInSet', $params);
    }

    public function setStickerEmojiList(string $sticker, array $emojiList): bool {
        $params = [];
        $params['sticker'] = $sticker;
        $params['emoji_list'] = $emojiList;
        return $this->request('setStickerEmojiList', $params);
    }

    public function setStickerKeywords(string $sticker, ?array $keywords = null): bool {
        $params = [];
        $params['sticker'] = $sticker;
        if (isset($keywords)) $params['keywords'] = $keywords;
        return $this->request('setStickerKeywords', $params);
    }

    public function setStickerMaskPosition(string $sticker, ?MaskPosition $maskPosition = null): bool {
        $params = [];
        $params['sticker'] = $sticker;
        if (isset($maskPosition)) $params['mask_position'] = $maskPosition;
        return $this->request('setStickerMaskPosition', $params);
    }

    public function setStickerSetTitle(string $name, string $title): bool {
        $params = [];
        $params['name'] = $name;
        $params['title'] = $title;
        return $this->request('setStickerSetTitle', $params);
    }

    public function setStickerSetThumbnail(string $name, int $userId, string $format, ?string $thumbnail = null): bool {
        $params = [];
        $params['name'] = $name;
        $params['user_id'] = $userId;
        if (isset($thumbnail)) $params['thumbnail'] = $thumbnail;
        $params['format'] = $format;
        return $this->request('setStickerSetThumbnail', $params);
    }

    public function setCustomEmojiStickerSetThumbnail(string $name, ?string $customEmojiId = null): bool {
        $params = [];
        $params['name'] = $name;
        if (isset($customEmojiId)) $params['custom_emoji_id'] = $customEmojiId;
        return $this->request('setCustomEmojiStickerSetThumbnail', $params);
    }

    public function deleteStickerSet(string $name): bool {
        $params = [];
        $params['name'] = $name;
        return $this->request('deleteStickerSet', $params);
    }

    public function answerInlineQuery(string $inlineQueryId, array $results, ?int $cacheTime = null, ?bool $isPersonal = null, ?string $nextOffset = null, ?InlineQueryResultsButton $button = null): bool {
        $params = [];
        $params['inline_query_id'] = $inlineQueryId;
        $params['results'] = $results;
        if (isset($cacheTime)) $params['cache_time'] = $cacheTime;
        if (isset($isPersonal)) $params['is_personal'] = $isPersonal;
        if (isset($nextOffset)) $params['next_offset'] = $nextOffset;
        if (isset($button)) $params['button'] = $button;
        return $this->request('answerInlineQuery', $params);
    }

    public function answerWebAppQuery(string $webAppQueryId, InlineQueryResult $result): SentWebAppMessage {
        $params = [];
        $params['web_app_query_id'] = $webAppQueryId;
        $params['result'] = $result;
        return SentWebAppMessage::fromArray($this->request('answerWebAppQuery', $params));
    }

    public function sendInvoice(int|string $chatId, string $title, string $description, string $payload, string $currency, array $prices, ?bool $needPhoneNumber = null, ?ReplyParameters $replyParameters = null, ?string $messageEffectId = null, ?bool $protectContent = null, ?bool $disableNotification = null, ?bool $isFlexible = null, ?bool $sendEmailToProvider = null, ?bool $sendPhoneNumberToProvider = null, ?bool $needShippingAddress = null, ?bool $needEmail = null, ?int $photoWidth = null, ?bool $needName = null, ?int $photoHeight = null, ?int $messageThreadId = null, ?int $photoSize = null, ?string $photoUrl = null, ?string $providerData = null, ?string $startParameter = null, ?array $suggestedTipAmounts = null, ?int $maxTipAmount = null, ?string $providerToken = null, ?InlineKeyboardMarkup $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['title'] = $title;
        $params['description'] = $description;
        $params['payload'] = $payload;
        if (isset($providerToken)) $params['provider_token'] = $providerToken;
        $params['currency'] = $currency;
        $params['prices'] = $prices;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($maxTipAmount)) $params['max_tip_amount'] = $maxTipAmount;
        if (isset($suggestedTipAmounts)) $params['suggested_tip_amounts'] = $suggestedTipAmounts;
        if (isset($startParameter)) $params['start_parameter'] = $startParameter;
        if (isset($providerData)) $params['provider_data'] = $providerData;
        if (isset($photoUrl)) $params['photo_url'] = $photoUrl;
        if (isset($photoSize)) $params['photo_size'] = $photoSize;
        if (isset($photoWidth)) $params['photo_width'] = $photoWidth;
        if (isset($photoHeight)) $params['photo_height'] = $photoHeight;
        if (isset($needName)) $params['need_name'] = $needName;
        if (isset($needPhoneNumber)) $params['need_phone_number'] = $needPhoneNumber;
        if (isset($needEmail)) $params['need_email'] = $needEmail;
        if (isset($needShippingAddress)) $params['need_shipping_address'] = $needShippingAddress;
        if (isset($sendPhoneNumberToProvider)) $params['send_phone_number_to_provider'] = $sendPhoneNumberToProvider;
        if (isset($sendEmailToProvider)) $params['send_email_to_provider'] = $sendEmailToProvider;
        if (isset($isFlexible)) $params['is_flexible'] = $isFlexible;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendInvoice', $params));
    }

    public function createInvoiceLink(string $title, string $description, string $payload, string $currency, array $prices, ?string $businessConnectionId = null, ?int $photoHeight = null, ?bool $sendEmailToProvider = null, ?bool $sendPhoneNumberToProvider = null, ?bool $needShippingAddress = null, ?bool $needEmail = null, ?bool $needPhoneNumber = null, ?bool $needName = null, ?string $photoUrl = null, ?int $photoWidth = null, ?int $photoSize = null, ?string $providerData = null, ?array $suggestedTipAmounts = null, ?int $maxTipAmount = null, ?int $subscriptionPeriod = null, ?string $providerToken = null, ?bool $isFlexible = null): string {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['title'] = $title;
        $params['description'] = $description;
        $params['payload'] = $payload;
        if (isset($providerToken)) $params['provider_token'] = $providerToken;
        $params['currency'] = $currency;
        $params['prices'] = $prices;
        if (isset($subscriptionPeriod)) $params['subscription_period'] = $subscriptionPeriod;
        if (isset($maxTipAmount)) $params['max_tip_amount'] = $maxTipAmount;
        if (isset($suggestedTipAmounts)) $params['suggested_tip_amounts'] = $suggestedTipAmounts;
        if (isset($providerData)) $params['provider_data'] = $providerData;
        if (isset($photoUrl)) $params['photo_url'] = $photoUrl;
        if (isset($photoSize)) $params['photo_size'] = $photoSize;
        if (isset($photoWidth)) $params['photo_width'] = $photoWidth;
        if (isset($photoHeight)) $params['photo_height'] = $photoHeight;
        if (isset($needName)) $params['need_name'] = $needName;
        if (isset($needPhoneNumber)) $params['need_phone_number'] = $needPhoneNumber;
        if (isset($needEmail)) $params['need_email'] = $needEmail;
        if (isset($needShippingAddress)) $params['need_shipping_address'] = $needShippingAddress;
        if (isset($sendPhoneNumberToProvider)) $params['send_phone_number_to_provider'] = $sendPhoneNumberToProvider;
        if (isset($sendEmailToProvider)) $params['send_email_to_provider'] = $sendEmailToProvider;
        if (isset($isFlexible)) $params['is_flexible'] = $isFlexible;
        return $this->request('createInvoiceLink', $params);
    }

    public function editUserStarSubscription(int $userId, string $telegramPaymentChargeId, bool $isCanceled): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['telegram_payment_charge_id'] = $telegramPaymentChargeId;
        $params['is_canceled'] = $isCanceled;
        return $this->request('editUserStarSubscription', $params);
    }

    public function setUserEmojiStatus(int $userId, ?string $emojiStatusCustomEmojiId = null, ?int $emojiStatusExpirationDate = null): bool {
        $params = [];
        $params['user_id'] = $userId;
        if(isset($emojiStatusCustomEmojiId)) $params['emoji_status_custom_emoji_id'] = $emojiStatusCustomEmojiId;
        if(isset($emojiStatusExpirationDate)) $params['emoji_status_expiration_date'] = $emojiStatusExpirationDate;
        return $this->request('setUserEmojiStatus', $params);
    }

    public function savePreparedInlineMessage(int $userId, InlineQueryResult $result, ?bool $allowUserChats = null, ?bool $allowBotChats = null, ?bool $allowGroupChats = null, ?bool $allowChannelChats = null): PreparedInlineMessage {
        $params = [];
        $params['user_id'] = $userId;
        $params['result'] = $result;
        if(isset($allowUserChats)) $params['allow_user_chats'] = $allowUserChats;
        if(isset($allowBotChats)) $params['allow_bot_chats'] = $allowBotChats;
        if(isset($allowGroupChats)) $params['allow_group_chats'] = $allowGroupChats;
        if(isset($allowChannelChats)) $params['allow_channel_chats'] = $allowChannelChats;
        return PreparedInlineMessage::fromArray($this->request('savePreparedInlineMessage', $params));
    }

    public function getAvailableGifts(): Gifts {
        $params = [];
        return Gifts::fromArray($this->request('getAvailableGifts', $params));
    }

    public function sendGift(int $userId, string $giftId, ?string $text = null, ?string $textParseMode = null, ?array $textEntities = null): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['gift_id'] = $giftId;
        if(isset($text)) $params['text'] = $text;
        if(isset($textParseMode)) $params['text_parse_mode'] = $textParseMode;
        if(isset($textEntities)) $params['text_entities'] = $textEntities;
        return $this->request('sendGift', $params);
    }

    public function answerShippingQuery(string $shippingQueryId, bool $ok, ?array $shippingOptions = null, ?string $errorMessage = null): bool {
        $params = [];
        $params['shipping_query_id'] = $shippingQueryId;
        $params['ok'] = $ok;
        if (isset($shippingOptions)) $params['shipping_options'] = $shippingOptions;
        if (isset($errorMessage)) $params['error_message'] = $errorMessage;
        return $this->request('answerShippingQuery', $params);
    }

    public function answerPreCheckoutQuery(string $preCheckoutQueryId, bool $ok, ?string $errorMessage = null): bool {
        $params = [];
        $params['pre_checkout_query_id'] = $preCheckoutQueryId;
        $params['ok'] = $ok;
        if (isset($errorMessage)) $params['error_message'] = $errorMessage;
        return $this->request('answerPreCheckoutQuery', $params);
    }

    public function getStarTransactions(?int $offset = null, ?int $limit = null): StarTransactions {
        $params = [];
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        return StarTransactions::fromArray($this->request('getStarTransactions', $params));
    }

    public function refundStarPayment(int $userId, string $telegramPaymentChargeId): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['telegram_payment_charge_id'] = $telegramPaymentChargeId;
        return $this->request('refundStarPayment', $params);
    }

    public function setPassportDataErrors(int $userId, array $errors): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['errors'] = $errors;
        return $this->request('setPassportDataErrors', $params);
    }

    public function sendGame(int $chatId, string $gameShortName, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, ?InlineKeyboardMarkup $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['game_short_name'] = $gameShortName;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendGame', $params));
    }

    public function setGameScore(int $userId, int $score, ?bool $force = null, ?bool $disableEditMessage = null, ?int $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null): Message {
        $params = [];
        $params['user_id'] = $userId;
        $params['score'] = $score;
        if (isset($force)) $params['force'] = $force;
        if (isset($disableEditMessage)) $params['disable_edit_message'] = $disableEditMessage;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        return Message::fromArray($this->request('setGameScore', $params));
    }

    /**
     * @param int $userId
     * @param int|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     * @return GameHighScore[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function getGameHighScores(int $userId, ?int $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null): array {
        $params = [];
        $params['user_id'] = $userId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        return GameHighScore::arrayOf($this->request('getGameHighScores', $params));
    }

    public function downloadFile(string|File $file, string $savePath): void {
        if (is_string($file)) $file = $this->getFile($file);
        $tmpPath = '/tmp/' . uniqid($file->getFileId()) . '.tmp';
        $res = $this->client->get(sprintf('%s/file/bot%s/', $this->apiUrl, $this->token) . $file->getFilePath(), ['sink' => $tmpPath]);
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

    public function getFile(string $fileId): File {
        $params = [];
        $params['file_id'] = $fileId;
        return File::fromArray($this->request('getFile', $params));
    }

    public function getApiUrl(): string {
        return $this->apiUrl;
    }

    public function setApiUrl(string $apiUrl): void {
        $this->apiUrl = $apiUrl;
    }

    public function getToken(): string {
        return $this->token;
    }

    public function setToken(string $token): void {
        $this->token = $token;
    }

    public function getLogger(): ?LoggerInterface {
        return $this->logger;
    }

    public function setLogger(?LoggerInterface $logger): void {
        $this->logger = $logger;
    }

    private function file(?string $path): mixed {
        if(!$path) return null;
        elseif(str_starts_with($path, 'https://')) {
            return $path;
        } elseif(str_starts_with($path, 'file://')) {
            if(!file_exists($path)) throw new Exception("File path '{$path}' not found");
            return $path;
        } elseif(is_file($path)) {
            if(!file_exists($path)) throw new Exception("File path '{$path}' not found");
            return fopen($path, 'rb');
        } else {
            throw new Exception('Invalid file path');
        }
    }

}
