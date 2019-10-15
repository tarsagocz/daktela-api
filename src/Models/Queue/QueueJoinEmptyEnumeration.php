<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:17 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueJoinEmptyEnumeration
{
    const RINGING = 'ringing'; // Disable when all of operators are ringing
    const IN_USE = 'inuse'; // Disable when all of operators are talking
    const PAUSED = 'paused'; // Disable when all of operators are on a break
    const UNAVAILABLE = 'unavailable'; // Disable if all operators are disconnected
    const LOGOUT = 'logout'; // Disable if no operator is logged
    const PENALTY = 'penalty'; // Disable if there is no operator with the required priority
    const BUSY = 'busy'; // Disable when all of operators are busy
}