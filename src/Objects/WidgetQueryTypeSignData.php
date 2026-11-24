<?php

namespace Yabx\Telegram\Objects;

/**
 * The query contains data signed by a TON wallet of the user who sent the query. The data is signed for the domain bot<bot_id>, where <bot_id> is the identifier of the bot.
 * @link https://core.telegram.org/bots/api#widgetquerytypesigndata
 */
final class WidgetQueryTypeSignData extends WidgetQueryType {

    /**
     * Type
     *
     * Type of the object, always "sign_data"
     * @var string
     */
    protected string $type = 'sign_data';

    /**
     * Wallet
     *
     * The wallet that signed the data
     * @var WidgetQueryWallet|null
     */
    protected ?WidgetQueryWallet $wallet = null;

    /**
     * Sign Data
     *
     * JSON-serialized signed data
     * @var string|null
     */
    protected ?string $signData = null;

    public function __construct(
        ?WidgetQueryWallet $wallet = null,
        ?string $signData = null
    ) {
        $this->wallet = $wallet;
        $this->signData = $signData;
    }

    public static function fromArray(array $data): WidgetQueryTypeSignData {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['wallet'])) {
            $instance->wallet = WidgetQueryWallet::fromArray($data['wallet']);
        }
        if (isset($data['sign_data'])) {
            $instance->signData = $data['sign_data'];
        }
        return $instance;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getWallet(): ?WidgetQueryWallet {
        return $this->wallet;
    }

    public function setWallet(?WidgetQueryWallet $value): self {
        $this->wallet = $value;
        return $this;
    }

    public function getSignData(): ?string {
        return $this->signData;
    }

    public function setSignData(?string $value): self {
        $this->signData = $value;
        return $this;
    }
}
