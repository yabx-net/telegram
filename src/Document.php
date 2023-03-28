<?php

namespace Yabx\Telegram;

class Document extends File {

    private string $fileName;
    private string $mimeType;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->fileName = $data['file_name'];
        $this->mimeType = $data['mime_type'];
    }

    public function getFileName(): string {
        return $this->fileName;
    }

    public function getMimeType(): string {
        return $this->mimeType;
    }

}
