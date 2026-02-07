
default: init

init:
	composer install

test:
	./vendor/bin/pest

watch:
	find ./tests/ -name "*Test.php" | entr -p ./vendor/bin/pest /_
