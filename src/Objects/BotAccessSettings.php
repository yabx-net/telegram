<?php

namespace Yabx\Telegram\Objects;

/**
 * This object describes the access settings of a bot.
 * @link https://core.telegram.org/bots/api#botaccesssettings
 */
final class BotAccessSettings extends AbstractObject {

    /**
     * Is Access Restricted
     *
     * True, if the bot can be used only by administrators and explicitly added users.
     * @var bool|null
     */
    protected ?bool $isAccessRestricted = null;

    /**
     * Added Users
     *
     * Optional. Information about users who were explicitly added to the list of users allowed to use the bot.
     * @var User[]|null
     */
    protected ?array $addedUsers = null;

    public static function fromArray(array $data): BotAccessSettings {
        $instance = new self();
        if (isset($data['is_access_restricted'])) {
            $instance->isAccessRestricted = $data['is_access_restricted'];
        }
        if (isset($data['added_users'])) {
            $instance->addedUsers = [];
            foreach ($data['added_users'] as $item) {
                $instance->addedUsers[] = User::fromArray($item);
            }
        }
        return $instance;
    }

    public function __construct(
        ?bool $isAccessRestricted = null,
        ?array $addedUsers = null,
    ) {
        $this->isAccessRestricted = $isAccessRestricted;
        $this->addedUsers = $addedUsers;
    }

    public function getIsAccessRestricted(): ?bool {
        return $this->isAccessRestricted;
    }

    public function setIsAccessRestricted(?bool $value): self {
        $this->isAccessRestricted = $value;
        return $this;
    }

    public function getAddedUsers(): ?array {
        return $this->addedUsers;
    }

    public function setAddedUsers(?array $value): self {
        $this->addedUsers = $value;
        return $this;
    }

}
