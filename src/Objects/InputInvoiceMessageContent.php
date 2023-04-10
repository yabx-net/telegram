<?php

namespace Yabx\Telegram\Objects;

class InputInvoiceMessageContent {

    /**
     * Title
     *
     * Product name, 1-32 characters
     * @var string
     */
    protected string $title;

    /**
     * Description
     *
     * Product description, 1-255 characters
     * @var string
     */
    protected string $description;

    /**
     * Payload
     *
     * Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
     * @var string
     */
    protected string $payload;

    /**
     * Provider Token
     *
     * Payment provider token, obtained via @BotFather
     * @var string
     */
    protected string $providerToken;

    /**
     * Currency
     *
     * Three-letter ISO 4217 currency code, see more on currencies
     * @var string
     */
    protected string $currency;

    /**
     * Prices
     *
     * Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @var LabeledPrice[]
     */
    protected array $prices;

    /**
     * Max Tip Amount
     *
     * Optional. The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
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
     * Optional. Pass True if you require the user's full name to complete the order
     * @var bool|null
     */
    protected ?bool $needName = null;

    /**
     * Need Phone Number
     *
     * Optional. Pass True if you require the user's phone number to complete the order
     * @var bool|null
     */
    protected ?bool $needPhoneNumber = null;

    /**
     * Need Email
     *
     * Optional. Pass True if you require the user's email address to complete the order
     * @var bool|null
     */
    protected ?bool $needEmail = null;

    /**
     * Need Shipping Address
     *
     * Optional. Pass True if you require the user's shipping address to complete the order
     * @var bool|null
     */
    protected ?bool $needShippingAddress = null;

    /**
     * Send Phone Number To Provider
     *
     * Optional. Pass True if the user's phone number should be sent to provider
     * @var bool|null
     */
    protected ?bool $sendPhoneNumberToProvider = null;

    /**
     * Send Email To Provider
     *
     * Optional. Pass True if the user's email address should be sent to provider
     * @var bool|null
     */
    protected ?bool $sendEmailToProvider = null;

    /**
     * Is Flexible
     *
     * Optional. Pass True if the final price depends on the shipping method
     * @var bool|null
     */
    protected ?bool $isFlexible = null;


    public function __construct(array $data) {
        if (isset($data['title'])) {
            $this->title = $data['title'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['payload'])) {
            $this->payload = $data['payload'];
        }
        if (isset($data['provider_token'])) {
            $this->providerToken = $data['provider_token'];
        }
        if (isset($data['currency'])) {
            $this->currency = $data['currency'];
        }
        if (isset($data['prices'])) {
            $this->prices = [];
            foreach ($data['prices'] as $item) {
                $this->prices[] = new LabeledPrice($item);
            }
        }
        if (isset($data['max_tip_amount'])) {
            $this->maxTipAmount = $data['max_tip_amount'];
        }
        if (isset($data['suggested_tip_amounts'])) {
            $this->suggestedTipAmounts = [];
            foreach ($data['suggested_tip_amounts'] as $item) {
                $this->suggestedTipAmounts[] = $item;
            }
        }
        if (isset($data['provider_data'])) {
            $this->providerData = $data['provider_data'];
        }
        if (isset($data['photo_url'])) {
            $this->photoUrl = $data['photo_url'];
        }
        if (isset($data['photo_size'])) {
            $this->photoSize = $data['photo_size'];
        }
        if (isset($data['photo_width'])) {
            $this->photoWidth = $data['photo_width'];
        }
        if (isset($data['photo_height'])) {
            $this->photoHeight = $data['photo_height'];
        }
        if (isset($data['need_name'])) {
            $this->needName = $data['need_name'];
        }
        if (isset($data['need_phone_number'])) {
            $this->needPhoneNumber = $data['need_phone_number'];
        }
        if (isset($data['need_email'])) {
            $this->needEmail = $data['need_email'];
        }
        if (isset($data['need_shipping_address'])) {
            $this->needShippingAddress = $data['need_shipping_address'];
        }
        if (isset($data['send_phone_number_to_provider'])) {
            $this->sendPhoneNumberToProvider = $data['send_phone_number_to_provider'];
        }
        if (isset($data['send_email_to_provider'])) {
            $this->sendEmailToProvider = $data['send_email_to_provider'];
        }
        if (isset($data['is_flexible'])) {
            $this->isFlexible = $data['is_flexible'];
        }
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPayload(): string {
        return $this->payload;
    }

    public function getProviderToken(): string {
        return $this->providerToken;
    }

    public function getCurrency(): string {
        return $this->currency;
    }

    public function getPrices(): array {
        return $this->prices;
    }

    public function getMaxTipAmount(): ?int {
        return $this->maxTipAmount;
    }

    public function getSuggestedTipAmounts(): ?array {
        return $this->suggestedTipAmounts;
    }

    public function getProviderData(): ?string {
        return $this->providerData;
    }

    public function getPhotoUrl(): ?string {
        return $this->photoUrl;
    }

    public function getPhotoSize(): ?int {
        return $this->photoSize;
    }

    public function getPhotoWidth(): ?int {
        return $this->photoWidth;
    }

    public function getPhotoHeight(): ?int {
        return $this->photoHeight;
    }

    public function getNeedName(): ?bool {
        return $this->needName;
    }

    public function getNeedPhoneNumber(): ?bool {
        return $this->needPhoneNumber;
    }

    public function getNeedEmail(): ?bool {
        return $this->needEmail;
    }

    public function getNeedShippingAddress(): ?bool {
        return $this->needShippingAddress;
    }

    public function getSendPhoneNumberToProvider(): ?bool {
        return $this->sendPhoneNumberToProvider;
    }

    public function getSendEmailToProvider(): ?bool {
        return $this->sendEmailToProvider;
    }

    public function getIsFlexible(): ?bool {
        return $this->isFlexible;
    }


}
