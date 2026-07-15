web: APP_ENV=production APP_DEBUG=false APP_URL=https://${RAILWAY_PUBLIC_DOMAIN:-localhost} php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
release: APP_ENV=production APP_DEBUG=false APP_URL=https://${RAILWAY_PUBLIC_DOMAIN:-localhost} php artisan key:generate --force && APP_ENV=production APP_DEBUG=false APP_URL=https://${RAILWAY_PUBLIC_DOMAIN:-localhost} php artisan migrate --force
