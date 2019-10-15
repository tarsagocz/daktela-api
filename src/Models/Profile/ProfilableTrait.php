<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:42 21.08.2019
 */

namespace Daktela\Models\Profile;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait ProfilableTrait
{
    protected $profiles = null;
    /**
     * @param bool $force
     * @return null
     */
    public function profiles($force = false)
    {
        if ($force || is_null($this->profiles)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Profile::MODEL . '.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->profiles = [];
            foreach ($rows['result']['data'] as $row) {
                $this->profiles[] = Profile::createFromRow($row);
            }
        }

        return $this->profiles;
    }
}