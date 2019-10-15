<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:59 09.10.2019
 */

namespace Daktela\Models\Wallboard;

use Daktela\AbstractModel;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\ReadableTrait;

class Wallboard extends AbstractModel
{
    use FetchableTrait;
    use ReadableTrait;
    use ProfilableTrait;
    const MODEL = 'wallboards';
    /**
     * @var string|null
     */
    protected $name;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var string|null
     */
    protected $message;
    /**
     * @var string
     */
    protected $theme;
    /**
     * @var string|null Here you can add your own CSS styles. Mainly we mean set backgrounds and texts color, but is possible use any CSS property on any HTML element and make you own design of wallboard.
     */
    protected $custom_css;
    /**
     * @var bool|null
     */
    protected $deleted;

    /**
     * Wallboard constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $description
     * @param null|string $message
     * @param string $theme
     * @param null|string $custom_css
     * @param bool|null $deleted
     */
    public function __construct(?string $name, string $title, ?string $description, ?string $message, string $theme, ?string $custom_css, ?bool $deleted)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->message = $message;
        $this->theme = $theme;
        $this->custom_css = $custom_css;
        $this->deleted = $deleted;
    }

    /**
     * @param array $row
     * @return Wallboard
     */
    public static function createFromRow(array $row): Wallboard
    {
        $model = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('description', $row), self::optionalProperty('message', $row), $row['theme'], self::optionalProperty('custom_css', $row), self::optionalProperty('deleted', $row));
        return $model;
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
            'name'        => $this->name,
            'title'       => $this->title,
            'description' => $this->description,
            'message'     => $this->message,
            'theme'       => $this->theme,
            'custom_css'  => $this->custom_css,
            'deleted'     => $this->deleted
        ];
    }
}