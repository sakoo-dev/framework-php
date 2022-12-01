init:
	@cp .env.example .env
	@docker run --rm -it -v ${PWD}:/app composer:latest install
	@chmod +x ./vendor/sakoo/framework-core/bin/sakoo
	@./sakoo up -d --build

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