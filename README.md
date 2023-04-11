Installation
------------
```shell
composer req yabx/telegram
```
Simple usage
------------
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

// Create an BotApi client instance
$tg = new BotApi('123:qwe');

// Set webhook
$tg->setWebhook('https://tg.myservice.com/bot123');

// Get current webhook info
$webhook = $tg->getWebhookInfo();

// Sending message
$message = $tg->sendMessage(12345, 'Hello World!');
```
