@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Upgrade</h2>

        <hr>

        <ul>
            <li><a href="#how-to-upgrade-BillingTrack">How to Upgrade BillingTrack</a></li>
            <li><a href="#how-to-upgrade-an-add-on">How to Upgrade an Add-on</a></li>
        </ul>
        <hr>
        <span class="anchor" id="how-to-upgrade-BillingTrack"></span>
        <h3>How to Upgrade BillingTrack</h3>
        <ul>
            <li>Git pull (if originally cloned) or download and overwrite existing installation.
                (if downloading and extracting zip, delete the contents of "YOUR_BILLINGTRACK_WEBSITE/public" and "YOUR_BILLINGTRACK_WEBSITE/app"
                directory prior to extracting.)
            </li>
            <li>Run composer update</li>
            <li>Start YOUR_BILLINGTRACK_WEBSITE/setup</li>
            <li>After migration completes, signin.</li>
        </ul>

        <hr>


        <span class="anchor" id="how-to-upgrade-an-add-on"></span>
        <h3>How to Upgrade an Add-on</h3>

        <h4>Step 1: Download the add-on package</h4>
        <p>Download the add-on package to upgrade. Save it locally to your computer.</p>

        <h4>Step 2: Unzip the add-on package</h4>
        <p>Navigate to the downloaded Add-on package and unzip the contents.</p>

        <h4>Step 3: Upload the add-on folder to your server</h4>
        <p>
            Upload the unzipped add-on folder from your computer to the custom/addons folder on your server and let it
            merge/overwrite the
            existing folder. It is recommended that you use a standard FTP program such as
            <a href="https://filezilla-project.org/download.php?type=client"
               target="_blank">FileZilla</a> to upload the folder
            to your server.
        </p>

        <h4>Step 4: Upgrade the add-on</h4>
        <p>Log into your BillingTrack install and go to System -> Add-ons and press the Upgrade button for the add-on
            if it appears. If
            the Upgrade button doesn't appear, then no further action is required and the add-on should be upgraded and
            ready to use.</p>

    </div>

@stop
