<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:04 16.08.2019
 */

namespace Daktela\Models\CrmRecord;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class CrmRecord extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'crmRecords';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string Custom name
     */
    protected $title;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var bool|null Deleted flag
     */
    protected $deleted;
    /**
     * @var Carbon Created date
     */
    protected $created;
    /**
     * @var Carbon|null Last modified date
     */
    protected $edited;
    /**
     * @var string OPEN, CLOSE
     */
    protected $stage;

    /**
     * CrmRecord constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $description
     * @param bool|null $deleted
     * @param Carbon $created
     * @param Carbon|null $edited
     * @param string $stage
     */
    public function __construct(?string $name, string $title, ?string $description, ?bool $deleted, Carbon $created, ?Carbon $edited, string $stage)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->deleted = $deleted;
        $this->created = $created;
        $this->edited = $edited;
        $this->stage = $stage;
    }

    /**
     * @param array $row
     * @return CrmRecord
     */
    public static function createFromRow(array $row): CrmRecord
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row), self::optionalProperty('deleted', $row), self::isPropertyExist('created', $row) ? new Carbon($row['created']) : null, self::isPropertyExist('edited', $row) ? new Carbon($row['edited']) : null, $row['stage']);
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
            'deleted'     => $this->deleted,
            'created'     => $this->created,
            'edited'      => $this->edited,
            'state'       => $this->stage
        ];
    }
}