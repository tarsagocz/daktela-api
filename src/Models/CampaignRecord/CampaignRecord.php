<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:10 16.08.2019
 */

namespace Daktela\Models\CampaignRecord;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\Activity\ActivitableTrait;
use Daktela\Models\Database\Database;
use Daktela\Models\FetchableTrait;
use Daktela\Models\OptionableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Status\StatusableTrait;
use Daktela\Models\User\User;

class CampaignRecord extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use OptionableTrait;
    use StatusableTrait;
    use ActivitableTrait;
    use Snapshotable;
    const MODEL = 'campaignsRecords';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string Phone number [required]
     */
    protected $number;
    /**
     * @var string|null Display name
     */
    protected $title;
    /**
     * @var Carbon|null Date of the next call
     */
    protected $nextcall;
    /**
     * @var string Type of action [required]
     */
    protected $action;
    /**
     * @var string|null ID of the call
     */
    protected $call_id;
    /**
     * @var string|null Name of activity
     */
    protected $activity;
    /**
     * @var Carbon|null Date of the last change
     */
    protected $edited;
    /**
     * @var Carbon|null Date of creation
     */
    protected $created;

    protected $queue;
    protected $user;
    protected $database;
    protected $customFields = [];

    /**
     * CampaignRecord constructor.
     * @param null|string $name
     * @param string $number
     * @param null|string $title
     * @param Carbon|null $nextcall
     * @param string $action
     * @param null|string $call_id
     * @param null|string $activity
     * @param Carbon|null $edited
     * @param Carbon|null $created
     */
    public function __construct(?string $name, string $number, ?string $title, ?Carbon $nextcall, string $action, ?string $call_id, ?string $activity, ?Carbon $edited, ?Carbon $created)
    {
        $this->name = $name;
        $this->number = $number;
        $this->title = $title;
        $this->nextcall = $nextcall;
        $this->action = $action;
        $this->call_id = $call_id;
        $this->activity = $activity;
        $this->edited = $edited;
        $this->created = $created;
    }

    /**
     * @param array $row
     * @return CampaignRecord
     */
    public static function createFromRow(array $row): CampaignRecord
    {
        $model = new self(self::optionalProperty('name', $row), $row['number'], self::optionalProperty('title', $row), self::isPropertyExist('next_call', $row) ? new Carbon($row['next_call']) : null, self::optionalProperty('action', $row), self::optionalProperty('call_id', $row), self::optionalProperty('activity', $row), self::isPropertyExist('edited', $row) ? new Carbon($row['edited']) : null, self::isPropertyExist('created', $row) ? new Carbon($row['created']) : null);

        if ($model->isOptionable($row)) {
            $model->setOptions($row['options']);
        }

        self::setModel($row, 'queue', $model, Queue::class);
        self::setModel($row, 'user', $model, User::class);
        self::setModel($row, 'database', $model, Database::class);

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

    public function database()
    {
        if (is_string($this->database)) {
            $this->database = Database::read($this->database);
        }

        return $this->database;
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
            'name'     => $this->name,
            'number'   => $this->number,
            'title'    => $this->title,
            'nextcall' => $this->nextcall,
            'action'   => $this->action,
            'call_id'  => $this->call_id,
            'activity' => $this->activity,
            'edited'   => $this->edited,
            'created'  => $this->created
        ];
    }

    /**
     * @return array
     */
    public function getCustomFields(): array
    {
        return $this->customFields;
    }
}