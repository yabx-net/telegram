<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

abstract class RichText extends AbstractObject {

    public static function fromMixed(mixed $data): string|array|RichText {
        if (is_string($data)) {
            return $data;
        }
        if (!is_array($data)) {
            throw new InvalidArgumentException('Invalid RichText value');
        }
        if (isset($data['type'])) {
            return self::fromArray($data);
        }
        return array_map(fn(mixed $item) => self::fromMixed($item), $data);
    }

    public static function fromArray(array $data): RichText {
        return match ($data['type']) {
            'bold' => RichTextBold::fromArray($data),
            'italic' => RichTextItalic::fromArray($data),
            'underline' => RichTextUnderline::fromArray($data),
            'strikethrough' => RichTextStrikethrough::fromArray($data),
            'spoiler' => RichTextSpoiler::fromArray($data),
            'date_time' => RichTextDateTime::fromArray($data),
            'text_mention' => RichTextTextMention::fromArray($data),
            'subscript' => RichTextSubscript::fromArray($data),
            'superscript' => RichTextSuperscript::fromArray($data),
            'marked' => RichTextMarked::fromArray($data),
            'code' => RichTextCode::fromArray($data),
            'custom_emoji' => RichTextCustomEmoji::fromArray($data),
            'mathematical_expression' => RichTextMathematicalExpression::fromArray($data),
            'url' => RichTextUrl::fromArray($data),
            'email_address' => RichTextEmailAddress::fromArray($data),
            'phone_number' => RichTextPhoneNumber::fromArray($data),
            'bank_card_number' => RichTextBankCardNumber::fromArray($data),
            'mention' => RichTextMention::fromArray($data),
            'hashtag' => RichTextHashtag::fromArray($data),
            'cashtag' => RichTextCashtag::fromArray($data),
            'bot_command' => RichTextBotCommand::fromArray($data),
            'anchor' => RichTextAnchor::fromArray($data),
            'anchor_link' => RichTextAnchorLink::fromArray($data),
            'reference' => RichTextReference::fromArray($data),
            'reference_link' => RichTextReferenceLink::fromArray($data),
            default => throw new InvalidArgumentException('Invalid RichText type'),
        };
    }

    public static function toMixed(mixed $value): mixed {
        if ($value === null || is_string($value)) {
            return $value;
        }
        if (is_array($value)) {
            return array_map(fn(mixed $item) => self::toMixed($item), $value);
        }
        if ($value instanceof AbstractObject) {
            return $value->toArray();
        }
        return $value;
    }

}
