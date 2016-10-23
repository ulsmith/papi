FROM ulsmith/alpine-apache-php7
MAINTAINER Paul Smith <pa.ulsmith.net>

RUN curl -sS https://getcomposer.org/installer | php \
	&& mv composer.phar /usr/local/bin/composer

ADD ./public /app/public
ADD ./src /app/src
ADD ./bootstrap.php /app
ADD ./composer.json /app
ADD ./phpunit.xml /app

WORKDIR /app

RUN composer install

RUN chown -R apache:apache /app
