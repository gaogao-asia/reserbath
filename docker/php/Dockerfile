FROM node:8.15.0-alpine AS nodejs
ENV APP_ROOT /usr/src/reserbath-web

RUN mkdir -p $APP_ROOT
WORKDIR $APP_ROOT

COPY package.json $APP_ROOT
COPY package-lock.json $APP_ROOT

RUN apk add --update --no-cache \
    git \
    && \
    npm install

COPY . $APP_ROOT

RUN npm run production


FROM php:7.2.12-fpm-alpine3.8
ENV APP_ROOT /usr/src/reserbath-web
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN mkdir $APP_ROOT
WORKDIR $APP_ROOT

COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php/wait-for-it.sh /usr/src/wait-for-it.sh
COPY composer.json $APP_ROOT
COPY composer.lock $APP_ROOT

SHELL ["/bin/sh", "-o", "pipefail", "-c"]
RUN apk update && \
    apk add --update --no-cache \
    bash=4.4.19-r1 \
    mysql-client \
    zlib-dev \
    && \
    NPROC="$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1)" && \
    docker-php-ext-install -j"${NPROC}" pdo_mysql zip && \
    wget https://raw.githubusercontent.com/composer/getcomposer.org/6cc488c7604093278748e0b4fb9b80f21141ecb8/web/installer -O - -q \
    | php -- --quiet --install-dir=/usr/local/bin --filename composer && \
    composer install --no-interaction --no-autoloader --no-scripts

COPY --from=nodejs $APP_ROOT $APP_ROOT

RUN composer dump-autoload --optimize

VOLUME /usr/src/reserbath-web/public/assets

ENTRYPOINT ["sh", "-c", "/usr/src/wait-for-it.sh $DB_HOST:3306 -t 60 -- php artisan migrate --force && docker-php-entrypoint php-fpm -R"]
