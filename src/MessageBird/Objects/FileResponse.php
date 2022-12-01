<?php

namespace MessageBird\Objects;

use stdClass;

/**
 * Class Message.
 *
 * @property int $protocolId
 */
class FileResponse extends Base
{
    /**
     * An unique random ID which is created on the MessageBird
     * platform and is returned upon creation of the object.
     *
     * @var string
     */
    public $id;

    public $name;

    /**
     * @deprecated 2.2.0 No longer used by internal code, please switch to {@see self::loadFromStdclass()}
     *
     * @param mixed $object
     */
    public function loadFromArray($object): FileResponse
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
