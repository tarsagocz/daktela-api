<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:26 10.10.2019
 */

namespace Daktela\Models\Event;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait EventableTrait
{
    protected $events = null;
    /**
     *
     * @param bool $force
     * @return null
     */
    public function events($force = false)
    {
        if ($force || is_null($this->events)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Event::MODEL .'.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->events = [];
            foreach ($rows['result']['data'] as $row) {
                $this->events[] = Event::createFromRow($row);
            }
        }

        return $this->events;
    }
}