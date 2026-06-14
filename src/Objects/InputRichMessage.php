<?php

namespace Yabx\Telegram\Objects;

final class InputRichMessage extends AbstractObject {

    protected ?string $html = null;

    protected ?string $markdown = null;

    protected ?bool $isRtl = null;

    protected ?bool $skipEntityDetection = null;

    public function __construct(
        ?string $html = null,
        ?string $markdown = null,
        ?bool $isRtl = null,
        ?bool $skipEntityDetection = null
    ) {
        $this->html = $html;
        $this->markdown = $markdown;
        $this->isRtl = $isRtl;
        $this->skipEntityDetection = $skipEntityDetection;
    }

    public static function fromArray(array $data): InputRichMessage {
        $instance = new self();
        if (isset($data['html'])) {
            $instance->html = $data['html'];
        }
        if (isset($data['markdown'])) {
            $instance->markdown = $data['markdown'];
        }
        if (isset($data['is_rtl'])) {
            $instance->isRtl = $data['is_rtl'];
        }
        if (isset($data['skip_entity_detection'])) {
            $instance->skipEntityDetection = $data['skip_entity_detection'];
        }
        return $instance;
    }

    public function getHtml(): ?string {
        return $this->html;
    }

    public function setHtml(?string $value): self {
        $this->html = $value;
        return $this;
    }

    public function getMarkdown(): ?string {
        return $this->markdown;
    }

    public function setMarkdown(?string $value): self {
        $this->markdown = $value;
        return $this;
    }

    public function getIsRtl(): ?bool {
        return $this->isRtl;
    }

    public function setIsRtl(?bool $value): self {
        $this->isRtl = $value;
        return $this;
    }

    public function getSkipEntityDetection(): ?bool {
        return $this->skipEntityDetection;
    }

    public function setSkipEntityDetection(?bool $value): self {
        $this->skipEntityDetection = $value;
        return $this;
    }
}
