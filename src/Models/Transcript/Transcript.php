<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:47 14.10.2019
 */

namespace Daktela\Models\Transcript;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class Transcript extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'transcripts';
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string|null
     */
    protected $item_name;
    /**
     * @var string|null
     */
    protected $text;
    /**
     * @var float|null
     */
    protected $confidence;
    /**
     * @var bool|null
     */
    protected $correctly_routed;
    /**
     * @var string|null
     */
    protected $correct_route;
    /**
     * @var Carbon|null
     */
    protected $created;
    /**
     * @var array[]
     */
    protected $additional_data = [];
    /**
     * @var bool|null
     */
    protected $deleted;

    /**
     * Transcript constructor.
     * @param null|string $name
     * @param null|string $item_name
     * @param null|string $text
     * @param float|null $confidence
     * @param bool|null $correctly_routed
     * @param null|string $correct_route
     * @param Carbon|null $created
     * @param bool|null $deleted
     */
    public function __construct(?string $name, ?string $item_name, ?string $text, ?float $confidence, ?bool $correctly_routed, ?string $correct_route, ?Carbon $created, ?bool $deleted)
    {
        $this->name = $name;
        $this->item_name = $item_name;
        $this->text = $text;
        $this->confidence = $confidence;
        $this->correctly_routed = $correctly_routed;
        $this->correct_route = $correct_route;
        $this->created = $created;
        $this->deleted = $deleted;
    }

    /**
     * @param array $row
     * @return Transcript
     */
    public static function createFromRow(array $row): Transcript
    {
        $model = new self(self::optionalProperty('name', $row), self::optionalProperty('item_name', $row), self::optionalProperty('text', $row), self::optionalProperty('confidence', $row), self::optionalProperty('correctly_routed', $row), self::optionalProperty('correct_route', $row), self::isPropertyExist('created', $row) ? new Carbon($row['created']) : null, self::optionalProperty('deleted', $row));

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
            'name'             => $this->name,
            'item_name'        => $this->item_name,
            'text'             => $this->text,
            'confidence'       => $this->confidence,
            'correctly_routed' => $this->correctly_routed,
            'correct_route'    => $this->correct_route,
            'created'          => $this->created,
            'additional_data'  => $this->additional_data,
            'deleted'          => $this->deleted
        ];
    }
}