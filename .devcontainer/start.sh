#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."
# shellcheck source=codespace-env.sh
source "$(dirname "$0")/codespace-env.sh"

if [ -z "${CODESPACES:-}" ]; then
  exit 0
fi

if [ -f .env ]; then
  APP_URL="$(sync_app_url_to_env .env)"
  php artisan config:clear
fi

if [ ! -s database/database.sqlite ]; then
  touch database/database.sqlite
  php artisan migrate --force
  php artisan db:seed --force
fi

if ! pgrep -f "artisan serve" >/dev/null 2>&1; then
  XDEBUG_MODE=off nohup php artisan serve --host=0.0.0.0 --port=8000 \
    > /tmp/laravel-serve.log 2>&1 &
fi

if [ -n "${APP_URL:-}" ]; then
  echo "Laravel: ${APP_URL} (Ports → 8000 → Open in Browser)"
fi
