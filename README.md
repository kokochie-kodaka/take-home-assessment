# 招待状下書き管理アプリ（採用技術課題）

Laravel 10 + SQLite の小さな Web アプリです。  
**GitHub Codespaces** でブラウザだけで起動・修正できます。

課題内容は [`CHALLENGE.md`](./CHALLENGE.md) を読んでください。

---

## 起動手順（GitHub Codespaces）

1. GitHub でこのリポジトリを開く
2. **Code → Codespaces → Create codespace on main**
3. 初回は `postCreateCommand` で `composer install` / migrate / seed が走ります（数分）
4. 準備が終わると **ポート 8000** が転送され、ブラウザでアプリが開きます（開かない場合は **Ports** タブ → **8000** → **Open in Browser**）
5. `alice@example.com` / `password` でログイン

`postStartCommand` で `php artisan serve` も自動起動します。Codespace を再開したあとも、しばらく待ってから Ports の URL で開いてください。

**注意:** アドレスバーが `http://localhost:8000` になっていると動きません。必ず `https://….app.github.dev` の URL を使います。

作業が終わったら Codespace を **Stop**（不要なら Delete）してください。個人アカウントの無料枠を節約できます。

---

## テスト用アカウント

- `alice@example.com` / `password`
- `bob@example.com` / `password`

---

## 提出

- 修正差分（PR 推奨）
- `REPORT.md`（原因・切り分け・修正理由）

詳細は `CHALLENGE.md` を参照してください。

