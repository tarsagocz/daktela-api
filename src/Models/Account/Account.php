<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:57 16.08.2019
 */

namespace Daktela\Models\Account;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\Contact\ContactableTrait;
use Daktela\Models\CrmRecord\CrmRecordableTrait;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Ticket\TicketableTrait;

class Account extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use ContactableTrait;
    use CrmRecordableTrait;
    use TicketableTrait;
    use AccountSnapshotableTrait;
    const MODEL = 'accounts';
    /**
     * @var string Unique name
     */
    protected $name;
    /**
     * @var string Display name
     */
    protected $title;
    /**
     * @var string Optional description
     */
    protected $description;
    /**
     * @var Carbon Date of creation
     */
    protected $created;
    /**
     * @var Carbon|null Date of last modification
     */
    protected $edited;

    /**
     * Account constructor.
     * @param string $name
     * @param string $title
     * @param string $description
     * @param Carbon $created
     * @param Carbon $edited
     */
    public function __construct(string $name, string $title, string $description, Carbon $created, ?Carbon $edited)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->created = $created;
        $this->edited = $edited;
    }

    /**
     * @param array $row
     * @return Account
     */
    public static function createFromRow(array $row): Account
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row), self::isPropertyExist('created', $row) ? new Carbon($row['created']) : null, self::isPropertyExist('edited', $row) ? new Carbon($row['edited']) : null);
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
            'created'     => $this->created,
            'edited'      => $this->edited
        ];
    }
}