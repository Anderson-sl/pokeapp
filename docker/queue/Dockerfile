FROM php:8.1-alpine
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions xdebug pdo_pgsql pgsql redis
WORKDIR /var/www
CMD ["php", "artisan queue:work"]