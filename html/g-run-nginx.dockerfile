FROM erseco/alpine-php-webserver
WORKDIR /var/www/html
RUN rm /var/www/html/index.php
COPY ./ ./