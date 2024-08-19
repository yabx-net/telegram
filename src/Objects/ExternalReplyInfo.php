<?php

namespace Yabx\Telegram\Objects;

use Yabx\Telegram\ObjectTrait;

final class ExternalReplyInfo {

    use ObjectTrait;

    /**
     * Origin
     *
     * Origin of the message replied to by the given message
     * @var MessageOrigin|null
     */
    protected ?MessageOrigin $origin = null;

    /**
     * Chat
     *
     * Optional. Chat the original message belongs to. Available only if the chat is a supergroup or a channel.
     * @var Chat|null
     */
    protected ?Chat $chat = null;

    /**
     * Message Id
     *
     * Optional. Unique message identifier inside the original chat. Available only if the original chat is a supergroup or a channel.
     * @var int|null
     */
    protected ?int $messageId = null;

    /**
     * Link Preview Options
     *
     * Optional. Options used for link preview generation for the original message, if it is a text message
     * @var LinkPreviewOptions|null
     */
    protected ?LinkPreviewOptions $linkPreviewOptions = null;

    /**
     * Animation
     *
     * Optional. Message is an animation, information about the animation
     * @var Animation|null
     */
    protected ?Animation $animation = null;

    /**
     * Audio
     *
     * Optional. Message is an audio file, information about the file
     * @var Audio|null
     */
    protected ?Audio $audio = null;

    /**
     * Document
     *
     * Optional. Message is a general file, information about the file
     * @var Document|null
     */
    protected ?Document $document = null;

    /**
     * Paid Media
     *
     * Optional. Message contains paid media; information about the paid media
     * @var PaidMediaInfo|null
     */
    protected ?PaidMediaInfo $paidMedia = null;

    /**
     * Photo
     *
     * Optional. Message is a photo, available sizes of the photo
     * @var PhotoSize[]|null
     */
    protected ?array $photo = null;

    /**
     * Sticker
     *
     * Optional. Message is a sticker, information about the sticker
     * @var Sticker|null
     */
    protected ?Sticker $sticker = null;

    /**
     * Story
     *
     * Optional. Message is a forwarded story
     * @var Story|null
     */
    protected ?Story $story = null;

    /**
     * Video
     *
     * Optional. Message is a video, information about the video
     * @var Video|null
     */
    protected ?Video $video = null;

    /**
     * Video Note
     *
     * Optional. Message is a video note, information about the video message
     * @var VideoNote|null
     */
    protected ?VideoNote $videoNote = null;

    /**
     * Voice
     *
     * Optional. Message is a voice message, information about the file
     * @var Voice|null
     */
    protected ?Voice $voice = null;

    /**
     * Has Media Spoiler
     *
     * Optional. True, if the message media is covered by a spoiler animation
     * @var bool|null
     */
    protected ?bool $hasMediaSpoiler = null;

    /**
     * Contact
     *
     * Optional. Message is a shared contact, information about the contact
     * @var Contact|null
     */
    protected ?Contact $contact = null;

    /**
     * Dice
     *
     * Optional. Message is a dice with random value
     * @var Dice|null
     */
    protected ?Dice $dice = null;

    /**
     * Game
     *
     * Optional. Message is a game, information about the game. More about games »
     * @var Game|null
     */
    protected ?Game $game = null;

    /**
     * Giveaway
     *
     * Optional. Message is a scheduled giveaway, information about the giveaway
     * @var Giveaway|null
     */
    protected ?Giveaway $giveaway = null;

    /**
     * Giveaway Winners
     *
     * Optional. A giveaway with public winners was completed
     * @var GiveawayWinners|null
     */
    protected ?GiveawayWinners $giveawayWinners = null;

    /**
     * Invoice
     *
     * Optional. Message is an invoice for a payment, information about the invoice. More about payments »
     * @var Invoice|null
     */
    protected ?Invoice $invoice = null;

    /**
     * Location
     *
     * Optional. Message is a shared location, information about the location
     * @var Location|null
     */
    protected ?Location $location = null;

    /**
     * Poll
     *
     * Optional. Message is a native poll, information about the poll
     * @var Poll|null
     */
    protected ?Poll $poll = null;

    /**
     * Venue
     *
     * Optional. Message is a venue, information about the venue
     * @var Venue|null
     */
    protected ?Venue $venue = null;

    public static function fromArray(array $data): ExternalReplyInfo {
        $instance = new self();
        if (isset($data['origin'])) {
            $instance->origin = MessageOrigin::fromArray($data['origin']);
        }
        if (isset($data['chat'])) {
            $instance->chat = Chat::fromArray($data['chat']);
        }
        if (isset($data['message_id'])) {
            $instance->messageId = $data['message_id'];
        }
        if (isset($data['link_preview_options'])) {
            $instance->linkPreviewOptions = LinkPreviewOptions::fromArray($data['link_preview_options']);
        }
        if (isset($data['animation'])) {
            $instance->animation = Animation::fromArray($data['animation']);
        }
        if (isset($data['audio'])) {
            $instance->audio = Audio::fromArray($data['audio']);
        }
        if (isset($data['document'])) {
            $instance->document = Document::fromArray($data['document']);
        }
        if (isset($data['paid_media'])) {
            $instance->paidMedia = PaidMediaInfo::fromArray($data['paid_media']);
        }
        if (isset($data['photo'])) {
            $instance->photo = [];
            foreach ($data['photo'] as $item) {
                $instance->photo[] = PhotoSize::fromArray($item);
            }
        }
        if (isset($data['sticker'])) {
            $instance->sticker = Sticker::fromArray($data['sticker']);
        }
        if (isset($data['story'])) {
            $instance->story = Story::fromArray($data['story']);
        }
        if (isset($data['video'])) {
            $instance->video = Video::fromArray($data['video']);
        }
        if (isset($data['video_note'])) {
            $instance->videoNote = VideoNote::fromArray($data['video_note']);
        }
        if (isset($data['voice'])) {
            $instance->voice = Voice::fromArray($data['voice']);
        }
        if (isset($data['has_media_spoiler'])) {
            $instance->hasMediaSpoiler = $data['has_media_spoiler'];
        }
        if (isset($data['contact'])) {
            $instance->contact = Contact::fromArray($data['contact']);
        }
        if (isset($data['dice'])) {
            $instance->dice = Dice::fromArray($data['dice']);
        }
        if (isset($data['game'])) {
            $instance->game = Game::fromArray($data['game']);
        }
        if (isset($data['giveaway'])) {
            $instance->giveaway = Giveaway::fromArray($data['giveaway']);
        }
        if (isset($data['giveaway_winners'])) {
            $instance->giveawayWinners = GiveawayWinners::fromArray($data['giveaway_winners']);
        }
        if (isset($data['invoice'])) {
            $instance->invoice = Invoice::fromArray($data['invoice']);
        }
        if (isset($data['location'])) {
            $instance->location = Location::fromArray($data['location']);
        }
        if (isset($data['poll'])) {
            $instance->poll = Poll::fromArray($data['poll']);
        }
        if (isset($data['venue'])) {
            $instance->venue = Venue::fromArray($data['venue']);
        }
        return $instance;
    }

    public function __construct(
        ?MessageOrigin      $origin = null,
        ?Chat               $chat = null,
        ?int                $messageId = null,
        ?LinkPreviewOptions $linkPreviewOptions = null,
        ?Animation          $animation = null,
        ?Audio              $audio = null,
        ?Document           $document = null,
        ?PaidMediaInfo      $paidMedia = null,
        ?array              $photo = null,
        ?Sticker            $sticker = null,
        ?Story              $story = null,
        ?Video              $video = null,
        ?VideoNote          $videoNote = null,
        ?Voice              $voice = null,
        ?bool               $hasMediaSpoiler = null,
        ?Contact            $contact = null,
        ?Dice               $dice = null,
        ?Game               $game = null,
        ?Giveaway           $giveaway = null,
        ?GiveawayWinners    $giveawayWinners = null,
        ?Invoice            $invoice = null,
        ?Location           $location = null,
        ?Poll               $poll = null,
        ?Venue              $venue = null,
    ) {
        $this->origin = $origin;
        $this->chat = $chat;
        $this->messageId = $messageId;
        $this->linkPreviewOptions = $linkPreviewOptions;
        $this->animation = $animation;
        $this->audio = $audio;
        $this->document = $document;
        $this->paidMedia = $paidMedia;
        $this->photo = $photo;
        $this->sticker = $sticker;
        $this->story = $story;
        $this->video = $video;
        $this->videoNote = $videoNote;
        $this->voice = $voice;
        $this->hasMediaSpoiler = $hasMediaSpoiler;
        $this->contact = $contact;
        $this->dice = $dice;
        $this->game = $game;
        $this->giveaway = $giveaway;
        $this->giveawayWinners = $giveawayWinners;
        $this->invoice = $invoice;
        $this->location = $location;
        $this->poll = $poll;
        $this->venue = $venue;
    }

    public function getOrigin(): ?MessageOrigin {
        return $this->origin;
    }

    public function setOrigin(?MessageOrigin $value): self {
        $this->origin = $value;
        return $this;
    }

    public function getChat(): ?Chat {
        return $this->chat;
    }

    public function setChat(?Chat $value): self {
        $this->chat = $value;
        return $this;
    }

    public function getMessageId(): ?int {
        return $this->messageId;
    }

    public function setMessageId(?int $value): self {
        $this->messageId = $value;
        return $this;
    }

    public function getLinkPreviewOptions(): ?LinkPreviewOptions {
        return $this->linkPreviewOptions;
    }

    public function setLinkPreviewOptions(?LinkPreviewOptions $value): self {
        $this->linkPreviewOptions = $value;
        return $this;
    }

    public function getAnimation(): ?Animation {
        return $this->animation;
    }

    public function setAnimation(?Animation $value): self {
        $this->animation = $value;
        return $this;
    }

    public function getAudio(): ?Audio {
        return $this->audio;
    }

    public function setAudio(?Audio $value): self {
        $this->audio = $value;
        return $this;
    }

    public function getDocument(): ?Document {
        return $this->document;
    }

    public function setDocument(?Document $value): self {
        $this->document = $value;
        return $this;
    }

    public function getPaidMedia(): ?PaidMediaInfo {
        return $this->paidMedia;
    }

    public function setPaidMedia(?PaidMediaInfo $value): self {
        $this->paidMedia = $value;
        return $this;
    }

    public function getPhoto(): ?array {
        return $this->photo;
    }

    public function setPhoto(?array $value): self {
        $this->photo = $value;
        return $this;
    }

    public function getSticker(): ?Sticker {
        return $this->sticker;
    }

    public function setSticker(?Sticker $value): self {
        $this->sticker = $value;
        return $this;
    }

    public function getStory(): ?Story {
        return $this->story;
    }

    public function setStory(?Story $value): self {
        $this->story = $value;
        return $this;
    }

    public function getVideo(): ?Video {
        return $this->video;
    }

    public function setVideo(?Video $value): self {
        $this->video = $value;
        return $this;
    }

    public function getVideoNote(): ?VideoNote {
        return $this->videoNote;
    }

    public function setVideoNote(?VideoNote $value): self {
        $this->videoNote = $value;
        return $this;
    }

    public function getVoice(): ?Voice {
        return $this->voice;
    }

    public function setVoice(?Voice $value): self {
        $this->voice = $value;
        return $this;
    }

    public function getHasMediaSpoiler(): ?bool {
        return $this->hasMediaSpoiler;
    }

    public function setHasMediaSpoiler(?bool $value): self {
        $this->hasMediaSpoiler = $value;
        return $this;
    }

    public function getContact(): ?Contact {
        return $this->contact;
    }

    public function setContact(?Contact $value): self {
        $this->contact = $value;
        return $this;
    }

    public function getDice(): ?Dice {
        return $this->dice;
    }

    public function setDice(?Dice $value): self {
        $this->dice = $value;
        return $this;
    }

    public function getGame(): ?Game {
        return $this->game;
    }

    public function setGame(?Game $value): self {
        $this->game = $value;
        return $this;
    }

    public function getGiveaway(): ?Giveaway {
        return $this->giveaway;
    }

    public function setGiveaway(?Giveaway $value): self {
        $this->giveaway = $value;
        return $this;
    }

    public function getGiveawayWinners(): ?GiveawayWinners {
        return $this->giveawayWinners;
    }

    public function setGiveawayWinners(?GiveawayWinners $value): self {
        $this->giveawayWinners = $value;
        return $this;
    }

    public function getInvoice(): ?Invoice {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $value): self {
        $this->invoice = $value;
        return $this;
    }

    public function getLocation(): ?Location {
        return $this->location;
    }

    public function setLocation(?Location $value): self {
        $this->location = $value;
        return $this;
    }

    public function getPoll(): ?Poll {
        return $this->poll;
    }

    public function setPoll(?Poll $value): self {
        $this->poll = $value;
        return $this;
    }

    public function getVenue(): ?Venue {
        return $this->venue;
    }

    public function setVenue(?Venue $value): self {
        $this->venue = $value;
        return $this;
    }

}
