#!/usr/bin/env bash

while true
do
    /usr/bin/php -d variables_order=EGPCS /var/www/artisan schedule:run --verbose --no-interaction
    sleep 60
done