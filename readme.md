# Daktela API

## Documentation

[Daktela API](https://www.daktela.com/apihelp/v6/global/general-information)

## Installation
```
    composer require mfajfr/daktela-api
```

## Using

### Connection
```php
define('API_KEY', 'xxxxx'); // API section in Daktela

\Daktela\Connection::setSubDomain('example'); // Name of subdomain example.daktela.com
\Daktela\Connection::setAccessToken(API_KEY);
```

### Fetch
Loading group of records.

```php
    $rows = \Daktela\Models\ActivityCall\ActivityCall::fetch([
        // paginating, sorting, filtering ...
    ]);
```

### Read
Loading specific record
```php
    $call = \Daktela\Models\ActivityCall\ActivityCall::read('nameOfActivityCall');
```

### Relations (HasMany)
Loading records related to one record
```php
    $activity = \Daktela\Models\ActivityCall\Activity::read('nameOfActivity');
    $activity->statuses($force = true|false) // If $false == true then reload data
```


## Legend

:white_check_mark: ... Implemented 

:x: ... Not implemented

:no_entry_sign: ... Not available

## Models

### Basic methods

Namespace       | Model                 | Fetch             | Create                | Read              | Update                | Delete
--------------- | --------------------- | ----------------- | --------------------- | ----------------- | ------------------ | ------
Account         | Account               | :white_check_mark: | :x: | :x: | :x: | :x: |
  "             | AccountSnapshot       | :white_check_mark: | :no_entry_sign: | :x: | :no_entry_sign: | :no_entry_sign:      
Activity        | Activity              | :white_check_mark: | :x: | :white_check_mark: | :x: | :no_entry_sign: 
ActivityCall    | ActivityCall          | :white_check_mark: | :x: | :white_check_mark: |  :no_entry_sign: | :no_entry_sign: 
  "             | ActivityCallChannel   | :white_check_mark: | :no_entry_sign: | :white_check_mark: | :no_entry_sign: | :no_entry_sign:
  "             | ActivityCallRecording | :x: | :x: | :x: | :x: | :x:
ActivityChat    | ActivityChat          | :white_check_mark: | :x: | :x: | :x: | :no_entry_sign:
  "             | ActivityChatMessage   | :white_check_mark: | :x: | :x: | :no_entry_sign: |  :no_entry_sign: 
ActivityEmail   | ActivityEmail         | :white_check_mark: | :no_entry_sign: | :white_check_mark: | :x: | :no_entry_sign: 
  "             | ActivityEmailFile     | :x: | :x: | :x: | :x: | :x:
ActivityFbm     | ActivityFbm           | :x: | :x: | :x: | :x: | :x:
ActivitySms     | ActivitySms           | :white_check_mark: | :no_entry_sign:| :x: | :x: | :no_entry_sign:
Blacklist       | BlacklistDatabase     | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
  "             | BlacklistNumber       | :x: | :x: | :x: | :x: | :x:
CampaignRecord  | CampaignRecord        | :white_check_mark: | :x: | :x: | :x: | :x:
  "             | CustomField           | :x: | :x: | :x: | :no_entry_sign: | :x: 
  "             | CustomFieldScheme     | :x: | :x: | :x: | :x: | :x:
  "             | Snapshot              | :white_check_mark: | :x: | :x: | :x: | :x:
Contact         | Contact               | :white_check_mark: | :x: | :x: | :x: | :x:
  "             | ContactSnapshot       | :white_check_mark: | :no_entry_sign: | :x: | :no_entry_sign: | :no_entry_sign:
CrmRecod        | CrmRecord             | :white_check_mark: | :x: | :x: | :x: | :x:
Database        | Database              | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
Event           | Event                 | :white_check_mark: | :x: | :x: | :x: | :x:
Group           | Group                 | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
Music           | Music                 | :x: | :x: | :x: | :x: | :x:
Pause           | Pause                 | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
Profile         | Profile               | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
QAForm          | QAForm                | :white_check_mark: | :x: | :x: | :x: | :x:
Queue           | Queue                 | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
  "             | QueueProfile          | :x: | :x: | :x: | :x: | :x:
Recording       | Recording             | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
Role            | Role                  | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
Status          | Status                | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
Template        | Template              | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
  "             | File                  | :x: | :x: | :x: | :x: | :x:
Ticket          | Ticket                | :white_check_mark: | :x: | :x: | :x: | :x:
TicketCategory  | TicketCategory        | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
TicketSla       | TicketSla             | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
Timegroup       | Timegroup             | :x: | :x: | :x: | :x: | :x:
Transcript      | Transcript            | :white_check_mark: | :no_entry_sign: | :x: | :x: | :no_entry_sign:
User            | User                  | :white_check_mark: | :x: | :white_check_mark: | :x: | :x:
  "             | UserOptionsFields     | :x: | :x: | :x: | :x: | :x:
Wallboard       | Wallboard             | :white_check_mark: | :x: | :x: | :x: | :x:
 
 ### Account/Account
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
 Activity | :x: | TicketSla | :x:
 Ticket | :white_check_mark: | User | :x:
 Record | :white_check_mark: | CustomField | :x:
 Contact | :white_check_mark: |  | 
 Snapshot | :white_check_mark: |  | 
 Attachment | :x: |  | 
 Synchronization | :x: |  | 
 ### Account/AccountSnapshot
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 &nbsp; | &nbsp; | Account (account) | :x:
 &nbsp; | &nbsp; | User (user) | :x:
 &nbsp; | &nbsp; | TicketSla (sla) | :x:
 &nbsp; | &nbsp; | CustomField (customFields) | :x:
 &nbsp; | &nbsp; | User (created_by) | :x:
 ### Activity/Activity
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Status |  :white_check_mark:  | Ticket (ticket) | :x:
 RT User |  :x:  | Queue (queue) | :white_check_mark:
 Attachment |  :x:  | User (user) | :white_check_mark:
 Channel |  :x:  | Contact (contact) | :white_check_mark:
 Recording |  :x:  | NpsSurvey (survey) | :x:
 Statuses |  :white_check_mark:  | CampaignRecord (record) | :x:
 &nbsp; |  &nbsp;  | User (created_by) | :x:
 ### ActivityCall/ActivityCall
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Activity |  :white_check_mark:  | Queue (id_queue) | :white_check_mark:
 Transcript |  :white_check_mark:  | User (id_agent | :white_check_mark:
 ActivityCallChannel |  :white_check_mark:  | Contact (contact) | :white_check_mark:
 ### ActivityCall/ActivityCallChannel
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
 &nbsp; |  &nbsp;  | ActivityCall (call) | :white_check_mark:
 &nbsp; |  &nbsp;  | User (user) | :x:
 &nbsp; |  &nbsp;  | Extension (endpoint) | :x:
 &nbsp; |  &nbsp;  | Activity (activity) | :white_check_mark:
 ### ActivityCall/ActivityCallRecording
 ### ActivityChat/ActivityChat
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Message | :white_check_mark: | Queue (queue) | :white_check_mark:
 Flow | :x: | User (user) | :white_check_mark:
 Activity (activities) | :white_check_mark: | Contact (contact) | :white_check_mark:
 ### ActivityChat/ActivityChatMessage
 ### ActivityEmail/ActivityEmail
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Attachment |  :white_check_mark:  | Queue (queue) | :white_check_mark:
 Activity |  :white_check_mark:  | User (user) | :white_check_mark:
 &nbsp; | &nbsp; | Contact (contact) | :white_check_mark:
 ### ActivityEmail/ActivityEmailFile
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 &nbsp; | &nbsp; | ActivityEmail (email) | :x:
 ### ActivityFbm/ActivityFbm
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Message |  :x:  | Queue (queue) | :x:
 Activity | :x:  | User (user) | :x:
 Flow | :x:  | Contact (contact) | :x:
 &nbsp; | &nbsp; | FlowContact (fbm_contact) | :x:
 ### ActivitySms/ActivitySms
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Message |  :x:  | Queue (queue) | :white_check_mark:
 Activity |  :white_check_mark:  | User (user) | :white_check_mark:
 Flow |  :x:  | Contact (contact) | :white_check_mark:
 ### Blacklist/BlacklistDatabase
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   Queue        |  :white_check_mark:  |   | 
   Number        |  :white_check_mark:  |   | 
 ### Blacklist/BlacklistNumber
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   &nbsp; | &nbsp; | BlacklistDatabase | :x:
   &nbsp; | &nbsp; | User | :white_check_mark:
 ### CampaignRecord/CampaignRecord
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Status |  :white_check_mark:  | User (user) | :white_check_mark:
 Snapshot |  :white_check_mark:  | Queue (queue) | :white_check_mark:
 Activity |  :white_check_mark:  | Database (database) | :white_check_mark:
 CustomField (customFields) | :x: | Database (database) | :white_check_mark:
 &nbsp; | &nbsp; | 
 ### CampaignRecord/CustomField
 ### CampaignRecord/CustomFieldScheme
 ### CampaignRecord/Snapshot
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Status | :white_check_mark: | CampaignRecord (record) | :white_check_mark:
 CustomField (customFields) | :x: | User (user) | :white_check_mark:
 &nbsp; | &nbsp; | Queue (queue) | :white_check_mark:
 &nbsp; | &nbsp; | User (created_by) | :white_check_mark:
 ### Contact/Contact
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Activity |  :x:  | 
 Ticket |  :white_check_mark:  |
 Record |  :white_check_mark:  | 
 Snapshot |  :white_check_mark:  |
 Attachment |  :x:  | 
 Facebook contact |  :x:  | 
 Synchronization |  :x:  | 
 ### Contact/ContactSnapshot
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
 &nbsp; | &nbsp; | Contact | :x:
 &nbsp; | &nbsp; | Account | :x:
 &nbsp; | &nbsp; | User (user) | :x:
 &nbsp; | &nbsp; | CustomField | :x:
 &nbsp; | &nbsp; | User (created_by) | :x:
 ### CrmRecord/CrmRecord
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
 Snapshot | :x: | Type | :x:
 Attachment | :x: | Contact | :x:
 &nbsp; | &nbsp; | User | :x:
 &nbsp; | &nbsp; | Account | :x:
 &nbsp; | &nbsp; | Ticket | :x:
 &nbsp; | &nbsp; | Status | :x:
 &nbsp; | &nbsp; | CustomField | :x:
 ### Database/Database
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 &nbsp; | &nbsp; | Queue (queue) | :white_check_mark:
 ### Event/Event
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
  Profile |  :white_check_mark:  | Event (event) | :x:
  Handler |  :x:  |  
 ### Group/Group
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   Profile |  :white_check_mark: |   |  
   Member |  :white_check_mark: |   |  
 ### Pause/Pause
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Profile |  :x:  | 
 ### Profile/Profile
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   Queue        |  :white_check_mark:  |   |  
   User (assigned)        |  :white_check_mark:  |   |  
   User        |  :white_check_mark:  |   |  
   TicketCategory        |  :white_check_mark:  |   |  
   Profile        |  :white_check_mark:  |   |  
   Role        |  :white_check_mark:  |   |  
 ### QAForm/QAForm
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
  Queue | :x: 
  Question | :x: 
 ### Queue/Queue
  HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   Profile        |  :white_check_mark:  | Recording (recording_user(options)) | :white_check_mark:
   Status        |  :white_check_mark:  | Recording (target_before(options)) | :white_check_mark:
   Template        |  :white_check_mark:  | Recording (target_join(options)) | :white_check_mark:
   QAForm        |  :x:  | Timegroup (timecondition(options)) | :x:
   BlacklistDatabase        |  :white_check_mark:  | Music (music(options)) | :white_check_mark:
   CustomField        |  :x:  | Ivr (ivr_jump(options)) | :x:
   CampaignRecord        |  :x:  | Status (missed_record_status(options)) | :white_check_mark:
   Database        |  :x:  | TicketCategory (crm_ticket_category(options)) | :white_check_mark:
   Group        |  :white_check_mark:  | Template (signtemplate(options)) | :x:
   Greeting        |  :x:  | Template (npstemplate(options)) | :x:
   RT User        |  :x:  | Template (respond(options)) | :x:
   &nbsp; | &nbsp; | Template (respond_outside_timecondition(options)) | :x:
   &nbsp; | &nbsp; | Status (status_answer(options)) | :white_check_mark:
   &nbsp; | &nbsp; | Status (status_busy(options)) | :white_check_mark:
   &nbsp; | &nbsp; | Status (status_hangup_dialer(options)) | :white_check_mark:
   &nbsp; | &nbsp; | Status (status_hangup_customer(options)) | :white_check_mark:
   &nbsp; | &nbsp; | Template (closed_hours_template(options)) | :x:
 ### Queue/QueueProfile
 ### Role/Role
  HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   User        |  :white_check_mark:  |   | 
   Profile        |  :white_check_mark:  |   | 
 ### Status/Status
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
  TicketCategory |  :white_check_mark:  | BlacklistDatabase | :white_check_mark:
  Queue        |  :white_check_mark:  |   | 
  Type        |  :x:  |   | 
 ### Template/Template
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Profile       |  :white_check_mark:  | Template (id_template) | :x:
 Queue        |  :white_check_mark:  | 
 Attachment   |  :white_check_mark:  | 
 ### Template/File
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 Template   |  :x:  | 
 ### Ticket/Ticket
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   Bookmarked        |  :x:  | Ticket (id_merger) | :x:
   Status        |  :white_check_mark:  | TicketCategory (category) | :white_check_mark:
   MergeTicket        |  :x:  | User (user) | :x:
   Activity        |  :x:  | Contact | :x:
   Record        |  :white_check_mark:  | Ticket (parentTicket) | :x:
   Snapshot        |  :x:  | User (created_by) | :x:
   Status | :x: | User (created_by) | :x:
   CustomField | :x: |   | 
 ### TicketCategory/TicketCategory
 HasMany        |    | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
 Profile        |  :white_check_mark:  | TicketSla | :white_check_mark: 
 Status        |  :white_check_mark:  | Timegroup | :x: 
 Ticket        |  :white_check_mark:  | Queue (email) | :x: 
 Notify        |  :x:  | Queue (call) | :x: 
Group        |  :white_check_mark:  | Queue (sms) | :white_check_mark: 
 User        |  :white_check_mark:  |   | :  
 ### Timegroup/Timegroup
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   &nbsp; | &nbsp; | TimegroupCron | :x:
   &nbsp; | &nbsp; | TimegroupGroup | :x:
 ### Transcript/Transcript
 HasMany       |     | HasOne                  |  | 
 ------------- | --- | --------------------- | --- |
 &nbsp; | &nbsp; | ActivityCall (call) | :x:
 &nbsp; | &nbsp; | RoutingCallActivityCallSteering (call_steering) | :x:
 ### User/User
 HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   Activity        |  :x:  | Role | :white_check_mark:
   Ticket        |  :white_check_mark:  | Profile | :white_check_mark:
   Record        |  :white_check_mark:  | IntegrationConfig | :x:
   Contact        |  :white_check_mark:  | Announcement (target_announcement(options)) | :x:  
   Account        |  :white_check_mark:  | User (target_user(options)) | :x:  
   Queue        |  :white_check_mark:  | CallSteering (target_callsteering(options)) | :x:
   User        |  :white_check_mark:  | TimeCondition (target_condition(options)) | :x:
   TicketCategory        |  :white_check_mark:  | Customcontext (target_context(options)) | :x: 
   Profile        |  :white_check_mark:  | Language (target_language(options)) | :x:
   Role        |  :white_check_mark:  | Ivr (target_ivr_menu(options)) | :x:
   Wallboard        |  :white_check_mark:  | RingGroup (target_ringgroup(options)) | :x:
   Template        |  :white_check_mark:  | Queue (target_queue(options)) | :x:
   Event        |  :white_check_mark:  |   |  
   Group        |  :white_check_mark:  |   |  
   Pause        |  :x:  |   |  
   RT Queue        |  :x:  |   |  
   RT Activity        |  :x:  |   |  
   Device        |  :x:  |   |  
   Notify        |  :x:  |   |  
   Macro        |  :x:  |   |  
   Group member        |  :x:  |   |  
   Announcement        |  :x:  |   |  
   Saved filter        |  :x:  |   |  
 ### User/UserOptionsFields
 ### Wallboard/Wallboard
  HasMany       |     | HasOne                  |  | 
  ------------- | --- | --------------------- | --- |
   Profile        |  :white_check_mark:  |   |  