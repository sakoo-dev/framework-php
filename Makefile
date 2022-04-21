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

test-coverage:
	@./sakoo test --coverage-html=storage/tests/coverage/
	@open ./storage/tests/coverage/index.html

fresh:
	@./sakoo composer dump-autoload

watch:
	@./sakoo assist watch