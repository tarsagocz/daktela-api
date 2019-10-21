<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:25 18.10.2019
 */

namespace Daktela\Models\CampaignRecord;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait CustomFieldableTrait
{
    protected $fields = null;
    /**
     *
     * @param bool $force
     * @return CustomField[]
     */
    public function fields($force = false)
    {
        if ($force || is_null($this->fields)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/scheme.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->fields = [];
            foreach ($rows['result']['data'] as $row) {
                $this->fields[] = CustomField::createFromRow($row);
            }
        }

        return $this->fields;
    }
}