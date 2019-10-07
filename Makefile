run: www/index.php
	php -S localhost:8000 -t www/
prepare:
	npm install && composer install
