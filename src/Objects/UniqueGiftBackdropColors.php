<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes the colors of the backdrop of a unique gift.
 * @link https://core.telegram.org/bots/api#uniquegiftbackdropcolors
 */
final class UniqueGiftBackdropColors extends AbstractObject {

    /**
     * Center Color
     *
     * The color in the center of the backdrop in RGB format
     * @var int|null
     */
    protected ?int $centerColor = null;

    /**
     * Edge Color
     *
     * The color on the edges of the backdrop in RGB format
     * @var int|null
     */
    protected ?int $edgeColor = null;

    /**
     * Symbol Color
     *
     * The color to be applied to the symbol in RGB format
     * @var int|null
     */
    protected ?int $symbolColor = null;

    /**
     * Text Color
     *
     * The color for the text on the backdrop in RGB format
     * @var int|null
     */
    protected ?int $textColor = null;

    public static function fromArray(array $data): UniqueGiftBackdropColors {
        $instance = new self();
        if (isset($data['center_color'])) {
            $instance->centerColor = $data['center_color'];
        }
        if (isset($data['edge_color'])) {
            $instance->edgeColor = $data['edge_color'];
        }
        if (isset($data['symbol_color'])) {
            $instance->symbolColor = $data['symbol_color'];
        }
        if (isset($data['text_color'])) {
            $instance->textColor = $data['text_color'];
        }
        return $instance;
    }

    public function __construct(
        ?int $centerColor = null,
        ?int $edgeColor = null,
        ?int $symbolColor = null,
        ?int $textColor = null,
    ) {
        $this->centerColor = $centerColor;
        $this->edgeColor = $edgeColor;
        $this->symbolColor = $symbolColor;
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

    public function getSymbolColor(): ?int {
        return $this->symbolColor;
    }

    public function setSymbolColor(?int $value): self {
        $this->symbolColor = $value;
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
