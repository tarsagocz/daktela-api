<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:26 09.10.2019
 */

namespace Daktela\Models\Contact;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class ContactSnapshot extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'contactsSnapshots';
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var string|null
     */
    protected $firstname;
    /**
     * @var string
     */
    protected $lastname;
    /**
     * @var bool|null
     */
    protected $deleted;
    /**
     * @var Carbon|null
     */
    protected $time;

    /**
     * ContactSnapshot constructor.
     * @param string $title
     * @param null|string $description
     * @param null|string $firstname
     * @param string $lastname
     * @param bool|null $deleted
     * @param Carbon|null $time
     */
    public function __construct(string $title, ?string $description, ?string $firstname, string $lastname, ?bool $deleted, ?Carbon $time)
    {
        $this->title = $title;
        $this->description = $description;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->deleted = $deleted;
        $this->time = $time;
    }

    /**
     * @param array $row
     * @return ContactSnapshot
     */
    public static function createFromRow(array $row): ContactSnapshot
    {
        $model = new self($row['title'], self::optionalProperty('description', $row), self::optionalProperty('firstname', $row), $row['lastname'], self::optionalProperty('deleted', $row), self::isPropertyExist('time', $row) ? new Carbon($row['time']) : null);
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
            'firstname'   => $this->firstname,
            'lastname'    => $this->lastname,
            'deleted'     => $this->deleted,
            'time'        => $this->time
        ];
    }
}