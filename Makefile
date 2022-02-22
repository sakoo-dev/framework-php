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

stylefix:
	@./sakoo php ./vendor/bin/php-cs-fixer fix

test:
	@./sakoo test

fresh:
	@./sakoo composer dump-autoload