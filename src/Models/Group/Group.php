<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:17 16.08.2019
 */

namespace Daktela\Models\Group;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\ReadableTrait;

class Group extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use ProfilableTrait;
    const MODEL = 'groups';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string Display name
     */
    protected $title;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var string Type of the group
     */
    protected $type;
    /**
     * @var bool|null Deleted flag
     */
    protected $deleted;

    protected $membersName = [];

    /**
     * Group constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $description
     * @param string $type
     * @param bool|null $deleted
     */
    public function __construct(?string $name, string $title, ?string $description, string $type, ?bool $deleted)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->deleted = $deleted;
    }

    /**
     * @param array $row
     * @return Group
     */
    public static function createFromRow(array $row): Group
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row), $row['type'], self::optionalProperty('deleted', $row));
        $model->membersName = $row['membersName'];
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
            'name'        => $this->name,
            'title'       => $this->title,
            'description' => $this->description,
            'type'        => $this->type,
            'deleted'     => $this->deleted
        ];
    }
}