#!/usr/bin/env sh
set -o pipefail
set -e

echo "Clear cache for eventually changed environment variables"
rm -rf var/cache/*

echo "Install dependencies"
composer install -n -o

#echo "Wait for database initiation"
#until bin/console monitor:health doctrine_dbal_default_connection; do
#    sleep 2
#done

#bin/console doctrine:migrations:migrate -n --allow-no-migration
#
#RESULT=$(bin/console doctrine:query:sql 'SELECT COUNT(*) FROM users')
#COUNT=${RESULT:66:1}
#if [ $COUNT -lt 1 ];
#then
#  bin/console doctrine:fixtures:load -n
#fi

#echo "Create search indexes"
#bin/console fos:elastica:populate --no-delete

#echo "Make logs and cache directories writable"
#chmod -R a+w,g+s var

#php artisan serve

php-fpm
