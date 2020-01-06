<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:42 09.10.2019
 */

namespace Daktela\Models\Contact;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait ContactSnapshotableTrait
{
    protected $snapshots = null;

    /**
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
            $response = Connection::get(self::MODEL . '/' . $this->name . '/snapshots.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->snapshots = [];
            foreach ($rows['result']['data'] as $row) {
                $this->snapshots[] = ContactSnapshot::createFromRow($row);
            }
        }

        return $this->snapshots;
    }
}