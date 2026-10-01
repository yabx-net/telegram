<?php

namespace Yabx\Telegram\Objects;

/**
 * A block with a general file, corresponding to the custom HTML tag <tg-document>.
 * @link https://core.telegram.org/bots/api#richblockdocument
 */
final class RichBlockDocument extends RichBlock {

    /**
     * Type
     *
     * Type of the block, always "document"
     * @var string
     */
    protected string $type = 'document';

    /**
     * Document
     *
     * The document
     * @var Document|null
     */
    protected ?Document $document = null;

    /**
     * Caption
     *
     * Optional. Caption of the block
     * @var RichBlockCaption|null
     */
    protected ?RichBlockCaption $caption = null;

    public function __construct(
        ?Document $document = null,
        ?RichBlockCaption $caption = null,
    ) {
        $this->document = $document;
        $this->caption = $caption;
    }

    public static function fromArray(array $data): RichBlockDocument {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['document'])) {
            $instance->document = Document::fromArray($data['document']);
        }
        if (isset($data['caption'])) {
            $instance->caption = RichBlockCaption::fromArray($data['caption']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getDocument(): ?Document {
        return $this->document;
    }

    public function setDocument(?Document $value): self {
        $this->document = $value;
        return $this;
    }

    public function getCaption(): ?RichBlockCaption {
        return $this->caption;
    }

    public function setCaption(?RichBlockCaption $value): self {
        $this->caption = $value;
        return $this;
    }
}
