<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:51 01.11.2019
 */

namespace Daktela\Filters;

class Filter extends AbstractFilter
{
    /**
     * @var string
     */
    protected $field;
    /**
     * @var string
     */
    protected $operator;
    /**
     * @var string
     */
    protected $value;

    /**
     * Filtering constructor.
     * @param string $field
     * @param string $operator
     * @param string $value
     */
    public function __construct(string $field, string $operator, string $value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
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
            'field'    => $this->field,
            'operator' => $this->operator,
            'value'    => $this->value
        ];
    }
}