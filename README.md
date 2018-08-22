# FusionInvoice-FOSS
FusionInvoice 2018-8 after it was open sourced

Install:
clone repo

composer install

create a NEW FusionInvoiceFOSS database.
    you will be presented with an option to transfer an existing 2018-8 database during setup.

copy .env.example to .env

edit .env and change:
    DB_HOST=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
to your NEW database settings.

save file.

NEW INSTALL:
run "php artisan key:generate"
copy generated key to (APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx)

save file and exit.

UPGRADE FROM 2018-8:
Add your existing FusionInvoice 2018-8 app key to (APP_KEY= xxxxxxxxxxxxxxxxxxxxxx)

save file and exit.

Start FusionInvoiceFOSS/setup

after database configuration finishes, you will be presented with 2 choices:

create new account -> creates fresh installation with account

transfer existing 2018-8 database -> enter EXACT existing 2018-8 database name and data will be transfered to new database and structure.

sign in

If you find this product useful, feel free to buy me a beer: https://paypal.me/cytecheng