<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:01 19.08.2019
 */

namespace Daktela\Models\Queue;

use Daktela\AbstractFields;

class QueueOptionsFields extends AbstractFields
{
    const MULTIPLE_STATUSES = 'multiple_statuses'; // Multiple statuses-description
    const PREFIX = 'prefix'; // Prefix CID-description. For types: "in", "ctc"
    const OUTBOUND_CID = 'outboundcid'; // The number that is presented to the called party for calls from this queue. For types: "out", "outbounder", "ctc", "dialer", "progressive", "interviewer"
    const RECORD_CALLS = 'record_calls'; // Defines whether the calls routed via this queue are recorded. The calls are recorded if this options is set to On either on the queue or on the user. For types: "in", "ctc", "dialer", "interviewer", "out", "outbounder", "progressive"
    const DISABLE_PHONE_EDITING = 'disable_phone_editing'; // When set to On the agents are not able to change the phone number of the assigned and active record and have to work with the original number of the record only. For types: "in", "out", "ctc", "dialer", "outbounder", "interviewer", "progressive"
    const RECORDINGS_RETENTION = 'recordings_retention'; // How many days queue call's recordings will be saved in call center. Can't be more than Maximum recordings retention value, which is set globally for CC. If is set as 0 or empty, then recordings retention will be set as Maximum queue recording retention value. For types: "in", "ctc", "dialer", "interviewer", "out", "outbounder", "progressive"
    const CALL_BUSY = 'call_busy'; // No strategy. Used for one operator only. No prefmember. For types: "in"
    const RECORDING_USER = 'recording_user'; // Record for operator-description. For types: "in"
    const RECORDING_BEFORE = 'recording_before'; // Record before join-description. For types: "in"
    const RECORDING_JOIN = 'recording_join'; // Recording after connection - The recording that is played within the call after the customer connects to the queue. For types: "in", "dialer"
    const HELPDESK = 'helpdesk'; // Set helpdesk title for this queue. For types: "email"
    const TIME_CONDITION = 'timecondition'; // Working time-description. For types: "interviewer", "dialer", "progressive", "ctc", "sms", "chat", "fbm", "email"
    const CALLS_PER_OPERATOR = 'calls_per_operator'; // Calls per agent defines how many calls are dialled for each idle agent. When set to "Dynamic", dialler will automatically calculate the appropriate amount of calls based on previous 30 minutes traffic. For types: "dialer"
    const MUSIC = 'music'; // Ringtone-description. For types: "in", "dialer"
    const MAX_WAIT = 'maxwait'; // Max. waiting time-description. For types: "in", "ctc", "dialer", "chat", "sms", "fbm"
    const MAX_LENGTH = 'maxlength'; // Max. count waiting-description. For types: "in", "ctc"
    const CALL_TIMEOUT = 'call_timeout'; // Max. call time-description. For types: "in", "interviewer"
    const JOIN_EMPTY = 'join_empty'; // Enter to queue-description. For types: "in"
    const LEAVE_EMPTY = 'leave_empty'; // Leave from queue-description. For types: "in"
    const STRATEGY = 'strategy'; // Strategy of activities distribution for available users within queue.
    const CALL_LAST_AGENT = 'call_last_agent'; // Call last agent-description. For types: "in", "ctc", "chat", "sms", "fbm"
    const LAST_AGENT_HOURS = 'last_agent_hours'; // Last agent hours-description. For types: "in", "ctc", "chat", "sms", "fbm"
    const RINGTIME = 'ringtime'; // Ring time-description. For types: "in", "ctc"
    const WRAPUP_TIME = 'wrapuptime'; // Wrapup time-description. For types: "in", "out", "chat", "sms", "fbm", "email", "ctc"
    const WEIGHT = 'weight'; // Priority-description. For types: "in", "ctc"
    const LAJDAK = 'lajdak'; // Automatic Pause-description. For types: "in", "chat", "sms", "fbm", "ctc"
    const LAJDAK_TIME = 'lajdaktime'; // lazytime-description. For types: "outbounder"
    const LOAD_TIME = 'loadtime'; // For campaign preview (manual) it specifies the maximal time for operator to load and read the form. Automatic pause Lazy is set when this time expires. For campaign progressive it specifies the time for operator to read and study the form before system makes the call automatically. For types: "outbounder", "progressive"
    const SAVE_TIME = 'savetime'; // The time that is required for filling and saving the activity form. When the time expires, the "Lazy" pause is automatically set for the appropriate agent. For types: "outbounder", "dialer", "in", "out", "chat", "ctc", "progressive"
    const POSITION_ANNOUNCEMENT = 'position_announcement'; // IVR immediately-description. For types: "in" TODO
    const POSITION_REPEAT = 'position_repeat'; // IVR repeat-description. For types: "in"
    const ANNOUNCEMENT_LANGUAGE = 'announcement_language'; // Announcements language-description. For types: "in"
    const POSITION_TIME = 'position_time'; // Position time-description. For types: "in"
    const IVR_JUMP = 'ivr_jump'; // IVR menu jump-description. For types: "in"
    const IVR_REPEAT = 'ivr_repeat'; // IVR repeat-description. For types: "in"
    const IVR_IMMEDIATELY = 'ivr_immediately'; // IVR immediately-description. For types: "in"
    const IVR_FIELD = 'ivr_field'; // IVR Field-description. For types: "interviewer"
    const TRESHOLD_TIME = 'treshold_time'; // Treshold max time-description. For types: "in", "ctc"
    const TRESHOLD_USERS = 'treshold_users'; // Threshold free users-description. For types: "in", "ctc"
    const TRESHOLD_CALLS = 'treshold_calls'; // Threshold waiting calls-description. For types: "in", "ctc"
    const USE_FORM = 'use_form'; // Use record form-description. For types: "in", "out", "ctc"
    const MISSED = 'missed';
    const MISSED_RECORD_SEARCH = 'missed_record_search'; // Additional campaign queues to search record with missed call's CLID. For types: "in"
    const MISSED_RECORD_STATUS = 'missed_record_status'; // Status which will be set to record, that was updated/created from missed call. For types: "in"
    const MISSED_TIME_BACK = 'missed_time_back'; // Missed call back-description. For types: "in"
    const MISSED_TIME_LIMIT = 'missed_time_limit'; // MissedTimeLimit-description. For types: "in", "chat"
    const MISSED_AUTOCALL_BACK = 'missed_autocall_back'; // If missed calls should be called back automatically. For types: "in"
    const _HAS_STATUSES = '_has_statuses'; // For types: "chat", "ctc", "dialer", "email", "fbm", "in", "interviewer", "out", "outbounder", "progressive", "sms"
    const MISSED_CHANNELS = 'missed_channels'; // Missed activities. For types: "chat", "sms", "fbm"
    const CHANNELS_TIME_BACK = 'channels_time_back'; // For how long activities stays in missed activities. For types: "chat", "sms", "fbm"
    const MISSED_QUEUE_CALL = 'missed_queue_call'; // Queue type call for answering on missed channel. For types: "chat", "sms", "fbm"
    const MISSED_QUEUE_SMS = 'missed_queue_sms'; // Queue type sms for answering on missed channel. For types: "chat", "sms", "fbm"
    const MISSED_QUEUE_EMAIL = 'missed_queue_email'; // Queue type email for answering on missed channel. For types: "chat", "sms", "fbm"
    const MISSED_QUEUE_FBM = 'missed_queue_fbm'; // Queue for replying a missed facebook message. For types: "fbm"
    const SORT_TIME = 'sort_time'; // Type of sorting logic for choosing next record. For types: "outbounder", "dialer", "progressive"
    const CONTACT_TIMEOUT = 'contact_timeout'; // Contact timeout-description. For types: "outbounder", "dialer", "progressive"
    const MACROLINKS = 'macrolinks'; // Opening an external URL for example a customer card.
    const MACRO_TRANSPORTS = 'macrotransports'; // Invite and transfer for calls and chats.
    const CAMPAIGNS = 'campaigns'; // Campaigns-description. For types: "in"
    const TARGET = 'target'; // For types: "in", "dialer", "interviewer"
    const CRM_TICKET_CATEGORY = 'crm_ticket_category'; // Category-description. For types: "in", "out", "outbounder", "dialer", "ctc", "progressive", "chat", "sms", "fbm", "email"
    const AUTO_ANSWER = 'autoanswer'; // Auto answer-description. For types: "in", "ctc"
    const SELECT_RECORDS = 'select_records'; // Enables the agents to manually pick and call any campaign record that fills the appropriate conditions. For types: "in", "out", "outbounder", "dialer", "ctc"
    const REQUIRED_LOGIN = 'required_login'; // Required login-description. For types: "outbounder"
    const SKIP_RECORDS = 'skip_records'; // Enables the agents to save and skip the record that has been assigned to them without calling the assigned record. For types: "outbounder", "in", "out", "dialer", "ctc"
    const CHANGE_RECORDS_USER = 'change_records_user'; // Change user records-description. For types: "outbounder"
    const WAIT_TIME = 'waittime'; // Wait time-description. For types: "chat", "sms", "fbm"
    const SLEEP_TIME = 'sleeptime'; // Sleep time-description. For types: "chat"
    const PRIORITY = 'priority'; // Priority-description. For types: "chat", "fbm", "sms"
    const EMAIL = 'email'; // Email address on whitch will be send notification about chat. For types: "chat"
    const LANG = 'lang'; // Language-description. For types: "chat", "ctc"
    const SHOW_USERS_NAME = 'show_users_name'; // Show full name of user or user alias or nothing to customer. For types: "chat"
    const SHOW_USERS_ICON = 'show_users_icon'; // Show user photo to customer. For types: "chat"
    const ALLOW_FILE_UPLOADS = 'allow_file_uploads'; // Allow sending files (images, documents,..) form operator to customer, from customer to operator or both sides. For types: "chat", "fbm"
    const SYSTEM_INPUTS = 'system_inputs'; // Settings of system inputs. For types: "chat"
    const CUSTOM_INPUTS = 'custom_inputs'; // Settings of custom inputs. For types: "chat", "ctc"
    const CUSTOM_GREETINGS = 'custom_greetings'; // Settings of custom greetings (will be displayed according to URL and time). For types: "chat", "ctc"
    const CLIENT_DESIGN = 'client_design'; // Settings of design and functionality on customer side. For types: "chat", "ctc"
    const USERNAME = 'username'; // User name-description. For types: "email"
    const ADDRESS = 'address'; // Email address. For types: "email"
    const SIGN = 'sign'; // Signature-description. For types: "email"
    const SIGN_TEMPLATE = 'signtemplate'; // Signature template-description. For types: "email"
    const NPS_TEMPLATE = 'npstemplate'; // Template for adding Net Promoter Score surveys. For types: "email", "chat"
    const NO_KEEP_ON_MAILSERVER = 'no_keep_on_mailserver'; // Remove emails from the mail server after downloading them. For types: "email"
    const SSL_TRUSMACROLINKSTED = 'ssl_trusmacrolinksted'; // Allow trusted only certificates. For types: "email"
    const IN_TYPE = 'in_type'; // Protocol-description. For types: "email"
    const IN_SERVER = 'in_server'; // Server on which your email is located on. For types: "email"
    const IN_NAME = 'in_name'; // Login name(email) for your email. For types: "email"
    const IN_PASSWORD = 'in_password'; // Login password for your email. For types: "email"
    const IN_SSL = 'in_ssl'; // SSL-description. For types: "email"
    const OUT_SERVER = 'out_server'; // Server on which your email is located on. For types: "email"
    const OUT_NAME = 'out_name'; // Login name(email) for your email. For types: "email"
    const OUT_PASSWORD = 'out_password'; // Login password for your email. For types: "email"
    const OUT_PORT = 'out_port'; // SMTP | Port 587 (Insecure Transport), SMTP | Port 465 (Secure Transport — SSL function enabled), SMTP | Port 25 (Outdated and not recommended. username/password authentication MUST be enabled if using this port). For types: "email"
    const RESPOND = 'respond'; // Respond-description. For types: "email"
    const RESPOND_OUTSIDE_TIME_CONDITION = 'respond_outside_timecondition'; // Respond. When the condition does not apply. For types: "email"
    const EXCLUDE_EMAILS = 'exclude_emails'; // Exclude emails-description. For types: "email"
    const ALLOW_NUMBERS = 'allow_numbers'; // Allowed numbers-description. For types: "ctc"
    const POWER = 'power'; // Power-description. For types: "dialer", "interviewer", "ctc", "progressive", "email"
    const MAX_RINGTIME = 'max_ringtime'; // Defines the time in seconds how long should the dialler wait for call answer by the customer. If the max ring time expires, the call is dropped and "Dialler hangup status" is set to the record. For types: "dialer", "interviewer", "progressive"
    const MAX_ATTEMPTS = 'max_attempts'; // Defines how many times the dialler should call the record before stopping the record completely, after unsuccesful reaching of the customer. The other attempts are performed after the "Attempts delay". E.g. when "Max attempts" is set to 2 and "Attempts delay" set to 18 hours, the record is dialled once and not answered, then again after 18 hours from the first attempt, and last time after 18 hours from the second attempt before stopping the record dialling at all. For types: "dialer", "interviewer", "progressive"
    const DELAY_TIME = 'delaytime'; // The period between each individual attempt made by the dialler according to the "Max attempts" option. For types: "dialer", "interviewer", "progressive"
    const DELAY_ANSWERED = 'delay_answered'; // Pause after answered call. Next form (campaign record) is loaded after that. For types: "progressive"
    const DELAY_UNANSWERED = 'delay_unanswered'; // Pause after unanswered call. Next form (campaign record) is loaded after that. For types: "progressive"
    const STATUS_ANSWER = 'status_answer'; // Answer status-description. For types: "interviewer"
    const STATUS_BUSY = 'status_busy'; // Defines which status shall be set to the record when the called party is busy while the dialler attempts to make a connection. For types: "dialer", "interviewer", "progressive"
    const STATUS_HANGUP_DIALER = 'status_hangup_dialer'; // Defines which status shall be set to the record the called party cannot be reached within the "Max ring time" period and the call is dropped. For types: "dialer", "interviewer", "ctc", "progressive"
    const STATUS_HANGUP_CUSTOMER = 'status_hangup_customer'; // Defines which status shall be set to the record when the call is answered by the called party and the called party then drops the call before the call is handled by available agent. For types: "dialer"
    const MAX_THREADS = 'max_threads'; // Max Threads-description. For types: "interviewer"
    const SMS_TYPE = 'sms_type'; // Sms type-description. For types: "sms"
    const API_TOKEN = 'api_token'; // API token-description. For types: "sms"
    const SMS_PREFIX = 'sms_prefix'; // Number prefixes-description. For types: "sms"
    const SMS_UNICODE = 'sms_unicode'; // If enabled, the diacritic will not be stripped off. For types: "sms"
    const SMS_DELIVERY_RECEIPT = 'sms_delivery_receipt'; // Enable/disable the delivery receipt. For types: "sms"
    const SMS_ALLOWED_HOUR_BEGIN = 'sms_allowed_hour_begin'; // Begin hour-description. For types: "sms"
    const SMS_ALLOWED_HOUR_END = 'sms_allowed_hour_end'; // End hour-description. For types: "sms"
    const SMS_SENDING_RATE_LIMIT = 'sms_sending_rate_limit'; // Sending rate limit-description. For types: "sms"
    const SMS_SENDING_RATE_TIME = 'sms_sending_rate_time'; // Sending rate time-description. For types: "sms"
    const SMS_INCOMING_CALLBACK = 'sms_incoming_callback'; // Incoming callback-description. For types: "sms"
    const SMS_OUTGOING_CALLBACK = 'sms_outgoing_callback'; // Outgoing callback-description. For types: "sms"
    const SMS_SENDER = 'sms_sender'; // SMS Sender-description. For types: "sms"
    const SMS_PRIORITY = 'sms_priority'; // Priority-description. For types: "sms"
    const CLOSED_HOURS_TEMPLATE = 'closed_hours_template'; // This template will be used when opening hours are closed. For types: "sms", "fbm"
    const FB_PAGE_ID = 'fb_page_id'; // Unique identificator of your Facebook page, will be filled automatically. For types: "fbm"
    const FB_PAGE_URL = 'fb_page_url'; // Link to your Facebook page. For types: "fbm"
    const FB_PAGE_NAME = 'fb_page_name'; // Name of your Facebook page, will be filled automatically. For types: "fbm"
    const FB_AUTHORIZED = 'fb_authorized'; // Daktela application authorized to use page's Facebook messenger. For types: "fbm"
    const FB_AUTHORIZED_BY = 'fb_authorized_by'; // Facebook user who authorized this page to Facebook messenger. For types: "fbm"
    const FB_ICON = 'fb_icon'; // Facebook page icon. For types: "fbm"
    const ALLOW_DESCRIPTION = 'allow_decription'; // Allow filling in the description within open activity. For types: "in", "out", "outbounder", "ctc", "dialer", "chat", "sms", "fbm", "progressive"
    const TAB_AUTOFOCUS = 'tab_autofocus'; // Activity tab autofocus. For types: "in", "out"

    const FIELDS = [
        self::MULTIPLE_STATUSES => [
            'type' => 'bool'
        ],
        self::PREFIX => [
            'type' => 'string'
        ],
        self::OUTBOUND_CID => [
            'type' => 'string'
        ],
        self::RECORD_CALLS => [
            'type' => 'bool'
        ],
        self::DISABLE_PHONE_EDITING => [
            'type' => 'bool'
        ],
        self::RECORDINGS_RETENTION => [
            'type' => 'int'
        ],
        self::CALL_BUSY => [
            'type' => 'bool'
        ],
        self::RECORDING_USER => [
            'type' => 'object'
        ],
        self::RECORDING_BEFORE => [
            'type' => 'object'
        ],
        self::RECORDING_JOIN => [
            'type' => 'object'
        ],
        self::HELPDESK => [
            'type' => 'string'
        ],
        self::TIME_CONDITION => [
            'type' => 'object'
        ],
        self::CALLS_PER_OPERATOR => [
            'type' => 'string'
        ],
        self::MUSIC => [
            'type' => 'object'
        ],
        self::MAX_WAIT => [
            'type' => 'string'
        ],
        self::MAX_LENGTH => [
            'type' => 'string'
        ],
        self:: CALL_TIMEOUT => [
            'type' => 'string'
        ],
        self::JOIN_EMPTY => [
            'type' => 'string'
        ],
        self::LEAVE_EMPTY => [
            'type' => 'string'
        ],
        self::STRATEGY => [
            'type' => 'string'
        ],
        self::CALL_LAST_AGENT => [
            'type' => 'bool'
        ],
        self::LAST_AGENT_HOURS => [
            'type' => 'int'
        ],
        self::RINGTIME => [
            'type' => 'string'
        ],
        self::WRAPUP_TIME => [
            'type' => 'string'
        ],
        self::WEIGHT => [
            'type' => 'int'
        ],
        self::LAJDAK => [
            'type' => 'bool'
        ],
        self::LAJDAK_TIME => [
            'type' => 'string'
        ],
        self::LOAD_TIME => [
            'type' => 'string'
        ],
        self::SAVE_TIME => [
            'type' => 'string'
        ],
        self::POSITION_ANNOUNCEMENT => [
            'type' => 'bool'
        ],
        self::POSITION_REPEAT => [
            'type' => 'string'
        ],
        self::ANNOUNCEMENT_LANGUAGE => [
            'type' => 'string'
        ],
        self::POSITION_TIME => [
            'type' => 'string'
        ],
        self::IVR_JUMP => [
            'type' => 'object'
        ],
        self::IVR_REPEAT => [
            'type' => 'string'
        ],
        self::IVR_IMMEDIATELY => [
            'type' => 'bool'
        ],
        self::IVR_FIELD => [
            'type' => 'object'
        ],
        self::TRESHOLD_TIME => [
            'type' => 'string'
        ],
        self::TRESHOLD_USERS => [
            'type' => 'string'
        ],
        self::TRESHOLD_CALLS => [
            'type' => 'string'
        ],
        self::USE_FORM => [
            'type' => 'bool'
        ],
        self::MISSED => [
            'type' => 'string'
        ],
        self::MISSED_RECORD_SEARCH => [
            'type' => 'string'
        ],
        self::MISSED_RECORD_STATUS => [
            'type' => 'object'
        ],
        self::MISSED_TIME_BACK => [
            'type' => 'string'
        ],
        self::MISSED_TIME_LIMIT => [
            'type' => 'string'
        ],
        self::MISSED_AUTOCALL_BACK => [
            'type' => 'bool'
        ],
        self::_HAS_STATUSES => [
            'type' => 'bool'
        ],
        self::MISSED_CHANNELS => [
            'type' => 'bool'
        ],
        self::CHANNELS_TIME_BACK => [
            'type' => 'string'
        ],
        self::MISSED_QUEUE_CALL => [
            'type' => 'string'
        ],
        self::MISSED_QUEUE_SMS => [
            'type' => 'string'
        ],
        self::MISSED_QUEUE_EMAIL => [
            'type' => 'string'
        ],
        self::MISSED_QUEUE_FBM => [
            'type' => 'string'
        ],
        self::SORT_TIME => [
            'type' => 'string'
        ],
        self::CONTACT_TIMEOUT => [
            'type' => 'string'
        ],
        self::MACROLINKS => [
            'type' => 'array'
        ],
        self::MACRO_TRANSPORTS => [
            'type' => 'array'
        ],
        self::CAMPAIGNS => [
            'type' => 'string'
        ],
        self::TARGET => [
            'type' => 'string'
        ],
        self::CRM_TICKET_CATEGORY => [
            'type' => 'object'
        ],
        self::AUTO_ANSWER => [
            'type' => 'bool'
        ],
        self::SELECT_RECORDS => [
            'type' => 'bool'
        ],
        self::REQUIRED_LOGIN => [
            'type' => 'bool'
        ],
        self::SKIP_RECORDS => [
            'type' => 'bool'
        ],
        self::CHANGE_RECORDS_USER => [
            'type' => 'bool'
        ],
        self::WAIT_TIME => [
            'type' => 'int'
        ],
        self::SLEEP_TIME => [
            'type' => 'int'
        ],
        self::PRIORITY => [
            'type' => 'int'
        ],
        self::EMAIL => [
            'type' => 'string'
        ],
        self::LANG => [
            'type' => 'string'
        ],
        self::SHOW_USERS_NAME => [
            'type' => 'string'
        ],
        self::SHOW_USERS_ICON => [
            'type' => 'bool'
        ],
        self::ALLOW_FILE_UPLOADS => [
            'type' => 'string'
        ],
        self::SYSTEM_INPUTS => [
            'type' => 'array'
        ],
        self::CUSTOM_INPUTS => [
            'type' => 'array'
        ],
        self::CUSTOM_GREETINGS => [
            'type' => 'array'
        ],
        self::CLIENT_DESIGN => [
            'type' => 'array'
        ],
        self::USERNAME => [
            'type' => 'string'
        ],
        self::ADDRESS => [
            'type' => 'string'
        ],
        self::SIGN => [
            'type' => 'string'
        ],
        self::SIGN_TEMPLATE => [
            'type' => 'object'
        ],
        self::NPS_TEMPLATE => [
            'type' => 'object'
        ],
        self::NO_KEEP_ON_MAILSERVER => [
            'type' => 'bool'
        ],
        self::SSL_TRUSMACROLINKSTED => [
            'type' => 'bool'
        ],
        self::IN_TYPE => [
            'type' => 'string'
        ],
        self::IN_SERVER => [
            'type' => 'string'
        ],
        self::IN_NAME => [
            'type' => 'string'
        ],
        self::IN_PASSWORD => [
            'type' => 'string'
        ],
        self::IN_SSL => [
            'type' => 'bool'
        ],
        self::OUT_SERVER => [
            'type' => 'string'
        ],
        self::OUT_NAME => [
            'type' => 'sting'
        ],
        self::OUT_PASSWORD => [
            'type' => 'string'
        ],
        self::OUT_PORT => [
            'type' => 'int'
        ],
        self::RESPOND => [
            'type' => 'string'
        ],
        self::RESPOND_OUTSIDE_TIME_CONDITION => [
            'type' => 'string'
        ],
        self::EXCLUDE_EMAILS => [
            'type' => 'string'
        ],
        self::ALLOW_NUMBERS => [
            'type' => 'string'
        ],
        self::POWER => [
            'type' => 'bool'
        ],
        self::MAX_RINGTIME => [
            'type' => 'int'
        ],
        self::MAX_ATTEMPTS => [
            'type' => 'int'
        ],
        self::DELAY_TIME => [
            'type' => 'int'
        ],
        self::DELAY_ANSWERED => [
            'type' => 'string'
        ],
        self::DELAY_UNANSWERED => [
            'type' => 'string'
        ],
        self::STATUS_ANSWER => [
            'type' => 'object'
        ],
        self::STATUS_BUSY => [
            'type' => 'object'
        ],
        self::STATUS_HANGUP_DIALER => [
            'type' => 'object'
        ],
        self::STATUS_HANGUP_CUSTOMER => [
            'type' => 'object'
        ],
        self::MAX_THREADS => [
            'type' => 'int'
        ],
        self::SMS_TYPE => [
            'type' => 'string'
        ],
        self::API_TOKEN => [
            'type' => 'string'
        ],
        self::SMS_PREFIX => [
            'type' => 'string'
        ],
        self::SMS_UNICODE => [
            'type' => 'bool'
        ],
        self::SMS_DELIVERY_RECEIPT => [
            'type' => 'bool'
        ],
        self::SMS_ALLOWED_HOUR_BEGIN => [
            'type' => 'string'
        ],
        self::SMS_ALLOWED_HOUR_END => [
            'type' => 'string'
        ],
        self::SMS_SENDING_RATE_LIMIT => [
            'type' => 'string'
        ],
        self::SMS_SENDING_RATE_TIME => [
            'type' => 'string'
        ],
        self::SMS_INCOMING_CALLBACK => [
            'type' => 'string'
        ],
        self::SMS_OUTGOING_CALLBACK => [
            'type' => 'string'
        ],
        self::SMS_SENDER => [
            'type' => 'string'
        ],
        self::SMS_PRIORITY => [
            'type' => 'string'
        ],
        self::CLOSED_HOURS_TEMPLATE => [
            'type' => 'object'
        ],
        self::FB_PAGE_ID => [
            'type' => 'string'
        ],
        self::FB_PAGE_URL => [
            'type' => 'string'
        ],
        self::FB_PAGE_NAME => [
            'type' => 'string'
        ],
        self::FB_AUTHORIZED => [
            'type' => 'bool'
        ],
        self::FB_AUTHORIZED_BY => [
            'type' => 'string'
        ],
        self::FB_ICON => [
            'type' => 'string'
        ],
        self::ALLOW_DESCRIPTION => [
            'type' => 'bool'
        ],
        self::TAB_AUTOFOCUS => [
            'type' => 'bool'
        ]

    ];
}