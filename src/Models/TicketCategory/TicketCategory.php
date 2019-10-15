<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 9:37 08.10.2019
 */

namespace Daktela\Models\TicketCategory;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Group\GroupableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Status\StatusableTrait;
use Daktela\Models\Ticket\TicketableTrait;
use Daktela\Models\TicketSla\TicketSla;
use Daktela\Models\User\UserableTrait;

class TicketCategory extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use GroupableTrait;
    use StatusableTrait;
    use ProfilableTrait;
    use UserableTrait;
    use TicketableTrait;
    const MODEL = 'ticketsCategories';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string Subject of category
     */
    protected $title;
    /**
     * @var bool|null Mark if status is required
     */
    protected $status_required;
    /**
     * @var bool|null Allow use multiple statuses
     */
    protected $multiple_statuses;
    /**
     * @var bool|null Mark if all child tickets must be closed before closing or deleting ticket
     */
    protected $closeCheckChilds;
    /**
     * @var TicketSla|string
     */
    protected $sla;


    /**
     * TicketCategory constructor.
     * @param null|string $name
     * @param string $title
     * @param bool|null $status_required
     * @param bool|null $multiple_statuses
     * @param bool|null $closeCheckChilds
     */
    public function __construct(?string $name, string $title, ?bool $status_required, ?bool $multiple_statuses, ?bool $closeCheckChilds)
    {
        $this->name = $name;
        $this->title = $title;
        $this->status_required = $status_required;
        $this->multiple_statuses = $multiple_statuses;
        $this->closeCheckChilds = $closeCheckChilds;
    }

    /**
     * @param array $row
     * @return TicketCategory
     */
    public static function createFromRow(array $row): TicketCategory
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('status_required', $row), self::optionalProperty('multiple_statuses', $row), self::optionalProperty('closeCheckChilds', $row));

        if (is_array($row['sla'])) {
            $model->sla = TicketSla::createFromRow($row['sla']);
        } else {
            $model->sla = $row['sla'];
        }

        return $model;
    }

    public function sla()
    {
        if (is_string($this->sla)) {
            $this->sla = TicketSla::read($this->sla);
        }

        return $this->sla;
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
            'name'               => $this->name,
            'title'              => $this->title,
            'status_required'    => $this->status_required,
            'multiples_statuses' => $this->multiple_statuses,
            'closeCheckChilds'   => $this->closeCheckChilds
        ];
    }
}