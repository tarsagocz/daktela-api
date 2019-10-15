<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:03 16.08.2019
 */

namespace Daktela\Apis;

use Daktela\AbstractApi;

class Users extends AbstractApi
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'users';
}