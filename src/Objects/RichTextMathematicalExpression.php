<?php

namespace Yabx\Telegram\Objects;

final class RichTextMathematicalExpression extends RichText {

    protected string $type = 'mathematical_expression';

    protected ?string $expression = null;

    public function __construct(
        ?string $expression = null
    ) {
        $this->expression = $expression;
    }

    public static function fromArray(array $data): RichTextMathematicalExpression {
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
