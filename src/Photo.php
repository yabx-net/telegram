<?php

namespace Yabx\Telegram;

class Photo extends File {

    protected int $width;
    protected int $height;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->width = $data['width'];
        $this->height = $data['height'];
    }

}
