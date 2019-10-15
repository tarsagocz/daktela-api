<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:10 16.08.2019
 */

namespace Daktela\Models\ActivityCall;

class ActivityCallDisconnectionCauseEnumeration
{
    const NULL = '';
    const ABANDON = 'abandon';
    const EXIT_WITH_TIMEOUT = 'exitwithtimeout';
    const EXIT_WITH_KEY = 'exitwithkey';
    const EXIT_EMPTY = 'exitempty';
    const BUSY = 'busy';
    const CANCEL = 'cancel';
    const NO_ANSWER = 'noanswer';
    const FAILED = 'failed';
}