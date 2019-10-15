<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:23 19.08.2019
 */

namespace Daktela\Models\Queue;

use Daktela\AbstractFields;

class QueueMacrolinksFields extends AbstractFields
{
    const TITLE = 'title';
    const URL = 'url';
    const AUTO_OPEN = 'autoOpen';
    const UNIQUE = 'unique';
    const POPUP = 'popup';
    const POPUP_WIDTH = 'popupWidth';
    const POPUP_HEIGHT = 'popupHeight';

    const FIELDS = [
        self::TITLE => [
            'type' => 'bool'
        ],
        self::URL => [
            'type' => 'string'
        ],
        self::AUTO_OPEN => [
            'type' => 'bool'
        ],
        self::UNIQUE => [
            'type' => 'bool'
        ],
        self::POPUP => [
            'type' => 'bool'
        ],
        self::POPUP_WIDTH => [
            'type' => 'int'
        ],
        self::POPUP_HEIGHT => [
            'type' => 'int'
        ]
    ];
}