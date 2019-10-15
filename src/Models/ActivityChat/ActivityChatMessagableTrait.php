<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:53 14.10.2019
 */

namespace Daktela\Models\ActivityChat;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait ActivityChatMessagableTrait
{
    protected $messages = null;
    /**
     *
     * @param bool $force
     * @return ActivityChatMessage[]
     */
    public function messages($force = false)
    {
        if ($force || is_null($this->messages)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/messages.json');
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->messages = [];
            foreach ($rows['result']['data'] as $row) {
                $this->messages[] = ActivityChatMessage::createFromRow($row);
            }
        }

        return $this->messages;
    }
}