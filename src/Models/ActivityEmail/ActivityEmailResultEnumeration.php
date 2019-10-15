<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:17 16.08.2019
 */

namespace Daktela\Models\ActivityEmail;

class ActivityEmailResultEnumeration
{
    const FAILED = 'failed'; // Sending failed
    const OK = 'ok'; // Sent
    const NULL = null; // Waiting to be sent
}