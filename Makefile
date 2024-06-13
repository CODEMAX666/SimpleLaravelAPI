# Makefile for Laravel Project

# Run PHPStan static analysis
phpstan:
	composer exec phpstan analyse

# Run tests
test:
	php artisan test

# Run migrations
migrate:
	php artisan migrate

# Rollback migrations
rollback:
	php artisan migrate:rollback

# Clear application cache
cache-clear:
	php artisan cache:clear

# Clear config cache
config-clear:
	php artisan config:clear

# Clear route cache
route-clear:
	php artisan route:clear

# Clear view cache
view-clear:
	php artisan view:clear

# Generate Swagger documentation
swagger:
	php artisan l5-swagger:generate

