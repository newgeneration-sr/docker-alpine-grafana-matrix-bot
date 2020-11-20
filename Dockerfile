FROM dotriver/alpine-s6

RUN apk add nginx php7 php7-fpm php7-curl \
 && mkdir -p /run/nginx

ADD conf/ / 
