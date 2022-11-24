<?php

namespace MessageBird\Objects;

use MessageBird\Objects\Conversation\Content;
use stdClass;

/**
 * Class Message.
 *
 * @property int $protocolId
 */
class MessageResponse extends Base
{
    /**
     * An unique random ID which is created on the MessageBird
     * platform and is returned upon creation of the object.
     *
     * @var string
     */
    public $id;

    /**
     * An unique random ID which is created on the MessageBird
     * platform and is returned upon creation of the conversation object.
     *
     * @var string
     */
    public $conversationId;

    /**
     * The platform the message is sent over.
     */
    public $platform;

    /**
     * The receiver of the message. This can be a telephone number
     * (including country code) or an alphanumeric string. In case
     * of an alphanumeric string, the maximum length is 11 characters.
     *
     * @var string
     */
    public $to;

    /**
     * The sender of the message. This can be a telephone number
     * (including country code) or an alphanumeric string. In case
     * of an alphanumeric string, the maximum length is 11 characters.
     *
     * @var string
     */
    public $from;

    /**
     * The channel ID the message is sent over.
     */
    public $channelId;

    /**
     * The type of message. Values can be: sms, binary, premium, or flash.
     *
     * @var string
     */
    public $type;

    /**
     * The content of the message.
     */
    public $content;

    /**
     * Tells you if the message is sent or received.
     * mt: mobile terminated (sent to mobile)
     * mo: mobile originated (received from mobile).
     *
     * @var string
     */
    public $direction;

    public $status;

    /**
     * The date and time of the creation of the message in RFC3339 format (Y-m-d\TH:i:sP).
     * @var string
     */
    public $createdDatetime;

    /**
     * The date and time of the last update of the message in RFC3339 format (Y-m-d\TH:i:sP).
     * @var string
     */
    public $updatedDatetime;

    /**
     * @deprecated 2.2.0 No longer used by internal code, please switch to {@see self::loadFromStdclass()}
     *
     * @param mixed $object
     */
    public function loadFromArray($object): MessageResponse
    {
        parent::loadFromArray($object);

        return $this;
    }

    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        if (property_exists($object, 'content')) {
            $content = new Content();
            $content->loadFromStdclass($object->content);
            $this->content = $content;
        }

        return $this;
    }
}
