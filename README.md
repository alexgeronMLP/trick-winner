# Symfony 4.0 + Docker

## Credits
To help setting up this project, I used [the following repo](https://github.com/guham/symfony-docker) 

##  Requirements

- [Docker](https://docs.docker.com/engine/installation/) installed
- [Docker Compose](https://docs.docker.com/compose/install/) installed

## Installation

1. Clone this repository
    ```bash
    $ git clone https://github.com/guham/symfony-docker.git
    ```
2. Update the Docker `.env` file according to your needs. The `NGINX_HOST` environment variable allows you to use a custom server name

3. Add the server name in your system host file

4. Copy the `symfony/.env.dist` file to `symfony/.env`
    ```bash
    $ cp symfony/.env.dist symfony/.env
    ```

5. Build & run containers with `docker-compose` by specifying a second compose file, e.g., with MySQL 
    ```bash
    $ docker-compose -f docker-compose.yaml -f docker-compose.mysql.yaml build
    ```
    then
    ```bash
    $ docker-compose -f docker-compose.yaml -f docker-compose.mysql.yaml up -d
    ```
   

6. Composer install

    first, configure permissions on `symfony/var` folder
    ```bash
    $ docker-compose exec app chown -R www-data:1000 var
    ```
    then
    ```bash
    $ docker-compose exec -u www-data app composer install
    ```

## How to use the application

You can access the application both in HTTP and HTTPS:

