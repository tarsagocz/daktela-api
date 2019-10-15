<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:50 09.10.2019
 */

namespace Daktela\Models\Account;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class AccountSnapshot extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'accountsSnapshots';
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var bool|string
     */
    protected $deleted;
    /**
     * @var Carbon|null
     */
    protected $time;

    /**
     * AccountSnapshot constructor.
     * @param string $title
     * @param null|string $description
     * @param bool|string $deleted
     * @param Carbon|null $time
     */
    public function __construct(string $title, ?string $description, $deleted, ?Carbon $time)
    {
        $this->title = $title;
        $this->description = $description;
        $this->deleted = $deleted;
        $this->time = $time;
    }

    /**
     * @param array $row
     * @return AccountSnapshot
     */
    public static function createFromRow(array $row): AccountSnapshot
    {
        $model = new self($row['title'], self::optionalProperty('description', $row), self::optionalProperty('deleted', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null);
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
            'title'       => $this->title,
            'description' => $this->description,
            'deleted'     => $this->deleted,
            'time'        => $this->time
        ];
    }
}