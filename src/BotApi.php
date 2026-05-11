<?php

namespace Yabx\Telegram;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Throwable;
use Yabx\Telegram\Enum\ChatAction;
use Yabx\Telegram\Objects\AbstractObject;
use Yabx\Telegram\Objects\AcceptedGiftTypes;
use Yabx\Telegram\Objects\BotAccessSettings;
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
use Yabx\Telegram\Objects\InputChecklist;
use Yabx\Telegram\Objects\InputPollMedia;
use Yabx\Telegram\Objects\InputProfilePhoto;
use Yabx\Telegram\Objects\InputSticker;
use Yabx\Telegram\Objects\InputStoryContent;
use Yabx\Telegram\Objects\KeyboardButton;
use Yabx\Telegram\Objects\LinkPreviewOptions;
use Yabx\Telegram\Objects\MaskPosition;
use Yabx\Telegram\Objects\MenuButton;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\MessageId;
use Yabx\Telegram\Objects\OwnedGifts;
use Yabx\Telegram\Objects\Poll;
use Yabx\Telegram\Objects\PreparedInlineMessage;
use Yabx\Telegram\Objects\PreparedKeyboardButton;
use Yabx\Telegram\Objects\ReplyKeyboardMarkup;
use Yabx\Telegram\Objects\ReplyKeyboardRemove;
use Yabx\Telegram\Objects\ReplyParameters;
use Yabx\Telegram\Objects\SentGuestMessage;
use Yabx\Telegram\Objects\SentWebAppMessage;
use Yabx\Telegram\Objects\StarAmount;
use Yabx\Telegram\Objects\StarTransactions;
use Yabx\Telegram\Objects\Sticker;
use Yabx\Telegram\Objects\StickerSet;
use Yabx\Telegram\Objects\Story;
use Yabx\Telegram\Objects\SuggestedPostParameters;
use Yabx\Telegram\Objects\Update;
use Yabx\Telegram\Objects\User;
use Yabx\Telegram\Objects\UserChatBoosts;
use Yabx\Telegram\Objects\UserProfileAudios;
use Yabx\Telegram\Objects\UserProfilePhotos;
use Yabx\Telegram\Objects\WebhookInfo;

class BotApi {

    protected string $apiUrl;
    protected Client $client;
    protected string $token;
    protected ?LoggerInterface $logger;
    protected ?array $lastResponse = null;

    /**
     * Create a new BotApi client instance.
     * @param string $token
     * @param array $guzzleOptions
     * @param ?LoggerInterface $logger
     * @param string $apiUrl
     */
    public function __construct(string $token, array $guzzleOptions = [], ?LoggerInterface $logger = null, string $apiUrl = 'https://api.telegram.org') {
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
            $this->lastResponse = (array)$json;
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new Exception($e->getMessage());
        }
        if ($json['ok'] ?? false) {
            $this->logger->debug('RESPONSE', $json);
            return $json['result'];
        } else {
            $this->logger->debug('ERROR', $json);
            throw new Exception($json['description'] ?? 'Unknown error', $json['error_code'] ?? 500);
        }
    }

    /**
     * Method: setWebhook
     *
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified URL, containing a JSON-serialized Update . In case of an unsuccessful request (a request with response HTTP status code different from 2XY ), we will repeat the request and give up after a reasonable amount of attempts. Returns True on success.
     * @link https://core.telegram.org/bots/api#setwebhook
     * @param string $url
     * @param ?string $ipAddress
     * @param ?int $maxConnections
     * @param ?array $allowedUpdates
     * @param ?bool $dropPendingUpdates
     * @param ?string $secretToken
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: deleteWebhook
     *
     * Use this method to remove webhook integration if you decide to switch back to getUpdates . Returns True on success.
     * @link https://core.telegram.org/bots/api#deletewebhook
     * @param ?bool $dropPendingUpdates
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteWebhook(?bool $dropPendingUpdates = null): bool {
        $params = [];
        if (isset($dropPendingUpdates)) $params['drop_pending_updates'] = $dropPendingUpdates;
        return $this->request('deleteWebhook', $params);
    }

    /**
     * Method: getWebhookInfo
     *
     * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates , will return an object with the url field empty.
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     * @return WebhookInfo
     * @throws Exception
     * @throws GuzzleException
     */
    public function getWebhookInfo(): WebhookInfo {
        $params = [];

        return WebhookInfo::fromArray($this->request('getWebhookInfo', $params));
    }

    /**
     * Method: getMe
     *
     * A simple method for testing your bot's authentication token. Requires no parameters. Returns basic information about the bot in form of a User object.
     * @link https://core.telegram.org/bots/api#getme
     * @return User
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMe(): User {
        $params = [];

        return User::fromArray($this->request('getMe', $params));
    }

    /**
     * Method: logOut
     *
     * Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on success. Requires no parameters.
     * @link https://core.telegram.org/bots/api#logout
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function logOut(): bool {
        $params = [];

        return $this->request('logOut', $params);
    }

    /**
     * Method: close
     *
     * Use this method to close the bot instance before moving it from one local server to another. You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart. The method will return error 429 in the first 10 minutes after the bot is launched. Returns True on success. Requires no parameters.
     * @link https://core.telegram.org/bots/api#close
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function close(): bool {
        $params = [];

        return $this->request('close', $params);
    }

    /**
     * Method: sendMessage
     *
     * Use this method to send text messages. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendmessage
     * @param int|string $chatId
     * @param string $text
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $parseMode
     * @param ?array $entities
     * @param ?LinkPreviewOptions $linkPreviewOptions
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendMessage(int|string $chatId, string $text, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $parseMode = null, ?array $entities = null, ?LinkPreviewOptions $linkPreviewOptions = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: forwardMessage
     *
     * Use this method to forward messages of any kind. Service messages and messages with protected content can't be forwarded. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#forwardmessage
     * @param int|string $chatId
     * @param int|string $fromChatId
     * @param int $messageId
     * @param ?int $messageThreadId
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: copyMessage
     *
     * Use this method to copy messages of any kind. Service messages, paid media messages, giveaway messages, giveaway winners messages, and invoice messages can't be copied. A quiz poll can be copied only if the value of the field correct_option_id is known to the bot. The method is analogous to the method forwardMessage , but the copied message doesn't have a link to the original message. Returns the MessageId of the sent message on success.
     * @link https://core.telegram.org/bots/api#copymessage
     * @param int|string $chatId
     * @param int|string $fromChatId
     * @param int $messageId
     * @param ?int $messageThreadId
     * @param ?string $caption
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?bool $showCaptionAboveMedia
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return MessageId
     * @throws Exception
     * @throws GuzzleException
     */
    public function copyMessage(int|string $chatId, int|string $fromChatId, int $messageId, ?int $messageThreadId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): MessageId {
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

    /**
     * Method: sendPhoto
     *
     * Use this method to send photos. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendphoto
     * @param int|string $chatId
     * @param string $photo
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $caption
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?bool $showCaptionAboveMedia
     * @param ?bool $hasSpoiler
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendPhoto(int|string $chatId, string $photo, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?bool $hasSpoiler = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendLivePhoto
     *
     * Use this method to send live photos. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendlivephoto
     * @param int|string $chatId
     * @param string $livePhoto
     * @param string $photo
     * @param string|null $businessConnectionId
     * @param int|null $messageThreadId
     * @param int|null $directMessagesTopicId
     * @param string|null $caption
     * @param string|null $parseMode
     * @param array|null $captionEntities
     * @param bool|null $showCaptionAboveMedia
     * @param bool|null $hasSpoiler
     * @param bool|null $disableNotification
     * @param bool|null $protectContent
     * @param bool|null $allowPaidBroadcast
     * @param string|null $messageEffectId
     * @param SuggestedPostParameters|null $suggestedPostParameters
     * @param ReplyParameters|null $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendLivePhoto(int|string $chatId, string $livePhoto, string $photo, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?int $directMessagesTopicId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?bool $hasSpoiler = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?bool $allowPaidBroadcast = null, ?string $messageEffectId = null, ?SuggestedPostParameters $suggestedPostParameters = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null): Message {
        if (file_exists($livePhoto)) $livePhoto = fopen($livePhoto, 'r');
        if (file_exists($photo)) $photo = fopen($photo, 'r');
        $params = [];
        $params['chat_id'] = $chatId;
        $params['live_photo'] = $livePhoto;
        $params['photo'] = $photo;
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        if (isset($directMessagesTopicId)) $params['direct_messages_topic_id'] = $directMessagesTopicId;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($showCaptionAboveMedia)) $params['show_caption_above_media'] = $showCaptionAboveMedia;
        if (isset($hasSpoiler)) $params['has_spoiler'] = $hasSpoiler;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($suggestedPostParameters)) $params['suggested_post_parameters'] = $suggestedPostParameters;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendLivePhoto', $params, is_resource($livePhoto) || is_resource($photo)));
    }

    /**
     * Method: sendAudio
     *
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     * @link https://core.telegram.org/bots/api#sendaudio
     * @param int|string $chatId
     * @param string $audio
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $caption
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?int $duration
     * @param ?string $performer
     * @param ?string $title
     * @param ?string $thumbnail
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendAudio(int|string $chatId, string $audio, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?int $duration = null, ?string $performer = null, ?string $title = null, ?string $thumbnail = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendDocument
     *
     * Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     * @link https://core.telegram.org/bots/api#senddocument
     * @param int|string $chatId
     * @param string $document
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $thumbnail
     * @param ?string $caption
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?bool $disableContentTypeDetection
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendDocument(int|string $chatId, string $document, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $thumbnail = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $disableContentTypeDetection = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendVideo
     *
     * Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be sent as Document ). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     * @link https://core.telegram.org/bots/api#sendvideo
     * @param int|string $chatId
     * @param string $video
     * @param ?string $businessConnectionId
     * @param ?bool $showCaptionAboveMedia
     * @param ?ReplyParameters $replyParameters
     * @param ?string $messageEffectId
     * @param ?bool $protectContent
     * @param ?bool $disableNotification
     * @param ?bool $supportsStreaming
     * @param ?bool $hasSpoiler
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?string $caption
     * @param ?string $thumbnail
     * @param ?int $height
     * @param ?int $width
     * @param ?int $duration
     * @param ?int $messageThreadId
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendVideo(int|string $chatId, string $video, ?string $businessConnectionId = null, ?bool $showCaptionAboveMedia = null, ?ReplyParameters $replyParameters = null, ?string $messageEffectId = null, ?bool $protectContent = null, ?bool $disableNotification = null, ?bool $supportsStreaming = null, ?bool $hasSpoiler = null, ?string $parseMode = null, ?array $captionEntities = null, ?string $caption = null, ?string $thumbnail = null, ?int $height = null, ?int $width = null, ?int $duration = null, ?int $messageThreadId = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendAnimation
     *
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     * @link https://core.telegram.org/bots/api#sendanimation
     * @param int|string $chatId
     * @param string $animation
     * @param ?string $businessConnectionId
     * @param ?ReplyParameters $replyParameters
     * @param ?string $messageEffectId
     * @param ?bool $protectContent
     * @param ?bool $disableNotification
     * @param ?bool $hasSpoiler
     * @param ?bool $showCaptionAboveMedia
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?string $caption
     * @param ?string $thumbnail
     * @param ?int $height
     * @param ?int $width
     * @param ?int $duration
     * @param ?int $messageThreadId
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendAnimation(int|string $chatId, string $animation, ?string $businessConnectionId = null, ?ReplyParameters $replyParameters = null, ?string $messageEffectId = null, ?bool $protectContent = null, ?bool $disableNotification = null, ?bool $hasSpoiler = null, ?bool $showCaptionAboveMedia = null, ?string $parseMode = null, ?array $captionEntities = null, ?string $caption = null, ?string $thumbnail = null, ?int $height = null, ?int $width = null, ?int $duration = null, ?int $messageThreadId = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendVoice
     *
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS, or in .MP3 format, or in .M4A format (other formats may be sent as Audio or Document ). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     * @link https://core.telegram.org/bots/api#sendvoice
     * @param int|string $chatId
     * @param string $voice
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $caption
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?int $duration
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendVoice(int|string $chatId, string $voice, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?int $duration = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendVideoNote
     *
     * As of v.4.0 , Telegram clients support rounded square MPEG4 videos of up to 1 minute long. Use this method to send video messages. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendvideonote
     * @param int|string $chatId
     * @param string $videoNote
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?int $duration
     * @param ?int $length
     * @param ?string $thumbnail
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendVideoNote(int|string $chatId, string $videoNote, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?int $duration = null, ?int $length = null, ?string $thumbnail = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendPaidMedia
     *
     * Use this method to send paid media. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendpaidmedia
     * @param int|string $chatId
     * @param int $starCount
     * @param array $media
     * @param ?string $payload
     * @param ?string $businessConnectionId
     * @param ?string $caption
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?bool $showCaptionAboveMedia
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendPaidMedia(int|string $chatId, int $starCount, array $media, ?string $payload = null, ?string $businessConnectionId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendLocation
     *
     * Use this method to send point on the map. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendlocation
     * @param int|string $chatId
     * @param float $latitude
     * @param float $longitude
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?float $horizontalAccuracy
     * @param ?int $livePeriod
     * @param ?int $heading
     * @param ?int $proximityAlertRadius
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendLocation(int|string $chatId, float $latitude, float $longitude, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?float $horizontalAccuracy = null, ?int $livePeriod = null, ?int $heading = null, ?int $proximityAlertRadius = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendVenue
     *
     * Use this method to send information about a venue. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendvenue
     * @param int|string $chatId
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @param string $address
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $foursquareId
     * @param ?string $foursquareType
     * @param ?string $googlePlaceId
     * @param ?string $googlePlaceType
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendVenue(int|string $chatId, float $latitude, float $longitude, string $title, string $address, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $foursquareId = null, ?string $foursquareType = null, ?string $googlePlaceId = null, ?string $googlePlaceType = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendContact
     *
     * Use this method to send phone contacts. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendcontact
     * @param int|string $chatId
     * @param string $phoneNumber
     * @param string $firstName
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $lastName
     * @param ?string $vcard
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendContact(int|string $chatId, string $phoneNumber, string $firstName, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $lastName = null, ?string $vcard = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendPoll
     *
     * Use this method to send a native poll. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendpoll
     * @param int|string $chatId
     * @param string $question
     * @param array $options
     * @param string|null $businessConnectionId
     * @param array|null $explanationEntities
     * @param ReplyParameters|null $replyParameters
     * @param string|null $messageEffectId
     * @param bool|null $protectContent
     * @param bool|null $disableNotification
     * @param bool|null $isClosed
     * @param int|null $closeDate
     * @param int|null $openPeriod
     * @param string|null $explanation
     * @param string|null $explanationParseMode
     * @param int|null $correctOptionId
     * @param bool|null $allowsMultipleAnswers
     * @param string|null $type
     * @param bool|null $isAnonymous
     * @param array|null $questionEntities
     * @param string|null $questionParseMode
     * @param int|null $messageThreadId
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param bool|null $allowPaidBroadcast
     * @param InputPollMedia|null $media
     * @param InputPollMedia|null $explanationMedia
     * @param bool|null $membersOnly
     * @param array|null $countryCodes
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendPoll(int|string $chatId, string $question, array $options, ?string $businessConnectionId = null, ?array $explanationEntities = null, ?ReplyParameters $replyParameters = null, ?string $messageEffectId = null, ?bool $protectContent = null, ?bool $disableNotification = null, ?bool $isClosed = null, ?int $closeDate = null, ?int $openPeriod = null, ?string $explanation = null, ?string $explanationParseMode = null, ?int $correctOptionId = null, ?bool $allowsMultipleAnswers = null, ?string $type = null, ?bool $isAnonymous = null, ?array $questionEntities = null, ?string $questionParseMode = null, ?int $messageThreadId = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null, ?InputPollMedia $media = null, ?InputPollMedia $explanationMedia = null, ?bool $membersOnly = null, ?array $countryCodes = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['question'] = $question;
        if (isset($questionParseMode)) $params['question_parse_mode'] = $questionParseMode;
        if (isset($questionEntities)) $params['question_entities'] = $questionEntities;
        $params['options'] = $options;
        if (isset($media)) $params['media'] = $media;
        if (isset($allowPaidBroadcast)) $params['allow_paid_broadcast'] = $allowPaidBroadcast;
        if (isset($isAnonymous)) $params['is_anonymous'] = $isAnonymous;
        if (isset($type)) $params['type'] = $type;
        if (isset($allowsMultipleAnswers)) $params['allows_multiple_answers'] = $allowsMultipleAnswers;
        if (isset($membersOnly)) $params['members_only'] = $membersOnly;
        if (isset($countryCodes)) $params['country_codes'] = $countryCodes;
        if (isset($correctOptionId)) $params['correct_option_id'] = $correctOptionId;
        if (isset($explanation)) $params['explanation'] = $explanation;
        if (isset($explanationParseMode)) $params['explanation_parse_mode'] = $explanationParseMode;
        if (isset($explanationEntities)) $params['explanation_entities'] = $explanationEntities;
        if (isset($explanationMedia)) $params['explanation_media'] = $explanationMedia;
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

    /**
     * Method: sendDice
     *
     * Use this method to send an animated emoji that will display a random value. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#senddice
     * @param int|string $chatId
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $emoji
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendDice(int|string $chatId, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $emoji = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: sendChatAction
     *
     * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
     * @link https://core.telegram.org/bots/api#sendchataction
     * @param int|string $chatId
     * @param ChatAction $action
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendChatAction(int|string $chatId, ChatAction $action, ?string $businessConnectionId = null, ?int $messageThreadId = null): bool {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        $params['action'] = $action->value;
        return $this->request('sendChatAction', $params);
    }

    /**
     * Method: setMessageReaction
     *
     * Use this method to change the chosen reactions on a message. Service messages of some types can't be reacted to. Automatically forwarded messages from a channel to its discussion group have the same available reactions as messages in the channel. Bots can't use paid reactions. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmessagereaction
     * @param int|string $chatId
     * @param int $messageId
     * @param ?array $reaction
     * @param ?bool $isBig
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMessageReaction(int|string $chatId, int $messageId, ?array $reaction = null, ?bool $isBig = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($reaction)) $params['reaction'] = $reaction;
        if (isset($isBig)) $params['is_big'] = $isBig;
        return $this->request('setMessageReaction', $params);
    }

    /**
     * Method: deleteMessageReaction
     *
     * Use this method to remove a reaction from a message in a group or a supergroup chat. The bot must have the 'can_delete_messages' administrator right in the chat. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletemessagereaction
     * @param int|string $chatId
     * @param int $messageId
     * @param int|null $userId
     * @param int|null $actorChatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteMessageReaction(int|string $chatId, int $messageId, ?int $userId = null, ?int $actorChatId = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($userId)) $params['user_id'] = $userId;
        if (isset($actorChatId)) $params['actor_chat_id'] = $actorChatId;
        return $this->request('deleteMessageReaction', $params);
    }

    /**
     * Method: deleteAllMessageReactions
     *
     * Use this method to remove up to 10000 recent reactions in a group or a supergroup chat added by a given user or chat. The bot must have the 'can_delete_messages' administrator right in the chat. Returns True on success.
     * @link https://core.telegram.org/bots/api#deleteallmessagereactions
     * @param int|string $chatId
     * @param int|null $userId
     * @param int|null $actorChatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteAllMessageReactions(int|string $chatId, ?int $userId = null, ?int $actorChatId = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($userId)) $params['user_id'] = $userId;
        if (isset($actorChatId)) $params['actor_chat_id'] = $actorChatId;
        return $this->request('deleteAllMessageReactions', $params);
    }

    /**
     * Method: getUserProfilePhotos
     *
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     * @param int $userId
     * @param ?int $offset
     * @param ?int $limit
     * @return UserProfilePhotos
     * @throws Exception
     * @throws GuzzleException
     */
    public function getUserProfilePhotos(int $userId, ?int $offset = null, ?int $limit = null): UserProfilePhotos {
        $params = [];
        $params['user_id'] = $userId;
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        return UserProfilePhotos::fromArray($this->request('getUserProfilePhotos', $params));
    }

    /**
     * Method: banChatMember
     *
     * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#banchatmember
     * @param int|string $chatId
     * @param int $userId
     * @param ?int $untilDate
     * @param ?bool $revokeMessages
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function banChatMember(int|string $chatId, int $userId, ?int $untilDate = null, ?bool $revokeMessages = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        if (isset($untilDate)) $params['until_date'] = $untilDate;
        if (isset($revokeMessages)) $params['revoke_messages'] = $revokeMessages;
        return $this->request('banChatMember', $params);
    }

    /**
     * Method: unbanChatMember
     *
     * Use this method to unban a previously banned user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be removed from the chat. If you don't want this, use the parameter only_if_banned . Returns True on success.
     * @link https://core.telegram.org/bots/api#unbanchatmember
     * @param int|string $chatId
     * @param int $userId
     * @param ?bool $onlyIfBanned
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function unbanChatMember(int|string $chatId, int $userId, ?bool $onlyIfBanned = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        if (isset($onlyIfBanned)) $params['only_if_banned'] = $onlyIfBanned;
        return $this->request('unbanChatMember', $params);
    }

    /**
     * Method: restrictChatMember
     *
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass True for all permissions to lift restrictions from a user. Returns True on success.
     * @link https://core.telegram.org/bots/api#restrictchatmember
     * @param int|string $chatId
     * @param int $userId
     * @param ChatPermissions $permissions
     * @param ?bool $useIndependentChatPermissions
     * @param ?int $untilDate
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function restrictChatMember(int|string $chatId, int $userId, ChatPermissions $permissions, ?bool $useIndependentChatPermissions = null, ?int $untilDate = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        $params['permissions'] = $permissions;
        if (isset($useIndependentChatPermissions)) $params['use_independent_chat_permissions'] = $useIndependentChatPermissions;
        if (isset($untilDate)) $params['until_date'] = $untilDate;
        return $this->request('restrictChatMember', $params);
    }

    /**
     * Method: promoteChatMember
     *
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass False for all boolean parameters to demote a user. Returns True on success.
     * @link https://core.telegram.org/bots/api#promotechatmember
     * @param int|string $chatId
     * @param int $userId
     * @param ?bool $canPinMessages
     * @param ?bool $canEditMessages
     * @param ?bool $canPostMessages
     * @param ?bool $canDeleteStories
     * @param ?bool $canEditStories
     * @param ?bool $canPostStories
     * @param ?bool $canChangeInfo
     * @param ?bool $canInviteUsers
     * @param ?bool $canPromoteMembers
     * @param ?bool $canRestrictMembers
     * @param ?bool $canManageVideoChats
     * @param ?bool $canDeleteMessages
     * @param ?bool $canManageChat
     * @param ?bool $isAnonymous
     * @param ?bool $canManageTopics
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: setChatAdministratorCustomTitle
     *
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
     * @param int|string $chatId
     * @param int $userId
     * @param string $customTitle
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setChatAdministratorCustomTitle(int|string $chatId, int $userId, string $customTitle): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        $params['custom_title'] = $customTitle;
        return $this->request('setChatAdministratorCustomTitle', $params);
    }

    /**
     * Method: banChatSenderChat
     *
     * Use this method to ban a channel chat in a supergroup or a channel. Until the chat is unbanned , the owner of the banned chat won't be able to send messages on behalf of any of their channels . The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#banchatsenderchat
     * @param int|string $chatId
     * @param int $senderChatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function banChatSenderChat(int|string $chatId, int $senderChatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['sender_chat_id'] = $senderChatId;
        return $this->request('banChatSenderChat', $params);
    }

    /**
     * Method: unbanChatSenderChat
     *
     * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#unbanchatsenderchat
     * @param int|string $chatId
     * @param int $senderChatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function unbanChatSenderChat(int|string $chatId, int $senderChatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['sender_chat_id'] = $senderChatId;
        return $this->request('unbanChatSenderChat', $params);
    }

    /**
     * Method: setChatPermissions
     *
     * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#setchatpermissions
     * @param int|string $chatId
     * @param ChatPermissions $permissions
     * @param ?bool $useIndependentChatPermissions
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setChatPermissions(int|string $chatId, ChatPermissions $permissions, ?bool $useIndependentChatPermissions = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['permissions'] = $permissions;
        if (isset($useIndependentChatPermissions)) $params['use_independent_chat_permissions'] = $useIndependentChatPermissions;
        return $this->request('setChatPermissions', $params);
    }

    /**
     * Method: exportChatInviteLink
     *
     * Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the new invite link as String on success.
     * @link https://core.telegram.org/bots/api#exportchatinvitelink
     * @param int|string $chatId
     * @return string
     * @throws Exception
     * @throws GuzzleException
     */
    public function exportChatInviteLink(int|string $chatId): string {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('exportChatInviteLink', $params);
    }

    /**
     * Method: createChatInviteLink
     *
     * Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. The link can be revoked using the method revokeChatInviteLink . Returns the new invite link as ChatInviteLink object.
     * @link https://core.telegram.org/bots/api#createchatinvitelink
     * @param int|string $chatId
     * @param ?string $name
     * @param ?int $expireDate
     * @param ?int $memberLimit
     * @param ?bool $createsJoinRequest
     * @return ChatInviteLink
     * @throws Exception
     * @throws GuzzleException
     */
    public function createChatInviteLink(int|string $chatId, ?string $name = null, ?int $expireDate = null, ?int $memberLimit = null, ?bool $createsJoinRequest = null): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($name)) $params['name'] = $name;
        if (isset($expireDate)) $params['expire_date'] = $expireDate;
        if (isset($memberLimit)) $params['member_limit'] = $memberLimit;
        if (isset($createsJoinRequest)) $params['creates_join_request'] = $createsJoinRequest;
        return ChatInviteLink::fromArray($this->request('createChatInviteLink', $params));
    }

    /**
     * Method: editChatInviteLink
     *
     * Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the edited invite link as a ChatInviteLink object.
     * @link https://core.telegram.org/bots/api#editchatinvitelink
     * @param int|string $chatId
     * @param string $inviteLink
     * @param ?string $name
     * @param ?int $expireDate
     * @param ?int $memberLimit
     * @param ?bool $createsJoinRequest
     * @return ChatInviteLink
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: createChatSubscriptionInviteLink
     *
     * Use this method to create a subscription invite link for a channel chat. The bot must have the can_invite_users administrator rights. The link can be edited using the method editChatSubscriptionInviteLink or revoked using the method revokeChatInviteLink . Returns the new invite link as a ChatInviteLink object.
     * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
     * @param int|string $chatId
     * @param int $subscriptionPeriod
     * @param int $subscriptionPrice
     * @param ?string $name
     * @return ChatInviteLink
     * @throws Exception
     * @throws GuzzleException
     */
    public function createChatSubscriptionInviteLink(int|string $chatId, int $subscriptionPeriod, int $subscriptionPrice, ?string $name = null): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($name)) $params['name'] = $name;
        $params['subscription_period'] = $subscriptionPeriod;
        $params['subscription_price'] = $subscriptionPrice;
        return ChatInviteLink::fromArray($this->request('createChatSubscriptionInviteLink', $params));
    }

    /**
     * Method: editChatSubscriptionInviteLink
     *
     * Use this method to edit a subscription invite link created by the bot. The bot must have the can_invite_users administrator rights. Returns the edited invite link as a ChatInviteLink object.
     * @link https://core.telegram.org/bots/api#editchatsubscriptioninvitelink
     * @param int|string $chatId
     * @param string $inviteLink
     * @param ?string $name
     * @return ChatInviteLink
     * @throws Exception
     * @throws GuzzleException
     */
    public function editChatSubscriptionInviteLink(int|string $chatId, string $inviteLink, ?string $name = null): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['invite_link'] = $inviteLink;
        if (isset($name)) $params['name'] = $name;
        return ChatInviteLink::fromArray($this->request('editChatSubscriptionInviteLink', $params));
    }

    /**
     * Method: revokeChatInviteLink
     *
     * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the revoked invite link as ChatInviteLink object.
     * @link https://core.telegram.org/bots/api#revokechatinvitelink
     * @param int|string $chatId
     * @param string $inviteLink
     * @return ChatInviteLink
     * @throws Exception
     * @throws GuzzleException
     */
    public function revokeChatInviteLink(int|string $chatId, string $inviteLink): ChatInviteLink {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['invite_link'] = $inviteLink;
        return ChatInviteLink::fromArray($this->request('revokeChatInviteLink', $params));
    }

    /**
     * Method: approveChatJoinRequest
     *
     * Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
     * @link https://core.telegram.org/bots/api#approvechatjoinrequest
     * @param int|string $chatId
     * @param int $userId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function approveChatJoinRequest(int|string $chatId, int $userId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return $this->request('approveChatJoinRequest', $params);
    }

    /**
     * Method: declineChatJoinRequest
     *
     * Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
     * @link https://core.telegram.org/bots/api#declinechatjoinrequest
     * @param int|string $chatId
     * @param int $userId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function declineChatJoinRequest(int|string $chatId, int $userId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return $this->request('declineChatJoinRequest', $params);
    }

    /**
     * Method: setChatPhoto
     *
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#setchatphoto
     * @param int|string $chatId
     * @param string $photo
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setChatPhoto(int|string $chatId, string $photo): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        if (file_exists($photo)) $photo = fopen($photo, 'r');
        $params['photo'] = $photo;
        return $this->request('setChatPhoto', $params, is_resource($photo));
    }

    /**
     * Method: deleteChatPhoto
     *
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletechatphoto
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteChatPhoto(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('deleteChatPhoto', $params);
    }

    /**
     * Method: setChatTitle
     *
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#setchattitle
     * @param int|string $chatId
     * @param string $title
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setChatTitle(int|string $chatId, string $title): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['title'] = $title;
        return $this->request('setChatTitle', $params);
    }

    /**
     * Method: setChatDescription
     *
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#setchatdescription
     * @param int|string $chatId
     * @param ?string $description
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setChatDescription(int|string $chatId, ?string $description = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($description)) $params['description'] = $description;
        return $this->request('setChatDescription', $params);
    }

    /**
     * Method: pinChatMessage
     *
     * Use this method to add a message to the list of pinned messages in a chat. In private chats and channel direct messages chats, all non-service messages can be pinned. Conversely, the bot must be an administrator with the 'can_pin_messages' right or the 'can_edit_messages' right to pin messages in groups and channels respectively. Returns True on success.
     * @link https://core.telegram.org/bots/api#pinchatmessage
     * @param int|string $chatId
     * @param int $messageId
     * @param ?string $businessConnectionId
     * @param ?bool $disableNotification
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function pinChatMessage(int|string $chatId, int $messageId, ?string $businessConnectionId = null, ?bool $disableNotification = null): bool {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        return $this->request('pinChatMessage', $params);
    }

    /**
     * Method: unpinChatMessage
     *
     * Use this method to remove a message from the list of pinned messages in a chat. In private chats and channel direct messages chats, all messages can be unpinned. Conversely, the bot must be an administrator with the 'can_pin_messages' right or the 'can_edit_messages' right to unpin messages in groups and channels respectively. Returns True on success.
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     * @param int|string $chatId
     * @param ?string $businessConnectionId
     * @param ?int $messageId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function unpinChatMessage(int|string $chatId, ?string $businessConnectionId = null, ?int $messageId = null): bool {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        return $this->request('unpinChatMessage', $params);
    }

    /**
     * Method: unpinAllChatMessages
     *
     * Use this method to clear the list of pinned messages in a chat. In private chats and channel direct messages chats, no additional rights are required to unpin all pinned messages. Conversely, the bot must be an administrator with the 'can_pin_messages' right or the 'can_edit_messages' right to unpin all pinned messages in groups and channels respectively. Returns True on success.
     * @link https://core.telegram.org/bots/api#unpinallchatmessages
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function unpinAllChatMessages(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('unpinAllChatMessages', $params);
    }

    /**
     * Method: leaveChat
     *
     * Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
     * @link https://core.telegram.org/bots/api#leavechat
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function leaveChat(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('leaveChat', $params);
    }

    /**
     * Method: getChat
     *
     * Use this method to get up-to-date information about the chat. Returns a ChatFullInfo object on success.
     * @link https://core.telegram.org/bots/api#getchat
     * @param int|string $chatId
     * @return ChatFullInfo
     * @throws Exception
     * @throws GuzzleException
     */
    public function getChat(int|string $chatId): ChatFullInfo {
        $params = [];
        $params['chat_id'] = $chatId;
        return ChatFullInfo::fromArray($this->request('getChat', $params));
    }

    /**
     * Method: getChatAdministrators
     *
     * Use this method to get a list of administrators in a chat. Returns an Array of ChatMember objects.
     * @link https://core.telegram.org/bots/api#getchatadministrators
     * @param int|string $chatId
     * @param bool|null $returnBots
     * @return ChatMember[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function getChatAdministrators(int|string $chatId, ?bool $returnBots = null): array {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($returnBots)) $params['return_bots'] = $returnBots;
        return ChatMember::arrayOf($this->request('getChatAdministrators', $params));
    }

    /**
     * Method: getChatMemberCount
     *
     * Use this method to get the number of members in a chat. Returns Int on success.
     * @link https://core.telegram.org/bots/api#getchatmembercount
     * @param int|string $chatId
     * @return int
     * @throws Exception
     * @throws GuzzleException
     */
    public function getChatMemberCount(int|string $chatId): int {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('getChatMemberCount', $params);
    }

    /**
     * Method: getChatMember
     *
     * Use this method to get information about a member of a chat. The method is only guaranteed to work for other users if the bot is an administrator in the chat. Returns a ChatMember object on success.
     * @link https://core.telegram.org/bots/api#getchatmember
     * @param int|string $chatId
     * @param int $userId
     * @return ChatMember
     * @throws Exception
     * @throws GuzzleException
     */
    public function getChatMember(int|string $chatId, int $userId): ChatMember {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return ChatMember::fromArray($this->request('getChatMember', $params));
    }

    /**
     * Method: setChatStickerSet
     *
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     * @link https://core.telegram.org/bots/api#setchatstickerset
     * @param int|string $chatId
     * @param string $stickerSetName
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setChatStickerSet(int|string $chatId, string $stickerSetName): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['sticker_set_name'] = $stickerSetName;
        return $this->request('setChatStickerSet', $params);
    }

    /**
     * Method: deleteChatStickerSet
     *
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletechatstickerset
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteChatStickerSet(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('deleteChatStickerSet', $params);
    }

    /**
     * Method: getForumTopicIconStickers
     *
     * Use this method to get custom emoji stickers, which can be used as a forum topic icon by any user. Requires no parameters. Returns an Array of Sticker objects.
     * @link https://core.telegram.org/bots/api#getforumtopiciconstickers
     * @return array
     * @throws Exception
     * @throws GuzzleException
     */
    public function getForumTopicIconStickers(): array {
        $params = [];
        return Sticker::arrayOf($this->request('getForumTopicIconStickers', $params));
    }

    /**
     * Method: createForumTopic
     *
     * Use this method to create a topic in a forum supergroup chat or a private chat with a user. In the case of a supergroup chat the bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator right. Returns information about the created topic as a ForumTopic object.
     * @link https://core.telegram.org/bots/api#createforumtopic
     * @param int|string $chatId
     * @param string $name
     * @param ?int $iconColor
     * @param ?string $iconCustomEmojiId
     * @return ForumTopic
     * @throws Exception
     * @throws GuzzleException
     */
    public function createForumTopic(int|string $chatId, string $name, ?int $iconColor = null, ?string $iconCustomEmojiId = null): ForumTopic {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['name'] = $name;
        if (isset($iconColor)) $params['icon_color'] = $iconColor;
        if (isset($iconCustomEmojiId)) $params['icon_custom_emoji_id'] = $iconCustomEmojiId;
        return ForumTopic::fromArray($this->request('createForumTopic', $params));
    }

    /**
     * Method: editForumTopic
     *
     * Use this method to edit name and icon of a topic in a forum supergroup chat or a private chat with a user. In the case of a supergroup chat the bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
     * @link https://core.telegram.org/bots/api#editforumtopic
     * @param int|string $chatId
     * @param int $messageThreadId
     * @param ?string $name
     * @param ?string $iconCustomEmojiId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function editForumTopic(int|string $chatId, int $messageThreadId, ?string $name = null, ?string $iconCustomEmojiId = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        if (isset($name)) $params['name'] = $name;
        if (isset($iconCustomEmojiId)) $params['icon_custom_emoji_id'] = $iconCustomEmojiId;
        return $this->request('editForumTopic', $params);
    }

    /**
     * Method: closeForumTopic
     *
     * Use this method to close an open topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
     * @link https://core.telegram.org/bots/api#closeforumtopic
     * @param int|string $chatId
     * @param int $messageThreadId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function closeForumTopic(int|string $chatId, int $messageThreadId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        return $this->request('closeForumTopic', $params);
    }

    /**
     * Method: reopenForumTopic
     *
     * Use this method to reopen a closed topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
     * @link https://core.telegram.org/bots/api#reopenforumtopic
     * @param int|string $chatId
     * @param int $messageThreadId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function reopenForumTopic(int|string $chatId, int $messageThreadId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        return $this->request('reopenForumTopic', $params);
    }

    /**
     * Method: deleteForumTopic
     *
     * Use this method to delete a forum topic along with all its messages in a forum supergroup chat or a private chat with a user. In the case of a supergroup chat the bot must be an administrator in the chat for this to work and must have the can_delete_messages administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#deleteforumtopic
     * @param int|string $chatId
     * @param int $messageThreadId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteForumTopic(int|string $chatId, int $messageThreadId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        return $this->request('deleteForumTopic', $params);
    }

    /**
     * Method: unpinAllForumTopicMessages
     *
     * Use this method to clear the list of pinned messages in a forum topic in a forum supergroup chat or a private chat with a user. In the case of a supergroup chat the bot must be an administrator in the chat for this to work and must have the can_pin_messages administrator right in the supergroup. Returns True on success.
     * @link https://core.telegram.org/bots/api#unpinallforumtopicmessages
     * @param int|string $chatId
     * @param int $messageThreadId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function unpinAllForumTopicMessages(int|string $chatId, int $messageThreadId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_thread_id'] = $messageThreadId;
        return $this->request('unpinAllForumTopicMessages', $params);
    }

    /**
     * Method: editGeneralForumTopic
     *
     * Use this method to edit the name of the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#editgeneralforumtopic
     * @param int|string $chatId
     * @param string $name
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function editGeneralForumTopic(int|string $chatId, string $name): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['name'] = $name;
        return $this->request('editGeneralForumTopic', $params);
    }

    /**
     * Method: closeGeneralForumTopic
     *
     * Use this method to close an open 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#closegeneralforumtopic
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function closeGeneralForumTopic(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('closeGeneralForumTopic', $params);
    }

    /**
     * Method: reopenGeneralForumTopic
     *
     * Use this method to reopen a closed 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. The topic will be automatically unhidden if it was hidden. Returns True on success.
     * @link https://core.telegram.org/bots/api#reopengeneralforumtopic
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function reopenGeneralForumTopic(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('reopenGeneralForumTopic', $params);
    }

    /**
     * Method: hideGeneralForumTopic
     *
     * Use this method to hide the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. The topic will be automatically closed if it was open. Returns True on success.
     * @link https://core.telegram.org/bots/api#hidegeneralforumtopic
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function hideGeneralForumTopic(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('hideGeneralForumTopic', $params);
    }

    /**
     * Method: unhideGeneralForumTopic
     *
     * Use this method to unhide the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. Returns True on success.
     * @link https://core.telegram.org/bots/api#unhidegeneralforumtopic
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function unhideGeneralForumTopic(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('unhideGeneralForumTopic', $params);
    }

    /**
     * Method: unpinAllGeneralForumTopicMessages
     *
     * Use this method to clear the list of pinned messages in a General forum topic. The bot must be an administrator in the chat for this to work and must have the can_pin_messages administrator right in the supergroup. Returns True on success.
     * @link https://core.telegram.org/bots/api#unpinallgeneralforumtopicmessages
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function unpinAllGeneralForumTopicMessages(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('unpinAllGeneralForumTopicMessages', $params);
    }

    /**
     * Method: answerCallbackQuery
     *
     * Use this method to send answers to callback queries sent from inline keyboards . The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
     * @link https://core.telegram.org/bots/api#answercallbackquery
     * @param string $callbackQueryId
     * @param ?string $text
     * @param ?bool $showAlert
     * @param ?string $url
     * @param ?int $cacheTime
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function answerCallbackQuery(string $callbackQueryId, ?string $text = null, ?bool $showAlert = null, ?string $url = null, ?int $cacheTime = null): bool {
        $params = [];
        $params['callback_query_id'] = $callbackQueryId;
        if (isset($text)) $params['text'] = $text;
        if (isset($showAlert)) $params['show_alert'] = $showAlert;
        if (isset($url)) $params['url'] = $url;
        if (isset($cacheTime)) $params['cache_time'] = $cacheTime;
        return $this->request('answerCallbackQuery', $params);
    }

    /**
     * Method: getUserChatBoosts
     *
     * Use this method to get the list of boosts added to a chat by a user. Requires administrator rights in the chat. Returns a UserChatBoosts object.
     * @link https://core.telegram.org/bots/api#getuserchatboosts
     * @param int|string $chatId
     * @param int $userId
     * @return UserChatBoosts
     * @throws Exception
     * @throws GuzzleException
     */
    public function getUserChatBoosts(int|string $chatId, int $userId): UserChatBoosts {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return UserChatBoosts::fromArray($this->request('getUserChatBoosts', $params));
    }

    /**
     * Method: getBusinessConnection
     *
     * Use this method to get information about the connection of the bot with a business account. Returns a BusinessConnection object on success.
     * @link https://core.telegram.org/bots/api#getbusinessconnection
     * @param string $businessConnectionId
     * @return BusinessConnection
     * @throws Exception
     * @throws GuzzleException
     */
    public function getBusinessConnection(string $businessConnectionId): BusinessConnection {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        return BusinessConnection::fromArray($this->request('getBusinessConnection', $params));
    }

    /**
     * Method: setMyCommands
     *
     * Use this method to change the list of the bot's commands. See this manual for more details about bot commands. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmycommands
     * @param array $commands
     * @param ?BotCommandScope $scope
     * @param ?string $languageCode
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyCommands(array $commands, ?BotCommandScope $scope = null, ?string $languageCode = null): bool {
        $params = [];
        $params['commands'] = $commands;
        if (isset($scope)) $params['scope'] = $scope;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('setMyCommands', $params);
    }

    /**
     * Method: deleteMyCommands
     *
     * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletemycommands
     * @param ?BotCommandScope $scope
     * @param ?string $languageCode
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: setMyName
     *
     * Use this method to change the bot's name. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmyname
     * @param ?string $name
     * @param ?string $languageCode
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyName(?string $name = null, ?string $languageCode = null): bool {
        $params = [];
        if (isset($name)) $params['name'] = $name;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('setMyName', $params);
    }

    /**
     * Method: getMyName
     *
     * Use this method to get the current bot name for the given user language. Returns BotName on success.
     * @link https://core.telegram.org/bots/api#getmyname
     * @param ?string $languageCode
     * @return BotName
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyName(?string $languageCode = null): BotName {
        $params = [];
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return BotName::fromArray($this->request('getMyName', $params));
    }

    /**
     * Method: setMyDescription
     *
     * Use this method to change the bot's description, which is shown in the chat with the bot if the chat is empty. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmydescription
     * @param ?string $description
     * @param ?string $languageCode
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyDescription(?string $description = null, ?string $languageCode = null): bool {
        $params = [];
        if (isset($description)) $params['description'] = $description;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('setMyDescription', $params);
    }

    /**
     * Method: getMyDescription
     *
     * Use this method to get the current bot description for the given user language. Returns BotDescription on success.
     * @link https://core.telegram.org/bots/api#getmydescription
     * @param ?string $languageCode
     * @return BotDescription
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyDescription(?string $languageCode = null): BotDescription {
        $params = [];
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return BotDescription::fromArray($this->request('getMyDescription', $params));
    }

    /**
     * Method: setMyShortDescription
     *
     * Use this method to change the bot's short description, which is shown on the bot's profile page and is sent together with the link when users share the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmyshortdescription
     * @param ?string $shortDescription
     * @param ?string $languageCode
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyShortDescription(?string $shortDescription = null, ?string $languageCode = null): bool {
        $params = [];
        if (isset($shortDescription)) $params['short_description'] = $shortDescription;
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return $this->request('setMyShortDescription', $params);
    }

    /**
     * Method: getMyShortDescription
     *
     * Use this method to get the current bot short description for the given user language. Returns BotShortDescription on success.
     * @link https://core.telegram.org/bots/api#getmyshortdescription
     * @param ?string $languageCode
     * @return BotShortDescription
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyShortDescription(?string $languageCode = null): BotShortDescription {
        $params = [];
        if (isset($languageCode)) $params['language_code'] = $languageCode;
        return BotShortDescription::fromArray($this->request('getMyShortDescription', $params));
    }

    /**
     * Method: setChatMenuButton
     *
     * Use this method to change the bot's menu button in a private chat, or the default menu button. Returns True on success.
     * @link https://core.telegram.org/bots/api#setchatmenubutton
     * @param ?int $chatId
     * @param ?MenuButton $menuButton
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setChatMenuButton(?int $chatId = null, ?MenuButton $menuButton = null): bool {
        $params = [];
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($menuButton)) $params['menu_button'] = $menuButton;
        return $this->request('setChatMenuButton', $params);
    }

    /**
     * Method: getChatMenuButton
     *
     * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button. Returns MenuButton on success.
     * @link https://core.telegram.org/bots/api#getchatmenubutton
     * @param ?int $chatId
     * @return MenuButton
     * @throws Exception
     * @throws GuzzleException
     */
    public function getChatMenuButton(?int $chatId = null): MenuButton {
        $params = [];
        if (isset($chatId)) $params['chat_id'] = $chatId;
        return MenuButton::fromArray($this->request('getChatMenuButton', $params));
    }

    /**
     * Method: setMyDefaultAdministratorRights
     *
     * Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels. These rights will be suggested to users, but they are free to modify the list before adding the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmydefaultadministratorrights
     * @param ?ChatAdministratorRights $rights
     * @param ?bool $forChannels
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyDefaultAdministratorRights(?ChatAdministratorRights $rights = null, ?bool $forChannels = null): bool {
        $params = [];
        if (isset($rights)) $params['rights'] = $rights;
        if (isset($forChannels)) $params['for_channels'] = $forChannels;
        return $this->request('setMyDefaultAdministratorRights', $params);
    }

    /**
     * Method: getMyDefaultAdministratorRights
     *
     * Use this method to get the current default administrator rights of the bot. Returns ChatAdministratorRights on success.
     * @link https://core.telegram.org/bots/api#getmydefaultadministratorrights
     * @param ?bool $forChannels
     * @return ChatAdministratorRights
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyDefaultAdministratorRights(?bool $forChannels = null): ChatAdministratorRights {
        $params = [];
        if (isset($forChannels)) $params['for_channels'] = $forChannels;
        return ChatAdministratorRights::fromArray($this->request('getMyDefaultAdministratorRights', $params));
    }

    /**
     * Method: editMessageText
     *
     * Use this method to edit text and game messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned. Note that business messages that were not sent by the bot and do not contain an inline keyboard can only be edited within 48 hours from the time they were sent.
     * @link https://core.telegram.org/bots/api#editmessagetext
     * @param string $text
     * @param ?string $businessConnectionId
     * @param int|string|null $chatId
     * @param ?int $messageId
     * @param ?string $inlineMessageId
     * @param ?string $parseMode
     * @param ?array $entities
     * @param ?LinkPreviewOptions $linkPreviewOptions
     * @param ?InlineKeyboardMarkup $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function editMessageText(string $text, ?string $businessConnectionId = null, int|string|null $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?string $parseMode = null, ?array $entities = null, ?LinkPreviewOptions $linkPreviewOptions = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
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

    /**
     * Method: editMessageCaption
     *
     * Use this method to edit captions of messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned. Note that business messages that were not sent by the bot and do not contain an inline keyboard can only be edited within 48 hours from the time they were sent.
     * @link https://core.telegram.org/bots/api#editmessagecaption
     * @param ?string $businessConnectionId
     * @param int|string|null $chatId
     * @param ?int $messageId
     * @param ?string $inlineMessageId
     * @param ?string $caption
     * @param ?string $parseMode
     * @param ?array $captionEntities
     * @param ?bool $showCaptionAboveMedia
     * @param ?InlineKeyboardMarkup $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function editMessageCaption(?string $businessConnectionId = null, int|string|null $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?bool $showCaptionAboveMedia = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
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

    /**
     * Method: editMessageMedia
     *
     * Use this method to edit animation, audio, document, live photo, photo, or video messages, or to add media to text messages.
     * @link https://core.telegram.org/bots/api#editmessagemedia
     * @param AbstractObject|string $media
     * @param string|null $businessConnectionId
     * @param int|string|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     * @param InlineKeyboardMarkup|null $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function editMessageMedia(AbstractObject|string $media, ?string $businessConnectionId = null, int|string|null $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        $multipart = false;
        $params['media'] = $media;
        if (is_string($media) && file_exists($media)) {
            $params['media'] = fopen($media, 'r');
            $multipart = true;
        }
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('editMessageMedia', $params, $multipart));
    }

    /**
     * Method: editMessageLiveLocation
     *
     * Use this method to edit live location messages. A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation . On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     * @param float $latitude
     * @param float $longitude
     * @param ?string $businessConnectionId
     * @param int|string|null $chatId
     * @param ?int $messageId
     * @param ?string $inlineMessageId
     * @param ?int $livePeriod
     * @param ?float $horizontalAccuracy
     * @param ?int $heading
     * @param ?int $proximityAlertRadius
     * @param ?InlineKeyboardMarkup $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function editMessageLiveLocation(float $latitude, float $longitude, ?string $businessConnectionId = null, int|string|null $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?int $livePeriod = null, ?float $horizontalAccuracy = null, ?int $heading = null, ?int $proximityAlertRadius = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
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

    /**
     * Method: stopMessageLiveLocation
     *
     * Use this method to stop updating a live location message before live_period expires. On success, if the message is not an inline message, the edited Message is returned, otherwise True is returned.
     * @link https://core.telegram.org/bots/api#stopmessagelivelocation
     * @param ?string $businessConnectionId
     * @param int|string|null $chatId
     * @param ?int $messageId
     * @param ?string $inlineMessageId
     * @param ?InlineKeyboardMarkup $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function stopMessageLiveLocation(?string $businessConnectionId = null, int|string|null $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('stopMessageLiveLocation', $params));
    }

    /**
     * Method: editMessageReplyMarkup
     *
     * Use this method to edit only the reply markup of messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned. Note that business messages that were not sent by the bot and do not contain an inline keyboard can only be edited within 48 hours from the time they were sent.
     * @link https://core.telegram.org/bots/api#editmessagereplymarkup
     * @param ?string $businessConnectionId
     * @param int|string|null $chatId
     * @param ?int $messageId
     * @param ?string $inlineMessageId
     * @param ?InlineKeyboardMarkup $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function editMessageReplyMarkup(?string $businessConnectionId = null, int|string|null $chatId = null, ?int $messageId = null, ?string $inlineMessageId = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        if (isset($chatId)) $params['chat_id'] = $chatId;
        if (isset($messageId)) $params['message_id'] = $messageId;
        if (isset($inlineMessageId)) $params['inline_message_id'] = $inlineMessageId;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('editMessageReplyMarkup', $params));
    }

    /**
     * Method: stopPoll
     *
     * Use this method to stop a poll which was sent by the bot. On success, the stopped Poll is returned.
     * @link https://core.telegram.org/bots/api#stoppoll
     * @param int|string $chatId
     * @param int $messageId
     * @param ?string $businessConnectionId
     * @param ?InlineKeyboardMarkup $replyMarkup
     * @return Poll
     * @throws Exception
     * @throws GuzzleException
     */
    public function stopPoll(int|string $chatId, int $messageId, ?string $businessConnectionId = null, ?InlineKeyboardMarkup $replyMarkup = null): Poll {
        $params = [];
        if (isset($businessConnectionId)) $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Poll::fromArray($this->request('stopPoll', $params));
    }

    /**
     * Method: deleteMessage
     *
     * Use this method to delete a message, including service messages, with the following limitations:
     * @link https://core.telegram.org/bots/api#deletemessage
     * @param int|string $chatId
     * @param int $messageId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteMessage(int|string $chatId, int $messageId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        return $this->request('deleteMessage', $params);
    }

    /**
     * Method: deleteMessages
     *
     * Use this method to delete multiple messages simultaneously. If some of the specified messages can't be found, they are skipped. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletemessages
     * @param int|string $chatId
     * @param array $messageIds
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteMessages(int|string $chatId, array $messageIds): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_ids'] = $messageIds;
        return $this->request('deleteMessages', $params);
    }

    /**
     * Method: sendSticker
     *
     * Use this method to send static .WEBP, animated .TGS, or video .WEBM stickers. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendsticker
     * @param int|string $chatId
     * @param string $sticker
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?string $emoji
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendSticker(int|string $chatId, string $sticker, ?string $businessConnectionId = null, ?int $messageThreadId = null, ?string $emoji = null, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null, ?bool $allowPaidBroadcast = null): Message {
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

    /**
     * Method: getStickerSet
     *
     * Use this method to get a sticker set. On success, a StickerSet object is returned.
     * @link https://core.telegram.org/bots/api#getstickerset
     * @param string $name
     * @return StickerSet
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: uploadStickerFile
     *
     * Use this method to upload a file with a sticker for later use in the createNewStickerSet , addStickerToSet , or replaceStickerInSet methods (the file can be used multiple times). Returns the uploaded File on success.
     * @link https://core.telegram.org/bots/api#uploadstickerfile
     * @param int $userId
     * @param string $sticker
     * @param string $stickerFormat
     * @return File
     * @throws Exception
     * @throws GuzzleException
     */
    public function uploadStickerFile(int $userId, string $sticker, string $stickerFormat): File {
        $params = [];
        $params['user_id'] = $userId;
        $params['sticker'] = fopen($sticker, 'r');
        $params['sticker_format'] = $stickerFormat;
        return File::fromArray($this->request('uploadStickerFile', $params, true));
    }

    /**
     * Method: createNewStickerSet
     *
     * Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus created. Returns True on success.
     * @link https://core.telegram.org/bots/api#createnewstickerset
     * @param int $userId
     * @param string $name
     * @param string $title
     * @param array $stickers
     * @param ?string $stickerType
     * @param ?bool $needsRepainting
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: addStickerToSet
     *
     * Use this method to add a new sticker to a set created by the bot. Emoji sticker sets can have up to 200 stickers. Other sticker sets can have up to 120 stickers. Returns True on success.
     * @link https://core.telegram.org/bots/api#addstickertoset
     * @param int $userId
     * @param string $name
     * @param InputSticker $sticker
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function addStickerToSet(int $userId, string $name, InputSticker $sticker): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['name'] = $name;
        $params['sticker'] = $sticker;
        return $this->request('addStickerToSet', $params);
    }

    /**
     * Method: setStickerPositionInSet
     *
     * Use this method to move a sticker in a set created by the bot to a specific position. Returns True on success.
     * @link https://core.telegram.org/bots/api#setstickerpositioninset
     * @param string $sticker
     * @param int $position
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setStickerPositionInSet(string $sticker, int $position): bool {
        $params = [];
        $params['sticker'] = $sticker;
        $params['position'] = $position;
        return $this->request('setStickerPositionInSet', $params);
    }

    /**
     * Method: deleteStickerFromSet
     *
     * Use this method to delete a sticker from a set created by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletestickerfromset
     * @param string $sticker
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteStickerFromSet(string $sticker): bool {
        $params = [];
        $params['sticker'] = $sticker;
        return $this->request('deleteStickerFromSet', $params);
    }

    /**
     * Method: replaceStickerInSet
     *
     * Use this method to replace an existing sticker in a sticker set with a new one. The method is equivalent to calling deleteStickerFromSet , then addStickerToSet , then setStickerPositionInSet . Returns True on success.
     * @link https://core.telegram.org/bots/api#replacestickerinset
     * @param int $userId
     * @param string $name
     * @param string $oldSticker
     * @param InputSticker $sticker
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function replaceStickerInSet(int $userId, string $name, string $oldSticker, InputSticker $sticker): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['name'] = $name;
        $params['old_sticker'] = $oldSticker;
        $params['sticker'] = $sticker;
        return $this->request('replaceStickerInSet', $params);
    }

    /**
     * Method: setStickerEmojiList
     *
     * Use this method to change the list of emoji assigned to a regular or custom emoji sticker. The sticker must belong to a sticker set created by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setstickeremojilist
     * @param string $sticker
     * @param array $emojiList
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setStickerEmojiList(string $sticker, array $emojiList): bool {
        $params = [];
        $params['sticker'] = $sticker;
        $params['emoji_list'] = $emojiList;
        return $this->request('setStickerEmojiList', $params);
    }

    /**
     * Method: setStickerKeywords
     *
     * Use this method to change search keywords assigned to a regular or custom emoji sticker. The sticker must belong to a sticker set created by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setstickerkeywords
     * @param string $sticker
     * @param ?array $keywords
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setStickerKeywords(string $sticker, ?array $keywords = null): bool {
        $params = [];
        $params['sticker'] = $sticker;
        if (isset($keywords)) $params['keywords'] = $keywords;
        return $this->request('setStickerKeywords', $params);
    }

    /**
     * Method: setStickerMaskPosition
     *
     * Use this method to change the mask position of a mask sticker. The sticker must belong to a sticker set that was created by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setstickermaskposition
     * @param string $sticker
     * @param ?MaskPosition $maskPosition
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setStickerMaskPosition(string $sticker, ?MaskPosition $maskPosition = null): bool {
        $params = [];
        $params['sticker'] = $sticker;
        if (isset($maskPosition)) $params['mask_position'] = $maskPosition;
        return $this->request('setStickerMaskPosition', $params);
    }

    /**
     * Method: setStickerSetTitle
     *
     * Use this method to set the title of a created sticker set. Returns True on success.
     * @link https://core.telegram.org/bots/api#setstickersettitle
     * @param string $name
     * @param string $title
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setStickerSetTitle(string $name, string $title): bool {
        $params = [];
        $params['name'] = $name;
        $params['title'] = $title;
        return $this->request('setStickerSetTitle', $params);
    }

    /**
     * Method: setStickerSetThumbnail
     *
     * Use this method to set the thumbnail of a regular or mask sticker set. The format of the thumbnail file must match the format of the stickers in the set. Returns True on success.
     * @link https://core.telegram.org/bots/api#setstickersetthumbnail
     * @param string $name
     * @param int $userId
     * @param string $format
     * @param ?string $thumbnail
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setStickerSetThumbnail(string $name, int $userId, string $format, ?string $thumbnail = null): bool {
        $params = [];
        $params['name'] = $name;
        $params['user_id'] = $userId;
        if (isset($thumbnail)) $params['thumbnail'] = $thumbnail;
        $params['format'] = $format;
        return $this->request('setStickerSetThumbnail', $params);
    }

    /**
     * Method: setCustomEmojiStickerSetThumbnail
     *
     * Use this method to set the thumbnail of a custom emoji sticker set. Returns True on success.
     * @link https://core.telegram.org/bots/api#setcustomemojistickersetthumbnail
     * @param string $name
     * @param ?string $customEmojiId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setCustomEmojiStickerSetThumbnail(string $name, ?string $customEmojiId = null): bool {
        $params = [];
        $params['name'] = $name;
        if (isset($customEmojiId)) $params['custom_emoji_id'] = $customEmojiId;
        return $this->request('setCustomEmojiStickerSetThumbnail', $params);
    }

    /**
     * Method: deleteStickerSet
     *
     * Use this method to delete a sticker set that was created by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletestickerset
     * @param string $name
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteStickerSet(string $name): bool {
        $params = [];
        $params['name'] = $name;
        return $this->request('deleteStickerSet', $params);
    }

    /**
     * Method: answerInlineQuery
     *
     * Use this method to send answers to an inline query. On success, True is returned.
     * @link https://core.telegram.org/bots/api#answerinlinequery
     * @param string $inlineQueryId
     * @param array $results
     * @param ?int $cacheTime
     * @param ?bool $isPersonal
     * @param ?string $nextOffset
     * @param ?InlineQueryResultsButton $button
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: answerGuestQuery
     *
     * Use this method to reply to a received guest message. On success, a SentGuestMessage object is returned.
     * @link https://core.telegram.org/bots/api#answerguestquery
     * @param string $guestQueryId
     * @param InlineQueryResult $result
     * @return SentGuestMessage
     * @throws Exception
     * @throws GuzzleException
     */
    public function answerGuestQuery(string $guestQueryId, InlineQueryResult $result): SentGuestMessage {
        $params = [];
        $params['guest_query_id'] = $guestQueryId;
        $params['result'] = $result;
        return SentGuestMessage::fromArray($this->request('answerGuestQuery', $params));
    }

    /**
     * Method: answerWebAppQuery
     *
     * Use this method to set the result of an interaction with a Web App and send a corresponding message on behalf of the user to the chat from which the query originated. On success, a SentWebAppMessage object is returned.
     * @link https://core.telegram.org/bots/api#answerwebappquery
     * @param string $webAppQueryId
     * @param InlineQueryResult $result
     * @return SentWebAppMessage
     * @throws Exception
     * @throws GuzzleException
     */
    public function answerWebAppQuery(string $webAppQueryId, InlineQueryResult $result): SentWebAppMessage {
        $params = [];
        $params['web_app_query_id'] = $webAppQueryId;
        $params['result'] = $result;
        return SentWebAppMessage::fromArray($this->request('answerWebAppQuery', $params));
    }

    /**
     * Method: sendInvoice
     *
     * Use this method to send invoices. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendinvoice
     * @param int|string $chatId
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $currency
     * @param array $prices
     * @param ?bool $needPhoneNumber
     * @param ?ReplyParameters $replyParameters
     * @param ?string $messageEffectId
     * @param ?bool $protectContent
     * @param ?bool $disableNotification
     * @param ?bool $isFlexible
     * @param ?bool $sendEmailToProvider
     * @param ?bool $sendPhoneNumberToProvider
     * @param ?bool $needShippingAddress
     * @param ?bool $needEmail
     * @param ?int $photoWidth
     * @param ?bool $needName
     * @param ?int $photoHeight
     * @param ?int $messageThreadId
     * @param ?int $photoSize
     * @param ?string $photoUrl
     * @param ?string $providerData
     * @param ?string $startParameter
     * @param ?array $suggestedTipAmounts
     * @param ?int $maxTipAmount
     * @param ?string $providerToken
     * @param ?InlineKeyboardMarkup $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: createInvoiceLink
     *
     * Use this method to create a link for an invoice. Returns the created invoice link as String on success.
     * @link https://core.telegram.org/bots/api#createinvoicelink
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $currency
     * @param array $prices
     * @param ?string $businessConnectionId
     * @param ?int $photoHeight
     * @param ?bool $sendEmailToProvider
     * @param ?bool $sendPhoneNumberToProvider
     * @param ?bool $needShippingAddress
     * @param ?bool $needEmail
     * @param ?bool $needPhoneNumber
     * @param ?bool $needName
     * @param ?string $photoUrl
     * @param ?int $photoWidth
     * @param ?int $photoSize
     * @param ?string $providerData
     * @param ?array $suggestedTipAmounts
     * @param ?int $maxTipAmount
     * @param ?int $subscriptionPeriod
     * @param ?string $providerToken
     * @param ?bool $isFlexible
     * @return string
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: editUserStarSubscription
     *
     * Allows the bot to cancel or re-enable extension of a subscription paid in Telegram Stars. Returns True on success.
     * @link https://core.telegram.org/bots/api#edituserstarsubscription
     * @param int $userId
     * @param string $telegramPaymentChargeId
     * @param bool $isCanceled
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function editUserStarSubscription(int $userId, string $telegramPaymentChargeId, bool $isCanceled): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['telegram_payment_charge_id'] = $telegramPaymentChargeId;
        $params['is_canceled'] = $isCanceled;
        return $this->request('editUserStarSubscription', $params);
    }

    /**
     * Method: setUserEmojiStatus
     *
     * Changes the emoji status for a given user that previously allowed the bot to manage their emoji status via the Mini App method requestEmojiStatusAccess . Returns True on success.
     * @link https://core.telegram.org/bots/api#setuseremojistatus
     * @param int $userId
     * @param ?string $emojiStatusCustomEmojiId
     * @param ?int $emojiStatusExpirationDate
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setUserEmojiStatus(int $userId, ?string $emojiStatusCustomEmojiId = null, ?int $emojiStatusExpirationDate = null): bool {
        $params = [];
        $params['user_id'] = $userId;
        if (isset($emojiStatusCustomEmojiId)) $params['emoji_status_custom_emoji_id'] = $emojiStatusCustomEmojiId;
        if (isset($emojiStatusExpirationDate)) $params['emoji_status_expiration_date'] = $emojiStatusExpirationDate;
        return $this->request('setUserEmojiStatus', $params);
    }

    /**
     * Method: savePreparedInlineMessage
     *
     * Stores a message that can be sent by a user of a Mini App. Returns a PreparedInlineMessage object.
     * @link https://core.telegram.org/bots/api#savepreparedinlinemessage
     * @param int $userId
     * @param InlineQueryResult $result
     * @param ?bool $allowUserChats
     * @param ?bool $allowBotChats
     * @param ?bool $allowGroupChats
     * @param ?bool $allowChannelChats
     * @return PreparedInlineMessage
     * @throws Exception
     * @throws GuzzleException
     */
    public function savePreparedInlineMessage(int $userId, InlineQueryResult $result, ?bool $allowUserChats = null, ?bool $allowBotChats = null, ?bool $allowGroupChats = null, ?bool $allowChannelChats = null): PreparedInlineMessage {
        $params = [];
        $params['user_id'] = $userId;
        $params['result'] = $result;
        if (isset($allowUserChats)) $params['allow_user_chats'] = $allowUserChats;
        if (isset($allowBotChats)) $params['allow_bot_chats'] = $allowBotChats;
        if (isset($allowGroupChats)) $params['allow_group_chats'] = $allowGroupChats;
        if (isset($allowChannelChats)) $params['allow_channel_chats'] = $allowChannelChats;
        return PreparedInlineMessage::fromArray($this->request('savePreparedInlineMessage', $params));
    }

    /**
     * Method: getAvailableGifts
     *
     * Returns the list of gifts that can be sent by the bot to users and channel chats. Requires no parameters. Returns a Gifts object.
     * @link https://core.telegram.org/bots/api#getavailablegifts
     * @return Gifts
     * @throws Exception
     * @throws GuzzleException
     */
    public function getAvailableGifts(): Gifts {
        $params = [];
        return Gifts::fromArray($this->request('getAvailableGifts', $params));
    }

    /**
     * Method: sendGift
     *
     * Sends a gift to the given user or channel chat. The gift can't be converted to Telegram Stars by the receiver. Returns True on success.
     * @link https://core.telegram.org/bots/api#sendgift
     * @param int $userId
     * @param string $giftId
     * @param ?string $text
     * @param ?string $textParseMode
     * @param ?array $textEntities
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendGift(int $userId, string $giftId, ?string $text = null, ?string $textParseMode = null, ?array $textEntities = null): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['gift_id'] = $giftId;
        if (isset($text)) $params['text'] = $text;
        if (isset($textParseMode)) $params['text_parse_mode'] = $textParseMode;
        if (isset($textEntities)) $params['text_entities'] = $textEntities;
        return $this->request('sendGift', $params);
    }

    /**
     * Method: answerShippingQuery
     *
     * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True is returned.
     * @link https://core.telegram.org/bots/api#answershippingquery
     * @param string $shippingQueryId
     * @param bool $ok
     * @param ?array $shippingOptions
     * @param ?string $errorMessage
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function answerShippingQuery(string $shippingQueryId, bool $ok, ?array $shippingOptions = null, ?string $errorMessage = null): bool {
        $params = [];
        $params['shipping_query_id'] = $shippingQueryId;
        $params['ok'] = $ok;
        if (isset($shippingOptions)) $params['shipping_options'] = $shippingOptions;
        if (isset($errorMessage)) $params['error_message'] = $errorMessage;
        return $this->request('answerShippingQuery', $params);
    }

    /**
     * Method: answerPreCheckoutQuery
     *
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query . Use this method to respond to such pre-checkout queries. On success, True is returned. Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     * @link https://core.telegram.org/bots/api#answerprecheckoutquery
     * @param string $preCheckoutQueryId
     * @param bool $ok
     * @param ?string $errorMessage
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function answerPreCheckoutQuery(string $preCheckoutQueryId, bool $ok, ?string $errorMessage = null): bool {
        $params = [];
        $params['pre_checkout_query_id'] = $preCheckoutQueryId;
        $params['ok'] = $ok;
        if (isset($errorMessage)) $params['error_message'] = $errorMessage;
        return $this->request('answerPreCheckoutQuery', $params);
    }

    /**
     * Method: getStarTransactions
     *
     * Returns the bot's Telegram Star transactions in chronological order. On success, returns a StarTransactions object.
     * @link https://core.telegram.org/bots/api#getstartransactions
     * @param ?int $offset
     * @param ?int $limit
     * @return StarTransactions
     * @throws Exception
     * @throws GuzzleException
     */
    public function getStarTransactions(?int $offset = null, ?int $limit = null): StarTransactions {
        $params = [];
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        return StarTransactions::fromArray($this->request('getStarTransactions', $params));
    }

    /**
     * Method: refundStarPayment
     *
     * Refunds a successful payment in Telegram Stars . Returns True on success.
     * @link https://core.telegram.org/bots/api#refundstarpayment
     * @param int $userId
     * @param string $telegramPaymentChargeId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function refundStarPayment(int $userId, string $telegramPaymentChargeId): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['telegram_payment_charge_id'] = $telegramPaymentChargeId;
        return $this->request('refundStarPayment', $params);
    }

    /**
     * Method: setPassportDataErrors
     *
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns True on success.
     * @link https://core.telegram.org/bots/api#setpassportdataerrors
     * @param int $userId
     * @param array $errors
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setPassportDataErrors(int $userId, array $errors): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['errors'] = $errors;
        return $this->request('setPassportDataErrors', $params);
    }

    /**
     * Method: sendGame
     *
     * Use this method to send a game. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendgame
     * @param int $chatId
     * @param string $gameShortName
     * @param ?string $businessConnectionId
     * @param ?int $messageThreadId
     * @param ?bool $disableNotification
     * @param ?bool $protectContent
     * @param ?string $messageEffectId
     * @param ?ReplyParameters $replyParameters
     * @param ?InlineKeyboardMarkup $replyMarkup
     * @param ?bool $allowPaidBroadcast
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: setGameScore
     *
     * Use this method to set the score of the specified user in a game message. On success, if the message is not an inline message, the Message is returned, otherwise True is returned. Returns an error, if the new score is not greater than the user's current score in the chat and force is False .
     * @link https://core.telegram.org/bots/api#setgamescore
     * @param int $userId
     * @param int $score
     * @param ?bool $force
     * @param ?bool $disableEditMessage
     * @param ?int $chatId
     * @param ?int $messageId
     * @param ?string $inlineMessageId
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: sendChecklist
     *
     * Use this method to send a checklist on behalf of a connected business account. On success, the sent Message is returned.
     * @link https://core.telegram.org/bots/api#sendchecklist
     * @param string $businessConnectionId
     * @param int $chatId
     * @param InputChecklist $checklist
     * @param bool|null $disableNotification
     * @param bool|null $protectContent
     * @param string|null $messageEffectId
     * @param ReplyParameters|null $replyParameters
     * @param InlineKeyboardMarkup|null $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendChecklist(string $businessConnectionId, int $chatId, InputChecklist $checklist, ?bool $disableNotification = null, ?bool $protectContent = null, ?string $messageEffectId = null, ?ReplyParameters $replyParameters = null, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        $params['checklist'] = $checklist;
        if (isset($disableNotification)) $params['disable_notification'] = $disableNotification;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        if (isset($messageEffectId)) $params['message_effect_id'] = $messageEffectId;
        if (isset($replyParameters)) $params['reply_parameters'] = $replyParameters;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('sendChecklist', $params));
    }

    /**
     * Method: sendMessageDraft
     *
     * Use this method to stream a partial message to a user while the message is being generated. Returns True on success.
     * @link https://core.telegram.org/bots/api#sendmessagedraft
     * @param int $chatId
     * @param int $draftId
     * @param string $text
     * @param int|null $messageThreadId
     * @param string|null $parseMode
     * @param array|null $entities
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function sendMessageDraft(int $chatId, int $draftId, string $text, ?int $messageThreadId = null, ?string $parseMode = null, ?array $entities = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['draft_id'] = $draftId;
        $params['text'] = $text;
        if (isset($messageThreadId)) $params['message_thread_id'] = $messageThreadId;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($entities)) $params['entities'] = $entities;
        return $this->request('sendMessageDraft', $params);
    }

    /**
     * Method: getUserProfileAudios
     *
     * Use this method to get a list of profile audios for a user. Returns a UserProfileAudios object.
     * @link https://core.telegram.org/bots/api#getuserprofileaudios
     * @param int $userId
     * @param int|null $offset
     * @param int|null $limit
     * @return UserProfileAudios
     * @throws Exception
     * @throws GuzzleException
     */
    public function getUserProfileAudios(int $userId, ?int $offset = null, ?int $limit = null): UserProfileAudios {
        $params = [];
        $params['user_id'] = $userId;
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        return UserProfileAudios::fromArray($this->request('getUserProfileAudios', $params));
    }

    /**
     * Method: getUserPersonalChatMessages
     *
     * Use this method to get the last messages from the personal chat (i.e., the chat currently added to their profile) of a given user. On success, an array of Message objects is returned.
     * @link https://core.telegram.org/bots/api#getuserpersonalchatmessages
     * @param int $userId
     * @param int $limit
     * @return Message[]
     * @throws Exception
     * @throws GuzzleException
     */
    public function getUserPersonalChatMessages(int $userId, int $limit): array {
        $params = [];
        $params['user_id'] = $userId;
        $params['limit'] = $limit;
        return Message::arrayOf($this->request('getUserPersonalChatMessages', $params));
    }

    /**
     * Method: setChatMemberTag
     *
     * Use this method to set a tag for a regular member in a group or a supergroup. The bot must be an administrator in the chat for this to work and must have the can_manage_tags administrator right. Returns True on success.
     * @link https://core.telegram.org/bots/api#setchatmembertag
     * @param int|string $chatId
     * @param int $userId
     * @param string|null $tag
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setChatMemberTag(int|string $chatId, int $userId, ?string $tag = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        if (isset($tag)) $params['tag'] = $tag;
        return $this->request('setChatMemberTag', $params);
    }

    /**
     * Method: getManagedBotToken
     *
     * Use this method to get the token of a managed bot. Returns the token as String on success.
     * @link https://core.telegram.org/bots/api#getmanagedbottoken
     * @param int $userId
     * @return string
     * @throws Exception
     * @throws GuzzleException
     */
    public function getManagedBotToken(int $userId): string {
        $params = [];
        $params['user_id'] = $userId;
        return $this->request('getManagedBotToken', $params);
    }

    /**
     * Method: replaceManagedBotToken
     *
     * Use this method to revoke the current token of a managed bot and generate a new one. Returns the new token as String on success.
     * @link https://core.telegram.org/bots/api#replacemanagedbottoken
     * @param int $userId
     * @return string
     * @throws Exception
     * @throws GuzzleException
     */
    public function replaceManagedBotToken(int $userId): string {
        $params = [];
        $params['user_id'] = $userId;
        return $this->request('replaceManagedBotToken', $params);
    }

    /**
     * Method: getManagedBotAccessSettings
     *
     * Use this method to get the access settings of a managed bot. Returns a BotAccessSettings object on success.
     * @link https://core.telegram.org/bots/api#getmanagedbotaccesssettings
     * @param int $userId
     * @return BotAccessSettings
     * @throws Exception
     * @throws GuzzleException
     */
    public function getManagedBotAccessSettings(int $userId): BotAccessSettings {
        $params = [];
        $params['user_id'] = $userId;
        return BotAccessSettings::fromArray($this->request('getManagedBotAccessSettings', $params));
    }

    /**
     * Method: setManagedBotAccessSettings
     *
     * Use this method to change the access settings of a managed bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmanagedbotaccesssettings
     * @param int $userId
     * @param bool $isAccessRestricted
     * @param array|null $addedUserIds
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setManagedBotAccessSettings(int $userId, bool $isAccessRestricted, ?array $addedUserIds = null): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['is_access_restricted'] = $isAccessRestricted;
        if (isset($addedUserIds)) $params['added_user_ids'] = $addedUserIds;
        return $this->request('setManagedBotAccessSettings', $params);
    }

    /**
     * Method: setMyProfilePhoto
     *
     * Changes the profile photo of the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#setmyprofilephoto
     * @param InputProfilePhoto $photo
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setMyProfilePhoto(InputProfilePhoto $photo): bool {
        $params = [];
        $params['photo'] = $photo;
        return $this->request('setMyProfilePhoto', $params);
    }

    /**
     * Method: removeMyProfilePhoto
     *
     * Removes the profile photo of the bot. Requires no parameters. Returns True on success.
     * @link https://core.telegram.org/bots/api#removemyprofilephoto
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function removeMyProfilePhoto(): bool {
        $params = [];
        return $this->request('removeMyProfilePhoto', $params);
    }

    /**
     * Method: giftPremiumSubscription
     *
     * Gifts a Telegram Premium subscription to the given user. Returns True on success.
     * @link https://core.telegram.org/bots/api#giftpremiumsubscription
     * @param int $userId
     * @param int $monthCount
     * @param int $starCount
     * @param string|null $text
     * @param string|null $textParseMode
     * @param array|null $textEntities
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function giftPremiumSubscription(int $userId, int $monthCount, int $starCount, ?string $text = null, ?string $textParseMode = null, ?array $textEntities = null): bool {
        $params = [];
        $params['user_id'] = $userId;
        $params['month_count'] = $monthCount;
        $params['star_count'] = $starCount;
        if (isset($text)) $params['text'] = $text;
        if (isset($textParseMode)) $params['text_parse_mode'] = $textParseMode;
        if (isset($textEntities)) $params['text_entities'] = $textEntities;
        return $this->request('giftPremiumSubscription', $params);
    }

    /**
     * Method: verifyUser
     *
     * Verifies a user on behalf of the organization which is represented by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#verifyuser
     * @param int $userId
     * @param string|null $customDescription
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function verifyUser(int $userId, ?string $customDescription = null): bool {
        $params = [];
        $params['user_id'] = $userId;
        if (isset($customDescription)) $params['custom_description'] = $customDescription;
        return $this->request('verifyUser', $params);
    }

    /**
     * Method: verifyChat
     *
     * Verifies a chat on behalf of the organization which is represented by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#verifychat
     * @param int|string $chatId
     * @param string|null $customDescription
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function verifyChat(int|string $chatId, ?string $customDescription = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($customDescription)) $params['custom_description'] = $customDescription;
        return $this->request('verifyChat', $params);
    }

    /**
     * Method: removeUserVerification
     *
     * Removes verification from a user who is currently verified on behalf of the organization represented by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#removeuserverification
     * @param int $userId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function removeUserVerification(int $userId): bool {
        $params = [];
        $params['user_id'] = $userId;
        return $this->request('removeUserVerification', $params);
    }

    /**
     * Method: removeChatVerification
     *
     * Removes verification from a chat that is currently verified on behalf of the organization represented by the bot. Returns True on success.
     * @link https://core.telegram.org/bots/api#removechatverification
     * @param int|string $chatId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function removeChatVerification(int|string $chatId): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        return $this->request('removeChatVerification', $params);
    }

    /**
     * Method: readBusinessMessage
     *
     * Marks incoming message as read on behalf of a business account. Requires the can_read_messages business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#readbusinessmessage
     * @param string $businessConnectionId
     * @param int $chatId
     * @param int $messageId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function readBusinessMessage(string $businessConnectionId, int $chatId, int $messageId): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        return $this->request('readBusinessMessage', $params);
    }

    /**
     * Method: deleteBusinessMessages
     *
     * Delete messages on behalf of a business account. Requires the can_delete_sent_messages business bot right to delete messages sent by the bot itself, or the can_delete_all_messages business bot right to delete any message. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletebusinessmessages
     * @param string $businessConnectionId
     * @param array $messageIds
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteBusinessMessages(string $businessConnectionId, array $messageIds): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['message_ids'] = $messageIds;
        return $this->request('deleteBusinessMessages', $params);
    }

    /**
     * Method: setBusinessAccountName
     *
     * Changes the first and last name of a managed business account. Requires the can_change_name business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#setbusinessaccountname
     * @param string $businessConnectionId
     * @param string $firstName
     * @param string|null $lastName
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setBusinessAccountName(string $businessConnectionId, string $firstName, ?string $lastName = null): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['first_name'] = $firstName;
        if (isset($lastName)) $params['last_name'] = $lastName;
        return $this->request('setBusinessAccountName', $params);
    }

    /**
     * Method: setBusinessAccountUsername
     *
     * Changes the username of a managed business account. Requires the can_change_username business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#setbusinessaccountusername
     * @param string $businessConnectionId
     * @param string|null $username
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setBusinessAccountUsername(string $businessConnectionId, ?string $username = null): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        if (isset($username)) $params['username'] = $username;
        return $this->request('setBusinessAccountUsername', $params);
    }

    /**
     * Method: setBusinessAccountBio
     *
     * Changes the bio of a managed business account. Requires the can_change_bio business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#setbusinessaccountbio
     * @param string $businessConnectionId
     * @param string|null $bio
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setBusinessAccountBio(string $businessConnectionId, ?string $bio = null): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        if (isset($bio)) $params['bio'] = $bio;
        return $this->request('setBusinessAccountBio', $params);
    }

    /**
     * Method: setBusinessAccountProfilePhoto
     *
     * Changes the profile photo of a managed business account. Requires the can_edit_profile_photo business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#setbusinessaccountprofilephoto
     * @param string $businessConnectionId
     * @param InputProfilePhoto $photo
     * @param bool|null $isPublic
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setBusinessAccountProfilePhoto(string $businessConnectionId, InputProfilePhoto $photo, ?bool $isPublic = null): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['photo'] = $photo;
        if (isset($isPublic)) $params['is_public'] = $isPublic;
        return $this->request('setBusinessAccountProfilePhoto', $params);
    }

    /**
     * Method: removeBusinessAccountProfilePhoto
     *
     * Removes the current profile photo of a managed business account. Requires the can_edit_profile_photo business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#removebusinessaccountprofilephoto
     * @param string $businessConnectionId
     * @param bool|null $isPublic
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function removeBusinessAccountProfilePhoto(string $businessConnectionId, ?bool $isPublic = null): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        if (isset($isPublic)) $params['is_public'] = $isPublic;
        return $this->request('removeBusinessAccountProfilePhoto', $params);
    }

    /**
     * Method: setBusinessAccountGiftSettings
     *
     * Changes the privacy settings pertaining to incoming gifts in a managed business account. Requires the can_change_gift_settings business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#setbusinessaccountgiftsettings
     * @param string $businessConnectionId
     * @param bool $showGiftButton
     * @param AcceptedGiftTypes $acceptedGiftTypes
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function setBusinessAccountGiftSettings(string $businessConnectionId, bool $showGiftButton, AcceptedGiftTypes $acceptedGiftTypes): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['show_gift_button'] = $showGiftButton;
        $params['accepted_gift_types'] = $acceptedGiftTypes;
        return $this->request('setBusinessAccountGiftSettings', $params);
    }

    /**
     * Method: getBusinessAccountStarBalance
     *
     * Returns the amount of Telegram Stars owned by a managed business account. Requires the can_view_gifts_and_stars business bot right. Returns StarAmount on success.
     * @link https://core.telegram.org/bots/api#getbusinessaccountstarbalance
     * @param string $businessConnectionId
     * @return StarAmount
     * @throws Exception
     * @throws GuzzleException
     */
    public function getBusinessAccountStarBalance(string $businessConnectionId): StarAmount {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        return StarAmount::fromArray($this->request('getBusinessAccountStarBalance', $params));
    }

    /**
     * Method: transferBusinessAccountStars
     *
     * Transfers Telegram Stars from the business account balance to the bot's balance. Requires the can_transfer_stars business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#transferbusinessaccountstars
     * @param string $businessConnectionId
     * @param int $starCount
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function transferBusinessAccountStars(string $businessConnectionId, int $starCount): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['star_count'] = $starCount;
        return $this->request('transferBusinessAccountStars', $params);
    }

    /**
     * Method: getBusinessAccountGifts
     *
     * Returns the gifts received and owned by a managed business account. Requires the can_view_gifts_and_stars business bot right. Returns OwnedGifts on success.
     * @link https://core.telegram.org/bots/api#getbusinessaccountgifts
     * @param string $businessConnectionId
     * @param bool|null $excludeUnsaved
     * @param bool|null $excludeSaved
     * @param bool|null $excludeUnlimited
     * @param bool|null $excludeLimitedUpgradable
     * @param bool|null $excludeLimitedNonUpgradable
     * @param bool|null $excludeUnique
     * @param bool|null $excludeFromBlockchain
     * @param bool|null $sortByPrice
     * @param string|null $offset
     * @param int|null $limit
     * @return OwnedGifts
     * @throws Exception
     * @throws GuzzleException
     */
    public function getBusinessAccountGifts(string $businessConnectionId, ?bool $excludeUnsaved = null, ?bool $excludeSaved = null, ?bool $excludeUnlimited = null, ?bool $excludeLimitedUpgradable = null, ?bool $excludeLimitedNonUpgradable = null, ?bool $excludeUnique = null, ?bool $excludeFromBlockchain = null, ?bool $sortByPrice = null, ?string $offset = null, ?int $limit = null): OwnedGifts {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        if (isset($excludeUnsaved)) $params['exclude_unsaved'] = $excludeUnsaved;
        if (isset($excludeSaved)) $params['exclude_saved'] = $excludeSaved;
        if (isset($excludeUnlimited)) $params['exclude_unlimited'] = $excludeUnlimited;
        if (isset($excludeLimitedUpgradable)) $params['exclude_limited_upgradable'] = $excludeLimitedUpgradable;
        if (isset($excludeLimitedNonUpgradable)) $params['exclude_limited_non_upgradable'] = $excludeLimitedNonUpgradable;
        if (isset($excludeUnique)) $params['exclude_unique'] = $excludeUnique;
        if (isset($excludeFromBlockchain)) $params['exclude_from_blockchain'] = $excludeFromBlockchain;
        if (isset($sortByPrice)) $params['sort_by_price'] = $sortByPrice;
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        return OwnedGifts::fromArray($this->request('getBusinessAccountGifts', $params));
    }

    /**
     * Method: getUserGifts
     *
     * Returns the gifts owned and hosted by a user. Returns OwnedGifts on success.
     * @link https://core.telegram.org/bots/api#getusergifts
     * @param int $userId
     * @param bool|null $excludeUnlimited
     * @param bool|null $excludeLimitedUpgradable
     * @param bool|null $excludeLimitedNonUpgradable
     * @param bool|null $excludeFromBlockchain
     * @param bool|null $excludeUnique
     * @param bool|null $sortByPrice
     * @param string|null $offset
     * @param int|null $limit
     * @return OwnedGifts
     * @throws Exception
     * @throws GuzzleException
     */
    public function getUserGifts(int $userId, ?bool $excludeUnlimited = null, ?bool $excludeLimitedUpgradable = null, ?bool $excludeLimitedNonUpgradable = null, ?bool $excludeFromBlockchain = null, ?bool $excludeUnique = null, ?bool $sortByPrice = null, ?string $offset = null, ?int $limit = null): OwnedGifts {
        $params = [];
        $params['user_id'] = $userId;
        if (isset($excludeUnlimited)) $params['exclude_unlimited'] = $excludeUnlimited;
        if (isset($excludeLimitedUpgradable)) $params['exclude_limited_upgradable'] = $excludeLimitedUpgradable;
        if (isset($excludeLimitedNonUpgradable)) $params['exclude_limited_non_upgradable'] = $excludeLimitedNonUpgradable;
        if (isset($excludeFromBlockchain)) $params['exclude_from_blockchain'] = $excludeFromBlockchain;
        if (isset($excludeUnique)) $params['exclude_unique'] = $excludeUnique;
        if (isset($sortByPrice)) $params['sort_by_price'] = $sortByPrice;
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        return OwnedGifts::fromArray($this->request('getUserGifts', $params));
    }

    /**
     * Method: getChatGifts
     *
     * Returns the gifts owned by a chat. Returns OwnedGifts on success.
     * @link https://core.telegram.org/bots/api#getchatgifts
     * @param int|string $chatId
     * @param bool|null $excludeUnsaved
     * @param bool|null $excludeSaved
     * @param bool|null $excludeUnlimited
     * @param bool|null $excludeLimitedUpgradable
     * @param bool|null $excludeLimitedNonUpgradable
     * @param bool|null $excludeFromBlockchain
     * @param bool|null $excludeUnique
     * @param bool|null $sortByPrice
     * @param string|null $offset
     * @param int|null $limit
     * @return OwnedGifts
     * @throws Exception
     * @throws GuzzleException
     */
    public function getChatGifts(int|string $chatId, ?bool $excludeUnsaved = null, ?bool $excludeSaved = null, ?bool $excludeUnlimited = null, ?bool $excludeLimitedUpgradable = null, ?bool $excludeLimitedNonUpgradable = null, ?bool $excludeFromBlockchain = null, ?bool $excludeUnique = null, ?bool $sortByPrice = null, ?string $offset = null, ?int $limit = null): OwnedGifts {
        $params = [];
        $params['chat_id'] = $chatId;
        if (isset($excludeUnsaved)) $params['exclude_unsaved'] = $excludeUnsaved;
        if (isset($excludeSaved)) $params['exclude_saved'] = $excludeSaved;
        if (isset($excludeUnlimited)) $params['exclude_unlimited'] = $excludeUnlimited;
        if (isset($excludeLimitedUpgradable)) $params['exclude_limited_upgradable'] = $excludeLimitedUpgradable;
        if (isset($excludeLimitedNonUpgradable)) $params['exclude_limited_non_upgradable'] = $excludeLimitedNonUpgradable;
        if (isset($excludeFromBlockchain)) $params['exclude_from_blockchain'] = $excludeFromBlockchain;
        if (isset($excludeUnique)) $params['exclude_unique'] = $excludeUnique;
        if (isset($sortByPrice)) $params['sort_by_price'] = $sortByPrice;
        if (isset($offset)) $params['offset'] = $offset;
        if (isset($limit)) $params['limit'] = $limit;
        return OwnedGifts::fromArray($this->request('getChatGifts', $params));
    }

    /**
     * Method: convertGiftToStars
     *
     * Converts a given regular gift to Telegram Stars. Requires the can_convert_gifts_to_stars business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#convertgifttostars
     * @param string $businessConnectionId
     * @param string $ownedGiftId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function convertGiftToStars(string $businessConnectionId, string $ownedGiftId): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['owned_gift_id'] = $ownedGiftId;
        return $this->request('convertGiftToStars', $params);
    }

    /**
     * Method: upgradeGift
     *
     * Upgrades a given regular gift to a unique gift. Requires the can_transfer_and_upgrade_gifts business bot right. Additionally requires the can_transfer_stars business bot right if the upgrade is paid. Returns True on success.
     * @link https://core.telegram.org/bots/api#upgradegift
     * @param string $businessConnectionId
     * @param string $ownedGiftId
     * @param bool|null $keepOriginalDetails
     * @param int|null $starCount
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function upgradeGift(string $businessConnectionId, string $ownedGiftId, ?bool $keepOriginalDetails = null, ?int $starCount = null): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['owned_gift_id'] = $ownedGiftId;
        if (isset($keepOriginalDetails)) $params['keep_original_details'] = $keepOriginalDetails;
        if (isset($starCount)) $params['star_count'] = $starCount;
        return $this->request('upgradeGift', $params);
    }

    /**
     * Method: transferGift
     *
     * Transfers an owned unique gift to another user. Requires the can_transfer_and_upgrade_gifts business bot right. Requires can_transfer_stars business bot right if the transfer is paid. Returns True on success.
     * @link https://core.telegram.org/bots/api#transfergift
     * @param string $businessConnectionId
     * @param string $ownedGiftId
     * @param int $newOwnerChatId
     * @param int|null $starCount
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function transferGift(string $businessConnectionId, string $ownedGiftId, int $newOwnerChatId, ?int $starCount = null): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['owned_gift_id'] = $ownedGiftId;
        $params['new_owner_chat_id'] = $newOwnerChatId;
        if (isset($starCount)) $params['star_count'] = $starCount;
        return $this->request('transferGift', $params);
    }

    /**
     * Method: postStory
     *
     * Posts a story on behalf of a managed business account. Requires the can_manage_stories business bot right. Returns Story on success.
     * @link https://core.telegram.org/bots/api#poststory
     * @param string $businessConnectionId
     * @param InputStoryContent $content
     * @param int $activePeriod
     * @param string|null $caption
     * @param string|null $parseMode
     * @param array|null $captionEntities
     * @param array|null $areas
     * @param bool|null $postToChatPage
     * @param bool|null $protectContent
     * @return Story
     * @throws Exception
     * @throws GuzzleException
     */
    public function postStory(string $businessConnectionId, InputStoryContent $content, int $activePeriod, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?array $areas = null, ?bool $postToChatPage = null, ?bool $protectContent = null): Story {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['content'] = $content;
        $params['active_period'] = $activePeriod;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($areas)) $params['areas'] = $areas;
        if (isset($postToChatPage)) $params['post_to_chat_page'] = $postToChatPage;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        return Story::fromArray($this->request('postStory', $params));
    }

    /**
     * Method: repostStory
     *
     * Reposts a story on behalf of a business account from another business account. Both business accounts must be managed by the same bot, and the story on the source account must have been posted (or reposted) by the bot. Requires the can_manage_stories business bot right for both business accounts. Returns Story on success.
     * @link https://core.telegram.org/bots/api#repoststory
     * @param string $businessConnectionId
     * @param int $fromChatId
     * @param int $fromStoryId
     * @param int $activePeriod
     * @param bool|null $postToChatPage
     * @param bool|null $protectContent
     * @return Story
     * @throws Exception
     * @throws GuzzleException
     */
    public function repostStory(string $businessConnectionId, int $fromChatId, int $fromStoryId, int $activePeriod, ?bool $postToChatPage = null, ?bool $protectContent = null): Story {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['from_chat_id'] = $fromChatId;
        $params['from_story_id'] = $fromStoryId;
        $params['active_period'] = $activePeriod;
        if (isset($postToChatPage)) $params['post_to_chat_page'] = $postToChatPage;
        if (isset($protectContent)) $params['protect_content'] = $protectContent;
        return Story::fromArray($this->request('repostStory', $params));
    }

    /**
     * Method: editStory
     *
     * Edits a story previously posted by the bot on behalf of a managed business account. Requires the can_manage_stories business bot right. Returns Story on success.
     * @link https://core.telegram.org/bots/api#editstory
     * @param string $businessConnectionId
     * @param int $storyId
     * @param InputStoryContent $content
     * @param string|null $caption
     * @param string|null $parseMode
     * @param array|null $captionEntities
     * @param array|null $areas
     * @return Story
     * @throws Exception
     * @throws GuzzleException
     */
    public function editStory(string $businessConnectionId, int $storyId, InputStoryContent $content, ?string $caption = null, ?string $parseMode = null, ?array $captionEntities = null, ?array $areas = null): Story {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['story_id'] = $storyId;
        $params['content'] = $content;
        if (isset($caption)) $params['caption'] = $caption;
        if (isset($parseMode)) $params['parse_mode'] = $parseMode;
        if (isset($captionEntities)) $params['caption_entities'] = $captionEntities;
        if (isset($areas)) $params['areas'] = $areas;
        return Story::fromArray($this->request('editStory', $params));
    }

    /**
     * Method: deleteStory
     *
     * Deletes a story previously posted by the bot on behalf of a managed business account. Requires the can_manage_stories business bot right. Returns True on success.
     * @link https://core.telegram.org/bots/api#deletestory
     * @param string $businessConnectionId
     * @param int $storyId
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function deleteStory(string $businessConnectionId, int $storyId): bool {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['story_id'] = $storyId;
        return $this->request('deleteStory', $params);
    }

    /**
     * Method: savePreparedKeyboardButton
     *
     * Stores a keyboard button that can be used by a user within a Mini App. Returns a PreparedKeyboardButton object.
     * @link https://core.telegram.org/bots/api#savepreparedkeyboardbutton
     * @param int $userId
     * @param KeyboardButton $button
     * @return PreparedKeyboardButton
     * @throws Exception
     * @throws GuzzleException
     */
    public function savePreparedKeyboardButton(int $userId, KeyboardButton $button): PreparedKeyboardButton {
        $params = [];
        $params['user_id'] = $userId;
        $params['button'] = $button;
        return PreparedKeyboardButton::fromArray($this->request('savePreparedKeyboardButton', $params));
    }

    /**
     * Method: editMessageChecklist
     *
     * Use this method to edit a checklist on behalf of a connected business account. On success, the edited Message is returned.
     * @link https://core.telegram.org/bots/api#editmessagechecklist
     * @param string $businessConnectionId
     * @param int $chatId
     * @param int $messageId
     * @param InputChecklist $checklist
     * @param InlineKeyboardMarkup|null $replyMarkup
     * @return Message
     * @throws Exception
     * @throws GuzzleException
     */
    public function editMessageChecklist(string $businessConnectionId, int $chatId, int $messageId, InputChecklist $checklist, ?InlineKeyboardMarkup $replyMarkup = null): Message {
        $params = [];
        $params['business_connection_id'] = $businessConnectionId;
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        $params['checklist'] = $checklist;
        if (isset($replyMarkup)) $params['reply_markup'] = $replyMarkup;
        return Message::fromArray($this->request('editMessageChecklist', $params));
    }

    /**
     * Method: approveSuggestedPost
     *
     * Use this method to approve a suggested post in a direct messages chat. The bot must have the 'can_post_messages' administrator right in the corresponding channel chat. Returns True on success.
     * @link https://core.telegram.org/bots/api#approvesuggestedpost
     * @param int $chatId
     * @param int $messageId
     * @param int|null $sendDate
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function approveSuggestedPost(int $chatId, int $messageId, ?int $sendDate = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($sendDate)) $params['send_date'] = $sendDate;
        return $this->request('approveSuggestedPost', $params);
    }

    /**
     * Method: declineSuggestedPost
     *
     * Use this method to decline a suggested post in a direct messages chat. The bot must have the 'can_manage_direct_messages' administrator right in the corresponding channel chat. Returns True on success.
     * @link https://core.telegram.org/bots/api#declinesuggestedpost
     * @param int $chatId
     * @param int $messageId
     * @param string|null $comment
     * @return bool
     * @throws Exception
     * @throws GuzzleException
     */
    public function declineSuggestedPost(int $chatId, int $messageId, ?string $comment = null): bool {
        $params = [];
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        if (isset($comment)) $params['comment'] = $comment;
        return $this->request('declineSuggestedPost', $params);
    }

    /**
     * Method: getMyStarBalance
     *
     * A method to get the current Telegram Stars balance of the bot. Requires no parameters. On success, returns a StarAmount object.
     * @link https://core.telegram.org/bots/api#getmystarbalance
     * @return StarAmount
     * @throws Exception
     * @throws GuzzleException
     */
    public function getMyStarBalance(): StarAmount {
        $params = [];
        return StarAmount::fromArray($this->request('getMyStarBalance', $params));
    }

    /**
     * Download a file returned by Telegram and save it to the specified path.
     * @param string|File $file
     * @param string $savePath
     * @return void
     * @throws Exception
     * @throws GuzzleException
     */
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

    /**
     * Method: getFile
     *
     * Use this method to get basic information about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path> , where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
     * @link https://core.telegram.org/bots/api#getfile
     * @param string $fileId
     * @return File
     * @throws Exception
     * @throws GuzzleException
     */
    public function getFile(string $fileId): File {
        $params = [];
        $params['file_id'] = $fileId;
        return File::fromArray($this->request('getFile', $params));
    }

    /**
     * Get the base Telegram Bot API URL.
     * @return string
     */
    public function getApiUrl(): string {
        return $this->apiUrl;
    }

    /**
     * Set the base Telegram Bot API URL.
     * @param string $apiUrl
     * @return void
     */
    public function setApiUrl(string $apiUrl): void {
        $this->apiUrl = $apiUrl;
    }

    /**
     * Get the current bot token.
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * Set the bot token.
     * @param string $token
     * @return void
     */
    public function setToken(string $token): void {
        $this->token = $token;
    }

    /**
     * Get the logger instance.
     * @return ?LoggerInterface
     */
    public function getLogger(): ?LoggerInterface {
        return $this->logger;
    }

    /**
     * Set the logger instance.
     * @param ?LoggerInterface $logger
     * @return void
     */
    public function setLogger(?LoggerInterface $logger): void {
        $this->logger = $logger;
    }

    //private function file(?string $path): mixed {
    //    if(!$path) return null;
    //    elseif(str_starts_with($path, 'https://')) {
    //        return $path;
    //    } elseif(str_starts_with($path, 'file://')) {
    //        if(!file_exists($path)) throw new Exception("File path '{$path}' not found");
    //        return $path;
    //    } elseif(is_file($path)) {
    //        if(!file_exists($path)) throw new Exception("File path '{$path}' not found");
    //        return fopen($path, 'rb');
    //    } else {
    //        throw new Exception('Invalid file path');
    //    }
    //}

    /**
     * Get the last decoded response received from Telegram.
     * @return ?array
     */
    public function getLastResponse(): ?array {
        return $this->lastResponse;
    }

}
