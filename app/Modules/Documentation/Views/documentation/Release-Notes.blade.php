@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Release Notes</h2>

        <hr>
        <h3>FusionInvoiceFOSS 4.1.3 (Jan 1, 2019)</h3>
        <ul>
            <li>- "fixed" top navbar</li>
            <li>- added global "back to top" of page</li>
        </ul>

        <hr>
        <h3>FusionInvoiceFOSS 4.1.2 (Dec 17, 2018)</h3>
        <ul>
            <li>- disable scroll in datetimepicker inputs</li>
        </ul>

        <hr>
        <h3>FusionInvoiceFOSS 4.1.1 (Dec 16, 2018)</h3>
        <ul>
            <li>- add formatted_summary to truncate display</li>
            <li>- correct some datatables sorting</li>
            <li>- correct duplicate class btn-enter-payment</li>
            <li>- @{{ trans() }} to @@lang</li>
            <li>- save manage trash tab state</li>
            <li>- add workorder_to_invoice default date setting (job_date or current date)</li>
        </ul>

        <hr>
        <h3>FusionInvoiceFOSS 4.1.0 (Nov 29, 2018)</h3>
        <ul>
            <li>- upgrade to laravel 5.7.*</li>
            <li>- migrate to Bootstrap 4.1.*</li>
            <li>- start resource move to laravel mix where applicable</li>
            <li>- fix email cc and bcc</li>
            <li>- documentation</li>
            <li>- "enabled module" in sidebar (system setting)</li>
            <li>- enabled update checker</li>
            <li>- added JQuery-UI theme config</li>
            <li>- clean and optimize scheduler</li>
            <li>- enable live demo</li>
        </ul>
        <hr>
        <h3>FusionInvoiceFOSS 4.0.2 (Oct 14, 2018)</h3>
            <ul>
                <li>- added resource quantity selection to createworkoorder modal</li>
                <li>- corrected some error response dialogs</li>
                <li>- validation for end_time greater than start_time</li>
                <li>- calendar create workorder-redirect to workorder if no client address (new client)</li>
        </ul>
        <hr>
        <h3>FusionInvoiceFOSS 4.0.1 (Sept 20, 2018)</h3>
        <ul>
            <li>- added "todays workorder" widget</li>
            <li>- added "recent payments" widget</li>
            <li>- modified setup for upgrade</li>
            <li>- added resources/lang/en-cust where client = customer</li>
            <li>- added system info (.env settings) tab to system settings</li>
            <li>- added modal Enter Payment function, with client lookup and payable invoices</li>
            <li>- server side datatables for scheduler categories, events, recurring events</li>
            <li>- correct employee lookup in calendar to approved workorders</li>
            <li>- workorder datatable sort by job date instead of expires_at</li>
            <li>- added orphan check utility for Scheduler (checks workorders for Unschedulable employees)</li>
        </ul>

        <hr>
        <h3>FusionInvoiceFOSS 4.0.0 (Sept 6, 2018)</h3>
        <ul>
            <li>- change server to public directory (requires apache change)</li>
            <li>- configure from .env (copy .env.example to .env and change required variables)</li>
            <li>- clean, consolidate and restructure mysql database</li>
            <li>- transfer existing 2018-8 database to new structure upon setup</li>
            <li>- move high profile sortables to server side datatables</li>
            <li>- implement softdeletes, with trash management</li>
            <li>- update to laravel 5.6.*</li>
            <li>- update all resources</li>
            <li>- add toolbox</li>
            <li>- add products</li>
            <li>- add employees</li>
            <li>- item lookup modal in quotes and invoices</li>
            <li>- extend skin configuration</li>
            <li>- integrate timetracking (projects/tasks/timers)</li>
            <li>- integrate workorders</li>
            <li>- integrate Scheduler</li>
        </ul>

        <hr>
        <h3>FusionInvoice 2018-74.0.0 (Apr 22, 2018)</h3>
        <ul>
            <li>Bugfixes</li>
            <ul>
                <li>Fixed an issue where payment receipts would not always form the contact fields correctly.</li>
            </ul>

            <li>Upgrading</li>
            <ul>
                <li><a href="Upgrade#how-to-upgrade-fusioninvoice-2018">How to upgrade from FusionInvoice
                        2018</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-2017-2016">How
                        to upgrade from FusionInvoice 2017 or 2016</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-v2">How to
                        upgrade from FusionInvoice v2</a></li>
            </ul>
        </ul>

        <hr>

        <h3>FusionInvoice 2018-7 (Apr 16, 2018)</h3>

        <ul>
            <li>Bugfixes</li>
            <ul>
                <li>Fixed THE FINAL bug which prevented the Mail Log screen from working in some cases.</li>
            </ul>

            <li>Upgrading</li>
            <ul>
                <li><a href="Upgrade#how-to-upgrade-fusioninvoice-2018">How to upgrade from FusionInvoice
                        2018</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-2017-2016">How
                        to upgrade from FusionInvoice 2017 or 2016</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-v2">How to
                        upgrade from FusionInvoice v2</a></li>
            </ul>
        </ul>

        <hr>

        <h3>FusionInvoice 2018-6 (Apr 15, 2018)</h3>

        <ul>
            <li>Bugfixes</li>
            <ul>
                <li>Fixed a bug which prevented the Mail Log screen from working in some cases.</li>
                <li>Fixed a bug which prevented overdue invoice reminders and upcoming due notices from being emailed.
                </li>
            </ul>

            <li>Upgrading</li>
            <ul>
                <li><a href="Upgrade#how-to-upgrade-fusioninvoice-2018">How to upgrade from FusionInvoice
                        2018</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-2017-2016">How
                        to upgrade from FusionInvoice 2017 or 2016</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-v2">How to
                        upgrade from FusionInvoice v2</a></li>
            </ul>
        </ul>

        <hr>

        <h3>FusionInvoice 2018-5 (Apr 1, 2018)</h3>

        <ul>
            <li>Bugfixes</li>
            <ul>
                <li>Fixed an issue with recurring invoices not emailing.</li>
                <li>Fixed an issue with the mail log page not loading.</li>
                <li>Fixed a bug causing recurring invoices to not save properly when a client with one or more custom
                    fields is edited directly from the invoice or quote screens.
                </li>
            </ul>

            <li>Upgrading</li>
            <ul>
                <li><a href="Upgrade#how-to-upgrade-fusioninvoice-2018">How to upgrade from FusionInvoice
                        2018</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-2017-2016">How
                        to upgrade from FusionInvoice 2017 or 2016</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-v2">How to
                        upgrade from FusionInvoice v2</a></li>
            </ul>
        </ul>

        <hr>

        <h3>FusionInvoice 2018-4 (Mar 28, 2018)</h3>

        <ul>
            <li>Enhancements and General Changes</li>
            <ul>
                <li>Added an <a href="../FAQ/Frequently-Asked-Questions#how-to-force-https">option</a> to the
                    General tab in System Settings to allow HTTPS to be forced. Prior to enabling this option, be sure
                    your FusionInvoice installation is functional via https. Failure to do so may result in a
                    non-functional (but fixable) installation.
                </li>
            </ul>
            <li>Bugfixes</li>
            <ul>
                <li>Fixed a bug causing invoices and quotes to not save properly when a client with one or more custom
                    fields is edited directly from the invoice or quote screens.
                </li>
                <li>Fixed an issue with domPDF which affects certain environments.</li>
                <li>Fixed a bug in the Expense List Report causing the date range to be ignored.</li>
            </ul>

            <li>Upgrading</li>
            <ul>
                <li><a href="Upgrade#how-to-upgrade-fusioninvoice-2018">How to upgrade from FusionInvoice
                        2018</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-2017-2016">How
                        to upgrade from FusionInvoice 2017 or 2016</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-v2">How to
                        upgrade from FusionInvoice v2</a></li>
            </ul>
        </ul>

        <hr>

        <h3>FusionInvoice 2018-3 (Mar 26, 2018)</h3>

        <ul>
            <li>Bugfixes</li>
            <ul>
                <li>Fixed an issue with domPDF which affects certain environments.</li>
            </ul>

            <li>Upgrading</li>
            <ul>
                <li><a href="Upgrade#how-to-upgrade-fusioninvoice-2018">How to upgrade from FusionInvoice
                        2018</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-2017-2016">How
                        to upgrade from FusionInvoice 2017 or 2016</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-v2">How to
                        upgrade from FusionInvoice v2</a></li>
            </ul>
        </ul>

        <hr>

        <h3>FusionInvoice 2018-2 (Mar 25, 2018)</h3>

        <ul>
            <li>Bugfixes</li>
            <ul>
                <li>Fixed a bug preventing notes from being added to different things.</li>
                <li>Fixed documentation links.</li>
            </ul>

            <li>Upgrading</li>
            <ul>
                <li><a href="Upgrade#how-to-upgrade-fusioninvoice-2018">How to upgrade from FusionInvoice
                        2018</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-2017-2016">How
                        to upgrade from FusionInvoice 2017 or 2016</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-v2">How to
                        upgrade from FusionInvoice v2</a></li>
            </ul>
        </ul>

        <hr>

        <h3>FusionInvoice 2018-1 (Mar 25, 2018)</h3>

        <ul>
            <li>Enhancements and General Changes</li>
            <ul>
                <li>Upgraded framework to Laravel 5.5.</li>
                <li><a href="Clients#multiple-contacts">Multiple contacts can be added per client
                        record.</a></li>
                <li><a href="System-Settings#backup-database">Added a new Backup tab to System
                        Settings.</a></li>
                <li>Added new Expense List report.</li>
                <li>Converting a quote to an invoice now changes the quote status to approved.</li>
                <li><a href="System-Settings#email-allow-self-signed-cert">Added an option to the
                        Email tab in System Settings to allow self-signed certificates when using SMTP / SSL.</a></li>
                <li>Added an option to the <a
                            href="System-Settings#quote-email-while-draft">Quotes</a> and <a
                            href="System-Settings#invoice-email-while-draft">Invoices</a> tab in
                    System Settings to optionally change the quote or invoice date to today's date when emailed
                    while in draft status.
                </li>
                <li>Sent email content can now be viewed through System -> Mail Log by clicking the email subject.</li>
                <li>Reduced the number of queries required for the Profit and Loss report.</li>
                <li>Replaced all validators with Laravel form requests.</li>
                <li>Removed Stripe's Bitcoin support since Stripe is dropping Bitcoin support.</li>
            </ul>

            <li>Bugfixes</li>
            <ul>
                <li>Fixed a bug in the Profit and Loss report where invoices may have been included when they shouldn't
                    have.
                </li>
                <li>Fixed a minor calculation bug affecting quotes and invoices in specific situations.</li>
                <li>Fixed a bug where client custom field values could potentially overwrite invoice, quote or recurring
                    invoice custom field values if the client was edited directly from the invoice, quote or recurring
                    invoice screens.
                </li>
                <li>Fixed a styling issue where the System menu would appear blank on mobile devices depending on the
                    selected skin.
                </li>
                <li>Fixed a bug preventing client payments from being recorded for display in the recent client activity
                    dashboard widget.
                </li>
                <li>Fixed a few issues when using PHP 7.2.</li>
            </ul>

            <li>Translations</li>
            <ul>
                <li>All non-English translations have been removed from the core package. The community is encouraged to
                    share and collaborate on their translation files.
                </li>
            </ul>

            <li>Time Tracking Add-on</li>
            <ul>
                <li>Bugfixes</li>
                <ul>
                    <li>Fixed a bug in the Time Tracking add-on that would create an invoice in the default group when
                        billing tasks when a non-default group was selected.
                    </li>
                    <li>Fixed a bug in the Timesheet report.</li>
                </ul>
            </ul>

            <li>REST API</li>
            <ul>
                <li>An updated version of the REST API client library is available to download.</li>
            </ul>

            <li>Upgrading</li>
            <ul>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-2017-2016">How
                        to upgrade from FusionInvoice 2017 or 2016</a></li>
                <li><a href="Upgrade#how-to-upgrade-to-fusioninvoice-2018-from-fusioninvoice-v2">How to
                        upgrade from FusionInvoice v2</a></li>
            </ul>
        </ul>

    </div>
@stop