#!/usr/bin/env bash
php artisan clear-compiled
php artisan view:clear
php artisan cache:clear
php artisan config:clear
composer dump-autoload
php artisan ide-helper:generate
