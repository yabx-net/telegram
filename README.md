# yabx/telegram

PHP SDK for the [Telegram Bot API](https://core.telegram.org/bots/api). Typed request/response objects, [Guzzle](https://github.com/guzzle/guzzle) HTTP client, and coverage aligned with **Bot API 10.2** (July 2026).

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

| Path             | Role                                               |
|------------------|----------------------------------------------------|
| `src/BotApi.php` | Client: all Bot API methods + `request()`          |
| `src/Objects/`   | Telegram types (`Message`, `Update`, keyboards, …) |
| `src/Enum/`      | Helpers such as `ChatAction`, etc.                 |
| `tests/`         | PHPUnit test suite and JSON fixtures               |

## Testing

```bash
composer install
composer test
```

Optional coverage report (requires the [PCOV](https://github.com/krakjoe/pcov) extension locally):

```bash
# Ubuntu/Debian — match your PHP version (php -v)
sudo apt install php8.3-pcov   # or php8.5-pcov, php8.2-pcov, …

composer test:coverage
```

HTML report in `build/coverage/`:

```bash
composer test:coverage-html
```

If PCOV is not installed, `composer test:coverage` prints installation hints instead of a cryptic PHPUnit error. CI collects coverage with PCOV on PHP 8.3 (job `coverage` in `.github/workflows/tests.yml`).

Tests use [PHPUnit](https://phpunit.de/) 10.5+ (PHP 8.1) or 11+ (PHP 8.2+) with Guzzle `MockHandler` for HTTP integration tests. Fixtures live in `tests/Fixtures/`.

### Coverage phases

| Phase | Scope                                                                               | Status                                                        |
|-------|-------------------------------------------------------------------------------------|---------------------------------------------------------------|
| 1     | Infrastructure, `Utils`, `BotApi`, core objects                                     | done                                                          |
| 2     | All `RichText` / `RichBlock` types, update variants                                 | done                                                          |
| 3     | Polymorphic dispatchers (`ChatMember`, `MessageOrigin`, …)                          | done                                                          |
| 4     | Round-trip manifest (`tests/Fixtures/roundtrip/`)                                   | done — 331 leaf classes (~93%); dispatchers tested separately |
| 5     | Composite variant tests (`ChatFullInfo`, `Message`, `ExternalReplyInfo`)            | done                                                          |
| 6     | All `Update` webhook variants                                                       | done — 22 fixtures                                            |
| 7     | `BotApi` integration (request serialization, response parsing)                      | done — 57 tests                                               |
| 8     | Composite variants (`Message` quote/forward, `ExternalReplyInfo` media)             | done                                                          |
| 9     | API response snapshots (`tests/Fixtures/api_responses/`)                            | done — 7 fixtures                                             |
| 10    | Shared `MocksBotApi` trait, multipart uploads, forum topic variants                 | done                                                          |
| 11    | Media send methods, payments, `ChatFullInfo` private, service messages              | done                                                          |
| 12    | Location/contact/video note, stars, migration/members, `getUpdatefromRequest`       | done                                                          |
| 13    | Paid media, batch delete/copy, `ChatBoostSource` dispatcher, chat service messages  | done                                                          |
| 14    | Chat actions, reactions, join requests, sticker set snapshot, chat event messages   | done                                                          |
| 15    | Live location, menu button, custom emoji, invite link snapshot, `Update` round-trip | done                                                          |
| 16    | Live photo, forum topics, games, restrict member, service message variants          | done — 79 BotApi tests, 13 snapshots                          |
| 17    | Chat admin, forum/general topics, stickers, bot profile/commands, join-query        | done — 113 BotApi tests, ~69% `BotApi.php` lines              |
| 18    | Business, stories, gifts/stars, payments, verification, managed bot, `downloadFile` | done — 127 BotApi tests, ~99% `BotApi.php` lines              |
| 19    | Deep `Message` / `ChatFullInfo` / `Update` variants                                 | done — 42 message fixtures, `Message` ~67% lines              |
| 20    | `BotApi` edge cases: multipart, `downloadFile`, logging, transport errors           | done — `BotApiEdgeCasesTest`                                  |
| 21    | API snapshots: business, gifts, boosts, invoice, extended chat                      | done — 18 snapshots                                           |
| 22    | Polymorphic dispatch + `sendPoll` / `InputPollMedia` contract                       | done                                                          |
| 23    | PHPStan level 2, coverage threshold 57%, CI static analysis                         | done — `composer phpstan`                                     |
| 24    | `CHANGELOG.md`, README examples for Bot API 10.2 features                           | done                                                          |

`InputPollMedia` / `InputPollOptionMedia` are PHP interfaces; implementing classes (`InputMediaPhoto`, `InputMediaLink`, …) are covered in the round-trip manifest and via `sendPoll` contract tests.

### Static analysis and coverage gate

```bash
composer phpstan          # PHPStan level 2 on src/
composer test:coverage    # fails if line coverage drops below 57%
```

### Bot API 10.2 examples

**Ephemeral messages**

```php
$bot->sendMessage($chatId, 'Only you can see this', receiverUserId: $userId, callbackQueryId: $queryId);
$bot->editEphemeralMessageText($chatId, $userId, $ephemeralMessageId, 'Updated');
$bot->deleteEphemeralMessage($chatId, $userId, $ephemeralMessageId);
```

**Rich message blocks**

```php
use Yabx\Telegram\Objects\InputRichBlockParagraph;
use Yabx\Telegram\Objects\InputRichMessage;

$bot->sendRichMessage($chatId, new InputRichMessage(
    blocks: [new InputRichBlockParagraph(text: 'Hello')],
));
```

### Bot API 10.1 examples

**Business connection**

```php
$connection = $bot->getBusinessConnection('bc-1');
$bot->readBusinessMessage('bc-1', $chatId, $messageId);
```

**Stories (managed business account)**

```php
use Yabx\Telegram\Objects\InputStoryContentPhoto;

$bot->postStory(
    businessConnectionId: 'bc-1',
    content: new InputStoryContentPhoto(type: 'photo', photo: '/tmp/story.jpg'),
    activePeriod: 86400,
    caption: 'News',
);
```

**Gifts and Stars**

```php
$gifts = $bot->getAvailableGifts();
$bot->sendGift($userId, 'gift-id', text: 'Enjoy!');
$balance = $bot->getMyStarBalance();
```

**Rich messages**

```php
use Yabx\Telegram\Objects\InputRichMessage;

$bot->sendRichMessage($chatId, new InputRichMessage(html: '<b>Hello</b>'));
```

To add coverage for a new object, append an entry to the appropriate file under `tests/Fixtures/roundtrip/` (merged by `roundtrip.php`):

```php
SomeObject::class => ['field' => 'value'],
```

## License

**MIT** (see [`composer.json`](composer.json)).

## See also

- [Telegram Bot API documentation](https://core.telegram.org/bots/api)
- [Creating a bot with BotFather](https://core.telegram.org/bots/tutorial)
