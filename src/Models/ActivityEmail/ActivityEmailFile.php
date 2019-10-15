<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:25 14.10.2019
 */

namespace Daktela\Models\ActivityEmail;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class ActivityEmailFile extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'activitiesEmailFiles';
    /**
     * @var string|null
     */
    protected $inline;
    /**
     * @var string|null
     */
    protected $cid;
    /**
     * @var string|null
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $type;
    /**
     * @var int|null
     */
    protected $size;
    /**
     * @var Carbon|null
     */
    protected $time;

    /**
     * ActivityEmailFile constructor.
     * @param null|string $inline
     * @param null|string $cid
     * @param null|string $title
     * @param null|string $type
     * @param int|null $size
     * @param Carbon|null $time
     */
    public function __construct(?string $inline, ?string $cid, ?string $title, ?string $type, ?int $size, ?Carbon $time)
    {
        $this->inline = $inline;
        $this->cid = $cid;
        $this->title = $title;
        $this->type = $type;
        $this->size = $size;
        $this->time = $time;
    }

    /**
     * @param array $row
     * @return ActivityEmailFile
     */
    public static function createFromRow(array $row): ActivityEmailFile
    {
        $model = new self(self::optionalProperty('inline', $row), self::optionalProperty('cid', $row), self::optionalProperty('title', $row), self::optionalProperty('type', $row), self::optionalProperty('size', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null);

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
        return [
            'inline' => $this->inline,
            'cid'    => $this->cid,
            'title'  => $this->title,
            'type'   => $this->type,
            'size'   => $this->size,
            'time'   => $this->time
        ];
    }
}