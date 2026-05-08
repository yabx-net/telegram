<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes the background of a gift.
 * @link https://core.telegram.org/bots/api#giftbackground
 */
final class GiftBackground extends AbstractObject {

    /**
     * Center Color
     *
     * Center color of the background in RGB format
     * @var int|null
     */
    protected ?int $centerColor = null;

    /**
     * Edge Color
     *
     * Edge color of the background in RGB format
     * @var int|null
     */
    protected ?int $edgeColor = null;

    /**
     * Text Color
     *
     * Text color of the background in RGB format
     * @var int|null
     */
    protected ?int $textColor = null;

    public static function fromArray(array $data): GiftBackground {
        $instance = new self();
        if (isset($data['center_color'])) {
            $instance->centerColor = $data['center_color'];
        }
        if (isset($data['edge_color'])) {
            $instance->edgeColor = $data['edge_color'];
        }
        if (isset($data['text_color'])) {
            $instance->textColor = $data['text_color'];
        }
        return $instance;
    }

    public function __construct(
        ?int $centerColor = null,
        ?int $edgeColor = null,
        ?int $textColor = null,
    ) {
        $this->centerColor = $centerColor;
        $this->edgeColor = $edgeColor;
        $this->textColor = $textColor;
    }

    public function getCenterColor(): ?int {
        return $this->centerColor;
    }

    public function setCenterColor(?int $value): self {
        $this->centerColor = $value;
        return $this;
    }

    public function getEdgeColor(): ?int {
        return $this->edgeColor;
    }

    public function setEdgeColor(?int $value): self {
        $this->edgeColor = $value;
        return $this;
    }

    public function getTextColor(): ?int {
        return $this->textColor;
    }

    public function setTextColor(?int $value): self {
        $this->textColor = $value;
        return $this;
    }

}
