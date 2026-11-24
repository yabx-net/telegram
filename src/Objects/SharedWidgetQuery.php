<?php

namespace Yabx\Telegram\Objects;

/**
 * This object represents an incoming query from a forwarded message with a shared widget created by the bot.
 * @link https://core.telegram.org/bots/api#sharedwidgetquery
 */
final class SharedWidgetQuery extends AbstractObject {

    /**
     * Id
     *
     * Unique identifier for this query
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * From
     *
     * Sender
     * @var User|null
     */
    protected ?User $from = null;

    /**
     * Type
     *
     * Type of the query
     * @var WidgetQueryType|null
     */
    protected ?WidgetQueryType $type = null;

    /**
     * Data
     *
     * Data of the query, 1-64 bytes
     * @var string|null
     */
    protected ?string $data = null;

    /**
     * Widget Id
     *
     * Unique identifier of the shared widget, which sent the query
     * @var string|null
     */
    protected ?string $widgetId = null;

    public function __construct(
        ?string $id = null,
        ?User $from = null,
        ?WidgetQueryType $type = null,
        ?string $data = null,
        ?string $widgetId = null
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->type = $type;
        $this->data = $data;
        $this->widgetId = $widgetId;
    }

    public static function fromArray(array $data): SharedWidgetQuery {
        $instance = new self();
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['from'])) {
            $instance->from = User::fromArray($data['from']);
        }
        if (isset($data['type'])) {
            $instance->type = WidgetQueryType::fromArray($data['type']);
        }
        if (isset($data['data'])) {
            $instance->data = $data['data'];
        }
        if (isset($data['widget_id'])) {
            $instance->widgetId = $data['widget_id'];
        }
        return $instance;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(?string $value): self {
        $this->id = $value;
        return $this;
    }

    public function getFrom(): ?User {
        return $this->from;
    }

    public function setFrom(?User $value): self {
        $this->from = $value;
        return $this;
    }

    public function getType(): ?WidgetQueryType {
        return $this->type;
    }

    public function setType(?WidgetQueryType $value): self {
        $this->type = $value;
        return $this;
    }

    public function getData(): ?string {
        return $this->data;
    }

    public function setData(?string $value): self {
        $this->data = $value;
        return $this;
    }

    public function getWidgetId(): ?string {
        return $this->widgetId;
    }

    public function setWidgetId(?string $value): self {
        $this->widgetId = $value;
        return $this;
    }
}
