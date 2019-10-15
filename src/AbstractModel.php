<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:48 16.08.2019
 */

namespace Daktela;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractModel implements \JsonSerializable
{
    public static function isPropertyExist($key, $array)
    {
        if (is_null($array)) {
            return false;
        }
        return array_key_exists($key, $array);
    }

    protected static function optionalProperty($key, $array)
    {
        return self::isPropertyExist($key, $array) ? $array[$key] : null;
    }
}