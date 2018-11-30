# FusionInvoiceFOSS Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 4.1.1
- add formatted_summary to truncate display

## 4.1.0
- upgrade to laravel 5.7.*
- migrate to Bootstrap 4.1.*
- start resource move to laravel mix where applicable
- fix email cc and bcc
- documentation
- "enabled module" in sidebar (system setting)
- enabled update checker
- added JQuery-UI theme config
- clean and optimize scheduler
- enable live demo

## 4.0.2
- added resource quantity selection to createworkoorder modal
- corrected some error response dialogs
- validation for end_time greater than start_time
- calendar create workorder-redirect to workorder if no client address (new client)


## 4.0.1

- added "todays workorder" widget
- added "recent payments" widget
- modified setup for upgrade
- added resources/lang/en-cust where client = customer
- added system info (.env settings) tab to system settings
- added modal Enter Payment function, with client lookup and payable invoices
- server side datatables for scheduler categories, events, recurring events
- correct employee lookup in calendar to approved workorders
- workorder datatable sort by job date instead of expires_at
- added orphan check utility for Scheduler (checks workorders for Unschedulable employees)


## 4.0.0

- change server to public directory (requires apache change)
- configure from .env (copy .env.example to .env and change required variables)
- clean, consolidate and restructure mysql database
- transfer existing 2018-8 database to new structure upon setup
- move high profile sortables to server side datatables
- implement softdeletes, with trash management
- update to laravel 5.6.*
- update all resources
- add toolbox
- add products
- add employees
- item lookup modal in quotes and invoices
- extend skin configuration
- integrate timetracking (projects/tasks/timers)
- integrate workorders 
- integrate Scheduler