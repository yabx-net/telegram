<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ChatPermissions {

    use ObjectTrait;

    /**
     * Can Send Messages
     *
     * Optional. True, if the user is allowed to send text messages, contacts, invoices, locations and venues
     * @var bool|null
     */
    protected ?bool $canSendMessages = null;

    /**
     * Can Send Audios
     *
     * Optional. True, if the user is allowed to send audios
     * @var bool|null
     */
    protected ?bool $canSendAudios = null;

    /**
     * Can Send Documents
     *
     * Optional. True, if the user is allowed to send documents
     * @var bool|null
     */
    protected ?bool $canSendDocuments = null;

    /**
     * Can Send Photos
     *
     * Optional. True, if the user is allowed to send photos
     * @var bool|null
     */
    protected ?bool $canSendPhotos = null;

    /**
     * Can Send Videos
     *
     * Optional. True, if the user is allowed to send videos
     * @var bool|null
     */
    protected ?bool $canSendVideos = null;

    /**
     * Can Send Video Notes
     *
     * Optional. True, if the user is allowed to send video notes
     * @var bool|null
     */
    protected ?bool $canSendVideoNotes = null;

    /**
     * Can Send Voice Notes
     *
     * Optional. True, if the user is allowed to send voice notes
     * @var bool|null
     */
    protected ?bool $canSendVoiceNotes = null;

    /**
     * Can Send Polls
     *
     * Optional. True, if the user is allowed to send polls
     * @var bool|null
     */
    protected ?bool $canSendPolls = null;

    /**
     * Can Send Other Messages
     *
     * Optional. True, if the user is allowed to send animations, games, stickers and use inline bots
     * @var bool|null
     */
    protected ?bool $canSendOtherMessages = null;

    /**
     * Can Add Web Page Previews
     *
     * Optional. True, if the user is allowed to add web page previews to their messages
     * @var bool|null
     */
    protected ?bool $canAddWebPagePreviews = null;

    /**
     * Can Change Info
     *
     * Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
     * @var bool|null
     */
    protected ?bool $canChangeInfo = null;

    /**
     * Can Invite Users
     *
     * Optional. True, if the user is allowed to invite new users to the chat
     * @var bool|null
     */
    protected ?bool $canInviteUsers = null;

    /**
     * Can Pin Messages
     *
     * Optional. True, if the user is allowed to pin messages. Ignored in public supergroups
     * @var bool|null
     */
    protected ?bool $canPinMessages = null;

    /**
     * Can Manage Topics
     *
     * Optional. True, if the user is allowed to create forum topics. If omitted defaults to the value of can_pin_messages
     * @var bool|null
     */
    protected ?bool $canManageTopics = null;

    public function __construct(
        ?bool $canSendMessages = null,
        ?bool $canSendAudios = null,
        ?bool $canSendDocuments = null,
        ?bool $canSendPhotos = null,
        ?bool $canSendVideos = null,
        ?bool $canSendVideoNotes = null,
        ?bool $canSendVoiceNotes = null,
        ?bool $canSendPolls = null,
        ?bool $canSendOtherMessages = null,
        ?bool $canAddWebPagePreviews = null,
        ?bool $canChangeInfo = null,
        ?bool $canInviteUsers = null,
        ?bool $canPinMessages = null,
        ?bool $canManageTopics = null,
    ) {
        $this->canSendMessages = $canSendMessages;
        $this->canSendAudios = $canSendAudios;
        $this->canSendDocuments = $canSendDocuments;
        $this->canSendPhotos = $canSendPhotos;
        $this->canSendVideos = $canSendVideos;
        $this->canSendVideoNotes = $canSendVideoNotes;
        $this->canSendVoiceNotes = $canSendVoiceNotes;
        $this->canSendPolls = $canSendPolls;
        $this->canSendOtherMessages = $canSendOtherMessages;
        $this->canAddWebPagePreviews = $canAddWebPagePreviews;
        $this->canChangeInfo = $canChangeInfo;
        $this->canInviteUsers = $canInviteUsers;
        $this->canPinMessages = $canPinMessages;
        $this->canManageTopics = $canManageTopics;
    }

    public static function fromArray(array $data): ChatPermissions {
        $instance = new self();
        if (isset($data['can_send_messages'])) {
            $instance->canSendMessages = $data['can_send_messages'];
        }
        if (isset($data['can_send_audios'])) {
            $instance->canSendAudios = $data['can_send_audios'];
        }
        if (isset($data['can_send_documents'])) {
            $instance->canSendDocuments = $data['can_send_documents'];
        }
        if (isset($data['can_send_photos'])) {
            $instance->canSendPhotos = $data['can_send_photos'];
        }
        if (isset($data['can_send_videos'])) {
            $instance->canSendVideos = $data['can_send_videos'];
        }
        if (isset($data['can_send_video_notes'])) {
            $instance->canSendVideoNotes = $data['can_send_video_notes'];
        }
        if (isset($data['can_send_voice_notes'])) {
            $instance->canSendVoiceNotes = $data['can_send_voice_notes'];
        }
        if (isset($data['can_send_polls'])) {
            $instance->canSendPolls = $data['can_send_polls'];
        }
        if (isset($data['can_send_other_messages'])) {
            $instance->canSendOtherMessages = $data['can_send_other_messages'];
        }
        if (isset($data['can_add_web_page_previews'])) {
            $instance->canAddWebPagePreviews = $data['can_add_web_page_previews'];
        }
        if (isset($data['can_change_info'])) {
            $instance->canChangeInfo = $data['can_change_info'];
        }
        if (isset($data['can_invite_users'])) {
            $instance->canInviteUsers = $data['can_invite_users'];
        }
        if (isset($data['can_pin_messages'])) {
            $instance->canPinMessages = $data['can_pin_messages'];
        }
        if (isset($data['can_manage_topics'])) {
            $instance->canManageTopics = $data['can_manage_topics'];
        }
        return $instance;
    }

    public function getCanSendMessages(): ?bool {
        return $this->canSendMessages;
    }

    public function setCanSendMessages(?bool $value): self {
        $this->canSendMessages = $value;
        return $this;
    }

    public function getCanSendAudios(): ?bool {
        return $this->canSendAudios;
    }

    public function setCanSendAudios(?bool $value): self {
        $this->canSendAudios = $value;
        return $this;
    }

    public function getCanSendDocuments(): ?bool {
        return $this->canSendDocuments;
    }

    public function setCanSendDocuments(?bool $value): self {
        $this->canSendDocuments = $value;
        return $this;
    }

    public function getCanSendPhotos(): ?bool {
        return $this->canSendPhotos;
    }

    public function setCanSendPhotos(?bool $value): self {
        $this->canSendPhotos = $value;
        return $this;
    }

    public function getCanSendVideos(): ?bool {
        return $this->canSendVideos;
    }

    public function setCanSendVideos(?bool $value): self {
        $this->canSendVideos = $value;
        return $this;
    }

    public function getCanSendVideoNotes(): ?bool {
        return $this->canSendVideoNotes;
    }

    public function setCanSendVideoNotes(?bool $value): self {
        $this->canSendVideoNotes = $value;
        return $this;
    }

    public function getCanSendVoiceNotes(): ?bool {
        return $this->canSendVoiceNotes;
    }

    public function setCanSendVoiceNotes(?bool $value): self {
        $this->canSendVoiceNotes = $value;
        return $this;
    }

    public function getCanSendPolls(): ?bool {
        return $this->canSendPolls;
    }

    public function setCanSendPolls(?bool $value): self {
        $this->canSendPolls = $value;
        return $this;
    }

    public function getCanSendOtherMessages(): ?bool {
        return $this->canSendOtherMessages;
    }

    public function setCanSendOtherMessages(?bool $value): self {
        $this->canSendOtherMessages = $value;
        return $this;
    }

    public function getCanAddWebPagePreviews(): ?bool {
        return $this->canAddWebPagePreviews;
    }

    public function setCanAddWebPagePreviews(?bool $value): self {
        $this->canAddWebPagePreviews = $value;
        return $this;
    }

    public function getCanChangeInfo(): ?bool {
        return $this->canChangeInfo;
    }

    public function setCanChangeInfo(?bool $value): self {
        $this->canChangeInfo = $value;
        return $this;
    }

    public function getCanInviteUsers(): ?bool {
        return $this->canInviteUsers;
    }

    public function setCanInviteUsers(?bool $value): self {
        $this->canInviteUsers = $value;
        return $this;
    }

    public function getCanPinMessages(): ?bool {
        return $this->canPinMessages;
    }

    public function setCanPinMessages(?bool $value): self {
        $this->canPinMessages = $value;
        return $this;
    }

    public function getCanManageTopics(): ?bool {
        return $this->canManageTopics;
    }

    public function setCanManageTopics(?bool $value): self {
        $this->canManageTopics = $value;
        return $this;
    }

}
