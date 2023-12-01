SHELL := /bin/bash

tests_init:
	docker compose up -d
	symfony console doctrine:database:drop --force --env=test --if-exists || true
	symfony console doctrine:database:create --env=test --connection=default
	symfony console doctrine:schema:create -n --env=test
tests:
	make tests_init
	symfony php bin/phpunit $@
.PHONY: tests
