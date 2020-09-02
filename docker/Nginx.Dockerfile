FROM nginx

ADD docker/conf/vhosts.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/tapir-test
