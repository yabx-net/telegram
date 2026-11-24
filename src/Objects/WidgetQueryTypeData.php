<?php

namespace Yabx\Telegram\Objects;

/**
 * The query contains data for the bot.
 * @link https://core.telegram.org/bots/api#widgetquerytypedata
 */
final class WidgetQueryTypeData extends WidgetQueryType {

    /**
     * Type
     *
     * Type of the object, always "data"
     * @var string
     */
    protected string $type = 'data';

    /**
     * Wallet Card
     *
     * Optional. TON wallet card of the user who sent the query, if it was sent to the bot along with the query
     * @var TonWalletCard|null
     */
    protected ?TonWalletCard $walletCard = null;

    public function __construct(
        ?TonWalletCard $walletCard = null
    ) {
        $this->walletCard = $walletCard;
    }

    public static function fromArray(array $data): WidgetQueryTypeData {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['wallet_card'])) {
            $instance->walletCard = TonWalletCard::fromArray($data['wallet_card']);
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getWalletCard(): ?TonWalletCard {
        return $this->walletCard;
    }

    public function setWalletCard(?TonWalletCard $value): self {
        $this->walletCard = $value;
        return $this;
    }
}
