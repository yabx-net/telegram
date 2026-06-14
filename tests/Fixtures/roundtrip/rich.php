<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\RichTextAnchor;
use Yabx\Telegram\Objects\RichTextAnchorLink;
use Yabx\Telegram\Objects\RichTextBankCardNumber;
use Yabx\Telegram\Objects\RichTextBold;
use Yabx\Telegram\Objects\RichTextBotCommand;
use Yabx\Telegram\Objects\RichTextCashtag;
use Yabx\Telegram\Objects\RichTextCode;
use Yabx\Telegram\Objects\RichTextCustomEmoji;
use Yabx\Telegram\Objects\RichTextDateTime;
use Yabx\Telegram\Objects\RichTextEmailAddress;
use Yabx\Telegram\Objects\RichTextHashtag;
use Yabx\Telegram\Objects\RichTextItalic;
use Yabx\Telegram\Objects\RichTextMarked;
use Yabx\Telegram\Objects\RichTextMathematicalExpression;
use Yabx\Telegram\Objects\RichTextMention;
use Yabx\Telegram\Objects\RichTextPhoneNumber;
use Yabx\Telegram\Objects\RichTextReference;
use Yabx\Telegram\Objects\RichTextReferenceLink;
use Yabx\Telegram\Objects\RichTextSpoiler;
use Yabx\Telegram\Objects\RichTextStrikethrough;
use Yabx\Telegram\Objects\RichTextSubscript;
use Yabx\Telegram\Objects\RichTextSuperscript;
use Yabx\Telegram\Objects\RichTextTextMention;
use Yabx\Telegram\Objects\RichTextUnderline;
use Yabx\Telegram\Objects\RichTextUrl;
use Yabx\Telegram\Tests\Support\SampleData;

$user = SampleData::user();

return [
    RichTextBold::class => ['type' => 'bold', 'text' => 'bold'],
    RichTextItalic::class => ['type' => 'italic', 'text' => 'italic'],
    RichTextUnderline::class => ['type' => 'underline', 'text' => 'underline'],
    RichTextStrikethrough::class => ['type' => 'strikethrough', 'text' => 'strike'],
    RichTextSpoiler::class => ['type' => 'spoiler', 'text' => 'spoiler'],
    RichTextDateTime::class => ['type' => 'date_time', 'text' => 'today', 'unix_time' => 1, 'date_time_format' => 'd'],
    RichTextTextMention::class => ['type' => 'text_mention', 'text' => '@u', 'user' => $user],
    RichTextSubscript::class => ['type' => 'subscript', 'text' => 'sub'],
    RichTextSuperscript::class => ['type' => 'superscript', 'text' => 'sup'],
    RichTextMarked::class => ['type' => 'marked', 'text' => 'mark'],
    RichTextCode::class => ['type' => 'code', 'text' => 'code'],
    RichTextCustomEmoji::class => ['type' => 'custom_emoji', 'custom_emoji_id' => '1', 'alternative_text' => 'smile'],
    RichTextMathematicalExpression::class => ['type' => 'mathematical_expression', 'expression' => 'E=mc^2'],
    RichTextUrl::class => ['type' => 'url', 'text' => 'link', 'url' => 'https://example.com'],
    RichTextEmailAddress::class => ['type' => 'email_address', 'text' => 'mail', 'email_address' => 'a@b.c'],
    RichTextPhoneNumber::class => ['type' => 'phone_number', 'text' => 'tel', 'phone_number' => '+100'],
    RichTextBankCardNumber::class => ['type' => 'bank_card_number', 'text' => 'card', 'bank_card_number' => '4111'],
    RichTextMention::class => ['type' => 'mention', 'text' => '@bot', 'username' => 'bot'],
    RichTextHashtag::class => ['type' => 'hashtag', 'text' => '#tag', 'hashtag' => 'tag'],
    RichTextCashtag::class => ['type' => 'cashtag', 'text' => '$USD', 'cashtag' => 'USD'],
    RichTextBotCommand::class => ['type' => 'bot_command', 'text' => '/start', 'bot_command' => '/start'],
    RichTextAnchor::class => ['type' => 'anchor', 'name' => 'section'],
    RichTextAnchorLink::class => ['type' => 'anchor_link', 'text' => 'go', 'anchor_name' => 'section'],
    RichTextReference::class => ['type' => 'reference', 'text' => 'ref', 'name' => 'note'],
    RichTextReferenceLink::class => ['type' => 'reference_link', 'text' => 'ref', 'reference_name' => 'note'],
];
