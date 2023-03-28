<?php

namespace Yabx\Telegram;

use DateTimeImmutable;
use Exception;

class EditedMessage extends Message {

    protected DateTimeImmutable $editDate;

    /**
     * @throws Exception
     */
    public function __construct(array $data) {
        parent::__construct($data);
        $this->editDate = new DateTimeImmutable(date('c', $data['edit_date']));
    }

    public function getEditDate(): DateTimeImmutable {
        return $this->editDate;
    }

}
