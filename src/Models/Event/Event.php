<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:18 10.10.2019
 */

namespace Daktela\Models\Event;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\ReadableTrait;

class Event extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use ProfilableTrait;
    const MODEL = 'events';
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $event2;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var string|null
     */
    protected $step;
    /**
     * @var Carbon|null
     */
    protected $timeout;
    /**
     * @var Carbon|null
     */
    protected $time;
    /**
     * @var bool|null
     */
    protected $deleted;
    /**
     * @var bool|null
     */
    protected $active;
    /**
     * @var array|null
     */
    protected $minute;
    /**
     * @var array|null
     */
    protected $hour;
    /**
     * @var array|null
     */
    protected $dom;
    /**
     * @var array|null
     */
    protected $month;
    /**
     * @var array|null
     */
    protected $dow;

    /**
     * Event constructor.
     * @param null|string $name
     * @param null|string $event2
     * @param string $type
     * @param string $title
     * @param null|string $description
     * @param null|string $step
     * @param Carbon|null $timeout
     * @param Carbon|null $time
     * @param bool|null $deleted
     * @param bool|null $active
     * @param array|null $minute
     * @param array|null $hour
     * @param array|null $dom
     * @param array|null $month
     * @param array|null $dow
     */
    public function __construct(?string $name, ?string $event2, string $type, string $title, ?string $description, ?string $step, ?Carbon $timeout, ?Carbon $time, ?bool $deleted, ?bool $active, ?array $minute, ?array $hour, ?array $dom, ?array $month, ?array $dow)
    {
        $this->name = $name;
        $this->event2 = $event2;
        $this->type = $type;
        $this->title = $title;
        $this->description = $description;
        $this->step = $step;
        $this->timeout = $timeout;
        $this->time = $time;
        $this->deleted = $deleted;
        $this->active = $active;
        $this->minute = $minute;
        $this->hour = $hour;
        $this->dom = $dom;
        $this->month = $month;
        $this->dow = $dow;
    }

    /**
     * @param array $row
     * @return Event
     */
    public static function createFromRow(array $row): Event
    {
        return new self(self::optionalProperty('name', $row), self::optionalProperty('event2', $row), $row['type'], $row['title'], self::optionalProperty('description', $row), self::optionalProperty('step', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null, self::isPropertyExist('timeout', $row) ? new Carbon($row['timeout']) : null, self::optionalProperty('deleted', $row), self::optionalProperty('active', $row), self::optionalProperty('minute', $row), self::optionalProperty('hour', $row), self::optionalProperty('dom', $row), self::optionalProperty('month', $row), self::optionalProperty('dow', $row));
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
            'name'        => $this->name,
            'event2'      => $this->event2,
            'type'        => $this->type,
            'description' => $this->description,
            'step'        => $this->step,
            'timeout'     => $this->timeout,
            'time'        => $this->time,
            'deleted'     => $this->deleted,
            'active'      => $this->active,
            'minute'      => $this->minute,
            'hour'        => $this->hour,
            'dom'         => $this->dom,
            'month'       => $this->month,
            'dow'         => $this->dow
        ];
    }
}