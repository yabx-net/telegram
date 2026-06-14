<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Unit\Objects;

use Yabx\Telegram\Objects\ChatMember;
use Yabx\Telegram\Objects\ChatMemberAdministrator;
use Yabx\Telegram\Objects\ChatMemberBanned;
use Yabx\Telegram\Objects\ChatMemberLeft;
use Yabx\Telegram\Objects\ChatMemberMember;
use Yabx\Telegram\Objects\ChatMemberOwner;
use Yabx\Telegram\Objects\ChatMemberRestricted;
use Yabx\Telegram\Tests\TestCase;

final class ChatMemberTest extends TestCase {

    public function testParsesAdministrator(): void {
        $data = $this->loadFixture('chat_member_administrator.json');

        $member = ChatMember::fromArray($data);

        $this->assertInstanceOf(ChatMemberAdministrator::class, $member);
        $this->assertSame('administrator', $member->getStatus());
        $this->assertTrue($member->getCanManageChat());
    }

    public function testParsesMember(): void {
        $data = $this->loadFixture('chat_member_member.json');

        $member = ChatMember::fromArray($data);

        $this->assertInstanceOf(ChatMemberMember::class, $member);
        $this->assertSame('Member', $member->getUser()->getFirstName());
    }

    public function testParsesRestricted(): void {
        $member = ChatMember::fromArray([
            'status' => 'restricted',
            'user' => ['id' => 3, 'is_bot' => false, 'first_name' => 'Restricted'],
            'is_member' => true,
            'can_send_messages' => true,
        ]);

        $this->assertInstanceOf(ChatMemberRestricted::class, $member);
    }

    public function testParsesOwner(): void {
        $member = ChatMember::fromArray([
            'status' => 'creator',
            'user' => ['id' => 4, 'is_bot' => false, 'first_name' => 'Owner'],
            'is_anonymous' => false,
        ]);

        $this->assertInstanceOf(ChatMemberOwner::class, $member);
    }

    public function testParsesLeft(): void {
        $member = ChatMember::fromArray([
            'status' => 'left',
            'user' => ['id' => 5, 'is_bot' => false, 'first_name' => 'Left'],
        ]);

        $this->assertInstanceOf(ChatMemberLeft::class, $member);
    }

    public function testParsesBanned(): void {
        $member = ChatMember::fromArray([
            'status' => 'kicked',
            'user' => ['id' => 6, 'is_bot' => false, 'first_name' => 'Banned'],
            'until_date' => 0,
        ]);

        $this->assertInstanceOf(ChatMemberBanned::class, $member);
    }

    public function testThrowsOnUnknownStatus(): void {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Failed to create ChatMember');

        ChatMember::fromArray(['status' => 'unknown']);
    }

}
