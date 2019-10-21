<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:48 16.08.2019
 */

namespace Daktela;

use Daktela\Models\Queue\Queue;
use Daktela\Models\Status\Status;
use mysql_xdevapi\Exception;
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

    protected static function setModel($row, $key, $model, $class, $keyModel = null)
    {
        if (is_null($keyModel)) {
            $keyModel = $key;
        }

        if (self::isPropertyExist($key, $row) && is_array($row[$key])) {
            $model->$keyModel = $class::createFromRow($row[$key]);
        } else {
            $model->$keyModel = self::optionalProperty($key, $row);
        }
    }
    protected static function setModels($row, $key, $model, $class, $keyModel = null)
    {
        if (is_null($keyModel)) {
            $keyModel = $key;
        }

        if (self::isPropertyExist($key, $row) && is_array($row[$key])) {
            foreach ($row[$key] as $status) {
                $model->$keyModel[] = $class::createFromRow($status);
            }
        } else {
            $model->$keyModel = self::optionalProperty($key, $row);
        }
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        if ($this->__isset($name)) {
            return $this->$name;
        }
        throw new \Exception('Property [' . $name .  ']  doesn\'t exiest');
    }

    public function __isset($name)
    {
        return property_exists(static::class, $name);
    }
}