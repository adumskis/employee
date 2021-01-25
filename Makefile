export CURRENT_USER=$(shell id -u):$(shell id -g)

up:
	docker-compose up -d

up_rebuild:
	docker-compose up -d --build

down:
	docker-compose down

ssh:
	docker-compose exec php bash

compose_install:
	docker-compose exec php composer install

artisan_migrate:
	docker-compose exec php php artisan migrate

artisan_migrate_fresh:
	docker-compose exec php php artisan migrate:fresh

phpunit:
	docker-compose exec php vendor/bin/phpunit
