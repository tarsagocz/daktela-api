<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:39 15.10.2019
 */

namespace Daktela\Models\CampaignRecord;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Status\Status;
use Daktela\Models\Status\StatusableTrait;
use Daktela\Models\User\User;

class Snapshot extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use StatusableTrait;
    const MODEL = 'campaignsRecordsSnapshots';
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $number;
    /**
     * @var string|null
     */
    protected $nextcall;
    /**
     * @var int|null
     */
    protected $action;
    /**
     * @var string|null
     */
    protected $activity;
    /**
     * @var string|null
     */
    protected $call_id;
    /**
     * @var Carbon|null
     */
    protected $time;

    protected $record;
    protected $queue;
    protected $user;
    protected $created_by;
    protected $customFields = [];

    /**
     * Snapshot constructor.
     * @param string $title
     * @param null|string $number
     * @param null|string $nextcall
     * @param int|null $action
     * @param null|string $activity
     * @param null|string $call_id
     * @param Carbon|null $time
     */
    public function __construct(string $title, ?string $number, ?string $nextcall, ?int $action, ?string $activity, ?string $call_id, ?Carbon $time)
    {
        $this->title = $title;
        $this->number = $number;
        $this->nextcall = $nextcall;
        $this->action = $action;
        $this->activity = $activity;
        $this->call_id = $call_id;
        $this->time = $time;
    }

    /**
     * @param array $row
     * @return Snapshot
     */
    public static function createFromRow(array $row): Snapshot
    {
        $model = new self($row['title'], self::optionalProperty('number', $row), self::optionalProperty('nextcall', $row), self::optionalProperty('action', $row), self::optionalProperty('activity', $row), self::optionalProperty('call_id', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null);

        self::setModel($row, 'queue', $model, Queue::class);
        self::setModel($row, 'user', $model, User::class);
        self::setModel($row, 'created_by', $model, User::class);
        self::setModel($row, 'record', $model, CampaignRecord::class);
        self::setModels($row, 'statuses', $model, Status::class);

        if (is_array($row['customFields'])) {
            foreach ($row['customFields'] as $key => $cf) {
                $model->customFields[$key] = $cf;
            }
        }

        return $model;
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
            'title' => $this->title,
            'number' => $this->number,
            'nextcall' => $this->nextcall,
            'action' => $this->action,
            'activity' => $this->activity,
            'call_id' => $this->call_id,
            'time' => $this->time
        ];
    }
}