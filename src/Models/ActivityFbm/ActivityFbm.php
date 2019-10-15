<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:52 16.08.2019
 */

namespace Daktela\Models\ActivityFbm;

use Carbon\Carbon;
use Daktela\Models\ActivityAny\ActivityAny;

class ActivityFbm extends ActivityAny
{
    /**
     * @var string Unique name
     */
    protected $name;
    /**
     * @var string Sender ID
     */
    protected $sender;
    /**
     * @var string Direction of the chat
     */
    protected $direction;
    /**
     * @var Carbon Time of creating
     */
    protected $time;
    /**
     * @var integer Total waiting time in queue before chat acceptance
     */
    protected $wait_time;
    /**
     * @var integer Duration of chat
     */
    protected $duration;
    /**
     * @var bool Mark if chat was answered
     */
    protected $answered;
    /**
     * @var string Reason of disconnection
     */
    protected $disconnection;
    /**
     * @var string Facebook full name
     */
    protected $full_name;
    /**
     * @var string Mark if facebook is missed
     */
    protected $missed;
    /**
     * @var Carbon Time when missed facebook
     */
    protected $missed_time;
}