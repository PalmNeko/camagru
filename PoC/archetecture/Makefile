

default: up

build:
	docker compose build

up:
	docker compose up -d --build --force-recreate
	@echo ''
	@echo 'exported ports (expected http):'
	@bash scripts/print-exported-ports.sh | sed 's/^/    /'

down:
	docker compose down

fclean:
	@docker compose down
	@docker volume prune -f
	@docker network prune -f
	@IMAGES=$$(docker image ls -aq); \
	if [ -n "$$IMAGES" ]; then \
		docker image rm -f $$IMAGES; \
	fi

	@ echo 'Deleted all container, volume, network and image.'
