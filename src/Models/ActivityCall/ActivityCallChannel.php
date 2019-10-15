<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:32 14.10.2019
 */

namespace Daktela\Models\ActivityCall;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\Activity\Activity;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class ActivityCallChannel extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'activitiesCallChannels';
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $app;
    /**
     * @var string|null
     */
    protected $clid;
    /**
     * @var string|null
     */
    protected $channel;
    /**
     * @var string|null
     */
    protected $bridge;
    /**
     * @var string|null
     */
    protected $state;
    /**
     * @var Carbon|null
     */
    protected $time_closed;
    /**
     * @var Carbon|null
     */
    protected $time_ringing;
    /**
     * @var Carbon|null
     */
    protected $time_speaking;
    /**
     * @var int|null
     */
    protected $cause;
    /**
     * @var int|null
     */
    protected $mosRx;
    /**
     * @var int|null
     */
    protected $mosTx;
    /**
     * @var string|null
     */
    protected $label;


    protected $call;

    /**
     * ActivityCallChannel constructor.
     * @param null|string $name
     * @param null|string $app
     * @param null|string $clid
     * @param null|string $channel
     * @param null|string $bridge
     * @param null|string $state
     * @param Carbon|null $time_closed
     * @param Carbon|null $time_ringing
     * @param Carbon|null $time_speaking
     * @param int|null $cause
     * @param int|null $mosRx
     * @param int|null $mosTx
     */
    public function __construct(?string $name, ?string $app, ?string $clid, ?string $channel, ?string $bridge, ?string $state, ?Carbon $time_closed, ?Carbon $time_ringing, ?Carbon $time_speaking, ?int $cause, ?int $mosRx, ?int $mosTx, ?string $label)
    {
        $this->name = $name;
        $this->app = $app;
        $this->clid = $clid;
        $this->channel = $channel;
        $this->bridge = $bridge;
        $this->state = $state;
        $this->time_closed = $time_closed;
        $this->time_ringing = $time_ringing;
        $this->time_speaking = $time_speaking;
        $this->cause = $cause;
        $this->mosRx = $mosRx;
        $this->mosTx = $mosTx;
        $this->label = $label;
    }

    /**
     * @param array $row
     * @return ActivityCallChannel
     */
    public static function createFromRow(array $row): ActivityCallChannel
    {
        $model = new self(self::optionalProperty('name', $row), self::optionalProperty('app', $row), self::optionalProperty('clid', $row), self::optionalProperty('channel', $row), self::optionalProperty('bridge', $row),
            self::optionalProperty('state', $row), self::isPropertyExist('time_closed', $row) ? new Carbon($row['time_closed']) : null, self::isPropertyExist('time_ringing', $row) ? new Carbon($row['time_ringing']) : null,
            self::isPropertyExist('time_speaking', $row) ? new Carbon($row['time_speaking']) : null, self::optionalProperty('cause', $row), self::optionalProperty('mosRx', $row), self::optionalProperty('mosTx', $row), self::optionalProperty('label', $row));

        if (is_array($row['call'])) {
            $model->call = ActivityCall::createFromRow($row['call']);
        } else {
            $model->call = $row['call'];
        }

        if (is_array($row['activity'])) {
            $model->activity = Activity::createFromRow($row['activity']);
        } else {
            $model->activity = $row['activity'];
        }

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
            'name'          => $this->name,
            'app'           => $this->app,
            'clid'          => $this->clid,
            'channel'       => $this->channel,
            'bridge'        => $this->bridge,
            'state'         => $this->state,
            'time_closed'   => $this->time_closed,
            'time_ringing'  => $this->time_ringing,
            'time_speaking' => $this->time_speaking,
            'cause'         => $this->cause,
            'mosRx'         => $this->mosRx,
            'mosTx'         => $this->mosTx
        ];
    }
}