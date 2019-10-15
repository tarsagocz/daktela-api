<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:13 20.08.2019
 */

namespace Daktela\Models;

trait OptionableTrait
{
    /**
     * @var [] Additional parameters
     */
    protected $options = [];

    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    public function getOption($key)
    {
        if ($this->issetOption($key)) {
            return $this->options[$key];
        } else {
            return null;
        }
    }

    public function issetOption($key)
    {
        return array_key_exists($key, $this->options);
    }

    public function setOptions($options) {
        foreach ($options as $key => $value) {
            $this->setOption($key, $value);
        }
    }

    public function createOptionClass($key, $class)
    {
        if (is_array($this->options[$key])) {
            $object = call_user_func($class . '::createFromRow', $this->options[$key]);
            $this->options[$key] = $object;
        }
    }

    public function isOptionable($row)
    {
        return self::isPropertyExist('options', $row) && !is_null($row['options']);
    }
}