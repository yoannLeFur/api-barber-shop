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

/**
 * Class ConverterHelper.
 */
class ConverterHelper
{
    /**
     * @param $num
     *
     * @return float
     */
    public static function tofloat($num)
    {
        $dotPos = mb_strrpos($num, '.');
        $commaPos = mb_strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

        if (!$sep) {
            return (float) (preg_replace('/[^0-9]/', '', $num));
        }

        if ('-' === mb_substr($num, 0, 1)) {
            return (float) (
                '-'.preg_replace('/[^0-9]/', '', mb_substr($num, 0, $sep)).'.'.
                preg_replace('/[^0-9]/', '', mb_substr($num, $sep + 1, mb_strlen($num)))
            );
        }

        return (float) (
            preg_replace('/[^0-9]/', '', mb_substr($num, 0, $sep)).'.'.
            preg_replace('/[^0-9]/', '', mb_substr($num, $sep + 1, mb_strlen($num)))
        );
    }

    /**
     * Transforme une chaine de caractère snake_case en camelCase.
     *
     * @param $string
     * @param bool $capitalizeFirstCharacter
     *
     * @return mixed|string
     */
    public static function snakeToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * Transforme une chaine de caractère kebab-case en camelCase.
     *
     * @param $string
     * @param bool $capitalizeFirstCharacter
     *
     * @return mixed|string
     */
    public static function kebabToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('-', '', ucwords($string, '-'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * Transforme une chaine de caractère camelCase en snake_case.
     *
     * @param $string
     *
     * @return string
     */
    public static function camelToSnakeCase($string)
    {
        $snakeCasedName = '';
        $len = mb_strlen($string);
        for ($i = 0; $i < $len; ++$i) {
            if (ctype_upper($string[$i])) {
                $snakeCasedName .= '_'.mb_strtolower($string[$i]);
            } else {
                $snakeCasedName .= mb_strtolower($string[$i]);
            }
        }

        return $snakeCasedName;
    }

    /**
     * Transforme une chaine de caractère camelCase en snake_case.
     *
     * @param $string
     *
     * @return string
     */
    public static function camelToKebabCase($string)
    {
        $snakeCasedName = '';
        $len = mb_strlen($string);
        for ($i = 0; $i < $len; ++$i) {
            if (ctype_upper($string[$i])) {
                $snakeCasedName .= '-'.mb_strtolower($string[$i]);
            } else {
                $snakeCasedName .= mb_strtolower($string[$i]);
            }
        }

        return $snakeCasedName;
    }
}
