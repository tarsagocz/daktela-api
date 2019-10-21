<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:13 18.10.2019
 */

namespace Daktela\Models\QAForm;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class QAForm extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'qaforms';
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
     * QAForm constructor.
     * @param null|string $name
     * @param string $title
     * @param string $description
     */
    public function __construct(?string $name, string $title, string $description)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @param $row
     * @return QAForm
     */
    public static function createFromRow($row) : QAForm
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row));

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
            'description' => $this->description
        ];
    }
}