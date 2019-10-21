<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:26 16.08.2019
 */

namespace Daktela\Models\ActivityChat;

use Carbon\Carbon;
use Daktela\Models\Activity\ActivitableTrait;
use Daktela\Models\Activity\Activity;
use Daktela\Models\ActivityAny\ActivityAny;
use Daktela\Models\Contact\Contact;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;
use Daktela\Models\User\User;

class ActivityChat extends ActivityAny
{
    use FetchableTrait;
    use ReadableTrait;
    use ActivitableTrait;
    use ActivityChatMessagableTrait;
    const MODEL = 'activitiesChat';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string|null Name of customer
     */
    protected $title;
    /**
     * @var string|null Email of customer
     */
    protected $email;
    /**
     * @var string|null Phone of customer
     */
    protected $phone;
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
     * @var Carbon|null Time of creating
     */
    protected $time;
    /**
     * @var string|null Mark if web chat is missed
     */
    protected $missed;
    /**
     * @var Carbon|null Time when missed web chat
     */
    protected $missed_time;
    protected $queue = null;
    protected $user = null;
    protected $contact = null;

    /**
     * ActivityChat constructor.
     * @param null|string $name
     * @param null|string $title
     * @param null|string $email
     * @param null|string $phone
     * @param int|null $wait_time
     * @param int|null $duration
     * @param bool|null $answered
     * @param null|string $disconnection
     * @param Carbon|null $time
     * @param null|string $missed
     * @param Carbon|null $missed_time
     */
    public function __construct(?string $name, ?string $title, ?string $email, ?string $phone, ?int $wait_time, ?int $duration, ?bool $answered, ?string $disconnection, ?Carbon $time, ?string $missed, ?Carbon $missed_time)
    {
        $this->name = $name;
        $this->title = $title;
        $this->email = $email;
        $this->phone = $phone;
        $this->wait_time = $wait_time;
        $this->duration = $duration;
        $this->answered = $answered;
        $this->disconnection = $disconnection;
        $this->time = $time;
        $this->missed = $missed;
        $this->missed_time = $missed_time;
    }

    /**
     * @param array $row
     * @return ActivityChat
     */
    public static function createFromRow(array $row): ActivityChat
    {
        $activity = new self(self::optionalProperty('name', $row), self::optionalProperty('title', $row), self::optionalProperty('email', $row), self::optionalProperty('phone', $row), self::optionalProperty('wait_time', $row), self::optionalProperty('duration', $row), self::optionalProperty('answered', $row), self::optionalProperty('disconnection', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null, self::optionalProperty('missed', $row), self::isPropertyExist('missed_time', $row) ? new Carbon($row['missed_time']) : null);

        if ($activity->isOptionable($row)) {
            $activity->setOptions($row['options']);
        }

        self::setModel($row, 'queue', $activity, Queue::class);
        self::setModel($row, 'user', $activity, User::class);
        self::setModel($row, 'contact', $activity, Contact::class);
        self::setModels($row, 'activities', $activity, Activity::class);

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
            'title'         => $this->title,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'wait_time'     => $this->wait_time,
            'duration'      => $this->duration,
            'answered'      => $this->answered,
            'disconnection' => $this->disconnection,
            'time'          => $this->time,
            'missed'        => $this->missed,
            'missed_time'   => $this->missed_time
        ];
    }
}