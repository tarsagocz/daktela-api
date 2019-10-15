<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:47 21.08.2019
 */

namespace Daktela\Models\Queue;

use Daktela\Models\Profile\Profile;

class QueueProfile extends Profile
{
    /**
     * @var string|null
     */
    protected $login;

    public function __construct(?string $name, string $title, ?string $description, ?int $maxActivities, int $maxOutRecords, ?bool $deleteMissedActivity, ?bool $noQueueCallsAllowed, ?string $login)
    {
        parent::__construct($name, $title, $description, $maxActivities, $maxOutRecords, $deleteMissedActivity, $noQueueCallsAllowed);
        $this->login = $login;
    }

    public static function createFromRow($row)
    {
        $profile = new self(self::isPropertyExist('name', $row) ? $row['name'] : null, $row['title'], self::isPropertyExist('description', $row) ? $row['description'] : null, self::isPropertyExist('maxActivities', $row) ? $row['maxActivities'] : null, self::isPropertyExist('maxOutRecords', $row) ? $row['maxOutRecords'] : null, self::isPropertyExist('deleteMissedActivity', $row) ? $row['deleteMissedActivity'] : null, self::isPropertyExist('noQueueCallsAllowed', $row) ? $row['noQueueCallsAllowed'] : null, self::isPropertyExist('login', $row) ? $row['login'] : null);
        if (array_key_exists('options', $row)) {
            $profile->setOptions($row['options']);
        }
        if (array_key_exists('customViews', $row)) {
            $profile->setCustomViews($row['customViews']);
        }

        return $profile;
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
        return parent::jsonSerialize() + [
                'login' => $this->login
            ];
    }
}