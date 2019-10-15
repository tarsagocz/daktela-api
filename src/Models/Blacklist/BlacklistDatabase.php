<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 9:11 08.10.2019
 */

namespace Daktela\Models\Blacklist;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\QueuableTrait;
use Daktela\Models\ReadableTrait;

class BlacklistDatabase extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use QueuableTrait;
    use BlacklistNumberableTrait;
    const MODEL = 'blacklistDatabases';

    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string Title
     */
    protected $title;
    /**
     * @var string|null Description
     */
    protected $description;

    protected $numbers = null;

    /**
     * BlacklistDatabase constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $description
     */
    public function __construct(?string $name, string $title, ?string $description)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @param array $row
     * @return BlacklistDatabase
     */
    public static function createFromRow(array $row): BlacklistDatabase
    {
        return new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row));
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