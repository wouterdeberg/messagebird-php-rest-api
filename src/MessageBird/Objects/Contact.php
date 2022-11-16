<?php

namespace MessageBird\Objects;

use stdClass;

/**
 * Class Contact
 *
 * @package MessageBird\Objects
 */
class Contact extends Base
{
    /**
     * An unique random ID which is created on the MessageBird
     * platform and is returned upon creation of the object.
     *
     * @var string
     */
    protected $id;
    /**
     * A display name (e.g. "{firstName} {lastName}", a username, or phone number) for the contact, typically used when displaying a contact in UI.
     * @var string
     */
    public $displayName;
    /**
     * The first name of the contact.
     *
     * @var string
     */
    public $firstName;
    /**
     * The last name of the contact.
     *
     * @var string
     */
    public $lastName;
    /**
     * Optional. An array of language identifiers. Will be populated with ISO 639-1 codes for the language of this contact if the contact has messaged on a platform that provides locale data.
     *
     * @var array
     */
    public $languages;  
    /**
     * Optional. An identifier the country this contact resides in. Will be populated with an ISO 3166-1 code if the contact has messaged on a platform that provides country data.
     * @var string
     */
    public $country;
    /**
     * Optional. A URL linking to an avatar for this contact.
     *
     * @var string
     */
    public $avatar;
    /**
     * Optional. A gender identifier for the customer. Free text format.
     *
     * @var string
     */
    public $gender;
    /**
     * The status of this contact, one of: active, merged.
     *
     * @var string
     */
    public $status;
    /**
     * Optional. An array of the profiles that link this Contact to a specific channel.
     *
     * @var array
     */
    public $profiles;
    /**
     * Optional. Custom key-value attributes that can be assigned to the contact. Any valid JSON object is accepted, but the maximum size of the object is 10kB.
     *
     * @var json
     */
    public $attributes;
    /**
     * The URL for this contact resource.
     *
     * @var string
     */
    public $href;
    /**
     * RFC3339 formatted timestamp of the creation time of the contact.
     *
     * @var date
     */
    public $createdAt;
    /**
     * RFC3339 formatted timestamp of the time of the last update made to the contact.
     *
     * @var string
     */
    public $updatedAt;
    /**
     * An Identifier is a value used by other platforms to Identify a contact.
     * This can be a generic identifier such as a phone number or email address that are used with multiple platforms,
     * as well as some platform specific identifiers such as your Facebook ID.
     */
    public $identifiers;
   
    public function getId(): string
    {
        return $this->id;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function getMessages(): stdClass
    {
        return $this->messages;
    }

    public function getCreatedDatetime(): string
    {
        return $this->createdDatetime;
    }

    public function getUpdatedDatetime(): ?string
    {
        return $this->updatedDatetime;
    }

    public function loadFromStdclass(stdClass $object): self
    {
        return parent::loadFromStdclass($object);
    }
}
