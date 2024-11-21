<?php

namespace Yabx\Telegram;

use Exception as BaseException;
use Throwable;

class Exception extends BaseException {

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null) {
        $message = preg_replace('/bot[0-9]{6,}:.{35}/', '***token***', $message);
        parent::__construct($message, $code, $previous);
    }

}
