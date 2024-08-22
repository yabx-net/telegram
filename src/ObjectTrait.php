<?php

namespace Yabx\Telegram;

trait ObjectTrait {

    public static function arrayOf(array $array): array {
        return array_map(fn(mixed $item) => call_user_func([get_called_class(), 'fromArray'], $item), $array);
    }

    public function toArray(): array {
        $result = [];
        foreach (array_keys(get_object_vars($this)) as $key) {
            $value = $this->$key ?? null;
            if($value === null) {
                continue;
            } elseif(is_array($value)) {
                array_walk_recursive($value, function (&$item) {
                    if(is_object($item) && method_exists($item, 'toArray')) {
                        $item = call_user_func([$item, 'toArray']);
                    }
                });
            } elseif(is_object($value) && method_exists($value, 'toArray')) {
                $value = call_user_func([$value, 'toArray']);
            }
            $result[Utils::toSnakeCase($key)] = $value;
        }
        return $result;
    }

    public function toJson(int $flags = 0): string {
        return json_encode($this->toArray(), $flags);
    }

    public function __toString(): string {
        return $this->toJson();
    }

}
