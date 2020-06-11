# docker-lemp-symfony5
Building a Symfony website (Linux, Nginx, MySQL, PHP) using docker compose

Support HTTP and HTTPS

## Installation

```console
# Create folder to store all your docker compose projects
mkdir docker-projects  

cd docker-projects  

git clone https://github.com/phoenixlam/docker-lemp-symfony5.git  

cd docker-lemp-symfony5  

cd docker  

# Optional, update environment variables for MySQL connection and Symfony
vi .env

# Optional, update init.sql if you updated DATABASE_NAME in .env
# init.sql will create a "testdb" with a "testtable" and insert some rows for testing CRUD operations
vi database/init.sql

# Optional, update port mapping
# Default
#   MySQL 3306
#   HTTP 80
#   HTTPS 443
#   php-fpm 9000 (can't change here)
vi docker-compose.yml

# Optional, update SSL certificate
# Path
#   nginx/ssl/nginx-selfsigned.crt
#   nginx/ssl/nginx-selfsigned.key

# Start the containers
docker-compose up

# Verify
# you may modify the test cases in web-skeleton/src/Controller/TestController.php
#   http://127.0.0.1/test/json
#   https://127.0.0.1/test/html
#   http://127.0.0.1/test/log
#   http://127.0.0.1/test/mysql/insert
#   http://127.0.0.1/test/mysql/select-one
#   http://127.0.0.1/test/mysql/select-many
#   http://127.0.0.1/test/mysql/update
#   http://127.0.0.1/test/mysql/delete

# Setup logrotate
vi /etc/logrotate.d/docker

# Below is a example of logrotate config file
/var/lib/docker/containers/*/*.log
/path-to-your-docker-folders/docker-lemp-symfony5/web-skeleton/var/log/*.log
/path-to-your-docker-folders/docker-lemp-symfony5/docker/logs/nginx/*.log {
    daily
    rotate 7
    copytruncate
    missingok
    dateext dateformat -%Y-%m-%d

    # because the symfony log is unknown user
    su root root
}
```

## Version of the images
Linux  
Nginx 1.18  
Mariadb 10.4  
PHP 7.4    
Symfony 5.1
