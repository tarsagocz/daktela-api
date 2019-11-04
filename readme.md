# Daktela API

## Documentation

[Daktela API](https://www.daktela.com/apihelp/v6/global/general-information)

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
 