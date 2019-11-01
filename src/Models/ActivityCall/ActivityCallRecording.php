<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 9:28 22.10.2019
 */

namespace Daktela\Models\ActivityCall;

use Daktela\AbstractModel;
use Daktela\Models\Activity\Activity;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Pause\Pause;
use Daktela\Models\ReadableTrait;

class ActivityCallRecording extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'activitiesCallRecordings';
    /**
     * @var string|null
     */
    protected $recording;
    /**
     * @var string|null
     */
    protected $id_call;
    /**
     * @var string|null
     */
    protected $path;
    /**
     * @var string|null
     */
    protected $status;

    /**
     * ActivityCallRecording constructor.
     * @param string|null $recording
     * @param string|null $id_call
     * @param string|null $path
     * @param string|null $status
     */
    public function __construct(?string $recording, ?string $id_call, ?string $path, ?string $status)
    {
        $this->recording = $recording;
        $this->id_call = $id_call;
        $this->path = $path;
        $this->status = $status;
    }

    /**
     * @param array $row
     * @return ActivityCallRecording
     */
    public static function createFromRow(array $row): ActivityCallRecording
    {
        $model = new self(self::optionalProperty('recording', $row), self::optionalProperty('id_call', $row), self::optionalProperty('path', $row), self::optionalProperty('status', $row));
        self::setModel($row, 'activity', $model, Activity::class);

        return  $model;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'recording' => $this->recording,
            'id_call'   => $this->id_call,
            'path'      => $this->path,
            'status'    => $this->status
        ];
    }
}