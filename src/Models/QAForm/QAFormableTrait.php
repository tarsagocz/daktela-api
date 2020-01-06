<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 11:20 18.10.2019
 */

namespace Daktela\Models\QAForm;

use Daktela\Connection;
use Psr\Http\Message\ResponseInterface;

trait QAFormableTrait
{
    protected $qaforms = null;

    /**
     *
     * @param array $params
     * @param bool $force
     * @return QAForm[]
     */
    public function qaforms($params = [], $force = false)
    {
        if ($force || is_null($this->qaforms)) {
            /**
             * @var ResponseInterface $response
             */
            $response = Connection::get(self::MODEL . '/' . $this->name . '/' . QAForm::MODEL . '.json', $params);
            $rows = json_decode($response->getBody()
                ->getContents(), true);

            if (!empty($rows['error'])) {
                return null;
            }

            $this->qaforms = [];
            foreach ($rows['result']['data'] as $row) {
                $this->qaforms[] = QAForm::createFromRow($row);
            }
        }

        return $this->qaforms;
    }
}