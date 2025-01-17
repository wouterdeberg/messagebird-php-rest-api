<?php

namespace MessageBird\Resources;

use Exception;
use InvalidArgumentException;
use MessageBird\Common;
use MessageBird\Common\HttpClient;
use MessageBird\Exceptions;
use MessageBird\Objects;
use MessageBird\Objects\Contact\Identifier;
use MessageBird\Resources\Messages;

/**
 * Class Contacts
 *
 * @package MessageBird\Resources
 */
class Contacts extends Base
{
    /**
     * @var Messages
     */
    private $messagesObject;

    public function __construct(Common\HttpClient $httpClient)
    {
        parent::__construct($httpClient);

        $this->object = new Objects\Contact();
        $this->setResourceName('contacts');

        $this->messagesObject = new Messages($httpClient);
    }

    /**
     * @param mixed $object
     * @param mixed $id
     *
     * @return Objects\Balance|Objects\Conversation\Conversation|Objects\Hlr|Objects\Lookup|Objects\Message|Objects\Verify|Objects\VoiceMessage|null ->object
     *
     * @throws \JsonException
     * @throws Exceptions\AuthenticateException
     * @throws Exceptions\HttpException
     * @throws Exceptions\RequestException
     * @throws Exceptions\ServerException
     *
     * @internal param array $parameters
     */
    public function update($object, $id)
    {
        $objVars = get_object_vars($object);
        $body = [];
        foreach ($objVars as $key => $value) {
            if ($value !== null) {
                $body[$key] = $value;
            }
        }

        $resourceName = $this->resourceName . ($id ? '/' . $id : null);
        $body = json_encode($body, \JSON_THROW_ON_ERROR);

        [, , $body] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_PATCH,
            $resourceName,
            false,
            $body
        );
        return $this->processRequest($body);
    }

    public function addIdentifier(Identifier $identifier, $id)
    {
        $identifierVars = get_object_vars($identifier);
        $body = [];
        foreach ($identifierVars as $key => $value) {
            if ($value !== null) {
                $body[$key] = $value;
            }
        }

        $resourceName = $this->resourceName.'/'.$id.'/identifiers';
        $body = json_encode($body, \JSON_THROW_ON_ERROR);

        [, , $body] = $this->httpClient->performHttpRequest(
            Common\HttpClient::REQUEST_POST,
            $resourceName,
            false,
            $body
        );
        return $this->processRequest($body);
    }

    public function deleteIdentifier($contactId, $id)
    {
        $resourceName = $this->resourceName.'/'.$contactId.'/identifiers/'.$id;

        try {
            [, , $body] = $this->httpClient->performHttpRequest(
                Common\HttpClient::REQUEST_DELETE,
                $resourceName
            );
        } catch (Exception $exception) {
            throw $exception;
        }

        return true;
    }

    /**
     * @param mixed $id
     * @param array|null $parameters
     *
     * @return Objects\Balance|Objects\BaseList|Objects\Conversation\Conversation|Objects\Hlr|Objects\Lookup|Objects\Message|Objects\Verify|Objects\VoiceMessage|null ->object
     * @throws \JsonException
     */
    public function getMessages($id, ?array $parameters = [])
    {
        if ($id === null) {
            throw new InvalidArgumentException('No contact id provided.');
        }

        $this->messagesObject->setResourceName($this->resourceName . '/' . $id . '/messages');
        return $this->messagesObject->getList($parameters);
    }

    /**
     * @param mixed $id
     * @param array|null $parameters
     *
     * @return Objects\Balance|Objects\BaseList|Objects\Conversation\Conversation|Objects\Hlr|Objects\Lookup|Objects\Message|Objects\Verify|Objects\VoiceMessage|null ->object
     * @throws \JsonException
     */
    public function getGroups($id, ?array $parameters = [])
    {
        if ($id === null) {
            throw new InvalidArgumentException('No contact id provided.');
        }

        $this->object = new Objects\Group();
        $this->setResourceName($this->resourceName . '/' . $id . '/groups');
        return $this->getList($parameters);
    }

    public function mergeContacts($origin, $destination)
    {
        if ($origin === null) {
            throw new InvalidArgumentException('No origin contact id provided.');
        }

        if ($destination === null) {
            throw new InvalidArgumentException('No destination contact id provided.');
        }

        $this->setResourceName('/ops/'. $this->resourceName . '/merge');

        $requestData = ['origin' => $origin, 'destination' => $destination];
        $requestBody = json_encode($requestData, \JSON_THROW_ON_ERROR);

        [, , $body] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_POST,
            $this->resourceName,
            null,
            $requestBody
        );

        $data = json_decode($body);

        return $this->object->loadFromStdclass($data);
    }
}
