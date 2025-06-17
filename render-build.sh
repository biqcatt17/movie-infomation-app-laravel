#!/usr/bin/env bash

echo "🚀 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "🔑 Generating APP_KEY if not set..."
php artisan key:generate --force

echo "⚙️ Caching Laravel config..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🔗 Creating storage symlink..."
php artisan storage:link

# Only run chmod if on Linux
if [[ "$OSTYPE" == "linux-gnu"* ]]; then
  echo "🛠️ Setting file permissions..."
  chmod -R 775 storage bootstrap/cache
fi

echo "✅ Build complete!"
