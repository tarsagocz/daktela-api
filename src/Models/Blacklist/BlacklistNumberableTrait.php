<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:13 08.10.2019
 */

namespace Daktela\Models\Blacklist;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait BlacklistNumberableTrait
{
    protected $numbers = null;
    /**
     *
     * @param bool $force
     * @return null
     */
    public function numbers($force = false)
    {
        if ($force || is_null($this->numbers)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/numbers.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->numbers = [];
            foreach ($rows['result']['data'] as $row) {
                $this->numbers[] = BlacklistNumber::createFromRow($row);
            }
        }

        return $this->numbers;
    }
}