<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:43 16.08.2019
 */

namespace Daktela\Models\ActivityAny;

class ActivityAnyDisconnectionEnumeration
{
    const NULL = '';
    const USER = 'USER'; // User
    const TIMEOUT = 'TIMEOUT'; // Timeout
    const NOT_AVAILABLE = 'NOT_AVAIL'; // Not available
    const OUT_OF_TIME = 'OUT_OF_TIME'; // Outside working hours
}