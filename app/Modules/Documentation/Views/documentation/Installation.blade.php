@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Installation</h2>
        <hr>

        <ul>
            <li><a href="#how-to-install-fusioninvoice">How to Install FusionInvoice</a></li>
            <li><a href="#how-to-install-an-add-on">How to Install an Add-on</a></li>
        </ul>

        <hr>

        <span class="anchor" id="how-to-install-fusioninvoice"></span>
        <h3>How to Install FusionInvoice</h3>

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