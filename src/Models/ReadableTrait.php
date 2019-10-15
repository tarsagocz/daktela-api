<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:28 16.08.2019
 */

namespace Daktela\Models;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait ReadableTrait
{
    /**
     * @param $name
     * @return mixed
     */
    public static function read($name)
    {
        /**
         * @var ResponseInterface $response
         */
        $response = Connection::get(self::MODEL . '/' . $name . '.json');
        $row = json_decode($response->getBody()
            ->getContents(), true);

        return self::createFromRow($row['result']);
    }
}