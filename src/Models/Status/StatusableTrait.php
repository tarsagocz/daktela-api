<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:23 08.10.2019
 */

namespace Daktela\Models\Status;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait StatusableTrait
{
    protected $statuses = null;

    /**
     * @param array $params
     * @param bool $force
     * @return array|null
     */
    public function statuses($params = [], $force = false)
    {
        if ($force || is_null($this->statuses)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Status::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->statuses = [];
            foreach ($rows['result']['data'] as $row) {
                $this->statuses[] = Status::createFromRow($row);
            }
        }

        return $this->statuses;
    }
}