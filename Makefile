init:
	@cp .env.example .env
	@chmod +x ./sakoo

up:
	@./sakoo up -d

down:
	@./sakoo down

rm:
	@./sakoo down -v --remove-orphans