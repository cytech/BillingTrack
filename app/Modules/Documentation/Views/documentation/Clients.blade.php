@extends('documentation.master')

@section('content')

        <div class="col-lg-9 documentation">

            <h2>Clients</h2>

            <hr>

            <p><a href="#add-client">How do I add a client?</a></p>
            <p><a href="#multiple-contacts">How do I add multiple contacts to my clients?</a></p>
            <p><a href="#create-logins">How do I create logins for my clients?</a></p>
            <p><a href="#change-localization">How do I change localization settings for a specific client?</a></p>

            <hr>

            <span class="anchor" id="add-client"></span>
            <h3>How do I add a client?</h3>

            <p>Click the Clients menu item and press the New button.</p>

            <a href="/img/documentation/client_create.png" target="_blank">
                <img src="/img/documentation/client_create_small.png" class="img-responsive">
            </a>

            <p>Use the Client Form screen to fill in details and contact information for your client.</p>


            <p>Addresses can be maintained in two different ways. It is recommended to choose either option and stick
                with it for all clients. The first
                option is to use the Address field to store the entire address - including street address, city, state,
                postal code, country, etc. This option
                allows you to easily format the address as you need to with no additional fuss. The other option is to
                store the address, city, state, postal
                code and country values in their respective fields.</p>

            <p>To allow the client to login to the Client Center, see <a href="#create-logins">how do I create logins
                    for my clients</a>.</p>

            <p>Press the Save button when finished.</p>

            <a href="/img/documentation/client_create2.png" target="_blank">
                <img src="/img/documentation/client_create2_small.png" class="img-responsive">
            </a>

            <hr>

            <span class="anchor" id="multiple-contacts"></span>
            <h3>How do I add multiple contacts to my clients?</h3>

            <p>On the client edit screen, select the Contacts tab and click the Add Contact button.</p>

            <a href="/img/documentation/client_contact1.png" target="_blank">
                <img src="/img/documentation/client_contact1_small.png" class="img-responsive">
            </a>

            <p>Enter the name and email address for the new contact and press the Save button.</p>

            <a href="/img/documentation/client_contact2.png" target="_blank">
                <img src="/img/documentation/client_contact2_small.png" class="img-responsive">
            </a>

            <p>Once the contact has been added, you can set them as a default to, cc or bcc recipient for outgoing
                quotes
                and invoices for the client the contact was added to.</p>

            <a href="/img/documentation/client_contact3.png" target="_blank">
                <img src="/img/documentation/client_contact3_small.png" class="img-responsive">
            </a>

            <p>Contacts which are not identified as a default to, cc or bcc recipient can still be selected as a
                recipient when emailing a quote or an invoice.</p>

            <a href="/img/documentation/client_contact4.png" target="_blank">
                <img src="/img/documentation/client_contact4_small.png" class="img-responsive">
            </a>

            <hr>

            <span class="anchor" id="create-logins"></span>
            <h3>How do I create logins for my clients?</h3>

            <p>BillingTrack provides a limited access client login feature called Client Center. The Client Center
                allows clients
                to log in and view their own invoices, quotes and payments without being able to access anything else in
                your system.</p>

            <p style="font-style: italic;">* Note: Providing login access to your clients is not required to allow them
                to pay their
                invoices online. Clients pay their invoices online using the public invoice link. The Client Center is
                intended to provide a
                convenient way to provide clients with access to all of their invoices, quotes and payments in a single
                area.</p>

            <p>User accounts are managed under System -> User Accounts.</p>

            <a href="/img/documentation/user_account_client1.png" target="_blank">
                <img src="/img/documentation/user_account_client1_small.png" class="img-responsive">
            </a>

            <p>To create a client user account, click the New button and then choose Client Account. </p>
            <a href="/img/documentation/user_account_client2.png" target="_blank">
                <img src="/img/documentation/user_account_client2_small.png" class="img-responsive">
            </a>

            <p>Select the name of the client to create the account for from the dropdown. The name and email address
                fields will
                fill in automatically. Enter and confirm the account password and press the Save button.</p>

            <p style="font-style: italic;">* Note: If a client isn't listed in the dropdown, it's because a) they
                already
                have a user account, b) their client record doesn't have an email address, or c) their client record is
                set
                to inactive.</p>
            <a href="/img/documentation/user_account_client3.png" target="_blank">
                <img src="/img/documentation/user_account_client3_small.png" class="img-responsive">
            </a>

            <p>Once the account has been created, it will be listed as a Client account. Client accounts log in
                using the same URL as admin accounts, but they will be logged into the Client Center, which provides
                limited
                access to just their invoices, quotes and payments.</p>
            <a href="/img/documentation/user_account_client4.png" target="_blank">
                <img src="/img/documentation/user_account_client4_small.png" class="img-responsive">
            </a>

            <hr>

            <span class="anchor" id="change-localization"></span>
            <h3>How do I change localization settings for a specific client?</h3>

            <p>Some of your clients may use different currency or speak another language than you do. In this case, you
                can adjust these
                client records to reflect their local currency and native language.</p>

            <p>To do so, edit the client record by clicking the Clients menu item, and then pressing the Options button
                on the
                client to edit and choosing Edit.</p>

            <a href="/img/documentation/client_edit.png" target="_blank">
                <img src="/img/documentation/client_edit_small.png" class="img-responsive">
            </a>

            <p>Both the currency and the language can be adjusted on the Client Form screen when editing an existing
                client
                or adding a new client.</p>

            <a href="/img/documentation/client_localization.png" target="_blank">
                <img src="/img/documentation/client_localization_small.png" class="img-responsive">
            </a>

        </div>

@stop
