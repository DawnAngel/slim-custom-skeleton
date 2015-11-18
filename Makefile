cs:
	./vendor/bin/phpcbf --standard=PSR2 \
		src

	./vendor/bin/phpcs --standard=PSR2 --warning-severity=0 -p \
		src

	./vendor/bin/phpcs --standard=Squiz --sniffs=Squiz.Commenting.FunctionComment,Squiz.Commenting.FunctionCommentThrowTag,Squiz.Commenting.ClassComment,Squiz.Commenting.VariableComment -p \
		src

test:
	./vendor/bin/phpunit

lint:
	find App -name *.php -exec php -l {} \;

deps:
	if [ ! -f composer.phar ]; then \
	    if command -v wget >/dev/null; then \
	        wget -q https://getcomposer.org/composer.phar -O ./composer.phar; \
	    else \
	        curl -p https://getcomposer.org/composer.phar -o composer.phar; \
	    fi \
	fi
	php composer.phar install

dist-clean:
	rm -rf vendor
	rm -f composer.lock
	rm -f composer.phar


.PHONY: lint test cs deps dist-clean alias
