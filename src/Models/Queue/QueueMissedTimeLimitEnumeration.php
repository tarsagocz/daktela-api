<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:06 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueMissedTimeLimitEnumeration
{
    const TWO_SECONDS = 2; // 2 seconds
    const FOUR_SECONDS = 4; // 4 seconds
    const SIX_SECONDS = 6; // 6 seconds
    const EIGHT_SECONDS = 8; // 8 seconds
    const TEN_SECONDS = 10; // 10 seconds
    const TWELVE_SECONDS = 12; // 12 seconds
    const FIFTEEN_SECONDS = 15; // 15 seconds
    const TWENTY_SECONDS = 20; // 20 seconds
    const THIRTY_SECONDS = 30; // 30 seconds
    const SIXTY_SECONDS = 60; // 60 seconds
    const NINETY_SECONDS = 90; // 90 seconds
    const TWO_MINUTES = 120; // 120 seconds
    const TWO_MINUTES_AND_HALF = 150; // 150 seconds
    const NO_LIMIT = '';
}