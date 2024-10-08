<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\Exception;


abstract class InlineQueryResult extends AbstractObject {

    public static function fromArray(array $data): InlineQueryResult {
        return match ($data['type'] ?? null) {
            'article' => InlineQueryResultArticle::fromArray($data),
            'audio' => InlineQueryResultAudio::fromArray($data),
            'contact' => InlineQueryResultContact::fromArray($data),
            'document' => InlineQueryResultDocument::fromArray($data),
            'game' => InlineQueryResultGame::fromArray($data),
            'gif' => InlineQueryResultGif::fromArray($data),
            'location' => InlineQueryResultLocation::fromArray($data),
            'photo' => InlineQueryResultPhoto::fromArray($data),
            'venue' => InlineQueryResultVenue::fromArray($data),
            'video' => InlineQueryResultVideo::fromArray($data),
            'voice' => InlineQueryResultVoice::fromArray($data),
            default => throw new Exception('Failed to create InlineQueryResult')
        };
    }

}
