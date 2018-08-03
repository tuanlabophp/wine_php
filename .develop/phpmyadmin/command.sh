#!/bin/bash

if [ ! -d "/var/www/app/.develop/phpmyadmin/src/phpMyAdmin-4.7.2" ]; then
    echo "------ [BEGIN] Extract PhpMyAdmin Source Code ------"
    mkdir -p "/var/www/app/.develop/phpmyadmin/src"
    tar -zxf /var/www/app/.develop/phpmyadmin/phpMyAdmin-4.7.2.tar.gz -C /var/www/app/.develop/phpmyadmin/src/
    echo "------ [END] Extract PhpMyAdmin Source Code ------"
fi
