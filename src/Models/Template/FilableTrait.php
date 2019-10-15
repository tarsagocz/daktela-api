<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 8:48 10.10.2019
 */

namespace Daktela\Models\Template;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait FilableTrait
{
    protected $files = null;
    /**
     *
     * @param bool $force
     * @return null
     */
    public function files($force = false)
    {
        if ($force || is_null($this->files)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/attachments.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->files = [];
            foreach ($rows['result']['data'] as $row) {
                $this->files[] = File::createFromRow($row);
            }
        }

        return $this->files;
    }
}