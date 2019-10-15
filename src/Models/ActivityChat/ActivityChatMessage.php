<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:57 14.10.2019
 */

namespace Daktela\Models\ActivityChat;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\User\User;

class ActivityChatMessage extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'activitiesChatMessages';
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $text;
    /**
     * @var string|null
     */
    protected $result;
    /**
     * @var string|null
     */
    protected $direction;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var Carbon
     */
    protected $time;

    protected $user;
    protected $chat;

    /**
     * ActivityChatMessage constructor.
     * @param null|string $name
     * @param null|string $text
     * @param null|string $result
     * @param null|string $direction
     * @param string $type
     * @param Carbon $time
     */
    public function __construct(?string $name, ?string $text, ?string $result, ?string $direction, string $type, Carbon $time)
    {
        $this->name = $name;
        $this->text = $text;
        $this->result = $result;
        $this->direction = $direction;
        $this->type = $type;
        $this->time = $time;
    }

    /**
     * @param array $row
     * @return ActivityChatMessage
     */
    public static function createFromRow(array $row): ActivityChatMessage
    {
        $model = new self(self::optionalProperty('name', $row), self::optionalProperty('text', $row), self::optionalProperty('result', $row), self::optionalProperty('direction', $row), self::optionalProperty('type', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null);
        if (is_array($row['user'])) {
            $model->user = User::createFromRow($row['user']);
        } else {
            $model->user = $row['user'];
        }

        if (is_array($row['chat'])) {
            $model->chat = ActivityChat::createFromRow($row['chat']);
        } else {
            $model->chat = $row['chat'];
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
            'name'      => $this->name,
            'text'      => $this->text,
            'result'    => $this->result,
            'direction' => $this->direction,
            'type'      => $this->type,
            'time'      => $this->time
        ];
    }
}