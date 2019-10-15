<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:01 08.10.2019
 */

namespace Daktela\Models\Blacklist;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\User\UserableTrait;

class BlacklistNumber extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use UserableTrait;
    const MODEL = 'blacklistnumbers';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string Phone number
     */
    protected $number;
    /**
     * @var string Optional description
     */
    protected $description;
    /**
     * @var Carbon Time of expiration
     */
    protected $expired;
    /**
     * @var string|null Normalized Phone number
     */
    protected $normalized_clid;
    /**
     * @var string|null Reversed value of normalized phone number
     */
    protected $reverse_value;
    /**
     * @var Carbon Time of creation
     */
    protected $created;

    /**
     * BlacklistNumber constructor.
     * @param null|string $name
     * @param string $number
     * @param string $description
     * @param Carbon $expired
     * @param null|string $normalized_clid
     * @param null|string $reverse_value
     * @param Carbon $created
     */
    public function __construct(?string $name, string $number, string $description, Carbon $expired, ?string $normalized_clid, ?string $reverse_value, Carbon $created)
    {
        $this->name = $name;
        $this->number = $number;
        $this->description = $description;
        $this->expired = $expired;
        $this->normalized_clid = $normalized_clid;
        $this->reverse_value = $reverse_value;
        $this->created = $created;
    }

    /**
     * @param array $row
     * @return BlacklistNumber
     */
    public static function createFromRow(array $row): BlacklistNumber
    {
        var_dump($row);
        return new self(self::optionalProperty('name', $row), $row['number'], self::optionalProperty('description', $row), self::isPropertyExist('expired', $row) ? new Carbon($row['expired']) : null, self::optionalProperty('normalized_clid', $row), self::optionalProperty('reverse_value', $row), self::isPropertyExist('created', $row) ? new Carbon($row['created']) : null);
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
            'name' => $this->name,
            'number' => $this->number,
            'description' => $this->description,
            'expired' => $this->expired,
            'normalized_clid' => $this->normalized_clid,
            'reverse_value' => $this->reverse_value,
            'created' => $this->created
        ];
    }
}