<?php

namespace Yabx\Telegram\Objects;

final class AffiliateInfo extends AbstractObject {

	/**
	 * Affiliate User
	 *
	 * Optional. The bot or the user that received an affiliate commission if it was received by a bot or a user
	 * @var User|null
	 */
	protected ?User $affiliateUser = null;

	/**
	 * Affiliate Chat
	 *
	 * Optional. The chat that received an affiliate commission if it was received by a chat
	 * @var Chat|null
	 */
	protected ?Chat $affiliateChat = null;

	/**
	 * Commission Per Mille
	 *
	 * The number of Telegram Stars received by the affiliate for each 1000 Telegram Stars received by the bot from referred users
	 * @var int|null
	 */
	protected ?int $commissionPerMille = null;

	/**
	 * Amount
	 *
	 * Integer amount of Telegram Stars received by the affiliate from the transaction, rounded to 0; can be negative for refunds
	 * @var int|null
	 */
	protected ?int $amount = null;

	/**
	 * Nanostar Amount
	 *
	 * Optional. The number of 1/1000000000 shares of Telegram Stars received by the affiliate; from -999999999 to 999999999; can be negative for refunds
	 * @var int|null
	 */
	protected ?int $nanostarAmount = null;

	public static function fromArray(array $data): AffiliateInfo {
		$instance = new self();
		if(isset($data['affiliate_user'])) {
		    $instance->affiliateUser = User::fromArray($data['affiliate_user']);
		}
		if(isset($data['affiliate_chat'])) {
		    $instance->affiliateChat = Chat::fromArray($data['affiliate_chat']);
		}
		if(isset($data['commission_per_mille'])) {
		    $instance->commissionPerMille = $data['commission_per_mille'];
		}
		if(isset($data['amount'])) {
		    $instance->amount = $data['amount'];
		}
		if(isset($data['nanostar_amount'])) {
		    $instance->nanostarAmount = $data['nanostar_amount'];
		}
		return $instance;
	}

	public function __construct(
		?User $affiliateUser = null,
		?Chat $affiliateChat = null,
		?int $commissionPerMille = null,
		?int $amount = null,
		?int $nanostarAmount = null,
	) {
		$this->affiliateUser = $affiliateUser;
		$this->affiliateChat = $affiliateChat;
		$this->commissionPerMille = $commissionPerMille;
		$this->amount = $amount;
		$this->nanostarAmount = $nanostarAmount;
	}

	public function getAffiliateUser(): ?User {
		return $this->affiliateUser;
	}

	public function setAffiliateUser(?User $value): self {
		$this->affiliateUser = $value;
		return $this;
	}

	public function getAffiliateChat(): ?Chat {
		return $this->affiliateChat;
	}

	public function setAffiliateChat(?Chat $value): self {
		$this->affiliateChat = $value;
		return $this;
	}

	public function getCommissionPerMille(): ?int {
		return $this->commissionPerMille;
	}

	public function setCommissionPerMille(?int $value): self {
		$this->commissionPerMille = $value;
		return $this;
	}

	public function getAmount(): ?int {
		return $this->amount;
	}

	public function setAmount(?int $value): self {
		$this->amount = $value;
		return $this;
	}

	public function getNanostarAmount(): ?int {
		return $this->nanostarAmount;
	}

	public function setNanostarAmount(?int $value): self {
		$this->nanostarAmount = $value;
		return $this;
	}

}
