<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:26 18.10.2019
 */

namespace Daktela\Models\CampaignRecord;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait CustomFieldSchemableTrait
{
    protected $schemes = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return CustomField[]
     */
    public function schemes($params = [], $force = false)
    {
        if ($force || is_null($this->schemes)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/scheme.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->schemes = [];
            foreach ($rows['result']['data'] as $row) {
                $this->schemes[] = CustomFieldScheme::createFromRow($row);
                die();
            }
        }

        return $this->schemes;
    }
}