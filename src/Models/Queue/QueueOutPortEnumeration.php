<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:29 19.08.2019
 */

namespace Daktela\Models\Queue;

class QueueOutPortEnumeration
{
    const UNSECURED_CONNECTION = 25;
    const ENCRYPTED_CONNECTION_SSL = 465;
    const ENCRYPTED_CONNECTION_MSA = 587;
}