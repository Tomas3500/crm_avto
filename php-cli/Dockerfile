FROM php:8.1-cli-alpine3.15

RUN apk add --no-cache --virtual build-dependencies icu-dev libxml2-dev $PHPIZE_DEPS \
    freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev libwebp-dev \
    && docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    && docker-php-ext-install -j$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) mysqli opcache pdo_mysql xml fileinfo pdo exif dom gd\
	&& pecl install xdebug redis \
    && docker-php-ext-enable xdebug redis
