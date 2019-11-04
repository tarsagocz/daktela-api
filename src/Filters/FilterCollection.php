<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:05 01.11.2019
 */

namespace Daktela\Filters;

class FilterCollection extends AbstractFilter
{
    /**
     * @var string
     */
    protected $logic;
    /**
     * @var AbstractFilter[]
     */
    protected $filters = [];

    /**
     * CollectionFiltering constructor.
     * @param string $logic
     * @param array $filters
     */
    public function __construct(string $logic, array $filters = [])
    {
        $this->logic = $logic;
        $this->filters = $filters;
    }

    public function add($filter)
    {
        $this->filters[] = $filter;
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
        $filters = [];
        foreach ($this->filters as $filter) {
            $filter[] = $filter->jsonSerialize();
        }
        return [
            'logic' => $this->logic,
            'filters' => $filters
        ];
    }
}