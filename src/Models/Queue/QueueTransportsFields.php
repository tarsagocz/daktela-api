<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:32 19.08.2019
 */

namespace Daktela\Models\User;

use Daktela\AbstractFields;
use function Sodium\crypto_box_seed_keypair;

class QueueTransportsFields extends AbstractFields
{
    const TITLE = 'title';
    const DESTINATION = 'destination';
    const TRANSFER = 'transfer';
    const INVITE = 'invite';

    const FIELDS = [
        self::TITLE => [
            'type' => 'string'
        ],
        self::DESTINATION => [
            'type' => 'strng'
        ],
        self::TRANSFER => [
            'type' => 'bool'
        ],
        self::INVITE => [
            'type' => 'bool'
        ]
    ];
}