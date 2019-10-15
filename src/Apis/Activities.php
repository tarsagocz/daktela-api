<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:22 16.08.2019
 */

namespace Daktela\Apis;

use Daktela\AbstractApi;

class Activities extends AbstractApi
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'activities';
}