#!/bin/sh

exec cd /var/www/api && composer install
exec /sbin/my_init