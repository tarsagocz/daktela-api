<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:43 16.08.2019
 */

namespace Daktela\Models\Ticket;

class TicketStageEnumeration
{
    const OPEN = 'OPEN'; // Open_noun
    const WAIT = 'WAIT'; // Waiting
    const CLOSE = 'CLOSE'; // Closed
    const ARCHIVE = 'ARCHIVE'; // Archived
}