# diary

Laravel 11 と Docker で動作する日記アプリです。

## 使用技術

- PHP 8.2
- Laravel 11
- MySQL 8.0
- Nginx 1.21
- phpMyAdmin
- Docker Compose
- Google Maps（場所の地図表示・任意で Embed API キー）

## Docker 構成

| サービス | 内容 | URL / ポート |
| --- | --- | --- |
| nginx | Web サーバー | http://localhost |
| php | Laravel 実行環境（PHP-FPM） | 9000（内部） |
| mysql | データベース | 3306（内部） |
| phpmyadmin | DB 管理画面 | http://localhost:8080 |

アプリ本体のコードは `src/` 配下にあり、コンテナ内の `/var/www` にマウントされます。

## 実装済みの機能

### 認証・アカウント

- ログイン / ログアウト
- 新規会員登録
- 退会（ユーザーと日記の削除）
- パスワード表示切替（ログイン・登録・退会・ログイン情報変更）

### 日記

- 日記の作成（複数件/日可）
- カレンダーから見返す
- 日付ごとの詳細・編集・削除
- 公開日記の一覧・詳細（他ユーザーの公開分）
- 場所入力に連動した Google マップ表示（作成・詳細）

### 設定・プロフィール

- ログイン情報の変更（名前・メール・パスワード）
- プロフィール変更（ユーザーネーム・生年月日・アイコン・自己紹介など）
- トップページ背景テーマの選択（青空 / 夕焼け / 夜空 / ミント）
  - トップ・日記作成・見返す・詳細・読む の枠内デザインに反映

## 画面・ルート

| URL | メソッド | 内容 |
| --- | --- | --- |
| `/` | GET | ログインページ |
| `/login` | POST | ログイン処理 |
| `/register` | GET | 新規会員登録ページ |
| `/register` | POST | 新規会員登録処理 |
| `/withdrawal` | GET | 退会ページ |
| `/withdrawal` | POST | 退会処理 |
| `/toppage` | GET | ログイン後トップページ |
| `/diary/create` | GET | 日記を書く |
| `/diary/create` | POST | 日記保存 |
| `/diary/lookback` | GET | 日記を見返す（カレンダー） |
| `/diary/lookback/{date}` | GET | 指定日の日記詳細 |
| `/diary/{diary}/edit` | GET | 日記編集 |
| `/diary/{diary}/update` | POST | 日記更新 |
| `/diary/{diary}/delete` | POST | 日記削除 |
| `/diary/read` | GET | 公開日記一覧 |
| `/diary/read/{diary}` | GET | 公開日記詳細 |
| `/settings` | GET | 設定メニュー |
| `/settings/user` | GET / POST | ログイン情報の表示・更新 |
| `/settings/profile` | GET / POST | プロフィールの表示・更新 |
| `/settings/background` | GET / POST | 背景テーマの表示・更新 |
| `/logout` | POST | ログアウト |

## バリデーション概要

### ログイン / 退会

- メールアドレス・パスワード必須
- パスワードは6文字以上

### 新規会員登録

- 名前・メールアドレス・パスワード必須
- メールアドレスは重複不可
- パスワードは6文字以上・確認用と一致

### 日記作成・編集

- タイトル・日付・出来事が必須
- 場所・良かったことは任意

### プロフィール

- 全項目任意（入力時のみ形式・文字数などを検証）
- 電話番号は日本の電話番号形式
- アイコンは画像・2MB以下

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

ブラウザで http://localhost を開きます。

## データベース設定

`.env` の DB 設定は以下です。

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

phpMyAdmin は http://localhost:8080 から利用できます。

## 任意設定

### Google Maps API キー

地図をより安定して表示する場合は `.env` に設定します（未設定でも埋め込み表示は可能です）。

```env
GOOGLE_MAPS_API_KEY=あなたのAPIキー
```

Google Cloud Console で **Maps Embed API** を有効にしたキーを使用してください。

### アップロード上限

プロフィールアイコン用に、Nginx / PHP 側でアップロード上限を引き上げています。

- Nginx: `client_max_body_size 10M`
- PHP: `upload_max_filesize = 8M` / `post_max_size = 10M`
- アプリ側バリデーション: 画像 2MB 以下

## ディレクトリ構成（抜粋）

```text
diary/
├── docker/
│   ├── mysql/
│   ├── nginx/
│   └── php/
├── docker-compose.yml
├── README.md
└── src/                  # Laravel アプリ
    ├── app/
    ├── database/
    ├── public/
    ├── resources/views/
    └── routes/web.php
```

## 主なファイル

- `docker-compose.yml` … Docker サービス定義
- `src/routes/web.php` … ルート定義
- `src/app/Http/Controllers/LoginController.php` … 画面・更新処理
- `src/app/Models/User.php` / `Diary.php` … モデル
- `src/database/seeders/UserSeeder.php` … 初期ユーザー
- `src/resources/views/` … 各画面のビュー
- `src/public/css/` … 画面ごとの CSS
