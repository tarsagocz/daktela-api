<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 12:47 16.08.2019
 */

namespace Daktela\Apis;

use Daktela\AbstractApi;
use Daktela\Models\Template\Template;
use Psr\Http\Message\ResponseInterface;

class Templates extends AbstractApi
{
    use FetchableTrait;
    use ReadableTrait;
    const MODEL = 'templates';

    protected function processFetch(ResponseInterface $response)
    {
        $rows = json_decode($response->getBody()->getContents(), true);

        if (!empty($rows['error'])) {
            return null;
        }

        $templates = [];

        foreach ($rows['result']['data'] as $row) {
            $templates[] = Template::createFromRow($row);
        }

        return $templates;
    }

    protected function processRead(ResponseInterface $response)
    {
        // TODO: Implement processRead() method.
    }

    public function profiles(Template $template)
    {
        return $this->processProfiles($this->connection->get(self::MODEL . '/' . $template->getName() .'/profiles.json'));
    }

    protected function processProfiles(ResponseInterface $response) {
        $rows = json_decode($response->getBody()->getContents(), true);

        if (!empty($rows['error'])) {
            return null;
        }

        $templates = [];

        foreach ($rows['result']['data'] as $row) {
            $templates[] = Template::createFromRow($row);
        }

        return $templates;
    }
}