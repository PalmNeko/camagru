
default: init

init:
	composer install

test:
	cd ./html ; ./vendor/bin/pest

watch:
	cd ./html ; find ./tests/ -name "*Test.php" | entr -p ./vendor/bin/pest /_
