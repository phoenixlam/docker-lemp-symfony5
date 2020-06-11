FROM php:7.4-fpm-alpine

# set timezone
ENV TZ=Asia/Hong_Kong
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN printf '[PHP]\ndate.timezone = "Asia/Hong_Kong"\n' > /usr/local/etc/php/conf.d/tzone.ini

# wait for mysql on
COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apk --update --no-cache add git

RUN docker-php-ext-install pdo_mysql

# install composer
# https://hub.docker.com/_/composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

#CMD composer install ; wait-for-it database:3306 -- bin/console doctrine:migrations:migrate ;  php-fpm 
CMD composer install ; php-fpm 

EXPOSE 9000
