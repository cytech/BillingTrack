@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Installation</h2>
        <hr>

        <ul>
            <li><a href="#how-to-install-fusioninvoicefoss">How to Install FusionInvoiceFOSS</a></li>
            <li><a href="#how-to-install-fusioninvoice">How to Install FusionInvoice 2018-8</a></li>
            <li><a href="#how-to-install-an-add-on">How to Install an Add-on</a></li>
        </ul>
        <hr>
        <span class="anchor" id="how-to-install-fusioninvoicefoss"></span>
        <h3>How to Install FusionInvoiceFOSS</h3>
        <ul>
            <li>1. Clone or download the repository to a new web directory (do not attempt to upgrade an old
                FusionInvoice installation)
            </li>

            <li>2. Run "composer install" in web directory</li>

            <li>3. create a NEW FusionInvoiceFOSS database.</li>

            (You will be presented with an option to transfer an existing FusionInvoice 2018-8 database during setup.)

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

            <li>**FOR UPGRADE FROM 2018-8:**</li>
            <ul>
                <li>Add your existing FusionInvoice 2018-8 app key to (APP_KEY= xxxxxxxxxxxxxxxxxxxxxx)</li>
            </ul>
            <li>Save .env file and exit.</li>

            <li>7. Set permissions for your site.</li>

            <li>8. Start FusionInvoiceFOSS/setup</li>

            <li>9. after database configuration finishes, you will be presented with 2 choices:</li>

            <li>**Create new account** -> creates fresh installation with account</li>

            <li>**Transfer existing 2018-8 database** -> enter EXACT existing 2018-8 database name and data will be
                transfered to new database and structure.
            </li>

            <li>Note: This can take a long time on a large database (i.e. 30 MiB = ~ 10 minutes). This function will
                transfer **only** existing FusionInvoice 2018-8. If you have an older version it will need to be
                upgraded to 2018-8.
                2018-8 is available in the release section of this repository.
                This will also transfer the cytech/workorders addon, cytech/scheduler addon and
                fusioninvoice/TimeTracking addon if they exist.
                Any other addons will have to be reinstalled and data manually transferred.
                Also, there is a limit of 10 custom fields columns transferred per _module_custom_ table. If you have
                more than 10 custom fields columns defined in any _module_custom_ table you will need to edit the code
                in SetupController.php line 201 and increase the
                value from 10 to the maximum number of your custom field columns.
            </li>

            <li>10. sign in</li>
        </ul>

        <hr>

        <span class="anchor" id="how-to-install-fusioninvoice"></span>
        <h3>How to Install FusionInvoice 2018</h3>

        <h4>Step 1: Download the install package</h4>
        <p>Download the latest package. Save it locally to your computer.</p>

        <h4>Step 2: Unzip the install package</h4>
        <p>Navigate to the downloaded install package and unzip the contents.</p>

        <h4>Step 3: Create a database</h4>

        <p>
            Using phpMyAdmin (or whatever tool you use to manage your MySQL databases with), create a new, empty
            database to use
            with FusionInvoice. Depending on your web host, you may create new databases from within your hosting
            control panel.
            If you are unsure how to create an empty database, contact your web host or system administrator.
        </p>

        <h4>Step 4: Database configuration</h4>

        <p>
            Open config/database.php from the unzipped installer package, edit accordingly for your database settings
            and save
            the modified file.
        </p>

        <p>
            Typically you should only have to configure the host, database, username and password values to connect to
            your
            database. Compatibility with MySQL is 100% guaranteed. Other database types may or may not work as expected
            and will
            no longer be supported.
        </p>

        <pre>
'mysql' => [
    'host'      => 'localhost',
    'database'  => 'fusioninvoice',
    'username'  => 'root',
    'password'  => 'password',
    'prefix'    => '',

    'driver'    => 'mysql',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'strict'    => false,
],
</pre>

        <hr>

        <h4>Step 5: License key configuration</h4>

        <p>
            Open config/app.php from the unzipped installer package and replace the ReplaceThisWithYourOwnLicenseKey
            value with
            your license key and save the modified file. Be sure there are no
            leading or trailing spaces.
        </p>

        <pre>
'key' => 'ReplaceThisWithYourOwnLicenseKey',
</pre>

        <h4>Step 6: Upload the files to your server</h4>

        <p>
            Upload the unzipped files from your computer to a new, empty folder on your server. It is recommended that
            you use
            a standard FTP program such as
            <a href="https://filezilla-project.org/download.php?type=client"
               target="_blank">FileZilla</a> to upload the files
            to your server. This initial upload may take a few minutes to complete.
        </p>

        <h4>Step 7: Set folder permissions</h4>

        <p>Apply recursive write permissions to the following folders (including all the folders and files contained
            within):</p>

        <ul>
            <li>storage</li>
            <li>bootstrap/cache</li>
        </ul>

        <p>The exact steps to set the appropriate permissions will depend on your web host and server configuration.
            FusionInvoice cannot advise on the exact steps or permissions to apply to make these folders writable. If
            you have
            questions about this step, please contact your web host or system administrator.</p>

        <h4>Step 8: Complete the install</h4>

        <p>
            To finalize the installation, visit http://YourFusionInvoiceURL/setup in your web browser. If
            http://YourFusionInvoiceURL/setup
            produces an error, try using http://YourFusionInvoiceURL/index.php/setup instead. This last step of the
            installation process
            will create the required database tables and prompt you for information to create your user account. Once
            you have
            completed this last step, you will be able to log in to your FusionInvoice system.
        </p>

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
        <p>Log into your FusionInvoice install and go to System -> Add-ons and click the Install button for the add-on.
            Once the add-on is installed,
            the applicable menu items will appear and the add-on will be usable.</p>

    </div>

@stop