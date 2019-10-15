<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 13:57 19.08.2019
 */

namespace Daktela\Models\User;

class UserTargetEnumeration
{
    const END_CALL = 'terminate';
    const ANNOUNCEMENT = 'announcement';
    const USER = 'user';
    const CALL_STEERING = 'callsteering';
    const VOICE_MAIL = 'voicemail';
    const TIME_CONDITION = 'condition';
    const CONTEXT = 'context';
    const LANGUAGE = 'language';
    const IVR_MENU = 'ivr_menu';
    const RING_GROUP = 'ringgroup';
    const QUEUE = 'queue';
    const CUSTOM = 'custom';
}