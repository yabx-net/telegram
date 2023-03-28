<?php

namespace Yabx\Telegram;

class Video extends Document {

    protected int $duration;
    protected int $width;
    protected int $height;
    protected Photo $thumb;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->duration = $data['duration'];
        $this->thumb = new Photo($data['thumb'] ?? $data['thumbnail']);
    }

    public function getDuration(): int {
        return $this->duration;
    }

    public function getWidth(): int {
        return $this->width;
    }

    public function getHeight(): int {
        return $this->height;
    }

    public function getThumb(): Photo {
        return $this->thumb;
    }

}
