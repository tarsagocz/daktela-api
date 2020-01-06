<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:11 09.10.2019
 */

namespace Daktela\Models\Contact;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait ContactableTrait
{
    protected $contacts = null;

    /**
     * @param array $params
     * @param bool $force
     * @return null
     */
    public function contacts($params = [], $force = false)
    {
        if ($force || is_null($this->contacts)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Contact::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->contacts = [];
            foreach ($rows['result']['data'] as $row) {
                $this->contacts[] = Contact::createFromRow($row);
            }
        }

        return $this->contacts;
    }
}