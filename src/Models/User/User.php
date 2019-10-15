<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:57 19.08.2019
 */

namespace Daktela\Models\User;

use Daktela\AbstractModel;
use Daktela\Models\Account\AccountableTrait;
use Daktela\Models\Contact\ContactableTrait;
use Daktela\Models\CrmRecord\CrmRecordableTrait;
use Daktela\Models\Event\EventableTrait;
use Daktela\Models\FetchableTrait;
use Daktela\Models\Group\GroupableTrait;
use Daktela\Models\OptionableTrait;
use Daktela\Models\Pause\PausableTrait;
use Daktela\Models\Profile\ProfilableTrait;
use Daktela\Models\Profile\Profile;
use Daktela\Models\Queue\QueuableTrait;
use Daktela\Models\ReadableTrait;
use Daktela\Models\Role\RolableTrait;
use Daktela\Models\Role\Role;
use Daktela\Models\Template\TemplatableTrait;
use Daktela\Models\Ticket\TicketableTrait;
use Daktela\Models\TicketCategory\TicketCategoriableTrait;
use Daktela\Models\Wallboard\WallboardableTrait;

class User extends AbstractModel
{
    use OptionableTrait;
    use FetchableTrait;
    use ReadableTrait;
    use ProfilableTrait;
    use RolableTrait;
    use GroupableTrait;
    use QueuableTrait;
    use TicketCategoriableTrait;
    use UserableTrait;
    use TicketableTrait;
    use CrmRecordableTrait;
    use AccountableTrait;
    use ContactableTrait;
    use WallboardableTrait;
    use TemplatableTrait;
    use PausableTrait;
    use EventableTrait;
    const MODEL = 'users';
    /**
     * @var string|null Login name
     */
    protected $name;
    /**
     * @var string Display name [required]
     */
    protected $title;
    /**
     * @var string|null User's alias, used for example in webchat as visible nickname for customer
     */
    protected $alias;
    /**
     * @var string|null Calculated NPS score for all activities of this user
     */
    protected $nps_score;
    /**
     * @var string|null Optional description
     */
    protected $description;
    /**
     * @var string|null Hint words for call steering application
     */
    protected $call_steering_description;
    /**
     * @var string Password [required]
     */
    protected $password;
    /**
     * @var string|null Extension is an internal number that shielding more SIP devices and external numbers
     */
    protected $extension;
    /**
     * @var string|null State of phisical devices, connected to extension
     */
    protected $extension_state;
    /**
     * @var string|null What phone number should the user represent when calling
     */
    protected $clid;
    /**
     * @var bool|null The type of registered user, static, the user for work should not be authenticated in the control panel
     */
    protected $static;
    /**
     * @var bool|null Switch for recording calls. Calls will be recorded if that settings is set either on User or on Queue
     */
    protected $recordCalls;
    /**
     * @var string|null Maximum ringing time in seconds on backoffice user
     */
    protected $backofficeRinging;
    /**
     * @var string|null User email address mainly for notifications
     */
    protected $email;
    /**
     * @var string|null Email that is used for Google authentication
     */
    protected $emailAuth;
    /**
     * @var string|null User's picture, used for example in webchat as avatar. It is better if picture have a square format.
     */
    protected $icon;
    /**
     * @var string|null User's emoji. It`s used only in Daktela user interface for better distinction of users.
     */
    protected $emoji;
    /**
     * @var bool|null Flag if user belongs to backoffice category
     */
    protected $backoffice_user;
    /**
     * @var string|null Call forwarding number
     */
    protected $forwarding_number;
    /**
     * @var bool|null Deactivated flag
     */
    protected $deactivated;
    /**
     * @var bool|null Deleted flag
     */
    protected $deleted;

    protected $profile;
    protected $role;

    /**
     * User constructor.
     * @param null|string $name
     * @param string $title
     * @param null|string $alias
     * @param null|string $nps_score
     * @param null|string $description
     * @param null|string $call_steering_description
     * @param string $password
     * @param null|string $extension
     * @param null|string $extension_state
     * @param null|string $clid
     * @param bool|null $static
     * @param bool|null $recordCalls
     * @param null|string $backofficeRinging
     * @param null|string $email
     * @param null|string $emailAuth
     * @param null|string $icon
     * @param null|string $emoji
     * @param bool|null $backoffice_user
     * @param null|string $forwarding_number
     * @param bool|null $deactivated
     * @param bool|null $deleted
     */
    public function __construct(?string $name, string $title, ?string $alias, ?string $nps_score, ?string $description, ?string $call_steering_description, ?string $password, ?string $extension, ?string $extension_state, ?string $clid, ?bool $static, ?bool $recordCalls, ?string $backofficeRinging, ?string $email, ?string $emailAuth, ?string $icon, ?string $emoji, ?bool $backoffice_user, ?string $forwarding_number, ?bool $deactivated, ?bool $deleted)
    {
        $this->name = $name;
        $this->title = $title;
        $this->alias = $alias;
        $this->nps_score = $nps_score;
        $this->description = $description;
        $this->call_steering_description = $call_steering_description;
        $this->password = $password;
        $this->extension = $extension;
        $this->extension_state = $extension_state;
        $this->clid = $clid;
        $this->static = $static;
        $this->recordCalls = $recordCalls;
        $this->backofficeRinging = $backofficeRinging;
        $this->email = $email;
        $this->emailAuth = $emailAuth;
        $this->icon = $icon;
        $this->emoji = $emoji;
        $this->backoffice_user = $backoffice_user;
        $this->forwarding_number = $forwarding_number;
        $this->deactivated = $deactivated;
        $this->deleted = $deleted;
    }

    /**
     * @param array $row
     * @return User
     */
    public static function createFromRow(array $row): User
    {
        $user = new self(self::optionalProperty('name', $row), $row['title'], self::optionalProperty('alias', $row), self::optionalProperty('nps_score', $row), self::optionalProperty('description', $row), self::optionalProperty('call_steering_description', $row), self::optionalProperty('password', $row), self::optionalProperty('extension', $row), self::optionalProperty('extension_state', $row), self::optionalProperty('clid', $row), self::optionalProperty('static', $row), self::optionalProperty('racordCalls', $row), self::optionalProperty('backofficeRinging', $row), self::optionalProperty('email', $row), self::optionalProperty('emailAuth', $row), self::optionalProperty('icon', $row), self::optionalProperty('emoji', $row), self::optionalProperty('backoffice_user', $row), self::optionalProperty('forwarding_number', $row), self::optionalProperty('deactived', $row), self::optionalProperty('deleted', $row));

        if (self::isPropertyExist('options', $row)) {
            $user->setOptions($row['options']);
        }

        if (self::isPropertyExist('profile', $row)) {
            $user->profile = Profile::createFromRow($row['profile']);
        }

        if (self::isPropertyExist('role', $row)) {
            $user->role = Profile::createFromRow($row['role']);
        }

        return $user;
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
            'name'                      => $this->name,
            'title'                     => $this->title,
            'alias'                     => $this->alias,
            'nps_score'                 => $this->nps_score,
            'description'               => $this->description,
            'call_steering_description' => $this->call_steering_description,
            'password'                  => $this->password,
            'extension'                 => $this->extension,
            'extension_state'           => $this->extension_state,
            'clid'                      => $this->clid,
            'static'                    => $this->static,
            'recordCalls'               => $this->recordCalls,
            'backofficeRinging'         => $this->backofficeRinging,
            'email'                     => $this->email,
            'emailAuth'                 => $this->emailAuth,
            'icon'                      => $this->icon,
            'emoji'                     => $this->emoji,
            'backoffice_user'           => $this->backoffice_user,
            'forwarding_number'         => $this->forwarding_number,
            'deactivated'               => $this->deactivated,
            'deleted'                   => $this->deleted,
        ];
    }

    public function role()
    {
        if (is_string($this->role)) {
            $this->role = Role::read($this->role);
        }

        return $this->role;
    }
}