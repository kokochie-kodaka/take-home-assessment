#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."

# Codespaces 再起動時に DB が空なら再作成する
if [ ! -s database/database.sqlite ]; then
  touch database/database.sqlite
  php artisan migrate --force
  php artisan db:seed --force
fi
