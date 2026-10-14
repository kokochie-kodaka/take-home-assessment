# 招待状下書き管理アプリ（採用技術課題）

Laravel 10 + SQLite の小さな Web アプリです。  
**GitHub Codespaces** でブラウザだけで起動・修正できます。

課題内容は [`CHALLENGE.md`](./CHALLENGE.md) を読んでください。

---

## 作業の進め方（概要）

1. 本家リポジトリを **Fork**（自分のアカウントにコピー）
2. Fork 上で作業ブランチを作成（例: **`test`**）
3. **自分の Fork** から Codespaces を起動して課題を修正
4. 作業ブランチを push し、本家 `main` 向けの **Pull Request** を作成
5. **PR の URL** を採用担当に連絡

手順の詳細は [`CHALLENGE.md` の「提出方法」](./CHALLENGE.md#提出方法) を参照してください。

---

## 起動手順（GitHub Codespaces）

1. **自分が Fork したリポジトリ** を GitHub で開く
2. 作業ブランチ（例: `test`）に切り替えたうえで、**Code → Codespaces → Create codespace on …**
3. 初回は `postCreateCommand` で `composer install` / migrate / seed が走ります（数分）
4. ターミナルでアプリを起動する:

```bash
XDEBUG_MODE=off php artisan serve --host=0.0.0.0 --port=8000
```

`Server running on [http://0.0.0.0:8000]` と表示されたら起動完了です。このターミナルは開いたままにしてください。

5. **Ports** タブ → **8000** → **Open in Browser** で開く
6. `alice@example.com` / `password` でログイン

**注意:** アドレスバーが `http://localhost:8000` になっていると動きません。必ず `https://….app.github.dev` の URL を使います。

Codespace を **Stop して再開** したあとは、手順 4 の `php artisan serve` を **もう一度実行** してください。

作業が終わったら Codespace を **Stop**（不要なら Delete）してください。個人アカウントの無料枠を節約できます。

---

## テスト用アカウント

- `alice@example.com` / `password`
- `bob@example.com` / `password`

---

## 提出

- 本家向け **Pull Request**（自分の Fork の作業ブランチ → 本家 `main`）
- PR に **`REPORT.md`** を含める
- 採用担当へ **PR の URL** を送る

詳細は [`CHALLENGE.md` の「提出方法」](./CHALLENGE.md#提出方法) を参照してください。
