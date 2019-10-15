<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:28 16.08.2019
 */

namespace Daktela\Models;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait FetchableTrait
{
    public static function fetch()
    {
        /**
         * @var ResponseInterface $response
         */
        $response = Connection::get(self::MODEL . '.json');
        $rows = json_decode($response->getBody()->getContents(), true);

        if (!empty($rows['error'])) {
            return null;
        }

        $objects = [];
        foreach ($rows['result']['data'] as $row) {
            $objects[] = self::createFromRow($row);
        }
        return $objects;
    }
}