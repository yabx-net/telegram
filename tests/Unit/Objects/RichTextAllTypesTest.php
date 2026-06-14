<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use PHPUnit\Framework\Attributes\DataProvider;
use Yabx\Telegram\Objects\RichText;
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
use Yabx\Telegram\Tests\TestCase;

final class RichTextAllTypesTest extends TestCase {

    #[DataProvider('richTextTypesProvider')]
    public function testFromArrayParsesType(array $data, string $expectedClass): void {
        $node = RichText::fromArray($data);

        $this->assertInstanceOf($expectedClass, $node);
        $this->assertSame($data, $node->toArray());
    }

    public static function richTextTypesProvider(): array {
        $user = SampleData::user();

        return [
            'bold' => [['type' => 'bold', 'text' => 'bold'], RichTextBold::class],
            'italic' => [['type' => 'italic', 'text' => 'italic'], RichTextItalic::class],
            'underline' => [['type' => 'underline', 'text' => 'underline'], RichTextUnderline::class],
            'strikethrough' => [['type' => 'strikethrough', 'text' => 'strike'], RichTextStrikethrough::class],
            'spoiler' => [['type' => 'spoiler', 'text' => 'spoiler'], RichTextSpoiler::class],
            'date_time' => [['type' => 'date_time', 'text' => 'today', 'unix_time' => 1, 'date_time_format' => 'd'], RichTextDateTime::class],
            'text_mention' => [['type' => 'text_mention', 'text' => '@u', 'user' => $user], RichTextTextMention::class],
            'subscript' => [['type' => 'subscript', 'text' => 'sub'], RichTextSubscript::class],
            'superscript' => [['type' => 'superscript', 'text' => 'sup'], RichTextSuperscript::class],
            'marked' => [['type' => 'marked', 'text' => 'mark'], RichTextMarked::class],
            'code' => [['type' => 'code', 'text' => 'code'], RichTextCode::class],
            'custom_emoji' => [['type' => 'custom_emoji', 'custom_emoji_id' => '1', 'alternative_text' => 'smile'], RichTextCustomEmoji::class],
            'mathematical_expression' => [['type' => 'mathematical_expression', 'expression' => 'E=mc^2'], RichTextMathematicalExpression::class],
            'url' => [['type' => 'url', 'text' => 'link', 'url' => 'https://example.com'], RichTextUrl::class],
            'email_address' => [['type' => 'email_address', 'text' => 'mail', 'email_address' => 'a@b.c'], RichTextEmailAddress::class],
            'phone_number' => [['type' => 'phone_number', 'text' => 'tel', 'phone_number' => '+100'], RichTextPhoneNumber::class],
            'bank_card_number' => [['type' => 'bank_card_number', 'text' => 'card', 'bank_card_number' => '4111'], RichTextBankCardNumber::class],
            'mention' => [['type' => 'mention', 'text' => '@bot', 'username' => 'bot'], RichTextMention::class],
            'hashtag' => [['type' => 'hashtag', 'text' => '#tag', 'hashtag' => 'tag'], RichTextHashtag::class],
            'cashtag' => [['type' => 'cashtag', 'text' => '$USD', 'cashtag' => 'USD'], RichTextCashtag::class],
            'bot_command' => [['type' => 'bot_command', 'text' => '/start', 'bot_command' => '/start'], RichTextBotCommand::class],
            'anchor' => [['type' => 'anchor', 'name' => 'section'], RichTextAnchor::class],
            'anchor_link' => [['type' => 'anchor_link', 'text' => 'go', 'anchor_name' => 'section'], RichTextAnchorLink::class],
            'reference' => [['type' => 'reference', 'text' => 'ref', 'name' => 'note'], RichTextReference::class],
            'reference_link' => [['type' => 'reference_link', 'text' => 'ref', 'reference_name' => 'note'], RichTextReferenceLink::class],
        ];
    }

}
