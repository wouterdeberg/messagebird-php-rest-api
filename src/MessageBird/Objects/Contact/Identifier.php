<?php

namespace MessageBird\Objects\Contact;

use MessageBird\Objects\Base;

/**
 * Class Identifier
 *
 */
class Identifier extends Base
{
    /**
     * A unique random ID used to identify this identifier on the MessageBird platform.
     *
     * @var string
     */
    protected $id;
    /**
     * The type of identifier.
     * @var string
     */
    public $type;
    /**
     * The identifier of the user on the provided channel.
     * Here is a list of possible identifier types. This list will expand as we add new channels:
     * - phonenumber: A valid MSISDN used by channels like WhatsApp and SMS.
     * - emailaddress: Email Address used by channels identifying with email.
     * - facebook: Facebook user ID, Can only be used with the Facebook channel.
     * - wechat: WeChat user ID. Can only be used with the WeChat channel.
     * - line: Line user ID. Can only be used with the Line channel.
     * - telegram: Telegram user ID. Can only be used with the Telegram channel.
     * - instagram: Instagram user ID. Can only be used with the Instagram channel.
     * - twitter: Twitter user ID. Can only be used with the Twitter channel.
     *
     * @var string
     */
    public $value;
   
    public function getId(): string
    {
        return $this->id;
    }
}
