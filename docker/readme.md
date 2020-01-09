Server :  Nginx {stable/1.16.1}

Php : php7.4-fpm

Php Extensions :
    php7.4-json
    php7.4-bcmath
    php7.4-cli
    php7.4-bz2
    php7.4-curl
    php7.4-mbstring
    php7.4-intl
    php7.4-imap
    php7.4-mysql
    php7.4-gd
    php7.4-opcache
    php7.4-xml
    php7.4-zip
    php7.4-common


Node : 12.x {LTS/12.14.0}

# To create radis container and image.
docker run -d -p 3276:6379  --name=redis redis:latest
#To create mariadb. 
Set up Database: docker run -d -p 3307:3306 --name=mariadb -e MYSQL_ROOT_PASSWORD=root mariadb
# To open mariadb shell and create user or create database.
Bash into the mariadb container: docker exec -it mariadb /bin/bash
Log into mysql: mysql -u root -p (password root)

# To set-up  ngx, node , php 
docker build -t swagify-admin:build --force-rm --no-cache -f docker/dockerFile.dev .

# To link current image  with redis , mariadb
docker run -d --name=swagify-admin --env NODE_ENV=development -p 8050:80 -v $PWD:/opt/swagify-admin -v "$PWD/../config":/etc/config --link redis:redis --link mariadb:mariadb swagify-admin:build

#To install php myadmin
sudo docker pull phpmyadmin/phpmyadmin:latest

#To configure with phpmyadmin
sudo docker run --name my-own-phpmyadmin -d --link mariadb:db -p 8081:80 phpmyadmin/phpmyadmin

# To open terminal in docker ubuntu:18.04
docker exec -it b6f389d49f59   /bin/bash











