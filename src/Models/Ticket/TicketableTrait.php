<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:17 09.10.2019
 */

namespace Daktela\Models\Ticket;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait TicketableTrait
{
    protected $tickets = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return null
     */
    public function tickets($params = [], $force = false)
    {
        if ($force || is_null($this->tickets)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Ticket::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->tickets = [];
            foreach ($rows['result']['data'] as $row) {
                $this->tickets[] = Ticket::createFromRow($row);
            }
        }

        return $this->tickets;
    }
}