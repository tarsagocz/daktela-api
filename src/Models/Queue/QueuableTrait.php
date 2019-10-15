<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:51 08.10.2019
 */

namespace Daktela\Models\Queue;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait QueuableTrait
{
    protected $queues = null;
    /**
     * TODO
     *
     * @param bool $force
     * @return null
     */
    public function queues($force = false)
    {
        if ($force || is_null($this->queues)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Queue::MODEL . '.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->queues = [];
            foreach ($rows['result']['data'] as $row) {
                $this->queues[] = Queue::createFromRow($row);
            }
        }

        return $this->queues;
    }
}