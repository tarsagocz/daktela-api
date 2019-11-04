<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:50 01.11.2019
 */

namespace Daktela\Filters;

class FilterPackage implements \JsonSerializable
{
    /**
     * @var null|Paginator
     */
    protected $paginating = null;
    /**
     * @var Sort[]
     */
    protected $sorting = [];
    /**
     * @var Filter[]
     */
    protected $filtering = [];

    public function add(AbstractFilter $filter)
    {
        switch (get_class($filter)) {
            case Paginator::class:
                $this->paginating = $filter;
                break;
            case Sort::class:
                $this->sorting[] = $filter;
                break;
            case FilterCollection::class:
            case Filter::class:
                $this->filtering[] = $filter;
                break;
        }
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
        $json = [];

        if (!is_null($this->paginating)) {
            $json = $this->paginating->jsonSerialize();
        }

        $sorts = [];
        foreach ($this->sorting as $sorting) {
            $sorts[] = $sorting->jsonSerialize();
        }
        $json['sort'] = $sorts;

        $filters = [];
        foreach ($this->filtering as $filtering) {
            $filters[] = $filtering->jsonSerialize();
        }

        return $json;
    }
}