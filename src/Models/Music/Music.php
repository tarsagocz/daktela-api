<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:04 09.10.2019
 */

namespace Daktela\Models\Music;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class Music extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'musics';
    /**
     * @var string
     */
    protected $name;

    /**
     * Music constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function createFromRow($row)
    {
        $model = new self(self::optionalProperty('name', $row));
        return $model;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->name;
    }
}