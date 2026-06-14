<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

abstract class RichBlock extends AbstractObject {

    public static function fromArray(array $data): RichBlock {
        return match ($data['type']) {
            'paragraph' => RichBlockParagraph::fromArray($data),
            'heading' => RichBlockSectionHeading::fromArray($data),
            'pre' => RichBlockPreformatted::fromArray($data),
            'footer' => RichBlockFooter::fromArray($data),
            'divider' => RichBlockDivider::fromArray($data),
            'mathematical_expression' => RichBlockMathematicalExpression::fromArray($data),
            'anchor' => RichBlockAnchor::fromArray($data),
            'list' => RichBlockList::fromArray($data),
            'blockquote' => RichBlockBlockQuotation::fromArray($data),
            'pullquote' => RichBlockPullQuotation::fromArray($data),
            'collage' => RichBlockCollage::fromArray($data),
            'slideshow' => RichBlockSlideshow::fromArray($data),
            'table' => RichBlockTable::fromArray($data),
            'details' => RichBlockDetails::fromArray($data),
            'map' => RichBlockMap::fromArray($data),
            'animation' => RichBlockAnimation::fromArray($data),
            'audio' => RichBlockAudio::fromArray($data),
            'photo' => RichBlockPhoto::fromArray($data),
            'video' => RichBlockVideo::fromArray($data),
            'voice_note' => RichBlockVoiceNote::fromArray($data),
            'thinking' => RichBlockThinking::fromArray($data),
            default => throw new InvalidArgumentException('Invalid RichBlock type'),
        };
    }

}
