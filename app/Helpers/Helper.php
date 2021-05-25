<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class Helper
{

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /**
     * @param array $array
     * @return mixed
     */
    public static function arrayToObject(Array $array)
    {
       return json_decode(json_encode((object) $array), FALSE);
    }


    /**
     * @return bool
     */
    public static function domainIsMain()
    {
        return (request()->getHost() == config('tenant.domain_main'));
    }

    /**
     * @param $route
     * @return bool
     */
    public static function in_route($route)
    {
        $piecesRoute = explode('/', request()->url());

        return in_array($route, $piecesRoute);
    }

    /**
     * @param $string
     * @return string|string[]
     */
    public static function sanitizeString($string)
    {
        // Valores informados
        $what = array(
            'ä',
            'ã',
            'à',
            'á',
            'â',
            'ê',
            'ë',
            'è',
            'é',
            'ï',
            'ì',
            'í',
            'ö',
            'õ',
            'ò',
            'ó',
            'ô',
            'ü',
            'ù',
            'ú',
            'û',
            'À',
            'Á',
            'É',
            'Í',
            'Ó',
            'Ú',
            'ñ',
            'Ñ',
            'ç',
            'Ç',
            '-',
            '(',
            ')',
            ',',
            ';',
            ':',
            '|',
            '!',
            '"',
            '#',
            '$',
            '%',
            '&',
            '/',
            '=',
            '?',
            '~',
            '^',
            '>',
            '<',
            'ª',
            'º',
            'Ã',
            'Õ',
            '&'
        );

        // Valores a serem substituídos
        $by = array(
            'a',
            'a',
            'a',
            'a',
            'a',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'o',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'A',
            'A',
            'E',
            'I',
            'O',
            'U',
            'n',
            'n',
            'c',
            'C',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            'A',
            'O',
            ''
        );

        // String Formatada
        return str_replace($what, $by, $string);
    }

    /**
     * @param $string
     * @return string|string[]
     */
    public static function createUrl($string)
    {
        //Retira os acentos
        $url = self::sanitizeString($string);

        //Deixa o texto em minusculo retira todos encodes html
        return str_replace(' ', '-', strtolower(filter_var($url, FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    }

    /**
     * @param $value
     * @param string $format
     * @return mixed
     */
    public static function formatDateTime($value, $format = 'd/m/Y H:i:s')
    {
        return Carbon::parse($value)->format($format);
    }

    /**
     * @param $value
     * @param int $decimals
     * @return string
     */
    public static function formatDecimal($value, $decimals = 2)
    {
        return number_format((float) $value, $decimals,',','.');
    }

    /**
     * @param $value
     * @return string|string[]
     */
    public static function replaceDecimal($value)
    {
        return str_replace(",", ".", str_replace(".", "", $value));
    }

    /**
     * @return string
     */
    public static function colorRand()
    {
        return '#' . dechex(rand(0x000000, 0xFFFFFF));
    }
}
