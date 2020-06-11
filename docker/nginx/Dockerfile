FROM nginx:1.18.0-alpine

# set timezone
ENV TZ=Asia/Hong_Kong
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www

CMD ["nginx"]

EXPOSE 80 443
