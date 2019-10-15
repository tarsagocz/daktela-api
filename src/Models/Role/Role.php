<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:16 08.10.2019
 */

namespace Daktela\Models\Role;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\OptionableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\User\UserableTrait;

class Role extends AbstractModel
{
    use OptionableTrait;
    use FetchableTrait;
    use ReadableTrait;
    use ProfilableTrait;
    use UserableTrait;
    const MODEL = 'roles';
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $decription;
    /**
     * @var array
     */
    protected $shortcuts;

    protected $usersCount = null;

    /**
     * Role constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $decription
     * @param array $shortcuts
     */
    public function __construct(?string $name, string $title, ?string $decription, array $shortcuts)
    {
        $this->name = $name;
        $this->title = $title;
        $this->decription = $decription;
        $this->shortcuts = $shortcuts;
    }

    /**
     * @param array $row
     * @return Role
     */
    public static function createFromRow(array $row): Role
    {
        $role = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row), self::isPropertyExist('shortcuts', $row) ? $row['shortcuts'] : []);

        if (self::isPropertyExist('options', $row)) {
            $role->setOptions($row['options']);
        }

        if (self::isPropertyExist('usersCount', $row)) {
            $role->usersCount = $row['usersCount'];
        }

        return $role;
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
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->decription,
            'shortcuts' => $this->shortcuts
        ];
    }
}