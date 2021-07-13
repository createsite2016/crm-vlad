start:
	docker start crm-vlad_fpm_1
	docker start crm-vlad_web-server_1
	docker start crm-vlad_postgres_1

stop:
	docker stop crm-vlad_fpm_1
	docker stop crm-vlad_web-server_1
	docker stop crm-vlad_postgres_1
