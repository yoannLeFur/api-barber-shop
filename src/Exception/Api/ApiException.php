<?php

namespace App\Exception\Api;

use Agediss\Core\Utils\ApiResponseMessage;
use Exception;
use Throwable;

/**
 * Class ApiException
 * Cette classe sert à transporté le message et les données d'une erreur api.
 */
class ApiException extends Exception
{
    /** @var mixed */
    private $apiResponseMessage;

    /**
     * ApiException constructor.
     *
     * @param int $code code http
     */
    public function __construct(ApiResponseMessage $apiExceptionMessage, $code = 0, Throwable $previous = null)
    {
        $this->apiResponseMessage = $apiExceptionMessage;
        parent::__construct($apiExceptionMessage->getMessage(), $code, $previous);
    }

    /**
     * @return ApiResponseMessage
     */
    public function getApiResponseMessage()
    {
        return $this->apiResponseMessage;
    }

    /**
     * @param ApiResponseMessage $apiResponseMessage
     */
    public function setApiResponseMessage($apiResponseMessage): void
    {
        $this->apiResponseMessage = $apiResponseMessage;
    }
}
