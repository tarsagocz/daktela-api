<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:40 16.08.2019
 */

namespace Daktela\Models\Ticket;

use Carbon\Carbon;
use Daktela\AbstractModel;
use Daktela\Models\Activity\Activity;
use Daktela\Models\Contact\ContactableTrait;
use Daktela\Models\CrmRecord\CrmRecordableTrait;
use Daktela\Models\FetchableTrait;
use Daktela\Models\OptionableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Status\StatusableTrait;
use Daktela\Models\TicketCategory\TicketCategory;

class Ticket extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use OptionableTrait;
    use StatusableTrait;
    use CrmRecordableTrait;
    use ContactableTrait;
    const MODEL = 'tickets';
    /**
     * @var int|null Unique name
     */
    protected $name;
    /**
     * @var string Subject of ticket
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $email;
    /**
     * @var bool|null Parent flag
     */
    protected $isParent;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var string OPEN, WAIT, CLOSE
     */
    protected $stage;
    /**
     * @var string Level of priority
     */
    protected $priority;
    /**
     * @var int|null SLA overdue in seconds
     */
    protected $sla_overdue;
    /**
     * @var Carbon|null Time till when the ticket needs to be closed
     */
    protected $sla_deadtime;
    /**
     * @var Carbon|null Auxiliary data for sla calculation
     */
    protected $sla_change;
    /**
     * @var int|null Time in seconds from last change to SLA deadline
     */
    protected $sla_duration;
    /**
     * @var bool|null Flag if ticket's deadline was set up manually
     */
    protected $sla_custom;
    /**
     * @var int|null All activities connection to this ticket
     */
    protected $interaction_activity_count;
    /**
     * @var Carbon|null Date whe the ticket will be automatically re-opened
     */
    protected $reopen;
    /**
     * @var Carbon|null Date of creation
     */
    protected $created;
    /**
     * @var Carbon|null Date of last modification
     */
    protected $edited;
    /**
     * @var Carbon|null Date of first answer
     */
    protected $first_answer;
    /**
     * @var int|null How long does it take until the ticket has been answered
     */
    protected $first_answer_duration;
    /**
     * @var Carbon|null Date when the ticket was closed
     */
    protected $closed;
    /**
     * @var bool|null Flag if the ticket has not been ready yet
     */
    protected $unread;
    /**
     * @var bool|null Flag if the ticket has attachment
     */
    protected $has_attachment;
    /**
     * @var Ticket[]|null
     */
    protected $mergeTickets = null;
    /**
     * @var Activity[]|null
     */
    protected $activities = null;
    /**
     * @var TicketCategory|string
     */
    protected $category;

    /**
     * Ticket constructor.
     * @param int|null $name
     * @param string $title
     * @param null|string $email
     * @param bool|null $isParent
     * @param null|string $description
     * @param string $stage
     * @param string $priority
     * @param int|null $sla_overdue
     * @param Carbon|null $sla_deadtime
     * @param Carbon|null $sla_change
     * @param int|null $sla_duration
     * @param bool|null $sla_custom
     * @param int|null $interaction_activity_count
     * @param Carbon|null $reopen
     * @param Carbon|null $created
     * @param Carbon|null $edited
     * @param Carbon|null $first_answer
     * @param int|null $first_answer_duration
     * @param Carbon|null $closed
     * @param bool|null $unread
     * @param bool|null $has_attachment
     */
    public function __construct(?int $name, string $title, ?string $email, ?bool $isParent, ?string $description, string $stage, string $priority, ?int $sla_overdue, ?Carbon $sla_deadtime, ?Carbon $sla_change, ?int $sla_duration, ?bool $sla_custom, ?int $interaction_activity_count, ?Carbon $reopen, ?Carbon $created, ?Carbon $edited, ?Carbon $first_answer, ?int $first_answer_duration, ?Carbon $closed, ?bool $unread, ?bool $has_attachment)
    {
        $this->name = $name;
        $this->title = $title;
        $this->email = $email;
        $this->isParent = $isParent;
        $this->description = $description;
        $this->stage = $stage;
        $this->priority = $priority;
        $this->sla_overdue = $sla_overdue;
        $this->sla_deadtime = $sla_deadtime;
        $this->sla_change = $sla_change;
        $this->sla_duration = $sla_duration;
        $this->sla_custom = $sla_custom;
        $this->interaction_activity_count = $interaction_activity_count;
        $this->reopen = $reopen;
        $this->created = $created;
        $this->edited = $edited;
        $this->first_answer = $first_answer;
        $this->first_answer_duration = $first_answer_duration;
        $this->closed = $closed;
        $this->unread = $unread;
        $this->has_attachment = $has_attachment;
    }

    /**
     * @param array $row
     * @return Ticket
     */
    public static function createFromRow(array $row): Ticket
    {
        $ticket = new self(self::optionalProperty('name', $row), self::optionalProperty('title', $row), self::optionalProperty('email', $row), self::optionalProperty('isParent', $row), self::optionalProperty('description', $row), self::optionalProperty('stage', $row), self::optionalProperty('priority', $row), self::optionalProperty('sla_overdue', $row), self::isPropertyExist('sla_deadtime', $row) ? new Carbon($row['sla_deadtime']) : null, self::isPropertyExist('sla_change', $row) ? new Carbon($row['sla_change']) : null, self::optionalProperty('sla_duration', $row), self::optionalProperty('sla_custom', $row), self::optionalProperty('interaction_activity_count', $row), self::isPropertyExist('reopen', $row) ? new Carbon($row['reopen']) : null, self::isPropertyExist('created', $row) ? new Carbon($row['created']) : null, self::isPropertyExist('edited', $row) ? new Carbon($row['edited']) : null, self::isPropertyExist('first_answer', $row) ? new Carbon($row['first_answer']) : null, self::optionalProperty('first_answer_duration', $row), self::isPropertyExist('closed', $row) ? new Carbon($row['closed']) : null, self::optionalProperty('unread', $row), self::optionalProperty('has_attachment', $row));
        if ($ticket->isOptionable($row)) {
            $ticket->setOptions($row['options']);
        }

        self::setModel($row, 'category', $ticket, TicketCategory::class);

        return $ticket;
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
            'name'                       => $this->name,
            'title'                      => $this->title,
            'email'                      => $this->email,
            'isParent'                   => $this->isParent,
            'description'                => $this->description,
            'stage'                      => $this->stage,
            'priority'                   => $this->priority,
            'sla_overdue'                => $this->sla_overdue,
            'sla_deadtime'               => $this->sla_deadtime,
            'sla_change'                 => $this->sla_change,
            'sla_duration'               => $this->sla_duration,
            'sla_custom'                 => $this->sla_custom,
            'interaction_activity_count' => $this->interaction_activity_count,
            'reopen'                     => $this->reopen,
            'created'                    => $this->created,
            'edited'                     => $this->edited,
            'first_answer'               => $this->first_answer,
            'first_answer_duration'      => $this->first_answer_duration,
            'closed'                     => $this->closed,
            'unread'                     => $this->unread,
            'has_attachment'             => $this->has_attachment,
        ];
    }
}