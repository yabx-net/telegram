<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use InvalidArgumentException;
use Yabx\Telegram\Objects\RichText;
use Yabx\Telegram\Objects\RichTextBold;
use Yabx\Telegram\Objects\RichTextTextMention;
use Yabx\Telegram\Objects\RichTextUrl;
use Yabx\Telegram\Tests\TestCase;

final class RichTextTest extends TestCase {

    public function testFromMixedWithPlainString(): void {
        $this->assertSame('plain text', RichText::fromMixed('plain text'));
    }

    public function testFromMixedWithArrayOfTypedNodes(): void {
        $result = RichText::fromMixed([
            'Hello ',
            ['type' => 'bold', 'text' => 'world'],
        ]);

        $this->assertIsArray($result);
        $this->assertSame('Hello ', $result[0]);
        $this->assertInstanceOf(RichTextBold::class, $result[1]);
        $this->assertSame('world', $result[1]->getText());
    }

    public function testFromArrayParsesBold(): void {
        $node = RichText::fromArray(['type' => 'bold', 'text' => 'important']);

        $this->assertInstanceOf(RichTextBold::class, $node);
        $this->assertSame('important', $node->getText());
    }

    public function testFromArrayParsesUrl(): void {
        $node = RichText::fromArray([
            'type' => 'url',
            'text' => 'Docs',
            'url' => 'https://core.telegram.org/bots/api',
        ]);

        $this->assertInstanceOf(RichTextUrl::class, $node);
        $this->assertSame('Docs', $node->getText());
        $this->assertSame('https://core.telegram.org/bots/api', $node->getUrl());
    }

    public function testFromArrayParsesTextMentionWithUser(): void {
        $node = RichText::fromArray([
            'type' => 'text_mention',
            'text' => '@user',
            'user' => ['id' => 42, 'is_bot' => false, 'first_name' => 'User'],
        ]);

        $this->assertInstanceOf(RichTextTextMention::class, $node);
        $this->assertSame(42, $node->getUser()->getId());
    }

    public function testToMixedRoundTrip(): void {
        $original = [
            'plain',
            ['type' => 'bold', 'text' => 'bold'],
        ];
        $parsed = RichText::fromMixed($original);
        $serialized = RichText::toMixed($parsed);

        $this->assertSame($original, $serialized);
    }

    public function testThrowsOnInvalidType(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid RichText type');

        RichText::fromArray(['type' => 'unknown']);
    }

    public function testThrowsOnInvalidValue(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid RichText value');

        RichText::fromMixed(123);
    }

}
