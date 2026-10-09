# 採用担当者向けメモ（候補者に渡さないこと）

## 意図的に入れた問題

| ID | 内容 | 主な場所 |
|----|------|----------|
| BUG-1 | バリデーション不足 | `InvitationController::store` / `update` |
| BUG-2 | N+1（eager load なし） | `InvitationController::index` + `invitations/index.blade.php` |
| BUG-3 | 所有者チェックなし | `InvitationController::update` / `destroy`（`edit` も同様に直せるか見るとよい） |

## 再現手順（確認用）

1. **BUG-1**: タイトル空・`guest_email=not-an-email` で作成 → 保存されてしまう
2. **BUG-2**: Alice で一覧表示。`DB::getQueryLog()` や Debugbar、ログでクエリ数が招待状件数に比例して増える
3. **BUG-3**: Alice ログイン中に Bob の招待状 ID（seed 後は概ね 13〜15）へ  
   `/invitations/13/edit` で更新・削除できてしまう

## 評価ルーブリック（20点）

1. 切り分け・原因特定（0〜5）
2. 修正方針の妥当性（0〜5）
3. Laravel/PHP の基礎感覚（0〜5）
4. 説明・不明点の開示・自走感（0〜5）

目安: 14+ 通過寄り / 10〜13 面談深掘り / 9以下 リスク高

## 合格ラインの目安

- バリデーションで `title` required、`guest_email` email、`status` in:draft,published など
- `with('guestComments')` 等で N+1 解消
- `abort_unless($invitation->user_id === Auth::id(), 403)` や Policy で認可

Policy 化や Form Request 分離は加点。完璧さより考え方を重視。
