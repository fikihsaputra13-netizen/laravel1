web: php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
release: cp .env.example .env 2>/dev/null || true; php artisan key:generate --force; php artisan migrate --force; php artisan config:cache; php artisan route:cache
