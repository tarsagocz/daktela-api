<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:14 16.08.2019
 */

namespace Daktela\Models\ActivityEmail;

use Carbon\Carbon;
use Daktela\Models\Activity\ActivitableTrait;
use Daktela\Models\Activity\Activity;
use Daktela\Models\ActivityAny\ActivityAny;
use Daktela\Models\Contact\Contact;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;
use Daktela\Models\User\User;

class ActivityEmail extends ActivityAny
{
    use FetchableTrait;
    use ReadableTrait;
    use ActivitableTrait;
    use ActivityEmailFilableTrait;
    const MODEL = 'activitiesEmail';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string|null Subject of email
     */
    protected $title;
    /**
     * @var string|null Sender's or recipient's email address
     */
    protected $address;
    /**
     * @var string|null If activity come in from customer or out from operator
     */
    protected $direction;
    /**
     * @var integer|null Total waiting time in queue
     */
    protected $wait_time;
    /**
     * @var integer|null Tim in seconds of creating email
     */
    protected $duration;
    /**
     * @var bool|null Mark if email was answered
     */
    protected $answered;
    /**
     * @var string|null HTML body
     */
    protected $text;
    /**
     * @var Carbon|null Email time
     */
    protected $time;
    /**
     * @var string|null Email sent status SUCCESS|FAILED|WAITING
     */
    protected $result;

    protected $user;

    /**
     * ActivityEmail constructor.
     * @param null|string $name
     * @param null|string $title
     * @param null|string $address
     * @param null|string $direction
     * @param int|null $wait_time
     * @param int|null $duration
     * @param bool|null $answered
     * @param null|string $text
     * @param Carbon|null $time
     * @param null|string $result
     */
    public function __construct(?string $name, ?string $title, ?string $address, ?string $direction, ?int $wait_time, ?int $duration, ?bool $answered, ?string $text, ?Carbon $time, ?string $result)
    {
        $this->name = $name;
        $this->title = $title;
        $this->address = $address;
        $this->direction = $direction;
        $this->wait_time = $wait_time;
        $this->duration = $duration;
        $this->answered = $answered;
        $this->text = $text;
        $this->time = $time;
        $this->result = $result;
    }

    /**
     * @param array $row
     * @return ActivityEmail
     */
    public static function createFromRow(array $row): ActivityEmail
    {
        var_dump($row);
        $activity = new self(self::optionalProperty('name', $row), self::optionalProperty('title', $row), self::optionalProperty('address', $row), self::optionalProperty('direction', $row), self::optionalProperty('wait_time', $row), self::optionalProperty('duration', $row), self::optionalProperty('answered', $row), self::optionalProperty('text', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null, self::optionalProperty('result', $row));

        if ($activity->isOptionable($row)) {
            $activity->setOptions($row['options']);
        }

        self::setModel($row, 'queue', $activity, Queue::class);
        self::setModel($row, 'user', $activity, User::class);
        self::setModel($row, 'contact', $activity, Contact::class);
        self::setModel($row, 'activities', $activity, Activity::class);
        self::setModel($row, 'files', $activity, ActivityEmailFile::class);

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
            'name'      => $this->name,
            'title'     => $this->title,
            'address'   => $this->address,
            'direction' => $this->direction,
            'wait_time' => $this->wait_time,
            'duration'  => $this->duration,
            'answered'  => $this->answered,
            'text'      => $this->text,
            'time'      => $this->time,
            'result'    => $this->result
        ];
    }
}