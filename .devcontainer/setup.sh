#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."
# shellcheck source=codespace-env.sh
source "$(dirname "$0")/codespace-env.sh"

if [ -z "${CODESPACES:-}" ]; then
  echo "ERROR: この課題は GitHub Codespaces 上でのみ起動する想定です。" >&2
  exit 1
fi

if [ ! -f .env ]; then
  cp .env.example .env
fi

APP_URL="$(sync_app_url_to_env .env)"

composer install --no-interaction

if ! grep -q '^APP_KEY=base64:' .env; then
  php artisan key:generate --force
fi

mkdir -p database
touch database/database.sqlite

php artisan migrate --force
php artisan db:seed --force
php artisan config:clear

echo ""
echo "Setup complete."
echo "App URL: ${APP_URL}"
echo "Open Ports tab → 8000 → Open in Browser (do not use localhost)."
echo "Login: alice@example.com / password"
