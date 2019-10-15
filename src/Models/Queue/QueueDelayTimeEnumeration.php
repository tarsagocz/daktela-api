<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:32 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueDelayTimeEnumeration
{
    const SIXTY_SECONDS = 60; // 60 seconds
    const TWO_MINUTES = 120; // 120 seconds
    const THREE_MINUTES = 180; // 180 seconds
    const FIVE_MINUTES = 300; // 300 seconds
    const TEN_MINUTES = 600; // 600 seconds
    const FIFTEEN_MINUTES = 900; // 900 seconds
    const THIRTY_MINUTES = 1800; // 1800 seconds
    const SIXTY_MINUTES = 3600; // 3600 seconds
    const NINETY_MINUTES = 5400; // 5400 seconds
    const TWO_HOURS = 7200; // 7200 seconds
    const THREE_HOURS = 10800; // 10800 seconds
    const FOUR_HOURS = 14400; // 14400 seconds
    const FIVE_HOURS = 18000; // 18000 seconds
    const SIX_HOURS = 21600; // 21600 seconds
    const EIGHT_HOURS = 36000; // 14400 seconds
    const TWELVE_HOURS = 43200; // 43200 seconds
    const EIGHTEEN_HOURS = 64800; // 64800 seconds
    const ONE_DAY = 86400; // 86400 seconds
    const ONE_DAY_AND_FOUR_HOURS = 100800; // 129600 seconds
    const ONE_DAY_AND_HALF = 129600; // 86400 seconds
    const TWO_DAYS = 172800; // 172800 seconds
    const THREE_DAYS = 259200; // 259200 seconds
    const FOUR_DAYS = 345600; // 259200 seconds
    const FIVE_DAYS = 432000; // 432000 seconds
    const SIX_DAYS = 518400; // 432000 seconds
    const SEVEN_DAYS = 604800; // 432000 seconds
}