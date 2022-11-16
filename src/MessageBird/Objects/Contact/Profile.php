<?php

namespace MessageBird\Objects\Contact;

use MessageBird\Objects\Base;

/**
 * Class Profile
 *
 */
class Profile extends Base
{
    /**
     * A unique random ID used to identify this identifier on the MessageBird platform.
     *
     * @var string
     */
    protected $id;
    /**
     * The id of the MessageBird channel for this profile.
     * @var string
     */
    public $channelId;
    /**
     * The platform-specific identifier of the user on the provided channel.
     *
     * @var string
     */
    public $identifier;
   
    public function getId(): string
    {
        return $this->id;
    }
}
