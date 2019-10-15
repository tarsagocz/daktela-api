<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:07 09.10.2019
 */

namespace Daktela\Models\Wallboard;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait WallboardableTrait
{
    protected $wallboards = null;
    /**
     *
     * @param bool $force
     * @return null
     */
    public function wallboards($force = false)
    {
        if ($force || is_null($this->wallboards)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Wallboard::MODEL .'.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->wallboards = [];
            foreach ($rows['result']['data'] as $row) {
                $this->wallboards[] = Wallboard::createFromRow($row);
            }
        }

        return $this->wallboards;
    }
}