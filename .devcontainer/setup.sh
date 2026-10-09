#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."

if [ ! -f .env ]; then
  cp .env.example .env
fi

composer install --no-interaction

if ! grep -q '^APP_KEY=base64:' .env; then
  php artisan key:generate --force
fi

mkdir -p database
touch database/database.sqlite

php artisan migrate --force
php artisan db:seed --force

echo ""
echo "Setup complete."
echo "Start the app with: php artisan serve --host=0.0.0.0 --port=8000"
echo "Login: alice@example.com / password"
