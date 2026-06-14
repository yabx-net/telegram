<?php

declare(strict_types=1);

return array_merge(
    require __DIR__ . '/roundtrip/core.php',
    require __DIR__ . '/roundtrip/media.php',
    require __DIR__ . '/roundtrip/keyboards.php',
    require __DIR__ . '/roundtrip/input_media.php',
    require __DIR__ . '/roundtrip/input_content.php',
    require __DIR__ . '/roundtrip/business.php',
    require __DIR__ . '/roundtrip/stories.php',
    require __DIR__ . '/roundtrip/stars.php',
    require __DIR__ . '/roundtrip/payments.php',
    require __DIR__ . '/roundtrip/forum.php',
    require __DIR__ . '/roundtrip/rich.php',
    require __DIR__ . '/roundtrip/blocks.php',
    require __DIR__ . '/roundtrip/games.php',
    require __DIR__ . '/roundtrip/checklists.php',
    require __DIR__ . '/roundtrip/bot.php',
    require __DIR__ . '/roundtrip/messages.php',
    require __DIR__ . '/roundtrip/giveaways.php',
    require __DIR__ . '/roundtrip/backgrounds.php',
    require __DIR__ . '/roundtrip/chat_members.php',
    require __DIR__ . '/roundtrip/inline_results.php',
    require __DIR__ . '/roundtrip/passport.php',
    require __DIR__ . '/roundtrip/services.php',
    require __DIR__ . '/roundtrip/social.php',
);
