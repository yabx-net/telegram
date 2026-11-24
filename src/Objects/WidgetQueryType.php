<?php

namespace Yabx\Telegram\Objects;

use InvalidArgumentException;

/**
 * This object describes the type of a query from a widget.
 * @link https://core.telegram.org/bots/api#widgetquerytype
 */
abstract class WidgetQueryType extends AbstractObject {

    public static function fromArray(array $data): WidgetQueryType {
        return match ($data['type'] ?? null) {
            'data' => WidgetQueryTypeData::fromArray($data),
            'sign_data' => WidgetQueryTypeSignData::fromArray($data),
            'sent_transaction' => WidgetQueryTypeSentTransaction::fromArray($data),
            default => throw new InvalidArgumentException('Invalid WidgetQueryType'),
        };
    }

}
