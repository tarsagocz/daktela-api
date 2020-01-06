<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:49 09.10.2019
 */

namespace Daktela\Models\Blacklist;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait BlacklistDatabasableTrait
{
    protected $blacklist_databases = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return null
     */
    public function blacklist_databases($params = [], $force = false)
    {
        if ($force || is_null($this->blacklist_databases)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/blacklistDatabases.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->blacklist_databases = [];
            foreach ($rows['result']['data'] as $row) {
                $this->blacklist_databases[] = BlacklistDatabase::createFromRow($row);
            }
        }

        return $this->blacklist_databases;
    }
}