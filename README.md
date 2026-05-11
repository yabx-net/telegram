# yabx/telegram

PHP SDK for the [Telegram Bot API](https://core.telegram.org/bots/api). Typed request/response objects, [Guzzle](https://github.com/guzzle/guzzle) HTTP client, and coverage aligned with **Bot API 10.0** (May 2026).

## Requirements

- PHP `>= 8.1`
- Extensions: `json`, `curl`
- Composer dependencies: `guzzlehttp/guzzle` `^7.9`, `psr/log` `^3.0`

## Installation

```bash
composer require yabx/telegram
```

## Features

- Strongly typed **`Yabx\Telegram\Objects\*`** models for [available types](https://core.telegram.org/bots/api#available-types)
- One method per Bot API method on **`Yabx\Telegram\BotApi`**, matching [available methods](https://core.telegram.org/bots/api#available-methods)
- **`request()`** for direct API calls when you need maximum flexibility
- Optional **PSR-3** logging and custom **Guzzle** / base URL for tests or proxies
- Webhook parsing from raw JSON or **`php://input`**
- **`getUpdates`** long polling support

## Quick start

```php
use Yabx\Telegram\BotApi;

$token = getenv('TELEGRAM_BOT_TOKEN');
$bot = new BotApi($token);

$me = $bot->getMe();
$chatId = 123456789; // Telegram user/group/channel id from an allowed update context
$sent = $bot->sendMessage($chatId, 'Bot is up. Connected as @' . ($me->getUsername() ?? 'bot'));
```

### Client options

```php
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;
use Yabx\Telegram\BotApi;

/** @var LoggerInterface $logger e.g. Monolog, Symfony Bridge, … */
$bot = new BotApi(
    $token,
    [
        RequestOptions::TIMEOUT => 30,
        RequestOptions::VERIFY => true,
    ],
    $logger,
    'https://api.telegram.org', // optional custom API host
);
```

### Send messages (text, parse mode, reply)

```php
use Yabx\Telegram\Objects\ReplyParameters;

$bot->sendMessage(
    chatId: $chatId,
    text: 'Hello, <b>world</b>',
    parseMode: 'HTML',
);

$bot->sendMessage(
    chatId: $chatId,
    text: 'Replying…',
    replyParameters: new ReplyParameters(messageId: $originalMessageId),
);
```

### Inline keyboard

```php
use Yabx\Telegram\Objects\InlineKeyboardButton;
use Yabx\Telegram\Objects\InlineKeyboardMarkup;

$keyboard = new InlineKeyboardMarkup([
    [
        new InlineKeyboardButton('Docs', url: 'https://core.telegram.org/bots/api'),
        new InlineKeyboardButton('Tap me', callbackData: 'demo:1'),
    ],
]);

$bot->sendMessage($chatId, 'Pick an action:', replyMarkup: $keyboard);
```

### Reply keyboard (custom keyboard)

```php
use Yabx\Telegram\Objects\KeyboardButton;
use Yabx\Telegram\Objects\ReplyKeyboardMarkup;

$markup = new ReplyKeyboardMarkup(
    keyboard: [
        [new KeyboardButton('Yes'), new KeyboardButton('No')],
        [new KeyboardButton('Cancel')],
    ],
    resizeKeyboard: true,
    oneTimeKeyboard: true,
);

$bot->sendMessage($chatId, 'Your choice?', replyMarkup: $markup);
```

### Photo from disk (multipart upload)

If the path exists on disk, the client opens the file and sends it as **multipart** automatically:

```php
$bot->sendPhoto(
    chatId: $chatId,
    photo: '/tmp/snapshot.jpg',
    caption: 'Snapshot',
    parseMode: 'HTML',
);
```

### Webhooks

Register and inspect the webhook:

```php
$bot->setWebhook(
    url: 'https://example.com/telegram/webhook',
    allowedUpdates: ['message', 'callback_query'],
    secretToken: getenv('WEBHOOK_SECRET'),
);

$info = $bot->getWebhookInfo();
```

Handle an incoming POST body (typical PHP endpoint):

```php
use Yabx\Telegram\BotApi;

// Reads php://input and builds an Update (throws if body is empty / invalid JSON)
$update = BotApi::getUpdateFromRequest();

// Or parse a string you already have:
$update = BotApi::getUpdateFromJson($requestBody);
```

Then branch on the update payload:

```php
if ($message = $update->getMessage()) {
    $chatId = $message->getChat()->getId();
    $text = $message->getText();
    $photos = $message->getPhotos();
    $video = $message->getVideo();
    $document = $message->getDocument();
    // … same pattern for stickers, polls, forwarded messages, etc.
}

if ($callback = $update->getCallbackQuery()) {
    $bot->answerCallbackQuery($callback->getId(), text: 'OK');
}
```

### Long polling (`getUpdates`)

```php
$offset = 0;

while (true) {
    $updates = $bot->getUpdates(offset: $offset, timeout: 50);

    foreach ($updates as $update) {
        $offset = $update->getUpdateId() + 1;

        if ($msg = $update->getMessage()) {
            $bot->sendMessage($msg->getChat()->getId(), 'Echo: ' . ($msg->getText() ?? ''));
        }
    }
}
```

### Low-level `request()`

Useful for new API parameters before a dedicated method exists, or rare calls:

```php
$result = $bot->request('getChat', ['chat_id' => $chatId]);
```

Objects with a `toArray()` method are normalized automatically. Upload methods on `BotApi` already set `multipart` where needed.

### Last raw API response

After each call, the decoded JSON envelope (including `ok`, `result`, `description`, etc.) is available:

```php
$bot->sendMessage($chatId, 'Hi');
$envelope = $bot->getLastResponse();
```

### Error handling

Failed Bot API responses throw **`Yabx\Telegram\Exception`** with Telegram’s **`error_code`** as the exception code when present:

```php
use Yabx\Telegram\Exception as TelegramApiException;

try {
    $bot->sendMessage($chatId, 'Ping');
} catch (TelegramApiException $e) {
    // $e->getCode() often matches Telegram's error_code
    error_log($e->getMessage());
}
```

## Project layout

| Path | Role |
|------|------|
| `src/BotApi.php` | Client: all Bot API methods + `request()` |
| `src/Objects/` | Telegram types (`Message`, `Update`, keyboards, …) |
| `src/Enum/` | Helpers such as `ChatAction`, etc. |

## License

**MIT** (see [`composer.json`](composer.json)).

## See also

- [Telegram Bot API documentation](https://core.telegram.org/bots/api)
- [Creating a bot with BotFather](https://core.telegram.org/bots/tutorial)
