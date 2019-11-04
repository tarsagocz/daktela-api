<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:36 01.11.2019
 */

namespace Daktela\Filters;

class Paginator extends AbstractFilter
{
    /**
     * @var int
     */
    protected $skip;
    /**
     * @var int
     */
    protected $take;

    /**
     * Paginating constructor.
     * @param int $skip
     * @param int $take
     */
    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
    }

    public static function createFromPage($page = 0, $take = 1000)
    {
        return new static($page * 1000, $take);
    }

    public function previous()
    {
        if ($this->skip == 0) {
            return $this;
        }
        $skip = $this->skip - $this->take;

        if ($skip < 0) {
            $skip = 0;
        }

        return new Paginator($skip, $this->take);
    }

    public function next()
    {
        $skip = $this->skip + $this->take;
        return new Paginator($skip, $this->take);
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
            'skip' => $this->skip,
            'take' => $this->take
        ];
    }
}