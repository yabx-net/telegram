Telegram Bot API SDK for PHP 8.1+
---------------------------------

Installation
------------
```shell
composer req yabx/telegram
```

Sending messages
----------------
```php
use Yabx\Telegram\BotApi;

// Create an BotApi client instance
$tg = new BotApi('123:qwe');

// Sending message
$message = $tg->sendMessage(12345, 'Hello World!');
```
Working with webhooks
---------------------
```php
use Yabx\Telegram\BotApi;

// Create an BotApi client instance
$tg = new BotApi('123:qwe');

// Set webhook
$tg->setWebhook('https://tg.myservice.com/bot123');

// Get webhook info
$webhook = $tg->getWebhookInfo();
```

Receiving updates
-----------------
```php
use Yabx\Telegram\BotApi;

// Parse telegram webhook
$update = BotApi::getUpdateFromRequest();
// or
$update = BotApi::getUpdateFromJson($json);

// Get Message object
$message = $update->getMessage();

// Get Sender and Chat objects
$sender = $message->getFrom();
$chat = $message->getChat();

// Get some message attributes
$text = $message->getText();
$video = $message->getVideo();
$photos = $message->getPhotos();
$document = $message->getDocument();
```
