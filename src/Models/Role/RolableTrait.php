<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:39 08.10.2019
 */

namespace Daktela\Models\Role;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait RolableTrait
{
    protected $roles = null;
    /**
     *
     * @param bool $force
     * @return null
     */
    public function roles($force = false)
    {
        if ($force || is_null($this->roles)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Role::MODEL . '.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->roles = [];
            foreach ($rows['result']['data'] as $row) {
                $this->roles[] = Role::createFromRow($row);
            }
        }

        return $this->roles;
    }
}