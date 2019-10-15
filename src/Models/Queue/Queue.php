<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:10 19.08.2019
 */

namespace Daktela\Models\Queue;

use Daktela\AbstractModel;
use Daktela\Connection;
use Daktela\Models\Blacklist\BlacklistDatabasableTrait;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Group\GroupableTrait;
use Daktela\Models\OptionableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Recording\Recording;
use Daktela\Models\Status\Status;
use Daktela\Models\Status\StatusableTrait;
use Daktela\Models\Template\TemplatableTrait;
use Daktela\Models\TicketCategory\TicketCategory;
use Psr\Http\Message\ResponseInterface;

class Queue extends AbstractModel
{
    use ReadableTrait;
    use FetchableTrait;
    use OptionableTrait;
    use ProfilableTrait;
    use StatusableTrait;
    use GroupableTrait;
    use BlacklistDatabasableTrait;
    use TemplatableTrait;
    const MODEL = 'queues';
    /**
     * @var string Unique number of queue
     */
    protected $name;
    /**
     * @var string|null Display name
     */
    protected $title;
    /**
     * @var string|null Queues's alias, used for example in webchat as visible target for customer
     */
    protected $alias;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var string|null Hint words for call steering application
     */
    protected $call_steering_description;
    /**
     * @var string Type of queue
     */
    protected $type;
    /**
     * @var string|null If an activity comes in from the customer or out from the operator
     */
    protected $direction;
    /**
     * @var bool|null Flag if queue is deactivated
     */
    protected $deactivated;
    protected $profiles = null;

    /**
     * Queue constructor.
     * @param string $name
     * @param null|string $title
     * @param null|string $alias
     * @param null|string $description
     * @param null|string $call_steering_description
     * @param string $type
     * @param null|string $direction
     * @param bool|null $deactivated
     */
    public function __construct(string $name, ?string $title, ?string $alias, ?string $description, ?string $call_steering_description, string $type, ?string $direction, ?bool $deactivated)
    {
        $this->name = $name;
        $this->title = $title;
        $this->alias = $alias;
        $this->description = $description;
        $this->call_steering_description = $call_steering_description;
        $this->type = $type;
        $this->direction = $direction;
        $this->deactivated = $deactivated;
    }

    /**
     * @param $row
     * @return Queue
     */
    public static function createFromRow($row) : Queue
    {
        $queue = new self($row['name'], self::isPropertyExist('title', $row) ? $row['title'] : null, self::isPropertyExist('alias', $row) ? $row['alias'] : null, self::isPropertyExist('description', $row) ? $row['description'] : null, self::isPropertyExist('call_steering_description', $row) ? $row['call_steering_description'] : null, $row['type'], self::isPropertyExist('direction', $row) ? $row['direction'] : null, self::isPropertyExist('deactivated', $row) ? $row['deactivated'] : null);
        if (array_key_exists('options', $row)) {
            $queue->setOptions($row['options']);
        }

        return $queue;
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
            'alias'                     => $this->alias,
            'description'               => $this->description,
            'call_steering_description' => $this->call_steering_description,
            'type'                      => $this->type,
            'direction'                 => $this->direction,
            'deactivated'               => $this->deactivated
        ];
    }

    public function getStatusHangUpCustomer()
    {
        if (!$this->issetOption(QueueOptionsFields::STATUS_HANGUP_CUSTOMER)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::STATUS_HANGUP_CUSTOMER])) {
            $this->options[QueueOptionsFields::STATUS_HANGUP_CUSTOMER] = Status::read($this->options[QueueOptionsFields::STATUS_HANGUP_CUSTOMER]);
        }
        return $this->options[QueueOptionsFields::STATUS_HANGUP_CUSTOMER];
    }

    public function getStatusHangUpDialer()
    {
        if (!$this->issetOption(QueueOptionsFields::STATUS_HANGUP_DIALER)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::STATUS_HANGUP_DIALER])) {
            $this->options[QueueOptionsFields::STATUS_HANGUP_DIALER] = Status::read($this->options[QueueOptionsFields::STATUS_HANGUP_DIALER]);
        }
        return $this->options[QueueOptionsFields::STATUS_HANGUP_DIALER];
    }

    public function getStatusAnswer()
    {
        if (!$this->issetOption(QueueOptionsFields::STATUS_ANSWER)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::STATUS_ANSWER])) {
            $this->options[QueueOptionsFields::STATUS_ANSWER] = Status::read($this->options[QueueOptionsFields::STATUS_ANSWER]);
        }
        return $this->options[QueueOptionsFields::STATUS_ANSWER];
    }

    public function getStatusBusy()
    {
        if (!$this->issetOption(QueueOptionsFields::STATUS_BUSY)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::STATUS_BUSY])) {
            $this->options[QueueOptionsFields::STATUS_BUSY] = Status::read($this->options[QueueOptionsFields::STATUS_BUSY]);
        }
        return $this->options[QueueOptionsFields::STATUS_BUSY];
    }

    public function getMissedRecordStatus()
    {
        if (!$this->issetOption(QueueOptionsFields::MISSED_RECORD_STATUS)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::MISSED_RECORD_STATUS])) {
            $this->options[QueueOptionsFields::MISSED_RECORD_STATUS] = Status::read($this->options[QueueOptionsFields::MISSED_RECORD_STATUS]);
        }
        return $this->options[QueueOptionsFields::MISSED_RECORD_STATUS];
    }

    public function getStatusReject()
    {
        if (!$this->issetOption('status_reject')) {
            return null;
        }
        if (is_string($this->options['status_reject'])) {
            $this->options['status_reject'] = Status::read($this->options['status_reject']);
        }

        return $this->options['status_reject'];
    }

    public function getRecordingUser()
    {
        if (!$this->issetOption(QueueOptionsFields::RECORDING_USER)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::RECORDING_USER])) {
            $this->options[QueueOptionsFields::RECORDING_USER] = Recording::read($this->options[QueueOptionsFields::RECORDING_USER]);
        }
        return $this->options[QueueOptionsFields::RECORDING_USER];
    }

    public function getRecordingBefore()
    {
        if (!$this->issetOption(QueueOptionsFields::RECORDING_BEFORE)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::RECORDING_BEFORE])) {
            $this->options[QueueOptionsFields::RECORDING_BEFORE] = Recording::read($this->options[QueueOptionsFields::RECORDING_BEFORE]);
        }
        return $this->options[QueueOptionsFields::RECORDING_BEFORE];
    }

    public function getRecordingJoin()
    {
        if (!$this->issetOption(QueueOptionsFields::RECORDING_JOIN)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::RECORDING_JOIN])) {
            $this->options[QueueOptionsFields::RECORDING_JOIN] = Recording::read($this->options[QueueOptionsFields::RECORDING_JOIN]);
        }
        return $this->options[QueueOptionsFields::RECORDING_JOIN];
    }

    public function getCrmTicketCategory()
    {
        if (!$this->issetOption(QueueOptionsFields::CRM_TICKET_CATEGORY)) {
            return null;
        }
        if (is_string($this->options[QueueOptionsFields::CRM_TICKET_CATEGORY])) {
            $this->options[QueueOptionsFields::CRM_TICKET_CATEGORY] = TicketCategory::read($this->options[QueueOptionsFields::CRM_TICKET_CATEGORY]);
        }
        return $this->options[QueueOptionsFields::CRM_TICKET_CATEGORY];
    }
}