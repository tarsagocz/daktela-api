<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:52 09.10.2019
 */

namespace Daktela\Models\User;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait UserableTrait
{
    protected $users = null;
    /**
     *
     * @param bool $force
     * @return null
     */
    public function users($force = false)
    {
        if ($force || is_null($this->users)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . User::MODEL .'.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->users = [];
            foreach ($rows['result']['data'] as $row) {
                $this->users[] = User::createFromRow($row);
            }
        }

        return $this->users;
    }
}