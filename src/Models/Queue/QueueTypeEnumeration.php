<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:12 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueTypeEnumeration
{
    const IN = 'in'; // Calls inbound
    const CTC = 'ctc'; // Web Click-To-Call
    const OUT = 'out'; // Calls outbound
    const OUTBOUNDER = 'outbounder'; // Campaign preview (manual)
    const PROGRESSIVE = 'progressive'; // Campaign progressive
    const DIALER = 'dialer'; // Campaign predictive (dialer)
    const INTERVIEWER = 'interviewer'; // Robocaller
    const EMAIL = 'email'; // Email
    const SMS = 'sms'; // SMS
    const CHAT = 'chat'; // Web chat
    const FBM = 'fbm'; // Facebook messenger
}