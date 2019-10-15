<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:46 21.08.2019
 */

namespace Daktela\Models\Profile;

use Daktela\AbstractModel;
use Daktela\Connection;
use Daktela\Models\Event\EventableTrait;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Group\GroupableTrait;
use Daktela\Models\OptionableTrait;
use Daktela\Models\Queue\QueuableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Role\RolableTrait;
use Daktela\Models\TicketCategory\TicketCategoriableTrait;
use Daktela\Models\User\User;
use Daktela\Models\User\UserableTrait;
use Daktela\Models\Wallboard\WallboardableTrait;
use Psr\Http\Message\ResponseInterface;

class Profile extends AbstractModel
{
    use OptionableTrait;
    use FetchableTrait;
    use ReadableTrait;
    use GroupableTrait;
    use QueuableTrait;
    use UserableTrait;
    use ProfilableTrait;
    use TicketCategoriableTrait;
    use RolableTrait;
    use WallboardableTrait;
    use EventableTrait;
    const MODEL = 'profiles';
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var int|null Maximum allowed number of concurrently incoming activities
     */
    protected $maxActivities;
    /**
     * @var int|null Maximum allowed number of concurrently open outgoing records
     */
    protected $maxOutRecords;
    /**
     * @var bool|null
     */
    protected $deleteMissedActivity;
    /**
     * @var bool|null
     */
    protected $noQueueCallsAllowed;
    /**
     * @var array
     */
    protected $customViews;

    /**
     * Profile constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $description
     * @param int|null $maxActivities
     * @param int|null $maxOutRecords
     * @param bool|null $deleteMissedActivity
     * @param bool|null $noQueueCallsAllowed
     */
    public function __construct(?string $name, ?string $title, ?string $description, ?int $maxActivities, ?int $maxOutRecords, ?bool $deleteMissedActivity, ?bool $noQueueCallsAllowed)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->maxActivities = $maxActivities;
        $this->maxOutRecords = $maxOutRecords;
        $this->deleteMissedActivity = $deleteMissedActivity;
        $this->noQueueCallsAllowed = $noQueueCallsAllowed;
    }

    public static function createFromRow($row)
    {
        $profile = new self(self::optionalProperty('name', $row), self::optionalProperty('title', $row), self::optionalProperty('description', $row), self::optionalProperty('maxActivities', $row), self::optionalProperty('maxOutRecords', $row), self::optionalProperty('deleteMissedActivity', $row), self::optionalProperty('noQueueCallsAllowed', $row));
        if (self::isPropertyExist('options', $row)) {
            $profile->setOptions($row['options']);
        }
        if (self::isPropertyExist('customViews', $row)) {
            $profile->setCustomViews($row['customViews']);
        }

        return $profile;
    }

    public function setCustomViews($customViews) {
        if (empty($customViews)) {
            $this->customViews = [];
        } else {
            foreach ($customViews as $key => $value) {
                $this->setCustomView($key, $value);
            }
        }
    }

    public function setCustomView($key, $value)
    {
        $this->customViews[$key] = $value;
    }

    public function getCustomView($key)
    {
        if ($this->issetCustomView($key)) {
            return $this->customViews[$key];
        } else {
            return null;
        }
    }

    public function issetCustomView($key)
    {
        return array_key_exists($key, $this->customViews);
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
            'name'                 => $this->name,
            'title'                => $this->title,
            'description'          => $this->description,
            'maxActivities'        => $this->maxActivities,
            'maxOutRecords'        => $this->maxOutRecords,
            'deleteMissedActivity' => $this->deleteMissedActivity,
            'noQueueCallsAllowed'  => $this->noQueueCallsAllowed,
            'customViews'          => $this->customViews
        ];
    }

    protected $assigned_users = null;
    /**
     *
     * @param bool $force
     * @return null
     */
    public function assigned_users($force = false)
    {
        if ($force || is_null($this->assigned_users)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/usersAssigned.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->assigned_users = [];
            foreach ($rows['result']['data'] as $row) {
                $this->assigned_users[] = User::createFromRow($row);
            }
        }

        return $this->assigned_users;
    }
}