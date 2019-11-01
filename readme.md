# Daktela API

## Legend

:white_check_mark: ... Implemented 

:x: ... Not implemented

:no_entry_sign: ... Not available

## Models

### Basic methods

Namespace       | Model                 | Fetch             | Create                | Read              | Update                | Delete
--------------- | --------------------- | ----------------- | --------------------- | ----------------- | ------------------ | ------
Account         | Account               | :white_check_mark: | :x: | :white_check_mark: | :x: | :x: |
  "             | AccountSnapshot       | :white_check_mark: | :no_entry_sign: | :white_check_mark: | :no_entry_sign: | :no_entry_sign:      
Activity        | Activity              | :white_check_mark: | :x: | :white_check_mark: | :x: | :no_entry_sign: 
ActivityCall    | ActivityCall          | :white_check_mark: | :x: | :white_check_mark: |  :no_entry_sign: | :no_entry_sign: 
  "             | ActivityCallChannel   | :white_check_mark: | :no_entry_sign: | :white_check_mark: | :no_entry_sign: | :no_entry_sign:
  "             | ActivityCallRecording | 
ActivityChat    | ActivityChat          | :white_check_mark: | :x: | :x: | :x: | :no_entry_sign:
  "             | ActivityChatMessage   | :white_check_mark: | :x: | :x: | :no_entry_sign: |  :no_entry_sign: 
ActivityEmail   | ActivityEmail         | :white_check_mark: | :no_entry_sign: | :white_check_mark: | :x: | :no_entry_sign: 
  "             | ActivityEmailFile     | 
ActivityFbm     | ActivityFbm           | 
ActivitySms     | ActivitySms           | :white_check_mark: | :no_entry_sign:| :x: | :x: | :no_entry_sign:
Blacklist       | BlacklistDatabase     |       |           |       |           |
  "             | BlacklistNumber       |       |           |       |           |
CampaignRecord  | CampaignRecord        | :white_check_mark: |           |       |           |
  "             | CustomField           | :x: | :x: | :x: | :no_entry_sign: | :x: 
  "             | CustomFieldScheme     | :x: | :x: | :x: | :x: | :x:
  "             | Snapshot              | :white_check_mark: |           |       |           |
Contact         | Contact               |       |           |       |           |
  "             | ContactSnapshot       |       |           |       |           |
CrmRecod        | CrmRecord             |       |           |       |           |
Database        | Database              | :white_check_mark: |  | :white_check_mark: |           |
Event           | Event                 |       |           |       |           |
Group           | Group                 |       |           |       |           |
Music           | Music                 |       |           |       |           |
Pause           | Pause                 |       |           |       |           |
Profile         | Profile               |       |           |       |           |
QAForm          | QAForm                | :white_check_mark: |           |       |           |
Queue           | Queue                 |       |           |       |           |
  "             | QueueProfile          |       |           |       |           |
Recording       | Recording             |       |           |       |           |
Role            | Role                  |       |           |       |           |
Status          | Status                |       |           |       |           |
Template        | Template              |       |           |       |           |
  "             | File                  |       |           |       |           |
Ticket          | Ticket                |       |           |       |           |
TicketCategory  | TicketCategory        |       |           |       |           |
TicketSla       | TicketSla             |       |           |       |           |
Timegroup       | Timegroup             |       |           |       |           |
Transcript      | Transcript            | :white_check_mark: | :no_entry_sign: |  |  | :no_entry_sign:
User            | User                  |       |           |       |           |
  "             | UserOptionsFields     |       |           |       |           |
Wallboard       | Wallboard             |       |           |       |           |
 