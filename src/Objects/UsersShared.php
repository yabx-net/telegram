<?php

namespace Yabx\Telegram\Objects;

final class UsersShared extends AbstractObject {

    /**
     * Request Id
     *
     * Identifier of the request
     * @var int|null
     */
    protected ?int $requestId = null;

    /**
     * Users
     *
     * Information about users shared with the bot.
     * @var SharedUser[]|null
     */
    protected ?array $users = null;

    public function __construct(
        ?int   $requestId = null,
        ?array $users = null,
    ) {
        $this->requestId = $requestId;
        $this->users = $users;
    }

    public static function fromArray(array $data): UsersShared {
        $instance = new self();
        if (isset($data['request_id'])) {
            $instance->requestId = $data['request_id'];
        }
        if (isset($data['users'])) {
            $instance->users = [];
            foreach ($data['users'] as $item) {
                $instance->users[] = SharedUser::fromArray($item);
            }
        }
        return $instance;
    }

    public function getRequestId(): ?int {
        return $this->requestId;
    }

    public function setRequestId(?int $value): self {
        $this->requestId = $value;
        return $this;
    }

    public function getUsers(): ?array {
        return $this->users;
    }

    public function setUsers(?array $value): self {
        $this->users = $value;
        return $this;
    }

}
