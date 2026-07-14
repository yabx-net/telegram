<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * This object represents a block in a rich formatted message to be sent. Currently, it can be any of the following types:
 * InputRichBlockParagraph, InputRichBlockSectionHeading, InputRichBlockPreformatted, InputRichBlockFooter,
 * InputRichBlockDivider, InputRichBlockMathematicalExpression, InputRichBlockAnchor, InputRichBlockList,
 * InputRichBlockBlockQuotation, InputRichBlockPullQuotation, InputRichBlockCollage, InputRichBlockSlideshow,
 * InputRichBlockTable, InputRichBlockDetails, InputRichBlockMap, InputRichBlockAnimation, InputRichBlockAudio,
 * InputRichBlockPhoto, InputRichBlockVideo, InputRichBlockVoiceNote, InputRichBlockThinking
 * @link https://core.telegram.org/bots/api#inputrichblock
 */
abstract class InputRichBlock extends AbstractObject {

    public static function fromArray(array $data): InputRichBlock {
        return match ($data['type']) {
            'paragraph' => InputRichBlockParagraph::fromArray($data),
            'heading' => InputRichBlockSectionHeading::fromArray($data),
            'pre' => InputRichBlockPreformatted::fromArray($data),
            'footer' => InputRichBlockFooter::fromArray($data),
            'divider' => InputRichBlockDivider::fromArray($data),
            'mathematical_expression' => InputRichBlockMathematicalExpression::fromArray($data),
            'anchor' => InputRichBlockAnchor::fromArray($data),
            'list' => InputRichBlockList::fromArray($data),
            'blockquote' => InputRichBlockBlockQuotation::fromArray($data),
            'pullquote' => InputRichBlockPullQuotation::fromArray($data),
            'collage' => InputRichBlockCollage::fromArray($data),
            'slideshow' => InputRichBlockSlideshow::fromArray($data),
            'table' => InputRichBlockTable::fromArray($data),
            'details' => InputRichBlockDetails::fromArray($data),
            'map' => InputRichBlockMap::fromArray($data),
            'animation' => InputRichBlockAnimation::fromArray($data),
            'audio' => InputRichBlockAudio::fromArray($data),
            'photo' => InputRichBlockPhoto::fromArray($data),
            'video' => InputRichBlockVideo::fromArray($data),
            'voice_note' => InputRichBlockVoiceNote::fromArray($data),
            'thinking' => InputRichBlockThinking::fromArray($data),
            default => throw new InvalidArgumentException('Invalid InputRichBlock type'),
        };
    }

}
