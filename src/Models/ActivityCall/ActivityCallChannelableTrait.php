<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:41 14.10.2019
 */

namespace Daktela\Models\ActivityCall;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait ActivityCallChannelableTrait
{
    protected $channels = null;
    /**
     *
     * @param bool $force
     * @return ActivityCallChannel[]
     */
    public function channels($force = false)
    {
        if ($force || is_null($this->channels)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Ac::MODEL . '.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->channels = [];
            foreach ($rows['result']['data'] as $row) {
                $this->channels[] = ActivityCallChannel::createFromRow($row);
            }
        }

        return $this->channels;
    }
}