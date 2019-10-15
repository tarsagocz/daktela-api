<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 9:00 15.10.2019
 */

namespace Daktela\Models\CampaignRecord;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class CustomField extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'campaignsRecordsCustomFields'; // ERROR
    /**
     * @var string|null
     */
    protected $position;
    /**
     * @var string|null
     */
    protected $value;
    /**
     * @var string|null
     */
    protected $reverse_value;

    /**
     * CustomField constructor.
     * @param null|string $position
     * @param null|string $value
     * @param null|string $reverse_value
     */
    public function __construct(?string $position, ?string $value, ?string $reverse_value)
    {
        $this->position = $position;
        $this->value = $value;
        $this->reverse_value = $reverse_value;
    }

    /**
     * @param array $row
     * @return CustomField
     */
    public static function createFromRow(array $row): CustomField
    {
        $model = new self(self::optionalProperty('position', $row), self::optionalProperty('value', $row), self::optionalProperty('reverse_value', $row));
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
            'position'      => $this->position,
            'value'         => $this->value,
            'reverse_value' => $this->reverse_value
        ];
    }
}