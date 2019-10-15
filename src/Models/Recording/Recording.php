<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 9:06 09.10.2019
 */

namespace Daktela\Models\Recording;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;

class Recording extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'recordings';
    /**
     * @var string|null
     */
    protected $id;
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string
     */
    protected $displayname;
    /**
     * @var string
     */
    protected $filename;
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var string|null
     */
    protected $fcode;
    /**
     * @var string|null
     */
    protected $fcode_pass;

    /**
     * Recording constructor.
     * @param null|string $id
     * @param null|string $name
     * @param string $displayname
     * @param string $filename
     * @param null|string $description
     * @param null|string $fcode
     * @param null|string $fcode_pass
     */
    public function __construct(?string $id, ?string $name, string $displayname, string $filename, ?string $description, ?string $fcode, ?string $fcode_pass)
    {
        $this->id = $id;
        $this->name = $name;
        $this->displayname = $displayname;
        $this->filename = $filename;
        $this->description = $description;
        $this->fcode = $fcode;
        $this->fcode_pass = $fcode_pass;
    }

    public static function createFromRow($row)
    {
        var_dump($row);
        return new self(self::optionalProperty('id', $row), self::optionalProperty('name', $row), $row['displayname'], $row['filename'], self::optionalProperty('description', $row), self::optionalProperty('fcode', $row), self::optionalProperty('fcode_pass', $row));
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
            'id'          => $this->id,
            'displayname' => $this->displayname,
            'filename'    => $this->filename,
            'description' => $this->description,
            'fcode'       => $this->fcode,
            'fcode_pass'  => $this->fcode_pass
        ];
    }
}