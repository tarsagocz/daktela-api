<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:37 16.08.2019
 */

namespace Daktela\Models\ActivitySms;

use Carbon\Carbon;
use Daktela\Models\Activity\ActivitableTrait;
use Daktela\Models\Activity\Activity;
use Daktela\Models\ActivityAny\ActivityAny;
use Daktela\Models\Contact\Contact;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;
use Daktela\Models\User\User;

class ActivitySms extends ActivityAny
{
    use FetchableTrait;
    use ReadableTrait;
    use ActivitableTrait;
    const MODEL = 'activitiesSms';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string|null Phone number
     */
    protected $clid;
    /**
     * @var string|null Direction of the chat
     */
    protected $direction;
    /**
     * @var Carbon|null Time of creating
     */
    protected $time;
    /**
     * @var integer|null Total waiting time in queue before chat acceptance
     */
    protected $wait_time;
    /**
     * @var integer|null Duration of chat
     */
    protected $duration;
    /**
     * @var bool|null Mark if chat was answered
     */
    protected $answered;
    /**
     * @var string|null Reason of disconnection
     */
    protected $disconnection;
    /**
     * @var string|null Mark if SMS chat is missed
     */
    protected $missed;
    /**
     * @var Carbon|null Time when missed SMS chat
     */
    protected $missed_time;

    protected $queue = null;
    protected $user = null;
    protected $contact = null;

    /**
     * ActivitySms constructor.
     * @param null|string $name
     * @param null|string $clid
     * @param null|string $direction
     * @param Carbon|null $time
     * @param int|null $wait_time
     * @param int|null $duration
     * @param bool|null $answered
     * @param null|string $disconnection
     * @param null|string $missed
     * @param Carbon|null $missed_time
     */
    public function __construct(?string $name, ?string $clid, ?string $direction, ?Carbon $time, ?int $wait_time, ?int $duration, ?bool $answered, ?string $disconnection, ?string $missed, ?Carbon $missed_time)
    {
        $this->name = $name;
        $this->clid = $clid;
        $this->direction = $direction;
        $this->time = $time;
        $this->wait_time = $wait_time;
        $this->duration = $duration;
        $this->answered = $answered;
        $this->disconnection = $disconnection;
        $this->missed = $missed;
        $this->missed_time = $missed_time;
    }

    /**
     * @param array $row
     * @return ActivitySms
     */
    public static function createFromRow(array $row): ActivitySms
    {
        $activity = new self(self::optionalProperty('name', $row), self::optionalProperty('clid', $row), self::optionalProperty('direction', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null, self::optionalProperty('wait_time', $row), self::optionalProperty('duration', $row), self::optionalProperty('answered', $row), self::optionalProperty('disconnection', $row), self::optionalProperty('missed', $row), self::isPropertyExist('missed_time', $row) ? new Carbon($row['missed_time']) : null);

        if (self::isPropertyExist('options', $row)) {
            $activity->setOptions($row['options']);
        }

        if (is_array($row['queue'])) {
            $activity->queue = Queue::createFromRow($row['queue']);
        } else {
            $activity->queue = $row['queue'];
        }

        if (is_array($row['user'])) {
            $activity->user = User::createFromRow($row['user']);
        } else {
            $activity->user = $row['user'];
        }

        if (is_array($row['contact'])) {
            $activity->contact = Contact::createFromRow($row['contact']);
        } else {
            $activity->contact = $row['contact'];
        }

        if (is_array($row['activities'])) {
            foreach ($row['activities'] as $a) {
                $activity->activities[] = Activity::createFromRow($a);
            }
        } else {
            $activity->activities = $row['activities'];
        }

        return $activity;
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
            'name'          => $this->name,
            'clid'          => $this->clid,
            'direction'     => $this->direction,
            'time'          => $this->time,
            'wait_time'     => $this->wait_time,
            'duration'      => $this->duration,
            'answered'      => $this->answered,
            'disconnection' => $this->disconnection,
            'missed'        => $this->missed,
            'missed_time'   => $this->missed_time
        ];
    }
}