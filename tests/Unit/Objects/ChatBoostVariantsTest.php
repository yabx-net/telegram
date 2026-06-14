<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\ChatBoost;
use Yabx\Telegram\Objects\ChatBoostSourcePremium;
use Yabx\Telegram\Tests\TestCase;

final class ChatBoostVariantsTest extends TestCase {

    public function testParsesPremiumSource(): void {
        $boost = ChatBoost::fromArray($this->loadFixture('chat_boost_premium.json'));

        $this->assertSame('boost-1', $boost->getBoostId());
        $this->assertInstanceOf(ChatBoostSourcePremium::class, $boost->getSource());
        $this->assertSame('Booster', $boost->getSource()->getUser()->getFirstName());
    }

    public function testPremiumBoostRoundTrip(): void {
        $this->assertRoundTrip(ChatBoost::class, $this->loadFixture('chat_boost_premium.json'));
    }

}
