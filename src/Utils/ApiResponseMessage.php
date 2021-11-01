<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils;

use App\Exception\Api\ApiException;

/**
 * Class ApiExceptionMessage.
 */
class ApiResponseMessage
{
    /** @var string */
    private $message;

    /** @var int */
    private $code;

    /** @var mixed */
    private $payload;

    /**
     * ApiExceptionMessage constructor.
     *
     * @param null $payload
     */
    public function __construct(string $message, int $code, $payload = null)
    {
        $this->message = $message;
        $this->code = $code;
        $this->payload = $payload;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function setPayload($payload): void
    {
        $this->payload = $payload;
    }

    /**
     * Retourne un tableau avec les valeurs de l'object pouvant etre passé dans une reponse http json.
     */
    public function getData(): array
    {
        return [
            'message' => $this->message,
            'code' => $this->code,
            'payload' => (false !== json_encode($this->payload)) ? json_encode($this->payload) : null,
        ];
    }

    /**
     * @param $data
     *
     * @throws ApiException
     *
     * @return ApiResponseMessage
     */
    public static function factory($data)
    {
        try {
            $data = json_decode($data);
            $response = new self($data->message, $data->code, isset($data->payload) ? $data->payload : null);

            return $response;
        } catch (\Exception $exception) {
            throw new ApiException(new self('Impossible de traduire le reponse de l\'api avec la methode '.__METHOD__, ApiCodeEnum::CALL_API_INTERNAL_ERROR), 500);
        }
    }
}
