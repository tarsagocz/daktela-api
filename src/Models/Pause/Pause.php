<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:22 16.08.2019
 */

namespace Daktela\Models\Pause;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\ReadableTrait;

class Pause extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use ProfilableTrait;
    const MODEL = 'pauses';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string|null Type of system pause
     */
    protected $type;
    /**
     * @var string Display name
     */
    protected $title;
    /**
     * @var bool|null Flag if pause is paid
     */
    protected $paid;
    /**
     * @var integer Set time in minutes. If zero then there is no limit
     */
    protected $max_duration;
    /**
     * @var string|null When reset calculation
     */
    protected $calculated_from;
    /**
     * @var bool|null On end of the pause set pause lazy bone
     */
    protected $auto_pause;
    /**
     * @var bool|null Deleted flag
     */
    protected $deleted;

    /**
     * Pause constructor.
     * @param null|string $name
     * @param null|string $type
     * @param string $title
     * @param bool|null $paid
     * @param int $max_duration
     * @param null|string $calculated_from
     * @param bool|null $auto_pause
     * @param bool|null $deleted
     */
    public function __construct(?string $name, ?string $type, string $title, ?bool $paid, int $max_duration, ?string $calculated_from, ?bool $auto_pause, ?bool $deleted)
    {
        $this->name = $name;
        $this->type = $type;
        $this->title = $title;
        $this->paid = $paid;
        $this->max_duration = $max_duration;
        $this->calculated_from = $calculated_from;
        $this->auto_pause = $auto_pause;
        $this->deleted = $deleted;
    }

    /**
     * @param array $row
     * @return Pause
     */
    public static function createFromRow(array $row): Pause
    {
        return new self(self::optionalProperty('name', $row), self::optionalProperty('type', $row), $row['title'], self::optionalProperty('paid', $row), $row['max_duration'], self::optionalProperty('calculated_from', $row), self::optionalProperty('auto_pause', $row), self::optionalProperty('deleted', $row));
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
            'type'            => $this->type,
            'title'           => $this->title,
            'paid'            => $this->paid,
            'max_duration'    => $this->max_duration,
            'calculated_from' => $this->calculated_from,
            'auto_pause'      => $this->auto_pause,
            'deleted'         => $this->deleted
        ];
    }
}