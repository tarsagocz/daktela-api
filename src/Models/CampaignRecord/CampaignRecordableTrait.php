<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:21 18.10.2019
 */

namespace Daktela\Models\CampaignRecord;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait CampaignRecordableTrait
{
    protected $campaignrecords = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return CampaignRecord[]
     */
    public function campaignrecords($params = [], $force = false)
    {
        if ($force || is_null($this->campaignrecords)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . strtolower(CampaignRecord::MODEL) . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->campaignrecords = [];
            foreach ($rows['result']['data'] as $row) {
                $this->campaignrecords[] = CampaignRecord::createFromRow($row);
            }
        }

        return $this->campaignrecords;
    }
}