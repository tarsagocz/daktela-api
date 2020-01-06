<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:13 10.10.2019
 */

namespace Daktela\Models\Pause;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait PausableTrait
{
    protected $pauses = null;

    /**
     * @param array $params
     * @param bool $force
     * @return null
     */
    public function pauses($params = [], $force = false)
    {
        if ($force || is_null($this->pauses)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Pause::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->pauses = [];
            foreach ($rows['result']['data'] as $row) {
                $this->pauses[] = Pause::createFromRow($row);
            }
        }

        return $this->pauses;
    }
}