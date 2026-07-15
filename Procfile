web: php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
release: cp .env.example .env 2>/dev/null || true; perl -pi -e "s/^APP_ENV=.*/APP_ENV=production/; s/^APP_DEBUG=.*/APP_DEBUG=false/; s|^APP_URL=.*|APP_URL=https://${RAILWAY_PUBLIC_DOMAIN:-localhost}|" .env; php artisan key:generate --force; php artisan migrate --force; php artisan config:cache; php artisan route:cache
