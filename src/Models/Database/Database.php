<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 8:37 15.10.2019
 */

namespace Daktela\Models\Database;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\Queue;
use Daktela\Models\ReadableTrait;

class Database extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'databases';
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $stage;
    /**
     * @var bool|null
     */
    protected $deleted;

    protected $queue;

    /**
     * Database constructor.
     * @param null|string $name
     * @param string $title
     * @param string $description
     * @param string $stage
     * @param bool|null $deleted
     */
    public function __construct(?string $name, string $title, string $description, string $stage, ?bool $deleted)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->stage = $stage;
        $this->deleted = $deleted;
    }

    /**
     * @param array $row
     * @return Database
     */
    public static function createFromRow(array $row): Database
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row), self::optionalProperty('stage', $row), self::optionalProperty('deleted', $row));

        if (is_array($row['queue'])) {
            $model->queue = Queue::createFromRow($row['queue']);
        } else {
            $model->queue = self::optionalProperty('queue', $row);
        }

        return $model;
    }

    public function queue()
    {
        if (is_string($this->queue)) {
            $this->queue = Queue::read($this->queue);
        }

        return $this->queue;
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
            'stage'       => $this->stage,
            'deleted'     => $this->deleted
        ];
    }
}