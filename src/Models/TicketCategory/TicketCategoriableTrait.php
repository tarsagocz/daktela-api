<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:28 08.10.2019
 */

namespace Daktela\Models\TicketCategory;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait TicketCategoriableTrait
{
    protected $ticket_categories = null;
    /**
     *
     * @param bool $force
     * @return null
     */
    public function categories($force = false)
    {
        if ($force || is_null($this->ticket_categories)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/categories.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->ticket_categories = [];
            foreach ($rows['result']['data'] as $row) {
                $this->ticket_categories[] = TicketCategory::createFromRow($row);
            }
        }

        return $this->ticket_categories;
    }
}