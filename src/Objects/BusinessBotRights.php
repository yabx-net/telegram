<?php

namespace Yabx\Telegram\Objects;

/**
 * Represents the rights of a business bot.
 * @link https://core.telegram.org/bots/api#businessbotrights
 */
final class BusinessBotRights extends AbstractObject {

    /**
     * Can Reply
     *
     * Optional. True, if the bot can send and edit messages in the private chats that had incoming messages in the last 24 hours
     * @var bool|null
     */
    protected ?bool $canReply = null;

    /**
     * Can Read Messages
     *
     * Optional. True, if the bot can mark incoming private messages as read
     * @var bool|null
     */
    protected ?bool $canReadMessages = null;

    /**
     * Can Delete Sent Messages
     *
     * Optional. True, if the bot can delete messages sent by the bot
     * @var bool|null
     */
    protected ?bool $canDeleteSentMessages = null;

    /**
     * Can Delete All Messages
     *
     * Optional. True, if the bot can delete all private messages in managed chats
     * @var bool|null
     */
    protected ?bool $canDeleteAllMessages = null;

    /**
     * Can Edit Name
     *
     * Optional. True, if the bot can edit the first and last name of the business account
     * @var bool|null
     */
    protected ?bool $canEditName = null;

    /**
     * Can Edit Bio
     *
     * Optional. True, if the bot can edit the bio of the business account
     * @var bool|null
     */
    protected ?bool $canEditBio = null;

    /**
     * Can Edit Profile Photo
     *
     * Optional. True, if the bot can edit the profile photo of the business account
     * @var bool|null
     */
    protected ?bool $canEditProfilePhoto = null;

    /**
     * Can Edit Username
     *
     * Optional. True, if the bot can edit the username of the business account
     * @var bool|null
     */
    protected ?bool $canEditUsername = null;

    /**
     * Can Change Gift Settings
     *
     * Optional. True, if the bot can change the privacy settings pertaining to gifts for the business account
     * @var bool|null
     */
    protected ?bool $canChangeGiftSettings = null;

    /**
     * Can View Gifts And Stars
     *
     * Optional. True, if the bot can view gifts and the amount of Telegram Stars owned by the business account
     * @var bool|null
     */
    protected ?bool $canViewGiftsAndStars = null;

    /**
     * Can Convert Gifts To Stars
     *
     * Optional. True, if the bot can convert regular gifts owned by the business account to Telegram Stars
     * @var bool|null
     */
    protected ?bool $canConvertGiftsToStars = null;

    /**
     * Can Transfer And Upgrade Gifts
     *
     * Optional. True, if the bot can transfer and upgrade gifts owned by the business account
     * @var bool|null
     */
    protected ?bool $canTransferAndUpgradeGifts = null;

    /**
     * Can Transfer Stars
     *
     * Optional. True, if the bot can transfer Telegram Stars received by the business account to its own account, or use them to upgrade and transfer gifts
     * @var bool|null
     */
    protected ?bool $canTransferStars = null;

    /**
     * Can Manage Stories
     *
     * Optional. True, if the bot can post, edit and delete stories on behalf of the business account
     * @var bool|null
     */
    protected ?bool $canManageStories = null;

    public static function fromArray(array $data): BusinessBotRights {
        $instance = new self();
        if (isset($data['can_reply'])) {
            $instance->canReply = $data['can_reply'];
        }
        if (isset($data['can_read_messages'])) {
            $instance->canReadMessages = $data['can_read_messages'];
        }
        if (isset($data['can_delete_sent_messages'])) {
            $instance->canDeleteSentMessages = $data['can_delete_sent_messages'];
        }
        if (isset($data['can_delete_all_messages'])) {
            $instance->canDeleteAllMessages = $data['can_delete_all_messages'];
        }
        if (isset($data['can_edit_name'])) {
            $instance->canEditName = $data['can_edit_name'];
        }
        if (isset($data['can_edit_bio'])) {
            $instance->canEditBio = $data['can_edit_bio'];
        }
        if (isset($data['can_edit_profile_photo'])) {
            $instance->canEditProfilePhoto = $data['can_edit_profile_photo'];
        }
        if (isset($data['can_edit_username'])) {
            $instance->canEditUsername = $data['can_edit_username'];
        }
        if (isset($data['can_change_gift_settings'])) {
            $instance->canChangeGiftSettings = $data['can_change_gift_settings'];
        }
        if (isset($data['can_view_gifts_and_stars'])) {
            $instance->canViewGiftsAndStars = $data['can_view_gifts_and_stars'];
        }
        if (isset($data['can_convert_gifts_to_stars'])) {
            $instance->canConvertGiftsToStars = $data['can_convert_gifts_to_stars'];
        }
        if (isset($data['can_transfer_and_upgrade_gifts'])) {
            $instance->canTransferAndUpgradeGifts = $data['can_transfer_and_upgrade_gifts'];
        }
        if (isset($data['can_transfer_stars'])) {
            $instance->canTransferStars = $data['can_transfer_stars'];
        }
        if (isset($data['can_manage_stories'])) {
            $instance->canManageStories = $data['can_manage_stories'];
        }
        return $instance;
    }

    public function __construct(
        ?bool $canReply = null,
        ?bool $canReadMessages = null,
        ?bool $canDeleteSentMessages = null,
        ?bool $canDeleteAllMessages = null,
        ?bool $canEditName = null,
        ?bool $canEditBio = null,
        ?bool $canEditProfilePhoto = null,
        ?bool $canEditUsername = null,
        ?bool $canChangeGiftSettings = null,
        ?bool $canViewGiftsAndStars = null,
        ?bool $canConvertGiftsToStars = null,
        ?bool $canTransferAndUpgradeGifts = null,
        ?bool $canTransferStars = null,
        ?bool $canManageStories = null,
    ) {
        $this->canReply = $canReply;
        $this->canReadMessages = $canReadMessages;
        $this->canDeleteSentMessages = $canDeleteSentMessages;
        $this->canDeleteAllMessages = $canDeleteAllMessages;
        $this->canEditName = $canEditName;
        $this->canEditBio = $canEditBio;
        $this->canEditProfilePhoto = $canEditProfilePhoto;
        $this->canEditUsername = $canEditUsername;
        $this->canChangeGiftSettings = $canChangeGiftSettings;
        $this->canViewGiftsAndStars = $canViewGiftsAndStars;
        $this->canConvertGiftsToStars = $canConvertGiftsToStars;
        $this->canTransferAndUpgradeGifts = $canTransferAndUpgradeGifts;
        $this->canTransferStars = $canTransferStars;
        $this->canManageStories = $canManageStories;
    }

    public function getCanReply(): ?bool {
        return $this->canReply;
    }

    public function setCanReply(?bool $value): self {
        $this->canReply = $value;
        return $this;
    }

    public function getCanReadMessages(): ?bool {
        return $this->canReadMessages;
    }

    public function setCanReadMessages(?bool $value): self {
        $this->canReadMessages = $value;
        return $this;
    }

    public function getCanDeleteSentMessages(): ?bool {
        return $this->canDeleteSentMessages;
    }

    public function setCanDeleteSentMessages(?bool $value): self {
        $this->canDeleteSentMessages = $value;
        return $this;
    }

    public function getCanDeleteAllMessages(): ?bool {
        return $this->canDeleteAllMessages;
    }

    public function setCanDeleteAllMessages(?bool $value): self {
        $this->canDeleteAllMessages = $value;
        return $this;
    }

    public function getCanEditName(): ?bool {
        return $this->canEditName;
    }

    public function setCanEditName(?bool $value): self {
        $this->canEditName = $value;
        return $this;
    }

    public function getCanEditBio(): ?bool {
        return $this->canEditBio;
    }

    public function setCanEditBio(?bool $value): self {
        $this->canEditBio = $value;
        return $this;
    }

    public function getCanEditProfilePhoto(): ?bool {
        return $this->canEditProfilePhoto;
    }

    public function setCanEditProfilePhoto(?bool $value): self {
        $this->canEditProfilePhoto = $value;
        return $this;
    }

    public function getCanEditUsername(): ?bool {
        return $this->canEditUsername;
    }

    public function setCanEditUsername(?bool $value): self {
        $this->canEditUsername = $value;
        return $this;
    }

    public function getCanChangeGiftSettings(): ?bool {
        return $this->canChangeGiftSettings;
    }

    public function setCanChangeGiftSettings(?bool $value): self {
        $this->canChangeGiftSettings = $value;
        return $this;
    }

    public function getCanViewGiftsAndStars(): ?bool {
        return $this->canViewGiftsAndStars;
    }

    public function setCanViewGiftsAndStars(?bool $value): self {
        $this->canViewGiftsAndStars = $value;
        return $this;
    }

    public function getCanConvertGiftsToStars(): ?bool {
        return $this->canConvertGiftsToStars;
    }

    public function setCanConvertGiftsToStars(?bool $value): self {
        $this->canConvertGiftsToStars = $value;
        return $this;
    }

    public function getCanTransferAndUpgradeGifts(): ?bool {
        return $this->canTransferAndUpgradeGifts;
    }

    public function setCanTransferAndUpgradeGifts(?bool $value): self {
        $this->canTransferAndUpgradeGifts = $value;
        return $this;
    }

    public function getCanTransferStars(): ?bool {
        return $this->canTransferStars;
    }

    public function setCanTransferStars(?bool $value): self {
        $this->canTransferStars = $value;
        return $this;
    }

    public function getCanManageStories(): ?bool {
        return $this->canManageStories;
    }

    public function setCanManageStories(?bool $value): self {
        $this->canManageStories = $value;
        return $this;
    }

}
