# 招待状下書き管理アプリ（採用技術課題）

Laravel 10 + SQLite の小さな Web アプリです。  
**GitHub Codespaces** でブラウザだけで起動・修正できるようにしてあります。

課題内容は [`CHALLENGE.md`](./CHALLENGE.md) を読んでください。

---

## 方法A: GitHub Codespaces（推奨）

1. GitHub でこのリポジトリを開く
2. **Code → Codespaces → Create codespace on main**
3. 初回は `postCreateCommand` で `composer install` / migrate / seed が走ります（数分）
4. ターミナルで起動:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

5. Ports タブの **8000** をブラウザで開く
6. `alice@example.com` / `password` でログイン

作業が終わったら Codespace を **Stop**（不要なら Delete）してください。個人アカウントの無料枠を節約できます。

---

## 方法B: ローカル

要件: PHP 8.1+、Composer、SQLite 拡張

```bash
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

http://localhost:8000 を開いてください。

---

## テスト用アカウント

- `alice@example.com` / `password`
- `bob@example.com` / `password`

---

## 提出

- 修正差分（PR 推奨）
- `REPORT.md`（原因・切り分け・修正理由）

詳細は `CHALLENGE.md` を参照してください。

---

## 採用担当者向け

評価の観点・想定バグは `REVIEWER.md` を参照してください。  
**候補者にリポジトリを共有する前に `REVIEWER.md` を削除するか、別管理にしてください。**
