<?php

declare(strict_types=1);

use Yabx\Telegram\Objects\Invoice;
use Yabx\Telegram\Objects\LabeledPrice;
use Yabx\Telegram\Objects\OrderInfo;
use Yabx\Telegram\Objects\RefundedPayment;
use Yabx\Telegram\Objects\ShippingOption;
use Yabx\Telegram\Objects\SuccessfulPayment;

return [
    LabeledPrice::class => [
        'label' => 'Product',
        'amount' => 1000,
    ],
    Invoice::class => [
        'title' => 'Premium',
        'description' => 'One month access',
        'start_parameter' => 'premium',
        'currency' => 'USD',
        'total_amount' => 1000,
    ],
    OrderInfo::class => [
        'name' => 'John Doe',
        'phone_number' => '+10000000000',
        'email' => 'john@example.com',
    ],
    ShippingOption::class => [
        'id' => 'standard',
        'title' => 'Standard Shipping',
        'prices' => [['label' => 'Shipping', 'amount' => 500]],
    ],
    SuccessfulPayment::class => [
        'currency' => 'USD',
        'total_amount' => 1000,
        'invoice_payload' => 'order-42',
        'telegram_payment_charge_id' => 'tg-charge-1',
        'provider_payment_charge_id' => 'provider-charge-1',
    ],
    RefundedPayment::class => [
        'currency' => 'XTR',
        'total_amount' => 100,
        'invoice_payload' => 'order-42',
        'telegram_payment_charge_id' => 'tg-charge-1',
        'provider_payment_charge_id' => 'provider-charge-1',
    ],
];
