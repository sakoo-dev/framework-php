init:
	@cp .env.example .env
	@chmod +x ./sakoo
	@./sakoo up -d --build
	@./sakoo composer install --ignore-platform-reqs

up:
	@./sakoo up -d

down:
	@./sakoo down

rm:
	@./sakoo down -v --remove-orphans