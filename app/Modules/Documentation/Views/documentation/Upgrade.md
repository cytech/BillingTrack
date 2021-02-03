Upgrade
---

---

-   [How to Upgrade BillingTrack](#how-to-upgrade-billingtrack)
-   [How to Upgrade an Add-on](#how-to-upgrade-an-add-on)

---

<a id="how-to-upgrade-billingtrack"></a>
### How to Upgrade BillingTrack

-   Git pull (if originally cloned) or download and overwrite existing
    installation. (if downloading and extracting zip, delete the
    contents of "YOUR\_BILLINGTRACK\_WEBSITE/public", "YOUR\_BILLINGTRACK\_WEBSITE/database/seeds" and
    "YOUR\_BILLINGTRACK\_WEBSITE/app" directory prior to extracting.)
-   Run composer update
-   Start YOUR\_BILLINGTRACK\_WEBSITE/setup
-   After migration completes, signin.

---

<a id="how-to-upgrade-an-add-on"></a>
### How to Upgrade an Add-on

#### Step 1: Download the add-on package

Download the add-on package to upgrade. Save it locally to your
computer.

#### Step 2: Unzip the add-on package

Navigate to the downloaded Add-on package and unzip the contents.

#### Step 3: Upload the add-on folder to your server

Upload the unzipped add-on folder from your computer to the
custom/addons folder on your server and let it merge/overwrite the
existing folder. It is recommended that you use a standard FTP program
such as
[FileZilla](https://filezilla-project.org/download.php?type=client) to
upload the folder to your server.

#### Step 4: Upgrade the add-on

Log into your BillingTrack install and go to System -&gt; Add-ons and
press the Upgrade button for the add-on if it appears. If the Upgrade
button doesn't appear, then no further action is required and the add-on
should be upgraded and ready to use.
