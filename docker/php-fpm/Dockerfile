FROM php:8.1-fpm-alpine
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions xdebug pdo_pgsql pgsql redis
RUN apk add bash
WORKDIR /var/www
ARG USER_DEFAULT=default
RUN echo $USER_DEFAULT
RUN adduser -D -g "$USER_DEFAULT" $USER_DEFAULT
RUN echo $USER_DEFAULT:123456 | chpasswd
RUN adduser $USER_DEFAULT wheel
RUN addgroup $USER_DEFAULT $USER_DEFAULT