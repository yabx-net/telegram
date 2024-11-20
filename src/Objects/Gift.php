<?php

namespace Yabx\Telegram\Objects;

final class Gift extends AbstractObject {

	/**
	 * Id
	 *
	 * Unique identifier of the gift
	 * @var string|null
	 */
	protected ?string $id = null;

	/**
	 * Sticker
	 *
	 * The sticker that represents the gift
	 * @var Sticker|null
	 */
	protected ?Sticker $sticker = null;

	/**
	 * Star Count
	 *
	 * The number of Telegram Stars that must be paid to send the sticker
	 * @var int|null
	 */
	protected ?int $starCount = null;

	/**
	 * Total Count
	 *
	 * Optional. The total number of the gifts of this type that can be sent; for limited gifts only
	 * @var int|null
	 */
	protected ?int $totalCount = null;

	/**
	 * Remaining Count
	 *
	 * Optional. The number of remaining gifts of this type that can be sent; for limited gifts only
	 * @var int|null
	 */
	protected ?int $remainingCount = null;

	public static function fromArray(array $data): Gift {
		$instance = new self();
		if(isset($data['id'])) {
		    $instance->id = $data['id'];
		}
		if(isset($data['sticker'])) {
		    $instance->sticker = Sticker::fromArray($data['sticker']);
		}
		if(isset($data['star_count'])) {
		    $instance->starCount = $data['star_count'];
		}
		if(isset($data['total_count'])) {
		    $instance->totalCount = $data['total_count'];
		}
		if(isset($data['remaining_count'])) {
		    $instance->remainingCount = $data['remaining_count'];
		}
		return $instance;
	}

	public function __construct(
		?string $id = null,
		?Sticker $sticker = null,
		?int $starCount = null,
		?int $totalCount = null,
		?int $remainingCount = null,
	) {
		$this->id = $id;
		$this->sticker = $sticker;
		$this->starCount = $starCount;
		$this->totalCount = $totalCount;
		$this->remainingCount = $remainingCount;
	}

	public function getId(): ?string {
		return $this->id;
	}

	public function setId(?string $value): self {
		$this->id = $value;
		return $this;
	}

	public function getSticker(): ?Sticker {
		return $this->sticker;
	}

	public function setSticker(?Sticker $value): self {
		$this->sticker = $value;
		return $this;
	}

	public function getStarCount(): ?int {
		return $this->starCount;
	}

	public function setStarCount(?int $value): self {
		$this->starCount = $value;
		return $this;
	}

	public function getTotalCount(): ?int {
		return $this->totalCount;
	}

	public function setTotalCount(?int $value): self {
		$this->totalCount = $value;
		return $this;
	}

	public function getRemainingCount(): ?int {
		return $this->remainingCount;
	}

	public function setRemainingCount(?int $value): self {
		$this->remainingCount = $value;
		return $this;
	}

}
