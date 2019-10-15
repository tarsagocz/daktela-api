<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:40 20.08.2019
 */

namespace Daktela\Models\User;

use Daktela\AbstractFields;

class UserOptionsFields extends AbstractFields
{
    const SIGN = 'sign'; // A custom signature is specified as plain text using HTML tags
    const TARGET = 'target';
    const TARGET_TERMINATE = 'target_terminate';
    const TARGET_ANNOUNCEMENT = 'target_announcement';
    const TARGET_USER = 'target_user';
    const TARGET_CALL_STEERING = 'target_callsteering';
    const TARGET_VOICE_MAIL = 'target_voicemail';
    const TARGET_SIGNAL = 'target_signal';
    const TARGET_CONDITION = 'target_condition';
    const TARGET_CONTEXT = 'target_context';
    const TARGET_PARAM = 'target_param';
    const TARGET_LANGUAGE = 'target_language';
    const TARGET_IVR_MENU = 'target_ivr_menu';
    const TARGET_RING_GROUP = 'target_ringgroup';
    const TARGET_QUEUE = 'target_queue';
    const TARGET_CUSTOM = 'target_custom';

    const FIELDS = [
        self::SIGN => [
            'type' => 'string'
        ],
        self::TARGET => [
            'type' => 'string'
        ],
        self::TARGET_TERMINATE => [
            'type' => 'string'
        ],
        self::TARGET_ANNOUNCEMENT => [
            'type' => 'object'
        ],
        self::TARGET_USER => [
            'type' => 'object'
        ],
        self::TARGET_CALL_STEERING => [
            'type' => 'object'
        ],
        self::TARGET_VOICE_MAIL => [
            'type' => 'string'
        ],
        self::TARGET_SIGNAL => [
            'type' => 'string'
        ],
        self::TARGET_CONDITION => [
            'type' => 'object'
        ],
        self::TARGET_CONTEXT => [
            'type' => 'object'
        ],
        self::TARGET_PARAM => [
            'type' => 'string'
        ],
        self::TARGET_LANGUAGE => [
            'type' => 'object'
        ],
        self::TARGET_IVR_MENU => [
            'type' => 'object'
        ],
        self::TARGET_RING_GROUP => [
            'type' => 'object'
        ],
        self::TARGET_QUEUE => [
            'type' => 'object'
        ],
        self::TARGET_CUSTOM => [
            'type' => 'string'
        ]
    ];
}