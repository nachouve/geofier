#!/bin/bash

# Script to download composer.phar and install dependencies

curl -s http://getcomposer.org/installer |php -d suhosin.executor.include.whitelist=phar
php -d suhosin.executor.include.whitelist=phar composer.phar install

