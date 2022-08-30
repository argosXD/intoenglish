FROM  php:7.4.30-apache
WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y git && \
    git clone https://github.com/argosXD/intoenglish.git && \
    cp -r /var/www/html/intoenglish/* /var/www/html

EXPOSE 8081



