<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:37 19.08.2019
 */

namespace Daktela\Models\User;

use Daktela\AbstractFields;

class QueueSystemInputsFields extends AbstractFields
{
    const INPUT_TITLE = 'input_title'; // Displaying of input Title
    const INPUT_EMAIL = 'input_email'; // Displaying of input Email
    const INPUT_PHONE = 'input_phone'; // Displaying of input Phone
    const INPUT_AGREEMENT = 'input_agreement'; // Displaying of input Agreement
    const INPUT_AGREEMENT_TEXT = 'input_agreement_text'; // Text of agreement shown next to the checkbox

    const FIELDS = [
        self::INPUT_TITLE => [
            'type' => 'int'
        ],
        self::INPUT_EMAIL => [
            'type' => 'int'
        ],
        self::INPUT_PHONE => [
            'type' => 'int'
        ],
        self::INPUT_AGREEMENT => [
            'type' => 'int'
        ],
        self::INPUT_AGREEMENT_TEXT => [
            'type' => 'string'
        ]
    ];
}