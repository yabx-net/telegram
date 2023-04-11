<?php

namespace Yabx\Telegram\Objects;

class ChatPermissions {

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

    protected array $rawData;

    public function __construct(array $data) {
        $this->rawData = $data;
        if (isset($data['can_send_messages'])) {
            $this->canSendMessages = $data['can_send_messages'];
        }
        if (isset($data['can_send_audios'])) {
            $this->canSendAudios = $data['can_send_audios'];
        }
        if (isset($data['can_send_documents'])) {
            $this->canSendDocuments = $data['can_send_documents'];
        }
        if (isset($data['can_send_photos'])) {
            $this->canSendPhotos = $data['can_send_photos'];
        }
        if (isset($data['can_send_videos'])) {
            $this->canSendVideos = $data['can_send_videos'];
        }
        if (isset($data['can_send_video_notes'])) {
            $this->canSendVideoNotes = $data['can_send_video_notes'];
        }
        if (isset($data['can_send_voice_notes'])) {
            $this->canSendVoiceNotes = $data['can_send_voice_notes'];
        }
        if (isset($data['can_send_polls'])) {
            $this->canSendPolls = $data['can_send_polls'];
        }
        if (isset($data['can_send_other_messages'])) {
            $this->canSendOtherMessages = $data['can_send_other_messages'];
        }
        if (isset($data['can_add_web_page_previews'])) {
            $this->canAddWebPagePreviews = $data['can_add_web_page_previews'];
        }
        if (isset($data['can_change_info'])) {
            $this->canChangeInfo = $data['can_change_info'];
        }
        if (isset($data['can_invite_users'])) {
            $this->canInviteUsers = $data['can_invite_users'];
        }
        if (isset($data['can_pin_messages'])) {
            $this->canPinMessages = $data['can_pin_messages'];
        }
        if (isset($data['can_manage_topics'])) {
            $this->canManageTopics = $data['can_manage_topics'];
        }
    }

    public function getCanSendMessages(): ?bool {
        return $this->canSendMessages;
    }

    public function getCanSendAudios(): ?bool {
        return $this->canSendAudios;
    }

    public function getCanSendDocuments(): ?bool {
        return $this->canSendDocuments;
    }

    public function getCanSendPhotos(): ?bool {
        return $this->canSendPhotos;
    }

    public function getCanSendVideos(): ?bool {
        return $this->canSendVideos;
    }

    public function getCanSendVideoNotes(): ?bool {
        return $this->canSendVideoNotes;
    }

    public function getCanSendVoiceNotes(): ?bool {
        return $this->canSendVoiceNotes;
    }

    public function getCanSendPolls(): ?bool {
        return $this->canSendPolls;
    }

    public function getCanSendOtherMessages(): ?bool {
        return $this->canSendOtherMessages;
    }

    public function getCanAddWebPagePreviews(): ?bool {
        return $this->canAddWebPagePreviews;
    }

    public function getCanChangeInfo(): ?bool {
        return $this->canChangeInfo;
    }

    public function getCanInviteUsers(): ?bool {
        return $this->canInviteUsers;
    }

    public function getCanPinMessages(): ?bool {
        return $this->canPinMessages;
    }

    public function getCanManageTopics(): ?bool {
        return $this->canManageTopics;
    }

    public function getRawData(): array {
        return $this->rawData;
    }

}
