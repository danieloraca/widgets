.PHONY: all
default: all;

unit:
	bin/phpunit --no-coverage src/

analysis:
	vendor/bin/phpstan.phar analyse -c phpstan.neon -l 7 \
		src
