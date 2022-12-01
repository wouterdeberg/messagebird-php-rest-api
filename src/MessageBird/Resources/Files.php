<?php

namespace MessageBird\Resources;

use GuzzleHttp\Client;
use MessageBird\Common;
use MessageBird\Common\HttpClient;
use MessageBird\Objects;

/**
 * Class Files
 *
 * @package MessageBird\Resources
 */
class Files extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\File();
        $this->setResponseObject(new Objects\FileResponse());
        $this->setResourceName('files');

        parent::__construct($httpClient);
    }

    public function upload(Objects\File $fileData)
    {
        $data = $this->httpClient->performFileUploadRequest($fileData);

        return $data;
    }

    public function getUrl($fileId)
    {
        return $this->httpClient->getRequestUrl('files', null).'/'.$fileId;
    }

    public function delete($fileId)
    {
        [, , $body] = $this->httpClient->performHttpRequest(
            HttpClient::REQUEST_DELETE,
            $this->resourceName.'/'.$fileId
        );

        return $this->processRequest($body);
    }

}
