<?php

namespace Yabx\Telegram\Objects;

final class WriteAccessAllowed extends AbstractObject {

    /**
     * From Request
     *
     * Optional. True, if the access was granted after the user accepted an explicit request from a Web App sent by the method requestWriteAccess
     * @var bool|null
     */
    protected ?bool $fromRequest = null;

    /**
     * Web App Name
     *
     * Optional. Name of the Web App, if the access was granted when the Web App was launched from a link
     * @var string|null
     */
    protected ?string $webAppName = null;

    /**
     * From Attachment Menu
     *
     * Optional. True, if the access was granted when the bot was added to the attachment or side menu
     * @var bool|null
     */
    protected ?bool $fromAttachmentMenu = null;

    public static function fromArray(array $data): WriteAccessAllowed {
        $instance = new self();
        if (isset($data['from_request'])) {
            $instance->fromRequest = $data['from_request'];
        }
        if (isset($data['web_app_name'])) {
            $instance->webAppName = $data['web_app_name'];
        }
        if (isset($data['from_attachment_menu'])) {
            $instance->fromAttachmentMenu = $data['from_attachment_menu'];
        }
        return $instance;
    }

    public function __construct(
        ?bool   $fromRequest = null,
        ?string $webAppName = null,
        ?bool   $fromAttachmentMenu = null,
    ) {
        $this->fromRequest = $fromRequest;
        $this->webAppName = $webAppName;
        $this->fromAttachmentMenu = $fromAttachmentMenu;
    }

    public function getFromRequest(): ?bool {
        return $this->fromRequest;
    }

    public function setFromRequest(?bool $value): self {
        $this->fromRequest = $value;
        return $this;
    }

    public function getWebAppName(): ?string {
        return $this->webAppName;
    }

    public function setWebAppName(?string $value): self {
        $this->webAppName = $value;
        return $this;
    }

    public function getFromAttachmentMenu(): ?bool {
        return $this->fromAttachmentMenu;
    }

    public function setFromAttachmentMenu(?bool $value): self {
        $this->fromAttachmentMenu = $value;
        return $this;
    }

}
