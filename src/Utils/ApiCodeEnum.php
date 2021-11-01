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

class ApiCodeEnum
{
    public const API_INTERNAL_ERROR = 1;

    // API standard
    public const REQUEST_BAD_PARAMETER = 2100; // Un paramètre de l'url n'est pas bon
    public const REQUEST_MISSING_ARGUMENT = 2101; // un argument est manquant
    public const REQUEST_NOT_FOUND_VALUE = 2102; // aucune valeur retournée
    public const REQUEST_FILE_CORRUPT = 2103; // aucune valeur retournée

    // Authotization
    public const AUTH_NO_ACCESS_API = 2400; // l'utilisateur n'existe pas dans la base litige

    // Ressources
    public const RESOURCE_NOT_AUTHORIZE = 2200;

    // Email
    public const INVALID_ATTACHMENT_PATH = 2600;
    public const NO_ADDRESS = 2601;
    public const INVALID_ADDRESS = 2602;

    // Form
    public const INVALID_FORM_VALUE = 2700;

    // Erreur Appel autres api
    public const CALL_API_INTERNAL_ERROR = 3000;
    public const CALL_API_REQUEST_BAD_PARAMETER = 3100; // Un paramètre de l'url n'est pas bon
    public const CALL_API_REQUEST_MISSING_ARGUMENT = 3101; // un argument est manquant
    public const CALL_API_REQUEST_NOT_FOUND_VALUE = 3102; // aucune valeur retournée
    public const CALL_API_REQUEST_FILE_CORRUPT = 3103; // aucune valeur retournée
    // Erreur Authotization autres api
    public const  CALL_API_AUTH_NO_ACCESS_API = 3400; // l'utilisateur n'existe pas dans la base litige

    // Ressources autres api
    public const  CALL_API_RESOURCE_NOT_AUTHORIZE = 3200;
}
