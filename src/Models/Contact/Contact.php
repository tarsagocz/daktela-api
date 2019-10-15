<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:59 16.08.2019
 */

namespace Daktela\Models\Contact;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\CrmRecord\CrmRecordableTrait;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Ticket\TicketableTrait;

class Contact extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use CrmRecordableTrait;
    use TicketableTrait;
    use ContactSnapshotableTrait;
    const MODEL = 'contacts';
    /**
     * @var string Unique name
     */
    protected $name;
    /**
     * @var string Formatted full name
     */
    protected $title;
    /**
     * @var string|null First name
     */
    protected $firstname;
    /**
     * @var string Last name
     */
    protected $lastname;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var float|null Calculated NPS score for all activities of this contact
     */
    protected $nps_score;
    /**
     * @var Carbon Date of creation
     */
    protected $created;
    /**
     * @var Carbon|null Date of last modification
     */
    protected $edited;

    /**
     * Contact constructor.
     * @param string $name
     * @param string $title
     * @param null|string $firstname
     * @param string $lastname
     * @param null|string $description
     * @param float|null $nps_score
     * @param Carbon $created
     * @param Carbon|null $edited
     */
    public function __construct(string $name, string $title, ?string $firstname, string $lastname, ?string $description, ?float $nps_score, Carbon $created, ?Carbon $edited)
    {
        $this->name = $name;
        $this->title = $title;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->description = $description;
        $this->nps_score = $nps_score;
        $this->created = $created;
        $this->edited = $edited;
    }

    /**
     * @param array $row
     * @return Contact
     */
    public static function createFromRow(array $row): Contact
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('firstname', $row), $row['lastname'], self::optionalProperty('description', $row), self::optionalProperty('nps_score', $row), self::isPropertyExist('created', $row) ? new Carbon($row['created']) : null, self::isPropertyExist('edited', $row) ? new Carbon($row['edited']) : null);
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
            'firstname'   => $this->firstname,
            'lastname'    => $this->lastname,
            'description' => $this->description,
            'nps_score'   => $this->nps_score,
            'created'     => $this->created,
            'edited'      => $this->edited
        ];
    }
}