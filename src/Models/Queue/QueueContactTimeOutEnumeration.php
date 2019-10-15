<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:14 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueContactTimeOutEnumeration
{
    const FIFTEEN_MINUTES = 900; // 900 seconds
    const THIRTY_MINUTES = 1800; // 1800 seconds
    const SIXTY_MINUTES = 3600; // 3600 seconds
    const NINETY_MINUTES = 5400; // 5400 seconds
    const TWO_HOURS = 7200; // 7200 seconds
    const FOUR_HOURS = 14400; // 14400 seconds
    const SIX_HOURS = 21600; // 14400 seconds
    const TWELVE_HOURS = 43200; // 43200 seconds
    const ONE_DAY = 86400; // 86400 seconds
    const ONE_DAY_AND_HALF = 129600; // 86400 seconds
    const TWO_DAYS = 172800; // 172800 seconds
    const THREE_DAYS = 259200; // 259200 seconds
    const FIVE_DAYS = 432000; // 432000 seconds
    const NO = ''; // No
}