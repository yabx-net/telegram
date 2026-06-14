# Changelog

All notable changes to this project are documented in this file.

## Unreleased

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
