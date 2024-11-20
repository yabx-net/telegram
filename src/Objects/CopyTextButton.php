<?php

namespace Yabx\Telegram\Objects;

final class CopyTextButton extends AbstractObject {

	/**
	 * Text
	 *
	 * The text to be copied to the clipboard; 1-256 characters
	 * @var string|null
	 */
	protected ?string $text = null;

	public static function fromArray(array $data): CopyTextButton {
		$instance = new self();
		if(isset($data['text'])) {
		    $instance->text = $data['text'];
		}
		return $instance;
	}

	public function __construct(
		?string $text = null,
	) {
		$this->text = $text;
	}

	public function getText(): ?string {
		return $this->text;
	}

	public function setText(?string $value): self {
		$this->text = $value;
		return $this;
	}

}
