<?php

namespace Yabx\Telegram\Objects;

final class TransactionPartnerTelegramAds extends TransactionPartner {

    /**
     * Type
     *
     * Type of the transaction partner, always “telegram_ads”
     * @var string|null
     */
    protected ?string $type = null;

    public static function fromArray(array $data): TransactionPartnerTelegramAds {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
    ) {
        $this->type = $type;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

}
