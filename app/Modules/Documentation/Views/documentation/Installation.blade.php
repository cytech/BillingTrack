@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Installation</h2>
        <hr>

        <ul>
            <li><a href="#how-to-install-BillingTrack">How to Install BillingTrack</a></li>
            <li><a href="#how-to-install-an-add-on">How to Install an Add-on</a></li>
        </ul>
        <hr>
        <span class="anchor" id="how-to-install-BillingTrack"></span>
        <h3>How to Install BillingTrack</h3>
        <ul>
            <li>1. Clone or download the repository to a new web directory (do not attempt to upgrade an old
                FusionInvoice installation)
            </li>

            <li>2. Run "composer install" in web directory</li>

            <li>3. create a NEW BillingTrack database.</li>

{{--            (You will be presented with an option to transfer an existing FusionInvoice 2018-8 database during setup.)--}}

            <li>4. Copy .env.example to .env</li>

            <li>5. edit .env and change:</li>
            <ul>
                <li>DB_HOST=</li>

                <li>DB_DATABASE=</li>

                <li>DB_USERNAME=</li>

                <li>DB_PASSWORD=</li>
            </ul>
            <li>to your **NEW** database settings.</li>

            (Do not set APP_DEBUG to true. On a large database transfer it will cause a failure.
            If you need to run debug, wait until setup is complete and app is running.)

            <li>6. save .env file.</li>

            <li>**FOR NEW INSTALL:**</li>
            <ul>
                <li>Run "php artisan key:generate"</li>
                <li>Copy generated key to (APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx)</li>

                <li>Save .env file and exit.</li>
            </ul>

{{--            <li>**FOR UPGRADE FROM 2018-8:**</li>--}}
{{--            <ul>--}}
{{--                <li>Add your existing FusionInvoice 2018-8 app key to (APP_KEY= xxxxxxxxxxxxxxxxxxxxxx)</li>--}}
{{--            </ul>--}}
{{--            <li>Save .env file and exit.</li>--}}

            <li>7. Set permissions for your site.</li>

            <li>8. Start YOUR_BILLINGTRACK_WEBSITE/setup</li>

            <li>9. after database configuration finishes (this may take a couple of minutes):</li>

            <li>**Create new account** -> creates fresh installation with account</li>

{{--            <li>**Transfer existing 2018-8 database** -> enter EXACT existing 2018-8 database name and data will be--}}
{{--                transfered to new database and structure.--}}
{{--            </li>--}}

{{--            <li>Note: This can take a long time on a large database (i.e. 30 MiB = ~ 10 minutes). This function will--}}
{{--                transfer **only** existing FusionInvoice 2018-8. If you have an older version it will need to be--}}
{{--                upgraded to 2018-8.--}}
{{--                2018-8 is available in the release section of this repository.--}}
{{--                This will also transfer the cytech/workorders addon, cytech/scheduler addon and--}}
{{--                fusioninvoice/TimeTracking addon if they exist.--}}
{{--                Any other addons will have to be reinstalled and data manually transferred.--}}
{{--                Also, there is a limit of 10 custom fields columns transferred per _module_custom_ table. If you have--}}
{{--                more than 10 custom fields columns defined in any _module_custom_ table you will need to edit the code--}}
{{--                in SetupController.php line 201 and increase the--}}
{{--                value from 10 to the maximum number of your custom field columns.--}}
{{--            </li>--}}

            <li>10. sign in</li>
        </ul>

        <hr>

        <span class="anchor" id="how-to-install-an-add-on"></span>
        <h3>How to Install an Add-on</h3>

        <h4>Step 1: Download the add-on package</h4>
        <p>Download the add-on package to install. Save it locally to your computer.</p>

        <h4>Step 2: Unzip the add-on package</h4>
        <p>Navigate to the downloaded Add-on package and unzip the contents.</p>

        <h4>Step 3: Upload the add-on folder to your server</h4>
        <p>
            Upload the unzipped add-on folder from your computer to the custom/addons folder on your server. It is
            recommended that you use
            a standard FTP program such as
            <a href="https://filezilla-project.org/download.php?type=client"
               target="_blank">FileZilla</a> to upload the folder
            to your server.
        </p>

        <h4>Step 4: Enable the add-on</h4>
        <p>Log into your BillingTrack install and go to System -> Add-ons and click the Install button for the add-on.
            Once the add-on is installed,
            the applicable menu items will appear and the add-on will be usable.</p>

    </div>

@stop
