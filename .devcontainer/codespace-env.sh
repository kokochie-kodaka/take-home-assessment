#!/usr/bin/env bash
# Codespaces 用 APP_URL の生成と .env への反映

set -euo pipefail

codespace_app_url() {
  if [ -z "${CODESPACES:-}" ] || [ -z "${CODESPACE_NAME:-}" ]; then
    return 1
  fi
  local domain="${GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN:-app.github.dev}"
  echo "https://${CODESPACE_NAME}-8000.${domain}"
}

sync_app_url_to_env() {
  local env_file="${1:-.env}"
  local url
  url="$(codespace_app_url)" || return 1

  if grep -q '^APP_URL=' "$env_file"; then
    sed -i "s|^APP_URL=.*|APP_URL=${url}|" "$env_file"
  else
    echo "APP_URL=${url}" >> "$env_file"
  fi

  echo "$url"
}
