run: www/index.php
	php -S localhost:8000 -t www/
compile:
	grunt style && grunt script
prepare:
	npm install && composer install
	mkdir log; sudo chown -R "${USER}:www-data" ./ && sudo chmod -R 755 ./
	touch app/config/local.neon
