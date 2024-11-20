<?php

namespace Yabx\Telegram\Objects;

final class TransactionPartnerTelegramApi extends AbstractObject {

	/**
	 * Type
	 *
	 * Type of the transaction partner, always “telegram_api”
	 * @var string
	 */
	protected string $type = 'telegram_api';

	/**
	 * Request Count
	 *
	 * The number of successful requests that exceeded regular limits and were therefore billed
	 * @var int|null
	 */
	protected ?int $requestCount = null;

	public static function fromArray(array $data): TransactionPartnerTelegramApi {
		$instance = new self();
		if(isset($data['type'])) {
		    $instance->type = $data['type'];
		}
		if(isset($data['request_count'])) {
		    $instance->requestCount = $data['request_count'];
		}
		return $instance;
	}

	public function __construct(
		?int $requestCount = null,
	) {
		$this->requestCount = $requestCount;
	}

	public function getType(): string {
		return $this->type;
	}

	public function getRequestCount(): ?int {
		return $this->requestCount;
	}

	public function setRequestCount(?int $value): self {
		$this->requestCount = $value;
		return $this;
	}

}
