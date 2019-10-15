<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 15:35 16.08.2019
 */

namespace Daktela\Models\Template;

class TemplateUsingTypeEnumeration
{
    const EMAIL = 'EMAIL'; // Email
    const SMS = 'SMS'; // SMS
    const MESSENGER = 'FBM'; // Messenger
    const CHAT = 'CHAT'; // Chat
    const CHAT_NPS = 'CHAT_NPS'; // Chat NPS survey
    const EMAIL_SIGN = 'EMAIL_SIGN'; // Email sign
    const EMAIL_NPS = 'EMAIL_NPS'; // Email NPS survey
}