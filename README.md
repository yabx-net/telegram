Installation
------------
```shell
composer req yabx/telegram
```
Simple usage
------------
```php
use Yabx\Telegram\Service;

// Parse telegram webhook
$update = Service::fromRequest();
// or
$update = Service::fromJson($json);

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
