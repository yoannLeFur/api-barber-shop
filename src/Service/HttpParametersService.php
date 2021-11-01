<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Service;

use App\Exception\Api\ApiException;
use App\Utils\ApiCodeEnum;
use App\Utils\ApiResponseMessage;
use LogicException;
use Symfony\Component\HttpFoundation\Request;

class HttpParametersService
{
    const INPUT_FORMAT_JSON = 'json';
    const INPUT_FORMAT_FORM_DATA = 'form-data';

    /**
     * Cette methode permet de extraire les paramètre d'une requete pour etre utilisés dans une requete sql.
     *
     * Elle peut aussi controler les parametres avec des restrictions.
     *
     * @param array $availableParams
     *
     * @return array
     */
    public function extractRequestParams(Request $request, array $availableParams = null)
    {
        if (empty($request->query->all())) {
            return [];
        }

        if (!$availableParams) {
            return $request->query->all();
        }

        array_push($availableParams, 'lang');
        $params = [];
        foreach ($request->query->all() as $key => $value) {
            if (!(\in_array($key, $availableParams, true)) && !isset($availableParams[$key])) {
                throw new LogicException("Paramètre : {$key} n'est pas correct vérifier vos paramètres", ApiCodeEnum::REQUEST_BAD_PARAMETER);
            }
            $params[$key] = $value;
        }

        return $params;
    }

    /**
     * Cette methode permet de extraire les data "json"  du body de la request.
     *
     * Elle peut aussi controler les parametres avec des restrictions.
     *
     * @param bool $assoc permet de choisir le format de retour (tableau pas defaut ou object en passant false)
     *
     * @throws ApiException
     *
     * @return array
     */
    public function extractRequestBody(Request $request, $assoc = true, $inputFormat = self::INPUT_FORMAT_JSON)
    {
        switch ($inputFormat) {
            case self::INPUT_FORMAT_JSON:
                $data = json_decode($request->getContent(), $assoc);
                if (null === $data && JSON_ERROR_NONE !== json_last_error()) {
                    throw new ApiException(new ApiResponseMessage("impossible d'éffectuer l'enregistrement veuillez vérifier les valeurs passées dans le corp de la requete.", ApiCodeEnum::REQUEST_BAD_PARAMETER, $data), 400);
                }
                break;
            case self::INPUT_FORMAT_FORM_DATA:
                return $request->request->all();
                break;
            default:
                throw new ApiException(new ApiResponseMessage('Le format du corp de la requete '.$inputFormat." n'est pas pris en charge.", ApiCodeEnum::API_INTERNAL_ERROR), 400);
        }

        return $data;
    }
}
