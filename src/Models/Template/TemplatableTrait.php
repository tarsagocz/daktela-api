<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 9:10 10.10.2019
 */

namespace Daktela\Models\Template;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait TemplatableTrait
{
    protected $templates = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return null
     */
    public function templates($params = [], $force = false)
    {
        if ($force || is_null($this->templates)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . Template::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->templates = [];
            foreach ($rows['result']['data'] as $row) {
                $this->templates[] = Template::createFromRow($row);
            }
        }

        return $this->templates;
    }
}