# WordPress with MySQL and Redis on Docker for Arch Linux

This repository contains a setup to run WordPress with a MySQL database and Redis as an object cache using Docker and Docker Compose. This setup allows you to quickly deploy a WordPress environment for development or testing purposes.

## Prerequisites

- **Docker**: Ensure that Docker is installed on Arch Linux machine. You can install it using the following command:

   ```bash
   sudo pacman -S docker docker-compose
   ```

- After installation, start the Docker service:

  ```bash
  sudo systemctl enable docker --now
  ```

## Getting Started

  ### 1. Dockerfile

  Create a file named `Dockerfile` with the following content:

    ```dockerfile
    FROM php:8.2-apache
    WORKDIR /var/www/html
    RUN apt-get update && \
        apt-get install -y libpng-dev && \
        docker-php-ext-install pdo pdo_mysql gd
    RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
    RUN pecl install redis && docker-php-ext-enable redis
    EXPOSE 80
    CMD ["apache2-foreground"]
    ```
  ### 2. docker-compose.yml

  Create a file named `docker-compose.yml` and fill it with the following content:
  
  ```docker-compose.yml
version: '3'
services:
  php:
    container_name: php-server
    build:
      context: .
      dockerfile: Dockerfile
    volumes:
      - ./src:/var/www/html
    ports:
      - 8080:80
    depends_on:
      - mysql
  mysql:
    image: mysql:latest
    container_name: mysql-server
    environment:
      MYSQL_ROOT_PASSWORD: katasandi
      MYSQL_DATABASE: wordpress_dp
      MYSQL_USER: wordpress_user
      MYSQL_PASSWORD: sandi_wordpress
    volumes:
      - ./mysql_data:/var/lib/mysql
  redis:
      image: redis:latest
      container_name: redis-server
volumes:
  mysql_data:
  ```

