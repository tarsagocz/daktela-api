<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:15 08.10.2019
 */

namespace Daktela\Models\TicketSla;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class TicketSla extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'ticketsSla';
    /**
     * @var string|null Name
     */
    protected $name;
    /**
     * @var string Title
     */
    protected $title;
    /**
     * @var int Low response
     */
    protected $response_low;
    /**
     * @var int Normal response
     */
    protected $response_normal;
    /**
     * @var int High response
     */
    protected $response_high;
    /**
     * @var int Low solution
     */
    protected $solution_low;
    /**
     * @var int Normal solution
     */
    protected $solution_normal;
    /**
     * @var int High solution
     */
    protected $solution_high;
    /**
     * @var string|null
     */
    protected $unit;

    /**
     * TicketSla constructor.
     * @param null|string $name
     * @param string $title
     * @param int $response_low
     * @param int $response_normal
     * @param int $response_high
     * @param int $solution_low
     * @param int $solution_normal
     * @param int $solution_high
     * @param string $unit
     */
    public function __construct(?string $name, string $title, int $response_low, int $response_normal, int $response_high, int $solution_low, int $solution_normal, int $solution_high, ?string $unit)
    {
        $this->name = $name;
        $this->title = $title;
        $this->response_low = $response_low;
        $this->response_normal = $response_normal;
        $this->response_high = $response_high;
        $this->solution_low = $solution_low;
        $this->solution_normal = $solution_normal;
        $this->solution_high = $solution_high;
        $this->unit = $unit;
    }

    /**
     * @param array $row
     * @return TicketSla
     */
    public static function createFromRow(array $row): TicketSla
    {
        return new self(self::optionalProperty('name', $row), $row['title'], $row['response_low'], $row['response_normal'], $row['response_high'], $row['solution_low'], $row['solution_normal'], $row['solution_high'], self::optionalProperty('unit', $row));
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
            'name'            => $this->name,
            'title'           => $this->title,
            'response_low'    => $this->response_low,
            'response_normal' => $this->response_normal,
            'response_high'   => $this->response_high,
            'solution_low'    => $this->solution_low,
            'solution_normal' => $this->solution_normal,
            'solution_high'   => $this->solution_high
        ];
    }
}