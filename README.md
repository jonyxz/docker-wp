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

  ### 1. Create Project Directory
   Create a new directory for your project and navigate into it:
   ```bash
   mkdir docker-wp && cd docker-wp
   ```
  ### 2. Dockerfile

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
  ### 3. docker-compose.yml

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

   ### 4. Build and Start Docker Containers

   After setting up the `Dockerfile` and `docker-compose.yml`, navigate to your project directory in the terminal and run the following commands:

   ```bash
   docker-compose build
   docker-compose up 
   ```

   This will build the Docker images and start the containers in detached mode.
   
   ### 5. Checking PHP Installation and Extensions

   To ensure that the PHP parser is functioning correctly and that the required extensions for WordPress are installed, follow the steps below:

   #### a. Create info.php

   Create a file named info.php in the src directory with the following content:

   ```php
      <?php
      phpinfo();
   ```

   #### b. Access info.php

   Open your web browser and navigate to the following URL:

   ```bash
      http://localhost:8080/info.php
   ```

   This page will display the current PHP configuration. Verify that the mysqli and redis extensions are listed among the installed extensions.
   
   ### 6. Set Up WordPress

   #### a. Download and Extract WordPress Files

   Next, download the latest version of WordPress from the official website [WordPress Download](https://wordpress.org/download/).
   Once the download is complete, extract the contents of the WordPress archive into the `src` directory. 

   #### b. Complete WordPress Installation

   Now, you can complete the WordPress installation by navigating to http://localhost:8080 in your web browser. Follow the on-screen instructions to set up WordPress.
   After WordPress is running smoothly, go to the administrator page at:

   ```bash
   http://localhost:8080/wp-admin
   ```

   #### c. Set Permissions for WordPress Files

   To set the correct permissions for WordPress files, execute the following command in your terminal:

   ```bash
   docker exec -it php-server bash
   chown -R www-data:www-data /var/www/html
   exit
   ```

   ### 7. Set Up and Enabling Redis Object Caching 
   #### a. Install Redis Object Cache Plugin

   In the WordPress admin panel, go to the Plugins menu.
   Search for the Redis Object Cache plugin, install it, and activate it (refer to the plugin documentation for installation instructions if needed).

   #### b. Configure Redis in wp-config.php

   Add the following configuration at the top of your wp-config.php file:

   ```php
   define('FS_METHOD', 'direct');

   define( 'WP_REDIS_HOST', 'redis-server' );
   define( 'WP_REDIS_PORT', 6379 );
   define( 'WP_REDIS_PREFIX', 'dolanan' );
   define( 'WP_REDIS_DATABASE', 0 ); // 0-15
   define( 'WP_REDIS_TIMEOUT', 1 );
   define( 'WP_REDIS_READ_TIMEOUT', 1 );
   ```

   #### c. Enable Redis Object Cache

   After installing and activating the Redis Object Cache plugin, open the WordPress admin panel and navigate to **Settings > Redis**. In this section, click on the **Enable Object Cache** button to activate Redis    caching for your WordPress site, which will help improve performance by storing cached data in Redis.

## Conclusion

By following these steps, you have successfully set up WordPress with MySQL and Redis using Docker on Arch Linux. If you encounter any issues, please refer to the official documentation for WordPress or PHP for troubleshooting.
