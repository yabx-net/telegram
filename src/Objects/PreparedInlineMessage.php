<?php

namespace Yabx\Telegram\Objects;

final class PreparedInlineMessage extends AbstractObject {

	/**
	 * Id
	 *
	 * Unique identifier of the prepared message
	 * @var string|null
	 */
	protected ?string $id = null;

	/**
	 * Expiration Date
	 *
	 * Expiration date of the prepared message, in Unix time. Expired prepared messages can no longer be used
	 * @var int|null
	 */
	protected ?int $expirationDate = null;

	public static function fromArray(array $data): PreparedInlineMessage {
		$instance = new self();
		if(isset($data['id'])) {
		    $instance->id = $data['id'];
		}
		if(isset($data['expiration_date'])) {
		    $instance->expirationDate = $data['expiration_date'];
		}
		return $instance;
	}

	public function __construct(
		?string $id = null,
		?int $expirationDate = null,
	) {
		$this->id = $id;
		$this->expirationDate = $expirationDate;
	}

	public function getId(): ?string {
		return $this->id;
	}

	public function setId(?string $value): self {
		$this->id = $value;
		return $this;
	}

	public function getExpirationDate(): ?int {
		return $this->expirationDate;
	}

	public function setExpirationDate(?int $value): self {
		$this->expirationDate = $value;
		return $this;
	}

}
