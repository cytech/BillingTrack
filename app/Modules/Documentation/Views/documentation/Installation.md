Installation
---

---

-   [How to Install BillingTrack](#how-to-install-billingtrack)
-   [How to Install an Add-on](#how-to-install-an-add-on)

---

<a id="how-to-install-billingtrack"></a>
### How to Install BillingTrack

1. Clone or download the repository to a new web directory.

2. Run "composer install" in web directory

3. create a NEW BillingTrack database.

4. Copy .env.example to .env

5. edit .env and change:

-   DB\_HOST=
-   DB\_DATABASE=
-   DB\_USERNAME=
-   DB\_PASSWORD=

- to your \*\*NEW\*\* database settings.

6. save .env file.

-   Run "php artisan key:generate"
-   This copies the app key into the .env file, attached to the APP_KEY= line.


7. Set permissions for your site.

8. Start YOUR\_BILLINGTRACK\_WEBSITE/setup

9. After database configuration finishes (this may take awhile. 10 minutes is not unusual):

Note: In some instances a fresh install will throw an "unknown error" alert box. If this happens, dismiss the alert box and continue. In all reported cases the migration completed properly but some timeout was thrown that causes the error.

- Create new account -&gt; creates fresh installation with account


10. sign in

---

<a id="how-to-install-an-add-on"></a>
### How to Install an Add-on

#### Step 1: Download the add-on package

Download the add-on package to install. Save it locally to your
computer.

#### Step 2: Unzip the add-on package

Navigate to the downloaded Add-on package and unzip the contents.

#### Step 3: Upload the add-on folder to your server

Upload the unzipped add-on folder from your computer to the
custom/addons folder on your server. It is recommended that you use a
standard FTP program such as
[FileZilla](https://filezilla-project.org/download.php?type=client) to
upload the folder to your server.

#### Step 4: Enable the add-on

Log into your BillingTrack install and go to System -&gt; Add-ons and
click the Install button for the add-on. Once the add-on is installed,
the applicable menu items will appear and the add-on will be usable.
