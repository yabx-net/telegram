<?php

namespace Yabx\Telegram;

use Yabx\Telegram\Objects\ForceReply;
use Yabx\Telegram\Objects\KeyboardButton;
use Yabx\Telegram\Objects\KeyboardButtonPollType;
use Yabx\Telegram\Objects\KeyboardButtonRequestChat;
use Yabx\Telegram\Objects\KeyboardButtonRequestUser;
use Yabx\Telegram\Objects\ReplyKeyboardMarkup;
use Yabx\Telegram\Objects\ReplyKeyboardRemove;
use Yabx\Telegram\Objects\WebAppInfo;

class Builder {

    public static function keyboardButton(string $text, bool $requestContact = false, bool $requestLocation = false,
                                          ?KeyboardButtonRequestUser $requestUser = null,
                                          ?KeyboardButtonRequestChat $requestChat = null,
                                          ?KeyboardButtonPollType $requestPoll = null,
                                          ?WebAppInfo $webAppInfo = null): KeyboardButton {
        $data = [
            'text' => $text,
            'request_contact' => $requestContact,
            'request_location' => $requestLocation,
        ];
        if($requestUser) $data['request_user'] = $requestUser->getRawData();
        if($requestChat) $data['request_chat'] = $requestChat->getRawData();
        if($requestPoll) $data['request_poll'] = $requestPoll->getRawData();
        if($webAppInfo) $data['web_app'] = $webAppInfo->getRawData();
        return new KeyboardButton($data);
    }

    public static function keyboardButtonRequestUser(int $requestid, ?bool $userIsBot = null, ?bool $userIsPremium = null): KeyboardButtonRequestUser {
        $data = ['request_id' => $requestid];
        if($userIsBot !== null) $data['user_is_bot'] = $userIsBot;
        if($userIsPremium !== null) $data['user_is_premium'] = $userIsBot;
        return new KeyboardButtonRequestUser($data);
    }

    public static function replyKeyboardMarkup(array $keyboard, bool $isPersistent = false, bool $resizeKeyboard = false,
                                               bool $oneTimeKeyboard = false, ?string $inputFieldPlaceholder = null,
                                               bool $selective = false): ReplyKeyboardMarkup {
        array_walk_recursive($keyboard, function (&$item) {
            if(is_object($item)) $item = call_user_func([$item, 'getRawData']);
        });
        print_r($keyboard);
        return new ReplyKeyboardMarkup([
            'keyboard' => $keyboard,
            'is_persistent' => $isPersistent,
            'resize_keyboard' => $resizeKeyboard,
            'one_time_keyboard' => $oneTimeKeyboard,
            'input_field_placeholder' => $inputFieldPlaceholder ?? '',
            'selective' => $selective
        ]);
    }

    public static function replyKeyboardRemove(): ReplyKeyboardRemove {
        return new ReplyKeyboardRemove(['remove_keyboard' => true]);
    }

    public static function forceReply(?string $inputFieldPlaceholder = null): ForceReply {
        return new ForceReply(['force_reply' => true, 'input_field_placeholder' => $inputFieldPlaceholder ?? '']);
    }

}
