<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:44 16.08.2019
 */

namespace Daktela\Apis;

use Daktela\AbstractApi;
use Daktela\Models\CampaignRecord\CampaignRecord;
use Psr\Http\Message\ResponseInterface;

class CampaignsRecords extends AbstractApi
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'campaignsRecords';

    public function processFetch(ResponseInterface $response)
    {
        $rows = json_decode($response->getBody()->getContents(), true);

        if (!empty($rows['error'])) {
            return null;
        }

        foreach ($rows['result'] as $row) {
            var_dump($row[0]);
            $campaignRecord = new CampaignRecord();
            die();
        }


        return [];
    }

    public function processRead(ResponseInterface $response)
    {

    }
}