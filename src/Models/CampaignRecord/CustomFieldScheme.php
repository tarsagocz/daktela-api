<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:15 18.10.2019
 */

namespace Daktela\Models\CampaignRecord;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;

class CustomFieldScheme extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'campaigns/Records/Customfields_scheme';
    /**
     * @var array|null
     */
    protected $config;
    /**
     * @var string|null;
     */
    protected $type;
    /**
     * @var int|null
     */
    protected $block;
    /**
     * @var int|null
     */
    protected $position;

    protected $queue;
    protected $parent;

    /**
     * CustomFieldScheme constructor.
     * @param null|string $type
     * @param int|null $block
     * @param int|null $position
     */
    public function __construct(?string $type, ?int $block, ?int $position)
    {
        $this->type = $type;
        $this->block = $block;
        $this->position = $position;
    }

    /**
     * @param $row
     * @return CustomFieldScheme
     */
    public static function createFromRow($row) : CustomFieldScheme
    {
        var_dump($row);
        $model = new self(self::optionalProperty('type', $row), self::optionalProperty('block', $row), self::optionalProperty('position', $row));

        self::setModel($row, 'queue', $model, Queue::class);
        self::setModel($row, 'parent', $model, CustomFieldScheme::class);

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
            'config'   => $this->config,
            'type'     => $this->type,
            'block'    => $this->block,
            'position' => $this->position
        ];
    }
}