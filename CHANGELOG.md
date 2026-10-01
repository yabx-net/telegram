# Changelog

All notable changes to this project are documented in this file.

## Unreleased

### Added

- Bot API 10.3 support (August 24, 2026):
  - Rich messages: `RichMessageButton`, `RichTextButton`, `RichBlockButtons` / `InputRichBlockButtons`, expandable quotations, document blocks, `is_compact` on tables, `tg://document?id=` media
  - Ephemeral messages: `EphemeralMessageParameters` replaces `receiver_user_id` / `callback_query_id` on send methods (including `sendLivePhoto` and `sendRichMessage`); `editEphemeralMessageText` accepts `rich_message`; `editEphemeralMessageCaption` accepts `show_caption_above_media`
  - Drafts: `can_stop` / `keep_on_stop` on `sendMessageDraft` and `sendRichMessageDraft`; `MessageGenerationStopped` and `Update.stopped_message_generation`
  - Communities: `CommunityChatJoined` and `Message.community_chat_joined`
  - Keyboards: `DisabledButton`, `InlineKeyboardButton.disabled`, `force_reply` on inline and reply keyboards
  - `can_send_welcome_messages` on administrator rights, chat member, and `promoteChatMember`
  - `UniqueGiftInfo.text` / `entities` / `is_private`

- Bot API 10.2 support (July 14, 2026):
  - Rich Messages: `InputRichBlock*` types, `InputRichBlockListItem`, `InputRichMessageMedia`, `InputMediaVoiceNote`; `InputRichMessage.blocks` / `media`
  - Ephemeral Messages: `Message.receiver_user` / `ephemeral_message_id`, `BotCommand.is_ephemeral`, `ReplyParameters.ephemeral_message_id`; `receiver_user_id` / `callback_query_id` on send* methods; `editEphemeralMessage*`, `deleteEphemeralMessage`
  - Communities: `Community`, `CommunityChatAdded`, `CommunityChatRemoved`; `Message.community_chat_*`, `ChatFullInfo.community`
  - Subscriptions: `BotSubscriptionUpdated`, `Update.subscription`
  - Tests: `InputRichBlockAllTypesTest`, roundtrip fixtures for InputRichBlock*/Community/subscription, ephemeral BotApi coverage including `editEphemeralMessageMedia`

### Fixed

- CI on PHP 8.1: allow PHPUnit 10.5 (`^10.5 || ^11.0`) because PHPUnit 11 requires PHP 8.2+.

## [10.1.1] - 2026-06-14

### Added

- Phase 19: deep variant tests for `Message`, `ChatFullInfo`, and `Update` (17 new message fixtures, extended chat snapshot).
- Phase 20: `BotApiEdgeCasesTest` — `downloadFile` by `file_id`, HTTP errors, `sendLivePhoto` multipart, PSR-3 logging, transport errors, `getUpdates` params.
- Phase 21: six API response snapshots (`get_business_connection`, `get_available_gifts`, `owned_gifts`, `get_user_chat_boosts`, `send_invoice`, extended `getChat`).
- Phase 22: polymorphic coverage for `StoryAreaTypeUniqueGift`; `sendPoll` with `InputMediaPhoto`.
- Phase 23: PHPStan (level 2), coverage threshold 57% in `scripts/coverage.php`, CI static analysis job step.
- `composer phpstan` script.

### Fixed

- `BotApi::setWebhook()` — removed reference to undefined `$certificate` variable (PHPStan finding).

### Testing

- **766 tests**, overall line coverage **~58%** (`Message` ~67%, `ChatFullInfo` ~66%, `Update` ~67%, `BotApi` ~99%).
