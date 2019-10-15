<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:41 19.08.2019
 */

namespace Daktela\Models\Queue;

use Daktela\AbstractFields;

class QueueCustomGreetingsFields extends AbstractFields
{
    const URL = 'url';
    const TIME_OUT = 'timeout';
    const TEXT = 'text';

    const FIELDS = [
        self::URL => [
            'type' => 'string'
        ],
        self::TIME_OUT => [
            'type' => 'int'
        ],
        self::TEXT => [
            'type' => 'string'
        ]
    ];
}