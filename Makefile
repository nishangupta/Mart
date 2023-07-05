#!/usr/bin/make -f

PROCESSORS_NUM := $(shell getconf _NPROCESSORS_ONLN)
GLOBAL_CONFIG := -d memory_limit=-1

# ---------------------------------------------------------------------

.PHONY: all
all: test

.PHONY: clean-all
clean-all:
	rm -rf ./vendor

.PHONY: clean-build
clean-build:
	git clean -Xfq bootstrap build storage storage/logs

.PHONY: clean-build-phpcs
clean-build-phpcs:
	rm -rf build/phpcs.xml

.PHONY: clean-build-test
clean-build-test:
	rm -rf build/phpunit

.PHONY: clean-build-coverage
clean-build-coverage: clean-build-test
	rm -rf build/coverage

.PHONY: logs
logs:
	tail -f storage/logs/*.log

.PHONY: phpcs
phpcs: clean-build-phpcs build/phpcs.xml

.PHONY: phpcbf
phpcbf:
	php ${GLOBAL_CONFIG} vendor/bin/phpcbf --parallel=${PROCESSORS_NUM}

.PHONY: test
test: vendor .env phpcs clean-build-test build/phpunit

.PHONY: fast-test
fast-test: vendor .env fast-phpcs clean-build-test build/phpunit

.PHONY: coverage
coverage: clean-build-coverage build/coverage
	open build/coverage/html/index.html

build/phpcs.xml:
	mkdir -p build
	php ${GLOBAL_CONFIG} vendor/bin/phpcs --parallel=${PROCESSORS_NUM} --report-junit=build/phpcs.xml

build/phpunit:
	php ${GLOBAL_CONFIG} vendor/bin/phpunit --no-coverage --stop-on-failure

build/coverage:
	php ${GLOBAL_CONFIG} -d xdebug.mode=coverage vendor/bin/phpunit --testdox

up:
	docker-compose up -d healthy

down:
	docker-compose down -v

.env:
	cp .env.example .env
	php artisan key:generate

vendor:
	composer install
