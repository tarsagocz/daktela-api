<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:15 08.10.2019
 */

namespace Daktela\Models\Group;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait GroupableTrait
{
    protected $groups = null;

    /**
     *
     * @param bool $force
     * @return null
     */
    public function groups($force = false)
    {
        if ($force || is_null($this->groups)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Group::MODEL . '.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->groups = [];
            foreach ($rows['result']['data'] as $row) {
                $this->groups[] = Group::createFromRow($row);
            }
        }

        return $this->groups;
    }
}