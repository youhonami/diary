# diary

Laravel 11 と Docker で作成している日記アプリです。

## 使用技術

- PHP 8.2
- Laravel 11
- MySQL 8.0
- Nginx
- phpMyAdmin
- Docker Compose

## Docker 構成

| サービス | 内容 | URL / ポート |
| --- | --- | --- |
| nginx | Web サーバー | http://localhost |
| php | Laravel 実行環境 | 9000 |
| mysql | データベース | 3306 |
| phpmyadmin | DB 管理画面 | http://localhost:8080 |

## 現在実装済みの機能

- ログイン画面
- 新規会員登録画面
- ログイン処理
- 会員登録処理
- ログイン後のトップページ表示

## 画面・ルート

| URL | メソッド | 内容 |
| --- | --- | --- |
| `/` | GET | ログインページ |
| `/login` | POST | ログイン処理 |
| `/register` | GET | 新規会員登録ページ |
| `/register` | POST | 新規会員登録処理 |
| `/toppage` | GET | ログイン後トップページ |

## ログイン仕様

- メールアドレスが必須
- パスワードが必須
- パスワードは6文字以上
- ログイン成功後は `/toppage` に遷移

## 新規会員登録仕様

- 名前が必須
- メールアドレスが必須
- メールアドレスは重複不可
- パスワードが必須
- パスワードは6文字以上
- 確認用パスワードと一致している必要あり
- 登録成功後は自動ログインして `/toppage` に遷移

## 初期ユーザー

Seeder で以下のユーザーを作成できます。

| メールアドレス | パスワード |
| --- | --- |
| test1@example.com | password |
| test2@example.com | password |
| test3@example.com | password |

## 環境構築手順

コンテナを起動します。

```bash
docker compose up -d --build
```

PHP コンテナ内で Composer の依存関係をインストールします。

```bash
docker compose exec php composer install
```

`.env` がない場合は作成します。

```bash
docker compose exec php cp .env.example .env
```

アプリケーションキーを生成します。

```bash
docker compose exec php php artisan key:generate
```

マイグレーションと Seeder を実行します。

```bash
docker compose exec php php artisan migrate --seed
```

## データベース設定

`.env` のDB設定は以下です。

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

## 主なファイル

- `src/routes/web.php`
- `src/app/Http/Controllers/LoginController.php`
- `src/resources/views/index.php`
- `src/resources/views/register.php`
- `src/resources/views/toppage.php`
- `src/database/seeders/UserSeeder.php`

## 今後作成予定

- トップページの内容作成
- 日記機能
- ログアウト機能
