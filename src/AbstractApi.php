<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:32 16.08.2019
 */

namespace Daktela;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractApi
{
    /**
     * @var Connection $connection
     */
    protected $connection;

    /**
     * Worker constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    protected abstract function processFetch(ResponseInterface $response);
    protected abstract function processRead(ResponseInterface $response);
}