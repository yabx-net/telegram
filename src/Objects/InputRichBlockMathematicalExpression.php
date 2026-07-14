<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with a mathematical expression in LaTeX format, corresponding to the custom HTML tag <tg-math-block>.
 * @link https://core.telegram.org/bots/api#inputrichblockmathematicalexpression
 */
final class InputRichBlockMathematicalExpression extends InputRichBlock {

    /**
     * Type
     *
     * Type of the block, always "mathematical_expression"
     * @var string
     */
    protected string $type = 'mathematical_expression';

    /**
     * Expression
     *
     * The mathematical expression in LaTeX format
     * @var string|null
     */
    protected ?string $expression = null;

    public function __construct(
        ?string $expression = null
    ) {
        $this->expression = $expression;
    }

    public static function fromArray(array $data): InputRichBlockMathematicalExpression {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['expression'])) {
            $instance->expression = $data['expression'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getExpression(): ?string {
        return $this->expression;
    }

    public function setExpression(?string $value): self {
        $this->expression = $value;
        return $this;
    }
}
