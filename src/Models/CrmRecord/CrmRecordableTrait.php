<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:56 09.10.2019
 */

namespace Daktela\Models\CrmRecord;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait CrmRecordableTrait
{
    protected $records = null;
    /**
     * @param bool $force
     * @return null
     */
    public function records($force = false)
    {
        if ($force || is_null($this->records)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/records.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->records = [];
            foreach ($rows['result']['data'] as $row) {
                $this->records[] = CrmRecord::createFromRow($row);
            }
        }

        return $this->records;
    }
}