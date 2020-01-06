<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:15 09.10.2019
 */

namespace Daktela\Models\Account;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait AccountableTrait
{
    protected $accounts = null;

    /**
     * @param array $params
     * @param bool $force
     * @return null
     */
    public function accounts($params = [], $force = false)
    {
        if ($force || is_null($this->accounts)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Account::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->accounts = [];
            foreach ($rows['result']['data'] as $row) {
                $this->accounts[] = Account::createFromRow($row);
            }
        }

        return $this->accounts;
    }
}