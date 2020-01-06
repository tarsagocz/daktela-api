<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:02 15.10.2019
 */

namespace Daktela\Models\CampaignRecord;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait Snapshotable
{
    protected $snapshots = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return null
     */
    public function snapshots($params = [], $force = false)
    {
        if ($force || is_null($this->snapshots)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Snapshot::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->snapshots = [];
            foreach ($rows['result']['data'] as $row) {
                $this->snapshots[] = Snapshot::createFromRow($row);
            }
        }

        return $this->snapshots;
    }
}