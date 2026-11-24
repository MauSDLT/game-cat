FROM php:8.5-apache

RUN docker-php-ext-install mysqli

RUN { \
      echo "upload_max_filesize = 20M"; \
      echo "post_max_size = 50M"; \
    } > /usr/local/etc/php/conf.d/uploads.ini