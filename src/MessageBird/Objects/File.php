<?php

namespace MessageBird\Objects;

use stdClass;

/**
 * Class Message
 *
 * @property int $protocolId
 * @package MessageBird\Objects
 */
class File extends Base
{
    public $contentType;

    public $contentDisposition;

    public $dataBinary;

    /**
     * @deprecated 2.2.0 No longer used by internal code, please switch to {@see self::loadFromStdclass()}
     * 
     * @param mixed $object
     * 
     * @return self
     */
    public function loadFromArray($object): self
    {
        parent::loadFromArray($object);

        return $this;
    }

    /**
     * @param stdClass $object 
     * @return self 
     */
    public function loadFromStdclass(stdClass $object): self
    {
        parent::loadFromStdclass($object);

        return $this;
    }
}
