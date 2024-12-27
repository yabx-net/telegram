<?php

namespace Yabx\Telegram\Objects;

final class TransactionPartnerAffiliateProgram extends AbstractObject {

    /**
     * Type
     *
     * Type of the transaction partner, always “affiliate_program”
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Sponsor User
     *
     * Optional. Information about the bot that sponsored the affiliate program
     * @var User|null
     */
    protected ?User $sponsorUser = null;

    /**
     * Commission Per Mille
     *
     * The number of Telegram Stars received by the bot for each 1000 Telegram Stars received by the affiliate program sponsor from referred users
     * @var int|null
     */
    protected ?int $commissionPerMille = null;

    public static function fromArray(array $data): TransactionPartnerAffiliateProgram {
        $instance = new self();
        if (isset($data['type'])) {
            $instance->type = $data['type'];
        }
        if (isset($data['sponsor_user'])) {
            $instance->sponsorUser = User::fromArray($data['sponsor_user']);
        }
        if (isset($data['commission_per_mille'])) {
            $instance->commissionPerMille = $data['commission_per_mille'];
        }
        return $instance;
    }

    public function __construct(
        ?string $type = null,
        ?User   $sponsorUser = null,
        ?int    $commissionPerMille = null,
    ) {
        $this->type = $type;
        $this->sponsorUser = $sponsorUser;
        $this->commissionPerMille = $commissionPerMille;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(?string $value): self {
        $this->type = $value;
        return $this;
    }

    public function getSponsorUser(): ?User {
        return $this->sponsorUser;
    }

    public function setSponsorUser(?User $value): self {
        $this->sponsorUser = $value;
        return $this;
    }

    public function getCommissionPerMille(): ?int {
        return $this->commissionPerMille;
    }

    public function setCommissionPerMille(?int $value): self {
        $this->commissionPerMille = $value;
        return $this;
    }

}
