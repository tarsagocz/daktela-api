<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:24 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueStrategyEnumeration
{
    const ALL = 'all'; // Everyone
    const ALL_PENALTY_ORDER = 'all_penalty_order'; // Everyone penalty order
    const LEASTRECENT = 'leastrecent'; // Least recent
    const RANDOM_WITH_PENALTY_GROUPS = 'random_with_penalty_groups'; // Random with penalty groups
}