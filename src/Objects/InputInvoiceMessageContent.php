<?php

namespace Yabx\Telegram\Objects;

final class InputInvoiceMessageContent extends AbstractObject {

    /**
     * Title
     *
     * Product name, 1-32 characters
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Description
     *
     * Product description, 1-255 characters
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Payload
     *
     * Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use it for your internal processes.
     * @var string|null
     */
    protected ?string $payload = null;

    /**
     * Provider Token
     *
     * Optional. Payment provider token, obtained via @BotFather. Pass an empty string for payments in Telegram Stars.
     * @var string|null
     */
    protected ?string $providerToken = null;

    /**
     * Currency
     *
     * Three-letter ISO 4217 currency code, see more on currencies. Pass “XTR” for payments in Telegram Stars.
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * Prices
     *
     * Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.). Must contain exactly one item for payments in Telegram Stars.
     * @var LabeledPrice[]|null
     */
    protected ?array $prices = null;

    /**
     * Max Tip Amount
     *
     * Optional. The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0. Not supported for payments in Telegram Stars.
     * @var int|null
     */
    protected ?int $maxTipAmount = null;

    /**
     * Suggested Tip Amounts
     *
     * Optional. A JSON-serialized array of suggested amounts of tip in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
     * @var int[]|null
     */
    protected ?array $suggestedTipAmounts = null;

    /**
     * Provider Data
     *
     * Optional. A JSON-serialized object for data about the invoice, which will be shared with the payment provider. A detailed description of the required fields should be provided by the payment provider.
     * @var string|null
     */
    protected ?string $providerData = null;

    /**
     * Photo Url
     *
     * Optional. URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service.
     * @var string|null
     */
    protected ?string $photoUrl = null;

    /**
     * Photo Size
     *
     * Optional. Photo size in bytes
     * @var int|null
     */
    protected ?int $photoSize = null;

    /**
     * Photo Width
     *
     * Optional. Photo width
     * @var int|null
     */
    protected ?int $photoWidth = null;

    /**
     * Photo Height
     *
     * Optional. Photo height
     * @var int|null
     */
    protected ?int $photoHeight = null;

    /**
     * Need Name
     *
     * Optional. Pass True if you require the user's full name to complete the order. Ignored for payments in Telegram Stars.
     * @var bool|null
     */
    protected ?bool $needName = null;

    /**
     * Need Phone Number
     *
     * Optional. Pass True if you require the user's phone number to complete the order. Ignored for payments in Telegram Stars.
     * @var bool|null
     */
    protected ?bool $needPhoneNumber = null;

    /**
     * Need Email
     *
     * Optional. Pass True if you require the user's email address to complete the order. Ignored for payments in Telegram Stars.
     * @var bool|null
     */
    protected ?bool $needEmail = null;

    /**
     * Need Shipping Address
     *
     * Optional. Pass True if you require the user's shipping address to complete the order. Ignored for payments in Telegram Stars.
     * @var bool|null
     */
    protected ?bool $needShippingAddress = null;

    /**
     * Send Phone Number To Provider
     *
     * Optional. Pass True if the user's phone number should be sent to the provider. Ignored for payments in Telegram Stars.
     * @var bool|null
     */
    protected ?bool $sendPhoneNumberToProvider = null;

    /**
     * Send Email To Provider
     *
     * Optional. Pass True if the user's email address should be sent to the provider. Ignored for payments in Telegram Stars.
     * @var bool|null
     */
    protected ?bool $sendEmailToProvider = null;

    /**
     * Is Flexible
     *
     * Optional. Pass True if the final price depends on the shipping method. Ignored for payments in Telegram Stars.
     * @var bool|null
     */
    protected ?bool $isFlexible = null;

    public function __construct(
        ?string $title = null,
        ?string $description = null,
        ?string $payload = null,
        ?string $providerToken = null,
        ?string $currency = null,
        ?array  $prices = null,
        ?int    $maxTipAmount = null,
        ?array  $suggestedTipAmounts = null,
        ?string $providerData = null,
        ?string $photoUrl = null,
        ?int    $photoSize = null,
        ?int    $photoWidth = null,
        ?int    $photoHeight = null,
        ?bool   $needName = null,
        ?bool   $needPhoneNumber = null,
        ?bool   $needEmail = null,
        ?bool   $needShippingAddress = null,
        ?bool   $sendPhoneNumberToProvider = null,
        ?bool   $sendEmailToProvider = null,
        ?bool   $isFlexible = null,
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->payload = $payload;
        $this->providerToken = $providerToken;
        $this->currency = $currency;
        $this->prices = $prices;
        $this->maxTipAmount = $maxTipAmount;
        $this->suggestedTipAmounts = $suggestedTipAmounts;
        $this->providerData = $providerData;
        $this->photoUrl = $photoUrl;
        $this->photoSize = $photoSize;
        $this->photoWidth = $photoWidth;
        $this->photoHeight = $photoHeight;
        $this->needName = $needName;
        $this->needPhoneNumber = $needPhoneNumber;
        $this->needEmail = $needEmail;
        $this->needShippingAddress = $needShippingAddress;
        $this->sendPhoneNumberToProvider = $sendPhoneNumberToProvider;
        $this->sendEmailToProvider = $sendEmailToProvider;
        $this->isFlexible = $isFlexible;
    }

    public static function fromArray(array $data): InputInvoiceMessageContent {
        $instance = new self();
        if (isset($data['title'])) {
            $instance->title = $data['title'];
        }
        if (isset($data['description'])) {
            $instance->description = $data['description'];
        }
        if (isset($data['payload'])) {
            $instance->payload = $data['payload'];
        }
        if (isset($data['provider_token'])) {
            $instance->providerToken = $data['provider_token'];
        }
        if (isset($data['currency'])) {
            $instance->currency = $data['currency'];
        }
        if (isset($data['prices'])) {
            $instance->prices = [];
            foreach ($data['prices'] as $item) {
                $instance->prices[] = LabeledPrice::fromArray($item);
            }
        }
        if (isset($data['max_tip_amount'])) {
            $instance->maxTipAmount = $data['max_tip_amount'];
        }
        if (isset($data['suggested_tip_amounts'])) {
            $instance->suggestedTipAmounts = [];
            foreach ($data['suggested_tip_amounts'] as $item) {
                $instance->suggestedTipAmounts[] = $item;
            }
        }
        if (isset($data['provider_data'])) {
            $instance->providerData = $data['provider_data'];
        }
        if (isset($data['photo_url'])) {
            $instance->photoUrl = $data['photo_url'];
        }
        if (isset($data['photo_size'])) {
            $instance->photoSize = $data['photo_size'];
        }
        if (isset($data['photo_width'])) {
            $instance->photoWidth = $data['photo_width'];
        }
        if (isset($data['photo_height'])) {
            $instance->photoHeight = $data['photo_height'];
        }
        if (isset($data['need_name'])) {
            $instance->needName = $data['need_name'];
        }
        if (isset($data['need_phone_number'])) {
            $instance->needPhoneNumber = $data['need_phone_number'];
        }
        if (isset($data['need_email'])) {
            $instance->needEmail = $data['need_email'];
        }
        if (isset($data['need_shipping_address'])) {
            $instance->needShippingAddress = $data['need_shipping_address'];
        }
        if (isset($data['send_phone_number_to_provider'])) {
            $instance->sendPhoneNumberToProvider = $data['send_phone_number_to_provider'];
        }
        if (isset($data['send_email_to_provider'])) {
            $instance->sendEmailToProvider = $data['send_email_to_provider'];
        }
        if (isset($data['is_flexible'])) {
            $instance->isFlexible = $data['is_flexible'];
        }
        return $instance;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $value): self {
        $this->title = $value;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $value): self {
        $this->description = $value;
        return $this;
    }

    public function getPayload(): ?string {
        return $this->payload;
    }

    public function setPayload(?string $value): self {
        $this->payload = $value;
        return $this;
    }

    public function getProviderToken(): ?string {
        return $this->providerToken;
    }

    public function setProviderToken(?string $value): self {
        $this->providerToken = $value;
        return $this;
    }

    public function getCurrency(): ?string {
        return $this->currency;
    }

    public function setCurrency(?string $value): self {
        $this->currency = $value;
        return $this;
    }

    public function getPrices(): ?array {
        return $this->prices;
    }

    public function setPrices(?array $value): self {
        $this->prices = $value;
        return $this;
    }

    public function getMaxTipAmount(): ?int {
        return $this->maxTipAmount;
    }

    public function setMaxTipAmount(?int $value): self {
        $this->maxTipAmount = $value;
        return $this;
    }

    public function getSuggestedTipAmounts(): ?array {
        return $this->suggestedTipAmounts;
    }

    public function setSuggestedTipAmounts(?array $value): self {
        $this->suggestedTipAmounts = $value;
        return $this;
    }

    public function getProviderData(): ?string {
        return $this->providerData;
    }

    public function setProviderData(?string $value): self {
        $this->providerData = $value;
        return $this;
    }

    public function getPhotoUrl(): ?string {
        return $this->photoUrl;
    }

    public function setPhotoUrl(?string $value): self {
        $this->photoUrl = $value;
        return $this;
    }

    public function getPhotoSize(): ?int {
        return $this->photoSize;
    }

    public function setPhotoSize(?int $value): self {
        $this->photoSize = $value;
        return $this;
    }

    public function getPhotoWidth(): ?int {
        return $this->photoWidth;
    }

    public function setPhotoWidth(?int $value): self {
        $this->photoWidth = $value;
        return $this;
    }

    public function getPhotoHeight(): ?int {
        return $this->photoHeight;
    }

    public function setPhotoHeight(?int $value): self {
        $this->photoHeight = $value;
        return $this;
    }

    public function getNeedName(): ?bool {
        return $this->needName;
    }

    public function setNeedName(?bool $value): self {
        $this->needName = $value;
        return $this;
    }

    public function getNeedPhoneNumber(): ?bool {
        return $this->needPhoneNumber;
    }

    public function setNeedPhoneNumber(?bool $value): self {
        $this->needPhoneNumber = $value;
        return $this;
    }

    public function getNeedEmail(): ?bool {
        return $this->needEmail;
    }

    public function setNeedEmail(?bool $value): self {
        $this->needEmail = $value;
        return $this;
    }

    public function getNeedShippingAddress(): ?bool {
        return $this->needShippingAddress;
    }

    public function setNeedShippingAddress(?bool $value): self {
        $this->needShippingAddress = $value;
        return $this;
    }

    public function getSendPhoneNumberToProvider(): ?bool {
        return $this->sendPhoneNumberToProvider;
    }

    public function setSendPhoneNumberToProvider(?bool $value): self {
        $this->sendPhoneNumberToProvider = $value;
        return $this;
    }

    public function getSendEmailToProvider(): ?bool {
        return $this->sendEmailToProvider;
    }

    public function setSendEmailToProvider(?bool $value): self {
        $this->sendEmailToProvider = $value;
        return $this;
    }

    public function getIsFlexible(): ?bool {
        return $this->isFlexible;
    }

    public function setIsFlexible(?bool $value): self {
        $this->isFlexible = $value;
        return $this;
    }

}
