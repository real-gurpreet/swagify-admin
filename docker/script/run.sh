#!/bin/sh

[ -f /run-pre.sh ] && /run-pre.sh
# Set the root in the conf
sed -i -e "s#%%NGINX_ROOT%%#$PROJ_DIRNAME#" /etc/nginx/conf.d/default.conf
sed -i -e "s#%%IMAGE_PHP_VERSION%%#$IMAGE_PHP_VER#" /etc/nginx/conf.d/default.conf

#set permissions
chown -Rf :www-data /opt/$PROJ_DIRNAME
chmod -R 0775 /opt/$PROJ_DIRNAME/bootstrap/cache
chmod -R 0775 /opt/$PROJ_DIRNAME/storage
chmod -R 0775 /etc/config

#create
mkdir -p /var/run/
service php7.4-fpm start
nginx
