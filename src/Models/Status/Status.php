<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:32 16.08.2019
 */

namespace Daktela\Models\Status;

use Daktela\AbstractModel;
use Daktela\Connection;
use Daktela\Models\Blacklist\BlacklistDatabase;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Queue\QueuableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\TicketCategory\TicketCategoriableTrait;
use Psr\Http\Message\ResponseInterface;

class Status extends AbstractModel
{
    use ReadableTrait;
    use FetchableTrait;
    use TicketCategoriableTrait;
    use QueuableTrait;
    const MODEL = 'statuses';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string Display name
     */
    protected $title;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var string|null Relative time that should be added to actual time in order to calculate expiration time for number in blacklist (e.g. +6 days , 19 months)
     */
    protected $blacklist_expiration_time;
    /**
     * @var bool|null Trigger for validation when saving CC records
     */
    protected $validation;
    /**
     * @var bool|null Trigger for required nextcall when saving CC records
     */
    protected $nextcall;
    /**
     * @var string|null Color of flag on ticket with this status
     */
    protected $color;
    protected $blacklistDatabase = null;

    /**
     * Status constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $description
     * @param null|string $blacklist_expiration_time
     * @param bool $validation
     * @param bool $nextcall
     * @param null|string $color
     */
    public function __construct(?string $name, string $title, ?string $description, ?string $blacklist_expiration_time, ?bool $validation, ?bool $nextcall, ?string $color)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->blacklist_expiration_time = $blacklist_expiration_time;
        $this->validation = $validation;
        $this->nextcall = $nextcall;
        $this->color = $color;
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
            'name'                      => $this->name,
            'title'                     => $this->title,
            'description'               => $this->description,
            'blacklist_expiration_time' => $this->blacklist_expiration_time,
            'validation'                => $this->validation,
            'nextcall'                  => $this->nextcall,
            'color'                     => $this->color
        ];
    }

    /**
     * @param array $row
     * @return Status
     */
    public static function createFromRow(array $row): Status
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row), self::optionalProperty('blacklist_expiration_time', $row), self::optionalProperty('validation', $row), $row['nextcall'], self::optionalProperty('color', $row));

        if (is_array($row['blacklist_database'])) {
            $model->blacklistDatabase = BlacklistDatabase::createFromRow($row['blacklist_database']);
        } else {
            $model->blacklistDatabase = $row['blacklist_database'];
        }

        return $model;
    }

    public function blacklistDatabase()
    {
        if (is_string($this->blacklistDatabase)) {
            $this->blacklistDatabase = BlacklistDatabase::read($this->blacklistDatabase);
        }

        return $this->blacklistDatabase;
    }

    public function types($force = false)
    {
        /**
         * @var ResponseInterface $response
         */
        $response = Connection::get(self::MODEL . '/' . $this->name . '/types.json');
        $rows = json_decode($response->getBody()
            ->getContents(), true);

        if (!empty($rows['error'])) {
            return null;
        }

        var_dump($rows);
//        die();
    }
}