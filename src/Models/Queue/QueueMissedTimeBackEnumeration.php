<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:51 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueMissedTimeBackEnumeration
{
    const FIFTEEN_MINUTES = 900; // 900 seconds
    const THIRTY_MINUTES = 1800; // 1800 seconds
    const SIXTY_MINUTES = 3600; // 3600 seconds
    const TWO_HOURS = 7200; // 7200 seconds
    const EIGHT_HOURS = 28800; // 28800 seconds
    const SIXTEEN_HOURS = 57600; // 57600 seconds
    const ONE_DAY = 86400; // 86400 seconds
    const TWO_DAYS = 172800; // 172800 seconds
    const THREE_DAYS = 259200; // 259200 seconds
    const FOUR_DAYS = 345600; // 345600 seconds
    const FIVE_DAYS = 432000; // 345600 seconds
    const MIDNIGHT = ''; // Unlimited
}