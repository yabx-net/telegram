Installation
------------
```shell
composer req yabx/telegram
```
Simple usage
------------
```php
use Yabx\Telegram\Update;

// Parse telegram webhook
$update = Update::fromRequest();
// or
$update = Update::fromJson($json);

// Get Message or EditedMessage object
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
