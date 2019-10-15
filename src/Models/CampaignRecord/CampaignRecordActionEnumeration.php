<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:07 16.08.2019
 */

namespace Daktela\Models\CampaignRecord;

class CampaignRecordActionEnumeration
{
    const NOT_ASSIGNED = '0'; // Not assigned
    const READY = '1'; // Ready
    const RESCHEDULED_BY_DIALER = '2'; // Rescheduled by Dialer
    const CALL_IN_PROGRESS = '3'; // Call in progress
    const HANG_UP = '4'; // Hangup
    const DONE = '5'; // Done
    const RESCHEDULED = '6'; // Rescheduled
}