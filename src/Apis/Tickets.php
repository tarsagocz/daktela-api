<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:47 16.08.2019
 */

namespace Daktela\Apis;

use Daktela\AbstractApi;

class Tickets extends AbstractApi
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'tickets';
}