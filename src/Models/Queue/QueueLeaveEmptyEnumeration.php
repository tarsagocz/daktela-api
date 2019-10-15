<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:21 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueLeaveEmptyEnumeration
{
    const RINGING = 'ringing'; // When all operators rings
    const IN_USE = 'inuse'; // When all operators speaks
    const PAUSED = 'paused'; // When all operators are on a break
    const UNAVAILABLE = 'unavailable'; // When all operators have disconnected phones
    const LOGOUT = 'logout'; // When there is no login operator
    const PENALTY = 'penalty'; // When an operator is not available with the required priority
    const BUSY = 'busy'; // When all operators are busy
}