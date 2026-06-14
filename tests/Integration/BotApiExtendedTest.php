<?php

declare(strict_types=1);

namespace Yabx\Telegram\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use Psr\Log\LoggerInterface;
use Yabx\Telegram\Objects\AcceptedGiftTypes;
use Yabx\Telegram\Objects\BotAccessSettings;
use Yabx\Telegram\Objects\BusinessConnection;
use Yabx\Telegram\Objects\ChatAdministratorRights;
use Yabx\Telegram\Objects\File;
use Yabx\Telegram\Objects\Gifts;
use Yabx\Telegram\Objects\InlineQueryResultArticle;
use Yabx\Telegram\Objects\InputChecklist;
use Yabx\Telegram\Objects\InputChecklistTask;
use Yabx\Telegram\Objects\InputProfilePhotoStatic;
use Yabx\Telegram\Objects\InputRichMessage;
use Yabx\Telegram\Objects\InputStoryContentPhoto;
use Yabx\Telegram\Objects\InputTextMessageContent;
use Yabx\Telegram\Objects\KeyboardButton;
use Yabx\Telegram\Objects\LabeledPrice;
use Yabx\Telegram\Objects\MaskPosition;
use Yabx\Telegram\Objects\Message;
use Yabx\Telegram\Objects\OwnedGifts;
use Yabx\Telegram\Objects\PassportElementErrorDataField;
use Yabx\Telegram\Objects\PreparedInlineMessage;
use Yabx\Telegram\Objects\PreparedKeyboardButton;
use Yabx\Telegram\Objects\SentGuestMessage;
use Yabx\Telegram\Objects\SentWebAppMessage;
use Yabx\Telegram\Objects\StarAmount;
use Yabx\Telegram\Objects\Story;
use Yabx\Telegram\Objects\UserChatBoosts;
use Yabx\Telegram\Objects\UserProfileAudios;
use Yabx\Telegram\Tests\Support\MocksBotApi;
use Yabx\Telegram\Tests\Support\SampleData;
use Yabx\Telegram\Tests\TestCase;

final class BotApiExtendedTest extends TestCase {

    use MocksBotApi;

    private function messageResult(): array {
        return [
            'message_id' => 1,
            'date' => 1681135130,
            'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
            'text' => 'Hi',
        ];
    }

    private function storyResult(): array {
        return [
            'chat' => ['id' => -1001234567890, 'type' => 'channel', 'title' => 'News'],
            'id' => 42,
        ];
    }

    private function businessConnectionResult(): array {
        return [
            'id' => 'bc-1',
            'user' => SampleData::user(),
            'user_chat_id' => 630692,
            'date' => 1681135130,
            'can_reply' => true,
            'is_enabled' => true,
        ];
    }

    private function inlineArticle(): InlineQueryResultArticle {
        return new InlineQueryResultArticle(
            id: 'art1',
            title: 'Article',
            inputMessageContent: new InputTextMessageContent(messageText: 'Text'),
        );
    }

    public function testTokenAndLoggerAccessors(): void {
        $logger = $this->createMock(LoggerInterface::class);
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertSame('test-token', $bot->getToken());
        $bot->setToken('new-token');
        $this->assertSame('new-token', $bot->getToken());
        $this->assertInstanceOf(LoggerInterface::class, $bot->getLogger());

        $bot->setLogger($logger);
        $this->assertSame($logger, $bot->getLogger());

        $bot->removeMyProfilePhoto();
        $this->assertSame('http://test/botnew-token/removeMyProfilePhoto', (string) $mock->getLastRequest()->getUri());
    }

    public function testSendInvoiceAndCreateInvoiceLink(): void {
        $prices = [new LabeledPrice('Item', 100)];
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse([
                'message_id' => 12,
                'date' => 1681135130,
                'chat' => ['id' => 1, 'type' => 'private', 'first_name' => 'User'],
                'invoice' => [
                    'title' => 'Product',
                    'description' => 'Desc',
                    'currency' => 'USD',
                    'total_amount' => 100,
                ],
            ])),
            new Response(200, [], $this->apiResponse('https://t.me/$invoice_link')),
        ]);

        $message = $bot->sendInvoice(
            chatId: 1,
            title: 'Product',
            description: 'Desc',
            payload: 'order-1',
            currency: 'USD',
            prices: $prices,
            needName: true,
            isFlexible: true,
            messageThreadId: 3,
        );
        $body = $this->decodeLastRequest($mock);
        $this->assertSame('Product', $body['title']);
        $this->assertSame('USD', $body['currency']);
        $this->assertTrue($body['need_name']);
        $this->assertTrue($body['is_flexible']);
        $this->assertInstanceOf(Message::class, $message);

        $link = $bot->createInvoiceLink(
            'Product',
            'Desc',
            'order-1',
            'USD',
            $prices,
            businessConnectionId: 'bc-1',
            subscriptionPeriod: 2592000,
        );
        $this->assertSame('https://t.me/$invoice_link', $link);
        $body = $this->decodeLastRequest($mock);
        $this->assertSame('bc-1', $body['business_connection_id']);
        $this->assertSame(2592000, $body['subscription_period']);
    }

    public function testStarPaymentsAndBalance(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(['amount' => 250, 'nanostar_amount' => 0])),
        ]);

        $this->assertTrue($bot->refundStarPayment(1, 'charge-abc'));
        $this->assertSame([
            'user_id' => 1,
            'telegram_payment_charge_id' => 'charge-abc',
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->editUserStarSubscription(1, 'charge-abc', isCanceled: true));
        $this->assertTrue($this->decodeLastRequest($mock)['is_canceled']);

        $balance = $bot->getMyStarBalance();
        $this->assertInstanceOf(StarAmount::class, $balance);
        $this->assertSame(250, $balance->getAmount());
    }

    public function testRichMessagesAndDrafts(): void {
        $rich = new InputRichMessage(html: '<b>Hello</b>', isRtl: false);
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse($this->messageResult())),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $message = $bot->sendRichMessage(
            chatId: 1,
            richMessage: $rich,
            businessConnectionId: 'bc-1',
            messageThreadId: 4,
            protectContent: true,
        );
        $body = $this->decodeLastRequest($mock);
        $this->assertSame('bc-1', $body['business_connection_id']);
        $this->assertSame('<b>Hello</b>', $body['rich_message']['html']);
        $this->assertInstanceOf(Message::class, $message);

        $this->assertTrue($bot->sendRichMessageDraft(1, 7, $rich, messageThreadId: 4));
        $this->assertSame(7, $this->decodeLastRequest($mock)['draft_id']);

        $this->assertTrue($bot->sendMessageDraft(1, 8, 'Draft text', messageThreadId: 4, parseMode: 'HTML'));
        $this->assertSame([
            'chat_id' => 1,
            'draft_id' => 8,
            'text' => 'Draft text',
            'message_thread_id' => 4,
            'parse_mode' => 'HTML',
        ], $this->decodeLastRequest($mock));
    }

    public function testInlineWebAppAndGuestQueries(): void {
        $result = $this->inlineArticle();
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(['inline_message_id' => 'inline-msg-1'])),
            new Response(200, [], $this->apiResponse(['inline_message_id' => 'inline-msg-2'])),
            new Response(200, [], $this->apiResponse(['id' => 'prep-1', 'expiration_date' => 1681221530])),
            new Response(200, [], $this->apiResponse(['id' => 'btn-1'])),
        ]);

        $webApp = $bot->answerWebAppQuery('waq-1', $result);
        $this->assertInstanceOf(SentWebAppMessage::class, $webApp);
        $this->assertSame('waq-1', $this->decodeLastRequest($mock)['web_app_query_id']);

        $guest = $bot->answerGuestQuery('gq-1', $result);
        $this->assertInstanceOf(SentGuestMessage::class, $guest);
        $this->assertSame('gq-1', $this->decodeLastRequest($mock)['guest_query_id']);

        $prepared = $bot->savePreparedInlineMessage(1, $result, allowUserChats: true);
        $this->assertInstanceOf(PreparedInlineMessage::class, $prepared);
        $this->assertTrue($this->decodeLastRequest($mock)['allow_user_chats']);

        $button = $bot->savePreparedKeyboardButton(1, new KeyboardButton('Tap'));
        $this->assertInstanceOf(PreparedKeyboardButton::class, $button);
        $this->assertSame('Tap', $this->decodeLastRequest($mock)['button']['text']);
    }

    public function testBusinessConnectionAndMessaging(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse($this->businessConnectionResult())),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $connection = $bot->getBusinessConnection('bc-1');
        $this->assertInstanceOf(BusinessConnection::class, $connection);
        $this->assertSame('bc-1', $connection->getId());

        $this->assertTrue($bot->readBusinessMessage('bc-1', 1, 15));
        $this->assertSame([
            'business_connection_id' => 'bc-1',
            'chat_id' => 1,
            'message_id' => 15,
        ], $this->decodeLastRequest($mock));

        $this->assertTrue($bot->deleteBusinessMessages('bc-1', [10, 11]));
        $this->assertSame([10, 11], $this->decodeLastRequest($mock)['message_ids']);
    }

    public function testBusinessAccountSettings(): void {
        $photo = new InputProfilePhotoStatic(type: 'static', photo: 'attach://profile.jpg');
        $giftTypes = new AcceptedGiftTypes(unlimitedGifts: true, limitedGifts: true, uniqueGifts: false);
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(['amount' => 50])),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->setBusinessAccountName('bc-1', 'Acme', lastName: 'Inc'));
        $this->assertSame('Acme', $this->decodeLastRequest($mock)['first_name']);

        $this->assertTrue($bot->setBusinessAccountUsername('bc-1', 'acme_shop'));
        $this->assertSame('acme_shop', $this->decodeLastRequest($mock)['username']);

        $this->assertTrue($bot->setBusinessAccountBio('bc-1', 'We sell things'));
        $this->assertSame('We sell things', $this->decodeLastRequest($mock)['bio']);

        $this->assertTrue($bot->setBusinessAccountProfilePhoto('bc-1', $photo, isPublic: true));
        $this->assertTrue($this->decodeLastRequest($mock)['is_public']);

        $this->assertTrue($bot->removeBusinessAccountProfilePhoto('bc-1'));
        $this->assertSame('bc-1', $this->decodeLastRequest($mock)['business_connection_id']);

        $this->assertTrue($bot->setBusinessAccountGiftSettings('bc-1', showGiftButton: true, acceptedGiftTypes: $giftTypes));
        $this->assertTrue($this->decodeLastRequest($mock)['show_gift_button']);

        $balance = $bot->getBusinessAccountStarBalance('bc-1');
        $this->assertInstanceOf(StarAmount::class, $balance);

        $this->assertTrue($bot->transferBusinessAccountStars('bc-1', 25));
        $this->assertSame(25, $this->decodeLastRequest($mock)['star_count']);
    }

    public function testStoriesLifecycle(): void {
        $content = new InputStoryContentPhoto(type: 'photo', photo: 'attach://story.jpg');
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse($this->storyResult())),
            new Response(200, [], $this->apiResponse($this->storyResult())),
            new Response(200, [], $this->apiResponse($this->storyResult())),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $story = $bot->postStory('bc-1', $content, activePeriod: 86400, caption: 'News', postToChatPage: true);
        $body = $this->decodeLastRequest($mock);
        $this->assertSame('bc-1', $body['business_connection_id']);
        $this->assertSame(86400, $body['active_period']);
        $this->assertInstanceOf(Story::class, $story);

        $reposted = $bot->repostStory('bc-1', fromChatId: -1001234567890, fromStoryId: 10, activePeriod: 43200);
        $this->assertSame(10, $this->decodeLastRequest($mock)['from_story_id']);
        $this->assertInstanceOf(Story::class, $reposted);

        $edited = $bot->editStory('bc-1', storyId: 42, content: $content, caption: 'Updated');
        $this->assertSame(42, $this->decodeLastRequest($mock)['story_id']);
        $this->assertInstanceOf(Story::class, $edited);

        $this->assertTrue($bot->deleteStory('bc-1', 42));
        $this->assertSame(42, $this->decodeLastRequest($mock)['story_id']);
    }

    public function testGiftsAndPremium(): void {
        $sticker = SampleData::sticker();
        $giftsFixture = [
            'gifts' => [
                ['id' => 'gift-1', 'sticker' => $sticker, 'star_count' => 15],
            ],
        ];
        $ownedFixture = [
            'total_count' => 1,
            'gifts' => [
                [
                    'type' => 'regular',
                    'owned_gift_id' => 'og-1',
                    'gift' => ['id' => 'gift-1', 'sticker' => $sticker, 'star_count' => 15],
                ],
            ],
        ];
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse($giftsFixture)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse($ownedFixture)),
            new Response(200, [], $this->apiResponse($ownedFixture)),
            new Response(200, [], $this->apiResponse($ownedFixture)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $available = $bot->getAvailableGifts();
        $this->assertInstanceOf(Gifts::class, $available);
        $this->assertCount(1, $available->getGifts());

        $this->assertTrue($bot->sendGift(1, 'gift-1', text: 'Enjoy!'));
        $this->assertSame('gift-1', $this->decodeLastRequest($mock)['gift_id']);

        $userGifts = $bot->getUserGifts(1, limit: 10, sortByPrice: true);
        $this->assertInstanceOf(OwnedGifts::class, $userGifts);

        $chatGifts = $bot->getChatGifts(-1001234567890, excludeSaved: true, limit: 5);
        $this->assertInstanceOf(OwnedGifts::class, $chatGifts);
        $this->assertTrue($this->decodeLastRequest($mock)['exclude_saved']);

        $accountGifts = $bot->getBusinessAccountGifts('bc-1', excludeUnique: true, limit: 5);
        $this->assertInstanceOf(OwnedGifts::class, $accountGifts);

        $this->assertTrue($bot->convertGiftToStars('bc-1', 'og-1'));
        $this->assertTrue($bot->upgradeGift('bc-1', 'og-1', keepOriginalDetails: true));
        $this->assertTrue($bot->transferGift('bc-1', 'og-1', newOwnerChatId: 1, starCount: 5));

        $this->assertTrue($bot->giftPremiumSubscription(1, monthCount: 3, starCount: 1000, text: 'Premium for you'));
        $body = $this->decodeLastRequest($mock);
        $this->assertSame(3, $body['month_count']);
        $this->assertSame(1000, $body['star_count']);
    }

    public function testVerificationAndManagedBot(): void {
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse('managed-token')),
            new Response(200, [], $this->apiResponse('new-managed-token')),
            new Response(200, [], $this->apiResponse(['is_access_restricted' => false])),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->verifyUser(1, customDescription: 'Verified'));
        $this->assertTrue($bot->verifyChat(-1001234567890, customDescription: 'Official'));
        $this->assertTrue($bot->removeUserVerification(1));
        $this->assertTrue($bot->removeChatVerification(-1001234567890));

        $this->assertSame('managed-token', $bot->getManagedBotToken(1));
        $this->assertSame('new-managed-token', $bot->replaceManagedBotToken(1));

        $settings = $bot->getManagedBotAccessSettings(1);
        $this->assertInstanceOf(BotAccessSettings::class, $settings);

        $this->assertTrue($bot->setManagedBotAccessSettings(1, isAccessRestricted: true, addedUserIds: [2, 3]));
        $this->assertTrue($this->decodeLastRequest($mock)['is_access_restricted']);
    }

    public function testChecklistsAndSuggestedPosts(): void {
        $checklist = new InputChecklist(
            title: 'Todo',
            tasks: [new InputChecklistTask(id: 1, text: 'Buy milk')],
        );
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse($this->messageResult())),
            new Response(200, [], $this->apiResponse($this->messageResult())),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $sent = $bot->sendChecklist('bc-1', 1, $checklist, protectContent: true);
        $this->assertInstanceOf(Message::class, $sent);
        $this->assertSame('Todo', $this->decodeLastRequest($mock)['checklist']['title']);

        $edited = $bot->editMessageChecklist('bc-1', 1, 15, $checklist);
        $this->assertInstanceOf(Message::class, $edited);
        $this->assertSame(15, $this->decodeLastRequest($mock)['message_id']);

        $this->assertTrue($bot->approveSuggestedPost(1, 20, sendDate: 1681221530));
        $this->assertSame(1681221530, $this->decodeLastRequest($mock)['send_date']);

        $this->assertTrue($bot->declineSuggestedPost(1, 20, comment: 'Not suitable'));
        $this->assertSame('Not suitable', $this->decodeLastRequest($mock)['comment']);
    }

    public function testAdminRightsProfileAndUserData(): void {
        $rights = new ChatAdministratorRights(
            isAnonymous: false,
            canManageChat: true,
            canDeleteMessages: true,
            canManageVideoChats: true,
            canRestrictMembers: true,
            canPromoteMembers: false,
            canChangeInfo: true,
            canInviteUsers: true,
            canPostStories: true,
            canEditStories: true,
            canDeleteStories: true,
            canPostMessages: true,
            canEditMessages: true,
            canPinMessages: true,
            canManageTopics: true,
        );
        $photo = new InputProfilePhotoStatic(type: 'static', photo: 'attach://avatar.jpg');
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse($rights->toArray())),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse([
                'boosts' => [
                    [
                        'boost_id' => 'boost-1',
                        'add_date' => 1681135130,
                        'expiration_date' => 1681221530,
                    ],
                ],
            ])),
            new Response(200, [], $this->apiResponse([
                'total_count' => 1,
                'audios' => [SampleData::audio()],
            ])),
            new Response(200, [], $this->apiResponse([$this->messageResult()])),
        ]);

        $this->assertTrue($bot->setMyDefaultAdministratorRights($rights, forChannels: true));
        $this->assertTrue($this->decodeLastRequest($mock)['for_channels']);

        $loaded = $bot->getMyDefaultAdministratorRights(forChannels: true);
        $this->assertInstanceOf(ChatAdministratorRights::class, $loaded);

        $this->assertTrue($bot->setMyProfilePhoto($photo));
        $this->assertTrue($bot->removeMyProfilePhoto());

        $this->assertTrue($bot->setUserEmojiStatus(1, emojiStatusCustomEmojiId: '123', emojiStatusExpirationDate: 1681221530));
        $this->assertSame('123', $this->decodeLastRequest($mock)['emoji_status_custom_emoji_id']);

        $this->assertTrue($bot->setChatMemberTag(-1001234567890, 42, tag: 'vip'));
        $this->assertSame('vip', $this->decodeLastRequest($mock)['tag']);

        $boosts = $bot->getUserChatBoosts(-1001234567890, 1);
        $this->assertInstanceOf(UserChatBoosts::class, $boosts);

        $audios = $bot->getUserProfileAudios(1, offset: 0, limit: 1);
        $this->assertInstanceOf(UserProfileAudios::class, $audios);
        $this->assertSame(1, $audios->getTotalCount());

        $messages = $bot->getUserPersonalChatMessages(1, limit: 5);
        $this->assertCount(1, $messages);
        $this->assertInstanceOf(Message::class, $messages[0]);
    }

    public function testPassportAndExtraStickerMethods(): void {
        $error = new PassportElementErrorDataField(
            type: 'passport',
            fieldName: 'number',
            dataHash: 'hash',
            message: 'Invalid',
        );
        $mask = new MaskPosition(point: 'forehead', xShift: 0.0, yShift: 0.1, scale: 1.0);
        [$bot, $mock] = $this->createBotWithMock([
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
            new Response(200, [], $this->apiResponse(true)),
        ]);

        $this->assertTrue($bot->setPassportDataErrors(1, [$error]));
        $this->assertSame('passport', $this->decodeLastRequest($mock)['errors'][0]['type']);

        $this->assertTrue($bot->deleteStickerFromSet('file_id_sticker'));
        $this->assertTrue($bot->setStickerMaskPosition('file_id_sticker', $mask));
        $this->assertSame('forehead', $this->decodeLastRequest($mock)['mask_position']['point']);

        $this->assertTrue($bot->setStickerSetTitle('my_set_by_bot', 'Renamed Set'));
        $this->assertSame('Renamed Set', $this->decodeLastRequest($mock)['title']);

        $this->assertTrue($bot->setCustomEmojiStickerSetThumbnail('emoji_set', customEmojiId: '999'));
        $this->assertSame('999', $this->decodeLastRequest($mock)['custom_emoji_id']);
    }

    public function testDownloadFileSavesContent(): void {
        $fileFixture = $this->loadFixture('api_responses/get_file.json');
        $savePath = tempnam(sys_get_temp_dir(), 'dl');
        $this->assertNotFalse($savePath);
        @unlink($savePath);

        try {
            [$bot] = $this->createBotWithMock([
                new Response(200, [], 'file-bytes'),
            ]);

            $bot->downloadFile(File::fromArray($fileFixture), $savePath);

            $this->assertFileExists($savePath);
            $this->assertSame('file-bytes', file_get_contents($savePath));
        } finally {
            @unlink($savePath);
        }
    }

}
