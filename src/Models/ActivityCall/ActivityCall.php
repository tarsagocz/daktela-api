<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:52 16.08.2019
 */

namespace Daktela\Models\ActivityCall;

use Carbon\Carbon;
use Daktela\Models\Activity\ActivitableTrait;
use Daktela\Models\Activity\Activity;
use Daktela\Models\ActivityAny\ActivityAny;
use Daktela\Models\CampaignRecord\CampaignRecord;
use Daktela\Models\Contact\Contact;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Status\Status;
use Daktela\Models\Transcript\Transcript;
use Daktela\Models\Transcript\TranscriptableTrait;
use Daktela\Models\User\User;

class ActivityCall extends ActivityAny
{
    use FetchableTrait;
    use ReadableTrait;
    use ActivitableTrait;
    use ActivityCallChannelableTrait;
    use TranscriptableTrait;
    const MODEL = 'activitiesCall';
    /**
     * @var string|null Unique number of call
     */
    protected $id_call;
    /**
     * @var Carbon|null Call time
     */
    protected $call_time;
    /**
     * @var string|null If activity come in from customer or out from operator
     */
    protected $direction;
    /**
     * @var bool|null Mark if call was answered
     */
    protected $answered;
    /**
     * @var string|null CLID (Caller identification)
     */
    protected $clid;
    /**
     * @var string|null Customer prefix Caller identification
     */
    protected $prefix_clid_name;
    /**
     * @var string|null DID (Direct inward dialing)
     */
    protected $did;
    /**
     * @var integer|null Total waiting time in queue
     */
    protected $waiting_time;
    /**
     * @var integer|null Last ringing time
     */
    protected $ringing_time;
    /**
     * @var integer|null How long operator wait on call from dialer
     */
    protected $dialer_time;
    /**
     * @var integer|null Sum of hold time
     */
    protected $hold_time;
    /**
     * @var integer|null Duration of answered call
     */
    protected $duration;
    /**
     * @var integer|null Position in queue, when call entered to queue
     */
    protected $orig_pos;
    /**
     * @var integer|null Position in queue, when call leave queue or was answered
     */
    protected $position;
    /**
     * @var string|null Who hangup call
     */
    protected $disposition_cause;
    /**
     * @var string|null Way of hangup call
     */
    protected $disconnection_cause;
    /**
     * @var integer|null Pressed key in queue
     */
    protected $pressed_key;
    /**
     * @var integer|null Mark if call is missed
     */
    protected $missed_call;
    /**
     * @var Carbon|null Time when missed call was call back
     */
    protected $missed_call_time;
    /**
     * @var integer|null
     */
    protected $attempts;
    /**
     * @var integer|null Total score of QA
     */
    protected $score;
    /**
     * @var string|null Note from QA
     */
    protected $note;

    protected $queue = null;
    protected $agent = null;
    protected $contact = null;

    /**
     * ActivityCall constructor.
     * @param null|string $id_call
     * @param Carbon|null $call_time
     * @param null|string $direction
     * @param bool|null $answered
     * @param null|string $clid
     * @param null|string $prefix_clid_name
     * @param null|string $did
     * @param int|null $waiting_time
     * @param int|null $ringing_time
     * @param int|null $dialer_time
     * @param int|null $hold_time
     * @param int|null $duration
     * @param int|null $orig_pos
     * @param int|null $position
     * @param null|string $disposition_cause
     * @param null|string $disconnection_cause
     * @param int|null $pressed_key
     * @param int|null $missed_call
     * @param Carbon|null $missed_call_time
     * @param int|null $attempts
     * @param int|null $score
     * @param null|string $note
     */
    public function __construct(?string $id_call, ?Carbon $call_time, ?string $direction, ?bool $answered, ?string $clid, ?string $prefix_clid_name, ?string $did, ?int $waiting_time, ?int $ringing_time, ?int $dialer_time, ?int $hold_time, ?int $duration, ?int $orig_pos, ?int $position, ?string $disposition_cause, ?string $disconnection_cause, ?int $pressed_key, ?int $missed_call, ?Carbon $missed_call_time, ?int $attempts, ?int $score, ?string $note)
    {
        $this->id_call = $id_call;
        $this->call_time = $call_time;
        $this->direction = $direction;
        $this->answered = $answered;
        $this->clid = $clid;
        $this->prefix_clid_name = $prefix_clid_name;
        $this->did = $did;
        $this->waiting_time = $waiting_time;
        $this->ringing_time = $ringing_time;
        $this->dialer_time = $dialer_time;
        $this->hold_time = $hold_time;
        $this->duration = $duration;
        $this->orig_pos = $orig_pos;
        $this->position = $position;
        $this->disposition_cause = $disposition_cause;
        $this->disconnection_cause = $disconnection_cause;
        $this->pressed_key = $pressed_key;
        $this->missed_call = $missed_call;
        $this->missed_call_time = $missed_call_time;
        $this->attempts = $attempts;
        $this->score = $score;
        $this->note = $note;
    }

    /**
     * @param array $row
     * @return ActivityCall
     */
    public static function createFromRow(array $row): ActivityCall
    {
        $activity = new self(self::optionalProperty('id_call', $row), self::isPropertyExist('call_time', $row) ? new Carbon($row['call_time']) : null, self::optionalProperty('direction', $row), self::optionalProperty('answered', $row), self::optionalProperty('clid', $row), self::optionalProperty('prefix_clid_name', $row), self::optionalProperty('did', $row),
            self::optionalProperty('waiting_time', $row), self::optionalProperty('ringing_time', $row), self::optionalProperty('dialer_time', $row), self::optionalProperty('hold_time', $row),
            self::optionalProperty('duration', $row), self::optionalProperty('orig_pos', $row), self::optionalProperty('position', $row), self::optionalProperty('disposition_cause', $row), self::optionalProperty('disconnection_cause', $row),
            self::optionalProperty('pressed_key', $row), self::optionalProperty('missed_call', $row), self::isPropertyExist('missed_call_time', $row) ? new Carbon($row['missed_call_time']) : null,
            self::optionalProperty('attempts', $row), self::optionalProperty('score', $row), self::optionalProperty('note', $row));

        if ($activity->isOptionable($row)) {
            $activity->setOptions($row['options']);
        }

        self::setModel($row, 'id_queue', $activity, Queue::class, 'queue');
        self::setModel($row, 'id_agent', $activity, User::class, 'agent');
        self::setModel($row, 'contact', $activity, Contact::class);
        self::setModels($row, 'activities', $activity, Activity::class);
        self::setModels($row, 'channels', $activity, ActivityCallChannel::class);
        self::setModels($row, 'transcripts', $activity, Transcript::class);

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
        if (is_string($this->agent)) {
            $this->agent = User::read($this->agent);
        }

        return $this->agent;
    }

    public function contact()
    {
        if (is_string($this->contact)) {
            $this->contact = Contact::read($this->contact);
        }

        return $this->contact;
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
            'id_call'             => $this->id_call,
            'call_time'           => $this->call_time,
            'direction'           => $this->direction,
            'answered'            => $this->answered,
            'clid'                => $this->clid,
            'prefix_clid_name'    => $this->prefix_clid_name,
            'did'                 => $this->did,
            'waiting_time'        => $this->waiting_time,
            'ringing_time'        => $this->ringing_time,
            'dialer_time'         => $this->dialer_time,
            'hold_time'           => $this->hold_time,
            'duration'            => $this->duration,
            'orig_pos'            => $this->orig_pos,
            'position'            => $this->position,
            'disposition_cause'   => $this->disposition_cause,
            'disconnection_cause' => $this->disconnection_cause,
            'pressed_key'         => $this->pressed_key,
            'missed_call'         => $this->missed_call,
            'missed_call_time'    => $this->missed_call_time,
            'attempts'            => $this->attempts,
            'score'               => $this->score,
            'note'                => $this->note
        ];
    }
}