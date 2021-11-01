<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Exception\Api\ApiException;
use App\Service\HttpParametersService;
use App\Utils\ApiCodeEnum;
use App\Utils\ApiResponseMessage;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractApiController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var HttpParametersService
     */
    protected $paramService;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var Request |null
     */
    protected $request;

    public function __construct(SerializerInterface $serializer, HttpParametersService $paramService, ValidatorInterface $validator, RequestStack $request)
    {
        $this->serializer = $serializer;
        $this->paramService = $paramService;
        $this->validator = $validator;
        $this->request = $request->getCurrentRequest();
    }

    /**
     * Returns a JsonResponse that uses the serializer component if enabled, or json_encode.
     *
     * @final
     *
     * @param $data
     */
    protected function json($data, int $status = 200, array $context = [], array $headers = []): JsonResponse
    {
        if ($this->container->has('serializer') && !empty($data)) {
            if (!empty($context)) {
                $json = $this->serializer->serialize($data, 'json', SerializationContext::create()
                    ->setGroups($context)
                    ->enableMaxDepthChecks()
                );
            } else {
                $json = $this->serializer->serialize($data, 'json');
            }

            return new JsonResponse($json, $status, $headers, true);
        }

        return new JsonResponse($data, $status, $headers);
    }

    /**
     * Returns a JsonResponse that uses the serializer component if enabled, or json_encode.
     *
     * @final
     *
     * @param $data
     */
    protected function sampleJson($data, int $status = 200, array $headers = []): JsonResponse
    {
        if (!\is_string($data) && (\is_array($data) || \is_object($data))) {
            return new JsonResponse(json_encode($data), $status, $headers, true);
        }

        return new JsonResponse($data, $status, $headers, true);
    }
}
