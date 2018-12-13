check: style cs-dry phpunit

style:
	php ./vendor/bin/phpstan analyse -l 7 -c ./phpstan.neon src

cs-fix:
	php ./vendor/bin/php-cs-fixer --no-interaction --diff -v fix

cs-dry:
	php ./vendor/bin/php-cs-fixer --no-interaction --diff --dry-run -v fix

phpunit:
	./vendor/bin/phpunit
