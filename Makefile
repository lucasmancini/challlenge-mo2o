#!/bin/bash
SYMFONY_VERSION=4.4
PHP_VERSION=7.4
NGINX_VERSION=1.21
NGINX_CONTAINER_NAME=rgo-apirest-nginx
PHP_CONTAINER_NAME=rgo-apirest-php
XDEBUG_ENV=development
#UID := $(shell id -u)
UID=1000

help: ## Show this help message
	@echo
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

.SILENT: run

init:
	@make build
	@make up
	@make install-symfony
	@make composer-install
	@make clear-cache

build:
	UID=${UID} PHP_CONTAINER_NAME=${PHP_CONTAINER_NAME} NGINX_CONTAINER_NAME=${NGINX_CONTAINER_NAME} SYMFONY_VERSION=${SYMFONY_VERSION} PHP_VERSION=${PHP_VERSION} NGINX_VERSION=${NGINX_VERSION} XDEBUG_ENV=${XDEBUG_ENV} docker-compose build --pull

up: ## Start the containers
	UID=${UID} PHP_CONTAINER_NAME=${PHP_CONTAINER_NAME} NGINX_CONTAINER_NAME=${NGINX_CONTAINER_NAME} SYMFONY_VERSION=${SYMFONY_VERSION} PHP_VERSION=${PHP_VERSION} NGINX_VERSION=${NGINX_VERSION} XDEBUG_ENV=${XDEBUG_ENV} docker-compose up --detach
	@make composer-install

down: ## Down the containers
	UID=${UID} docker-compose down --remove-orphans

stop: ## Stop the containers
	UID=${UID} docker-compose stop

install-symfony: ## Stop the containers
	docker exec -it -e SYMFONY_VERSION=${SYMFONY_VERSION} ${PHP_CONTAINER_NAME} sh /var/www/docker/php/install_symfony.sh

ssh: ## ssh's into the PHP container
	UID=${UID} docker exec -it ${PHP_CONTAINER_NAME} bash

restart: ## Restart the containers
	@make down
	@make up

composer-install: ## Installs composer dependencies
	UID=${UID} docker exec -it ${PHP_CONTAINER_NAME} composer install --no-scripts --no-interaction --optimize-autoloader

routing-sync:
	@U_ID=${UID} docker exec -it ${PHP_CONTAINER_NAME} php bin/console fos:js-routing:dump --format=json

routes:
	@U_ID=${UID} docker exec ${PHP_CONTAINER_NAME} php bin/console debug:router

test:
	@U_ID=${UID} docker exec ${PHP_CONTAINER_NAME} php bin/phpunit --testdox --stop-on-failure --colors=always
#   ej: php bin/phpunit --testdox --stop-on-failure --colors=always ./tests/Apps/Api/Policy/PolicyStoreControllerTest.php

clear-cache:
	@U_ID=${UID} docker exec ${PHP_CONTAINER_NAME} php bin/console cache:clear