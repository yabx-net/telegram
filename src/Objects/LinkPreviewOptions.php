<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class LinkPreviewOptions {

    use ObjectTrait;

    /**
     * Is Disabled
     *
     * Optional. True, if the link preview is disabled
     * @var bool|null
     */
    protected ?bool $isDisabled = null;

    /**
     * Url
     *
     * Optional. URL to use for the link preview. If empty, then the first URL found in the message text will be used
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * Prefer Small Media
     *
     * Optional. True, if the media in the link preview is supposed to be shrunk; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview
     * @var bool|null
     */
    protected ?bool $preferSmallMedia = null;

    /**
     * Prefer Large Media
     *
     * Optional. True, if the media in the link preview is supposed to be enlarged; ignored if the URL isn't explicitly specified or media size change isn't supported for the preview
     * @var bool|null
     */
    protected ?bool $preferLargeMedia = null;

    /**
     * Show Above Text
     *
     * Optional. True, if the link preview must be shown above the message text; otherwise, the link preview will be shown below the message text
     * @var bool|null
     */
    protected ?bool $showAboveText = null;

    public static function fromArray(array $data): LinkPreviewOptions {
        $instance = new self();
        if (isset($data['is_disabled'])) {
            $instance->isDisabled = $data['is_disabled'];
        }
        if (isset($data['url'])) {
            $instance->url = $data['url'];
        }
        if (isset($data['prefer_small_media'])) {
            $instance->preferSmallMedia = $data['prefer_small_media'];
        }
        if (isset($data['prefer_large_media'])) {
            $instance->preferLargeMedia = $data['prefer_large_media'];
        }
        if (isset($data['show_above_text'])) {
            $instance->showAboveText = $data['show_above_text'];
        }
        return $instance;
    }

    public function __construct(
        ?bool   $isDisabled = null,
        ?string $url = null,
        ?bool   $preferSmallMedia = null,
        ?bool   $preferLargeMedia = null,
        ?bool   $showAboveText = null,
    ) {
        $this->isDisabled = $isDisabled;
        $this->url = $url;
        $this->preferSmallMedia = $preferSmallMedia;
        $this->preferLargeMedia = $preferLargeMedia;
        $this->showAboveText = $showAboveText;
    }

    public function getIsDisabled(): ?bool {
        return $this->isDisabled;
    }

    public function setIsDisabled(?bool $value): self {
        $this->isDisabled = $value;
        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $value): self {
        $this->url = $value;
        return $this;
    }

    public function getPreferSmallMedia(): ?bool {
        return $this->preferSmallMedia;
    }

    public function setPreferSmallMedia(?bool $value): self {
        $this->preferSmallMedia = $value;
        return $this;
    }

    public function getPreferLargeMedia(): ?bool {
        return $this->preferLargeMedia;
    }

    public function setPreferLargeMedia(?bool $value): self {
        $this->preferLargeMedia = $value;
        return $this;
    }

    public function getShowAboveText(): ?bool {
        return $this->showAboveText;
    }

    public function setShowAboveText(?bool $value): self {
        $this->showAboveText = $value;
        return $this;
    }

}
