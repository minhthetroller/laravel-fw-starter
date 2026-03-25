#!/bin/sh
set -e

DB_HOST="${DB_HOST:-db}"
DB_PORT="${DB_PORT:-3306}"
DB_DATABASE="${DB_DATABASE:-laravel}"
DB_USERNAME="${DB_USERNAME:-laravel}"
DB_PASSWORD="${DB_PASSWORD:-secret}"

echo "[Entrypoint] Waiting for MySQL at $DB_HOST:$DB_PORT..."
until php -r "
try {
    new PDO('mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD');
    exit(0);
} catch (Exception \$e) {
    exit(1);
}
" > /dev/null 2>&1; do
    echo "[Entrypoint] Database not ready, retrying in 2s..."
    sleep 2
done

echo "[Entrypoint] Database is ready."

cd /var/www

# Install composer dependencies if vendor is missing
if [ ! -f "vendor/autoload.php" ]; then
    echo "[Entrypoint] Running composer install..."
    composer install --no-dev --optimize-autoloader --no-interaction
fi

# Generate app key if not already set
php artisan key:generate --no-interaction 2>/dev/null || true

# Run migrations
echo "[Entrypoint] Running migrations..."
php artisan migrate --force --no-interaction

# Clear stale config/view/route caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "[Entrypoint] Application ready. Starting PHP-FPM..."
exec php-fpm
