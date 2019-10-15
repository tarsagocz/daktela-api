<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:44 16.08.2019
 */

namespace Daktela\Apis;

use Daktela\AbstractApi;

class CrmRecords extends AbstractApi
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'crmRecords';
}