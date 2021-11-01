<?php

namespace App\Service\Api;

use App\Exception\Api\ApiException;
use App\Utils\ApiCodeEnum;
use App\Utils\ApiResponseMessage;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class ApiService
{
    /**
     * @var Client
     */
    public $client;

    /**
     * @var LoggerInterface
     */
    public $logger;

    public function __construct(LoggerInterface $logger, Client $client)
    {
        $this->logger = $logger;
        $this->client = $client;
    }

    /**
     * @param $e \Exception | GuzzleException | BadResponseException
     *
     * @throws ApiException
     */
    public function handleResponseError($e)
    {
        $this->logger->error($e->getMessage());
        switch ($e->getCode()) {
            case 400:
                throw new ApiException(ApiResponseMessage::factory($e->getResponse()->getBody()->getContents()), $e->getCode());
            default:
                throw new ApiException(new ApiResponseMessage($e->getMessage(), ApiCodeEnum::API_INTERNAL_ERROR), 500);
        }
    }
}
