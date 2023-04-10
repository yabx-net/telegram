<?php

namespace Yabx\Telegram\Objects;

class ChatMemberRestricted {

    /**
     * Status
     *
     * The member's status in the chat, always “restricted”
     * @var string
     */
    protected string $status;

    /**
     * User
     *
     * Information about the user
     * @var User
     */
    protected User $user;

    /**
     * Is Member
     *
     * True, if the user is a member of the chat at the moment of the request
     * @var bool
     */
    protected bool $isMember;

    /**
     * Can Send Messages
     *
     * True, if the user is allowed to send text messages, contacts, invoices, locations and venues
     * @var bool
     */
    protected bool $canSendMessages;

    /**
     * Can Send Audios
     *
     * True, if the user is allowed to send audios
     * @var bool
     */
    protected bool $canSendAudios;

    /**
     * Can Send Documents
     *
     * True, if the user is allowed to send documents
     * @var bool
     */
    protected bool $canSendDocuments;

    /**
     * Can Send Photos
     *
     * True, if the user is allowed to send photos
     * @var bool
     */
    protected bool $canSendPhotos;

    /**
     * Can Send Videos
     *
     * True, if the user is allowed to send videos
     * @var bool
     */
    protected bool $canSendVideos;

    /**
     * Can Send Video Notes
     *
     * True, if the user is allowed to send video notes
     * @var bool
     */
    protected bool $canSendVideoNotes;

    /**
     * Can Send Voice Notes
     *
     * True, if the user is allowed to send voice notes
     * @var bool
     */
    protected bool $canSendVoiceNotes;

    /**
     * Can Send Polls
     *
     * True, if the user is allowed to send polls
     * @var bool
     */
    protected bool $canSendPolls;

    /**
     * Can Send Other Messages
     *
     * True, if the user is allowed to send animations, games, stickers and use inline bots
     * @var bool
     */
    protected bool $canSendOtherMessages;

    /**
     * Can Add Web Page Previews
     *
     * True, if the user is allowed to add web page previews to their messages
     * @var bool
     */
    protected bool $canAddWebPagePreviews;

    /**
     * Can Change Info
     *
     * True, if the user is allowed to change the chat title, photo and other settings
     * @var bool
     */
    protected bool $canChangeInfo;

    /**
     * Can Invite Users
     *
     * True, if the user is allowed to invite new users to the chat
     * @var bool
     */
    protected bool $canInviteUsers;

    /**
     * Can Pin Messages
     *
     * True, if the user is allowed to pin messages
     * @var bool
     */
    protected bool $canPinMessages;

    /**
     * Can Manage Topics
     *
     * True, if the user is allowed to create forum topics
     * @var bool
     */
    protected bool $canManageTopics;

    /**
     * Until Date
     *
     * Date when restrictions will be lifted for this user; unix time. If 0, then the user is restricted forever
     * @var int
     */
    protected int $untilDate;


    public function __construct(array $data) {
        if (isset($data['status'])) {
            $this->status = $data['status'];
        }
        if (isset($data['user'])) {
            $this->user = new User($data['user']);
        }
        if (isset($data['is_member'])) {
            $this->isMember = $data['is_member'];
        }
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
        if (isset($data['until_date'])) {
            $this->untilDate = $data['until_date'];
        }
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getIsMember(): bool {
        return $this->isMember;
    }

    public function getCanSendMessages(): bool {
        return $this->canSendMessages;
    }

    public function getCanSendAudios(): bool {
        return $this->canSendAudios;
    }

    public function getCanSendDocuments(): bool {
        return $this->canSendDocuments;
    }

    public function getCanSendPhotos(): bool {
        return $this->canSendPhotos;
    }

    public function getCanSendVideos(): bool {
        return $this->canSendVideos;
    }

    public function getCanSendVideoNotes(): bool {
        return $this->canSendVideoNotes;
    }

    public function getCanSendVoiceNotes(): bool {
        return $this->canSendVoiceNotes;
    }

    public function getCanSendPolls(): bool {
        return $this->canSendPolls;
    }

    public function getCanSendOtherMessages(): bool {
        return $this->canSendOtherMessages;
    }

    public function getCanAddWebPagePreviews(): bool {
        return $this->canAddWebPagePreviews;
    }

    public function getCanChangeInfo(): bool {
        return $this->canChangeInfo;
    }

    public function getCanInviteUsers(): bool {
        return $this->canInviteUsers;
    }

    public function getCanPinMessages(): bool {
        return $this->canPinMessages;
    }

    public function getCanManageTopics(): bool {
        return $this->canManageTopics;
    }

    public function getUntilDate(): int {
        return $this->untilDate;
    }


}
