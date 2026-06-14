<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\InlineKeyboardButton;
use Yabx\Telegram\Objects\InlineKeyboardMarkup;
use Yabx\Telegram\Objects\ReplyKeyboardMarkup;
use Yabx\Telegram\Tests\TestCase;

final class InlineKeyboardMarkupTest extends TestCase {

    public function testFromArrayParsesRowsOfButtons(): void {
        $data = $this->loadFixture('inline_keyboard.json');

        $markup = InlineKeyboardMarkup::fromArray($data);

        $keyboard = $markup->getInlineKeyboard();
        $this->assertCount(2, $keyboard);
        $this->assertCount(2, $keyboard[0]);
        $this->assertCount(1, $keyboard[1]);

        $this->assertInstanceOf(InlineKeyboardButton::class, $keyboard[0][0]);
        $this->assertSame('Yes', $keyboard[0][0]->getText());
        $this->assertSame('yes', $keyboard[0][0]->getCallbackData());
        $this->assertSame('Docs', $keyboard[1][0]->getText());
        $this->assertSame('https://core.telegram.org/bots/api', $keyboard[1][0]->getUrl());
    }

    public function testToArrayRoundTrip(): void {
        $original = $this->loadFixture('inline_keyboard.json');

        $markup = InlineKeyboardMarkup::fromArray($original);

        $this->assertSame($original, $markup->toArray());
    }

}

final class ReplyKeyboardMarkupTest extends TestCase {

    public function testFromArrayParsesRowsOfButtons(): void {
        $data = $this->loadFixture('reply_keyboard.json');

        $markup = ReplyKeyboardMarkup::fromArray($data);

        $keyboard = $markup->getKeyboard();
        $this->assertCount(2, $keyboard);
        $this->assertCount(2, $keyboard[0]);
        $this->assertSame('Option A', $keyboard[0][0]->getText());
        $this->assertTrue($markup->getResizeKeyboard());
        $this->assertTrue($markup->getOneTimeKeyboard());
    }

    public function testToArrayRoundTrip(): void {
        $original = $this->loadFixture('reply_keyboard.json');

        $markup = ReplyKeyboardMarkup::fromArray($original);

        $this->assertSame($original, $markup->toArray());
    }

}
