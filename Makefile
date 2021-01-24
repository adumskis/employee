up:
	docker-compose up -d

up_rebuild:
	docker-compose up -d --build

down:
	docker-compose down

compose_install:
	docker-compose exec php composer install
