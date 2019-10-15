<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 14:44 19.08.2019
 */

namespace Daktela\Models\Queue;

use Daktela\AbstractFields;

class QueueClientDesignFields extends AbstractFields
{
    const SEND_URL_ALL_PREVIOUS = 'send_url_all_previous'; // Enable send customer URL addresses as they browse web pages before a chat is running
    const SEND_URL_CHANGE = 'send_url_change'; // Enable send customer URL addresses as they browse web pages while a chat is running
    const SEND_MESSAGE_DRAFT = 'send_message_draft'; // Do not enable this if you have not legally resolved displaying client's unsent message!
    const ALLOW_TRANSCRIPT = 'allow_transcript'; // Enable possibility get transcript of chat for customer
    const REFRESH_CLEAN_CLOSED = 'refresh_clean_closed'; // Chat will be cleaned if chat was terminated and customer refresh page (like older versions of Daktela). If disabled, chat will be cleaned after time
    const HIDE_IN_OFFLINE = 'hide_in_offline'; // Disable offline chat viewing, ie when out of hours or no operator available, chat is either displayed in offline mode for a one-off query or does not appear at all
    const HIDE_IN_OVERLOAD = 'hide_in_overload'; // Hide chat when pbx is overloaded by customers, ie no operator will be available by distribution matrix
    const HTML_FOLDER = 'html_holder'; // The CSS selector of the html element into the HTML of chat will be placed. If it is not filled in, the BODY tag will be used automatically
    const WINDOW_COLOR = 'window_color'; // Window color-description
    const WINDOW_POSITION = 'window_position'; // Window position-description
    const WINDOW_DESIGN = 'window_design'; // Window design-description
    const WINDOW_GRAYSCALE = 'window_greyscale'; // Window grayscale-description
    const WINDOW_TIMEOUT = 'window_timeout'; // The time to open chat automatically. None - Chat will be not automatically open; Now - Chat will be open immediately
    const WELCOME_TEXT = 'welcome_text'; // Welcome text-description
    const BUBBLE_IMAGE = 'bubble_image'; // Bubble image-description
    const BUBBLE_COLOR = 'bubble_color'; // Bubble color-description
    const BUBBLE_HEAD = 'bubble_head'; // Bubble title-description
    const BUBBLE_BODY = 'bubble_body'; // Bubble body-description
    const BUBBLE_TIMEOUT = 'bubble_timeout'; // Bubble timeout-description

    const FIELDS = [
        self::SEND_URL_ALL_PREVIOUS => [
            'type' => 'bool'
        ],
        self::SEND_URL_CHANGE => [
            'type' => 'bool'
        ],
        self::SEND_MESSAGE_DRAFT => [
            'type' => 'bool'
        ],
        self::ALLOW_TRANSCRIPT => [
            'type' => 'bool'
        ],
        self::REFRESH_CLEAN_CLOSED => [
            'type' => 'bool'
        ],
        self::HIDE_IN_OFFLINE => [
            'type' => 'bool'
        ],
        self::HIDE_IN_OVERLOAD => [
            'type' => 'bool'
        ],
        self::HTML_FOLDER => [
            'type' => 'string'
        ],
        self::WINDOW_COLOR => [
            'type' => 'string'
        ],
        self::WINDOW_POSITION => [
            'type' => 'string'
        ],
        self::WINDOW_GRAYSCALE => [
            'type' => 'string'
        ],
        self::WINDOW_TIMEOUT => [
            'type' => 'int'
        ],
        self::WELCOME_TEXT => [
            'type' => 'string'
        ],
        self::BUBBLE_IMAGE => [
            'type' => 'string'
        ],
        self::BUBBLE_COLOR => [
            'type' => 'string'
        ],
        self::BUBBLE_BODY => [
            'type' => 'string'
        ],
        self::BUBBLE_TIMEOUT => [
            'type' => 'string'
        ]
    ];
}