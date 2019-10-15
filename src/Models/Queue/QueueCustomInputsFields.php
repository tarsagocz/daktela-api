<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:40 19.08.2019
 */

namespace Daktela\Models\Queue;

use Daktela\AbstractFields;

class QueueCustomInputsFields extends AbstractFields
{
    const TITLE = 'title';
    const NAME = 'name';
    const FORMAT = 'format';
    const MANDATORY = 'mandatory';

    const FIELDS = [
        self::TITLE => [
            'type' => 'string'
        ],
        self::NAME => [
            'type' => 'string'
        ],
        self::FORMAT => [
            'type' => 'int'
        ],
        self::MANDATORY => [
            'type' => 'bool'
        ]
    ];
}