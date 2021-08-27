start: # запустить все образы
	docker start crm-vlad_fpm_1
	docker start crm-vlad_web-server_1
	docker start crm-vlad_postgres_1

stop: # остановить докер образы
	docker stop crm-vlad_fpm_1
	docker stop crm-vlad_web-server_1
	docker stop crm-vlad_postgres_1

install: # установить все контейнеры
	docker-compose up -d

cache: # сбросить весь кеш приложения
	php artisan optimize
	php artisan cache:clear
	php artisan route:cache
	php artisan view:clear
	php artisan config:cache

term:
	docker exec -it crm-vlad_fpm_1 bash
