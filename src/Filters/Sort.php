<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:48 01.11.2019
 */

namespace Daktela\Filters;

class Sort extends AbstractFilter
{
    /**
     * @var string
     */
    protected $field;
    /**
     * @var string
     */
    protected $dir = SortDirEnumeration::DESC;

    /**
     * Sorting constructor.
     * @param string $field
     * @param string $dir
     */
    public function __construct(string $field, string $dir)
    {
        $this->field = $field;
        $this->dir = mb_strtolower($dir);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'field' => $this->field,
            'dir'   => $this->dir
        ];
    }
}