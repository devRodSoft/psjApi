FROM php:7.2-apache-stretch

ENV SERVER "docker"

WORKDIR /tmp

RUN apt-get update && apt-get -y install libfreetype6-dev \
        libmcrypt-dev \
        libjpeg-dev \
        libpng-dev \
        wget \
        git \
        zlib1g-dev \
        sendmail \
        zlib1g-dev \
        unzip


RUN docker-php-ext-configure gd \
        --with-freetype-dir=/usr/include/freetype2 \
        --with-png-dir=/usr/include \
        --with-jpeg-dir=/usr/include && \
        docker-php-ext-install pdo pdo_mysql zip mbstring gd

RUN a2enmod rewrite
RUN a2enmod headers

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN echo "ServerName localhost" >> /etc/apache2/sites-available/000-default.conf; \
	echo "<VirtualHost *:80>" >> /etc/apache2/sites-available/000-default.conf; \
	echo "	ServerName api.localhost" >> /etc/apache2/sites-available/000-default.conf; \
	echo "	DocumentRoot /var/www/src/api/web" >> /etc/apache2/sites-available/000-default.conf; \
	echo "	ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/000-default.conf; \
	echo "	CustomLog ${APACHE_LOG_DIR}/access.log combined" >> /etc/apache2/sites-available/000-default.conf; \
	echo "</VirtualHost>" >> /etc/apache2/sites-available/000-default.conf; \
	echo "<VirtualHost *:80>" >> /etc/apache2/sites-available/000-default.conf; \
	echo "	ServerName backend.localhost" >> /etc/apache2/sites-available/000-default.conf; \
	echo "	DocumentRoot /var/www/src/backend/web" >> /etc/apache2/sites-available/000-default.conf; \
	echo "	ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/000-default.conf; \
	echo "	CustomLog ${APACHE_LOG_DIR}/access.log combined" >> /etc/apache2/sites-available/000-default.conf; \
	echo "</VirtualHost>" >> /etc/apache2/sites-available/000-default.conf; \
    echo "<VirtualHost *:80>" >> /etc/apache2/sites-available/000-default.conf; \
    echo "  ServerName taquilla.localhost" >> /etc/apache2/sites-available/000-default.conf; \
    echo "  DocumentRoot /var/www/src/taquilla/web" >> /etc/apache2/sites-available/000-default.conf; \
    echo "  ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/000-default.conf; \
    echo "  CustomLog ${APACHE_LOG_DIR}/access.log combined" >> /etc/apache2/sites-available/000-default.conf; \
    echo "</VirtualHost>" >> /etc/apache2/sites-available/000-default.conf;

WORKDIR /var/www
RUN chown www-data:www-data -R /var/www
RUN chmod 755 -R /var/www
RUN rm -fr /var/www/html
# USER www-data
RUN mkdir -p /var/www/src/api1/web





