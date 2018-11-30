# FusionInvoice-FOSS
FusionInvoice 2018-8 after it was open sourced

:+1: If you find this product useful, feel free to buy me a beer: https://paypal.me/cytecheng

[Link to Live Demo](http://fusioninvoicefoss-demo.cytech-eng.com)

[Link to prerequisites](https://github.com/cytech/FusionInvoice-FOSS/wiki)

**To Upgrade from v4.1.0 to v4.1.x**
1. Git pull (if originally cloned) or download and overwrite existing installation.
2. run composer update
3. Start FusionInvoiceFOSS/setup
4. after migration completes, signin.


**To Upgrade from v4.0.x to v4.1.x**
1. Git pull (if originally cloned) or download and overwrite existing installation.
   (if downloading and extracting zip, delete the contents of "YourFusionInvoiceFOSS/public" directory prior to extracting.)
2. run composer update
3. Start FusionInvoiceFOSS/setup
4. after migration completes, signin.

**To Upgrade from v4.0.0 to v4.0.x**
1. Git pull (if originally cloned) or download and overwrite existing installation.
2. run composer update
3. Start FusionInvoiceFOSS/setup
4. after migration completes, signin.

**To Install:**

1. Clone or download the repository to a new web directory (do not attempt to upgrade an old FusionInvoice installation)

2. Run "composer install" in web directory

3. create a NEW FusionInvoiceFOSS database.

    _You will be presented with an option to transfer an existing FusionInvoice 2018-8 database during setup._

4. Copy .env.example to .env

5. edit .env and change:

    DB_HOST=
    
    DB_DATABASE=
    
    DB_USERNAME=
    
    DB_PASSWORD=
    
    to your **NEW** database settings.

    _Do not set APP_DEBUG to true. On a large database transfer it will cause a failure._
    _If you need to run debug, wait until setup is complete and app is running._

6. save .env file.

    **FOR NEW INSTALL:**
        Run "php artisan key:generate"
        Copy generated key to (APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx)
    
        Save .env file and exit.

    **FOR UPGRADE FROM 2018-8:**
        Add your existing FusionInvoice 2018-8 app key to (APP_KEY= xxxxxxxxxxxxxxxxxxxxxx)
    
        Save .env file and exit.

7. Set permissions for your site.

8. Start FusionInvoiceFOSS/setup

9. after database configuration finishes, you will be presented with 2 choices:

    **Create new account** -> creates fresh installation with account

    **Transfer existing 2018-8 database** -> enter EXACT existing 2018-8 database name and data will be transfered to new database and structure.
    
    Note: This can take a long time on a large database (i.e. 30 MiB = ~ 10 minutes). This function will transfer **only** existing FusionInvoice 2018-8. If you have an older version it will need to be upgraded to 2018-8.
    2018-8 is available in the release section of this repository.
    This will also transfer the cytech/workorders addon, cytech/scheduler addon and fusioninvoice/TimeTracking addon if they exist.
    Any other addons will have to be reinstalled and data manually transferred.
    Also, there is a limit of 10 custom fields columns transferred per _module_custom_ table. If you have more than 10 custom fields columns defined in any _module_custom_ table you will need to edit the code in SetupController.php line 201 and increase the
    value from 10 to the maximum number of your custom field columns.

10. sign in

