<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:03 14.10.2019
 */

namespace Daktela\Models\Transcript;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait TranscriptableTrait
{
    protected $transcripts = null;
    /**
     *
     * @param bool $force
     * @return Transcript[]
     */
    public function transcripts($force = false)
    {
        if ($force || is_null($this->transcripts)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Transcript::MODEL . '.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->transcripts = [];
            foreach ($rows['result']['data'] as $row) {
                $this->transcripts[] = Transcript::createFromRow($row);
            }
        }

        return $this->transcripts;
    }
}