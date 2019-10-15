<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:48 16.08.2019
 */

namespace Daktela\Models\Activity;

use Carbon\Carbon;
use Daktela\Models\ActivityAny\ActivityAny;
use Daktela\Models\ActivityCall\ActivityCall;
use Daktela\Models\ActivityChat\ActivityChat;
use Daktela\Models\ActivityEmail\ActivityEmail;
use Daktela\Models\ActivitySms\ActivitySms;
use Daktela\Models\CampaignRecord\CampaignRecord;
use Daktela\Models\Contact\Contact;
use Daktela\Models\FetchableTrait;
use Daktela\Models\OptionableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Status\Status;
use Daktela\Models\Status\StatusableTrait;
use Daktela\Models\User\User;

class Activity extends ActivityAny
{
    use FetchableTrait;
    use ReadableTrait;
    use ProfilableTrait;
    use OptionableTrait;
    use StatusableTrait;

    const MODEL = 'activities';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string|null Display name
     */
    protected $title;
    /**
     * @var bool|null
     */
    protected $important;
    /**
     * @var string|null Actual state of the activity
     */
    protected $action;
    /**
     * @var string|null Type of the activity
     */
    protected $type;
    /**
     * @var int|null Level of priority
     */
    protected $priority;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var Carbon|null Time of creation
     */
    protected $time;
    /**
     * @var Carbon|null Waiting time
     */
    protected $time_wait;
    /**
     * @var Carbon|null Open time
     */
    protected $time_open;
    /**
     * @var Carbon|null Close time
     */
    protected $time_close;
    /**
     * @var int|null Before activity work time
     */
    protected $baw;
    /**
     * @var int|null After activity work time
     */
    protected $aaw;
    /**
     * @var int|null Duration of activity
     */
    protected $duration;
    /**
     * @var int|null Duration of activity's ringing
     */
    protected $ringing_time;


    protected $queue = null;
    protected $user = null;
    protected $contact = null;
    protected $item = null;
    protected $record = null;

    /**
     * Activity constructor.
     * @param null|string $name
     * @param null|string $title
     * @param bool|null $important
     * @param null|string $action
     * @param null|string $type
     * @param int|null $item
     * @param int|null $priority
     * @param null|string $description
     * @param Carbon|null $time
     * @param Carbon|null $time_wait
     * @param Carbon|null $time_open
     * @param Carbon|null $time_close
     * @param int|null $baw
     * @param int|null $aaw
     * @param int|null $duration
     * @param int|null $ringing_time
     */
    public function __construct(?string $name, ?string $title, ?bool $important, ?string $action, ?string $type, ?int $priority, ?string $description, ?Carbon $time, ?Carbon $time_wait, ?Carbon $time_open, ?Carbon $time_close, ?int $baw, ?int $aaw, ?int $duration, ?int $ringing_time)
    {
        $this->name = $name;
        $this->title = $title;
        $this->important = $important;
        $this->action = $action;
        $this->type = $type;
        $this->priority = $priority;
        $this->description = $description;
        $this->time = $time;
        $this->time_wait = $time_wait;
        $this->time_open = $time_open;
        $this->time_close = $time_close;
        $this->baw = $baw;
        $this->aaw = $aaw;
        $this->duration = $duration;
        $this->ringing_time = $ringing_time;
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
        // TODO: Implement jsonSerialize() method.
    }

    /**
     * @param array $row
     * @return Activity
     */
    public static function createFromRow(array $row): Activity
    {
        $activity = new self(self::optionalProperty('name', $row), self::optionalProperty('title', $row), self::optionalProperty('important', $row), self::optionalProperty('action', $row), self::optionalProperty('type', $row), self::optionalProperty('priority', $row), self::optionalProperty('description', $row),
            self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null, self::isPropertyExist('time_wait', $row) ? new Carbon($row['time_wait']) : null, self::isPropertyExist('time_open', $row) ? new Carbon($row['time_open']) : null, self::isPropertyExist('time_close', $row) ? new Carbon($row['time_close']) : null,
            self::optionalProperty('baw', $row), self::optionalProperty('aaw', $row), self::optionalProperty('duration', $row),
            self::optionalProperty('ringing_time', $row));

        if ($activity->isOptionable($row)) {
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

        if (is_array($row['record'])) {
            $activity->record = CampaignRecord::createFromRow($row['record']);
        } else {
            $activity->record = $row['record'];
        }

        if (is_array($row['statuses'])) {
            foreach ($row['statuses'] as $status) {
                $activity->statuses[] = Status::createFromRow($status);
            }
        } else {
            $activity->contact = $row['statuses'];
        }

        switch ($row['type']) {
            case ActivityTypeEnumeration::CALL:
                $activity->item = ActivityCall::createFromRow($row['item']);
                break;
            case ActivityTypeEnumeration::EMAIL:
                $activity->item = ActivityEmail::createFromRow($row['item']);
                break;
            case ActivityTypeEnumeration::SMS:
                $activity->item = ActivitySms::createFromRow($row['item']);
                break;
            case ActivityTypeEnumeration::WEB_CHAT:
                $activity->item = ActivityChat::createFromRow($row['item']);

        }

        return $activity;
    }

    public function queue()
    {
        if (is_string($this->queue)) {
            $this->queue = Queue::read($this->queue);
        }

        return $this->queue;
    }

    public function user()
    {
        if (is_string($this->user)) {
            $this->user = User::read($this->user);
        }

        return $this->user;
    }

    public function contact()
    {
        if (is_string($this->contact)) {
            $this->contact = Contact::read($this->contact);
        }

        return $this->contact;
    }
}