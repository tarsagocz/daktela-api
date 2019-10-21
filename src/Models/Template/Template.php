<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:37 16.08.2019
 */

namespace Daktela\Models\Template;

use Daktela\AbstractModel;
use Daktela\Connection;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\Queue\QueuableTrait;
use Daktela\Models\ReadableTrait;
use Psr\Http\Message\ResponseInterface;

class Template extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use ProfilableTrait;
    use QueuableTrait;
    use FilableTrait;
    const MODEL = 'templates';
    /**
     * @var string|null Unique name
     */
    protected $name;
    /**
     * @var string Display name
     */
    protected $title;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var string|null Formatting of the template
     */
    protected $format;
    /**
     * @var string Type of template
     */
    protected $usingtype;
    /**
     * @var string|null Email subject
     */
    protected $subject;
    /**
     * @var string|null Url
     */
    protected $externalDataUrl;
    /**
     * @var string|null HTML content of the template
     */
    protected $content;

    /**
     * Template constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $description
     * @param null|string $format
     * @param string $usingtype
     * @param null|string $subject
     * @param null|string $externalDataUrl
     * @param null|string $content
     */
    public function __construct(?string $name, string $title, ?string $description, ?string $format, string $usingtype, ?string $subject, ?string $externalDataUrl, ?string $content)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->format = $format;
        $this->usingtype = $usingtype;
        $this->subject = $subject;
        $this->externalDataUrl = $externalDataUrl;
        $this->content = $content;
    }

    /**
     * @param array $row
     * @return Template
     */
    public static function createFromRow(array $row): Template
    {
        $template = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row), self::optionalProperty('format', $row), $row['usingtype'], self::optionalProperty('subject', $row), self::optionalProperty('externalDataUrl', $row), self::optionalProperty('content', $row));

        self::setModels($row, 'files', $template, File::class);

        return $template;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'name'            => $this->name,
            'title'           => $this->title,
            'description'     => $this->description,
            'format'          => $this->format,
            'usingtype'       => $this->usingtype,
            'subject'         => $this->subject,
            'externalDataUrl' => $this->externalDataUrl,
            'content'         => $this->content
        ];
    }
}