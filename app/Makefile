
default: init

init: vendor
	composer install

test: vendor
	./vendor/bin/pest

watch:
	find ./tests/ -name "*Test.php" | entr -p ./vendor/bin/pest /_

vendor:
	composer install
