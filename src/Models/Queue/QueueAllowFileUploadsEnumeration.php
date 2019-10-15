<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:37 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueAllowFileUploadsEnumeration
{
    const NO = '';
    const OPERATOR = 'operator'; // From operator
    const CUSTOMER = 'customer'; // From customer
    const BOTH = 'both'; // Both directions
}