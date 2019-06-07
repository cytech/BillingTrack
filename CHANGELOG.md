# Billingtrack Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 5.1.0
- Added client shipping address fields (address_2,city_2,etc) accessible in templates
- Added client industry, size, id, and VAT fields
- Added client contact firstname, lastname, title, phone, fax, mobile, primary , optin and note fields
- Added individual Client payment terms and accessed by due_at (if not set defaults to invoice config value)
- Converted many events/listeners to model observers 

## 5.0.1
- Renamed project to BillingTrack

## 5.0.0
- PHP requirement >=7.2 
## 4.1.3 bump to 5.0.0
- update to Laravel 5.8.*
- update to sweetalert2 v8
- fixed errors when saving online payments
- fix filter in OrphanCheck
- fix error in recurr Show Proposed recurrence
- "fixed" top navbar
- added global "back to top" of page
- corrected numerous export errors
- add client_id to payment importer
- update resources
- update to mix 4

## 4.1.2
- disable scroll in datetimepicker inputs

## 4.1.1
- add formatted_summary to truncate display
- correct some datatables sorting
- correct duplicate class btn-enter-payment
- {{ trans() }} to @lang
- save manage trash tab state
- add workorder_to_invoice default date setting (job_date or current date)

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
