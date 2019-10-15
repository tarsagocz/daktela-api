<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:28 19.08.2019
 */

namespace Daktela;

abstract class AbstractFields
{
    const FIELDS = [];

    public static function hasField($name)
    {
        return array_key_exists($name, self::FIELDS);
    }
}