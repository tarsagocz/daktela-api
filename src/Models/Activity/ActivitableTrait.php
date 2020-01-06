<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:07 14.10.2019
 */

namespace Daktela\Models\Activity;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait ActivitableTrait
{
    protected $activities = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return Activity[]
     */
    public function activities($params = [], $force = false)
    {
        if ($force || is_null($this->activities)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Activity::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->activities = [];
            foreach ($rows['result']['data'] as $row) {
                $this->activities[] = Activity::createFromRow($row);
            }
        }

        return $this->activities;
    }
}