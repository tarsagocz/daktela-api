<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:32 14.10.2019
 */

namespace Daktela\Models\ActivityEmail;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait ActivityEmailFilableTrait
{
    protected $files = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return ActivityEmailFile[]
     */
    public function files($params = [], $force = false)
    {
        if ($force || is_null($this->files)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/attachments.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->files = [];
            foreach ($rows['result']['data'] as $row) {
                $this->files[] = ActivityEmailFile::createFromRow($row);
            }
        }

        return $this->files;
    }
}