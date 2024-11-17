# kintai

#アプリケーション名

勤怠管理システム「Atte（アット）」

![alt 打刻ページ/ホーム](<スクリーンショット 2024-11-16 22.24.19.png>)

#作成目的

社員の勤怠管理のために導入し、人事評価に活用する
(使用イメージを出すため社員のダミーデータを入れています)

#アプリケーション URL

http://localhost:8000

#他のリポジトリ

特になし

#機能一覧

・会員登録機能
・メール認証機能
・ログイン機能
・ログアウト機能

・勤務開始打刻機能
・勤務終了打刻機能
・休憩開始打刻機能
・休憩終了打刻機能

・日付別勤怠情報取得機能
・ユーザー別勤怠情報取得機能
・ユーザー一覧閲覧機能

・ページネーション機能

#使用技術（実行環境）

・フレームワーク: Laravel 8.83.27

・開発言語: PHP 7.4.9

・バージョン管理: GitHub

・OS: mac

#テーブル設計

![alt テーブル設計](<スクリーンショット 2024-11-16 21.33.14.png>)

#ER 図

![alt ER図](<スクリーンショット 2024-09-20 21.30.56.png>)

#環境構築

1.まず、下記の SSH からリポジトリをクローンしてください。

git@github.com:ganbarinoryo/kintai.git

2.必要に応じて、以下のコマンドを実行してください。（.env.example ファイルをコピーして.env ファイルを作成するコマンド）

cp .env.example .env

3.作成した.env ファイルのデータベースの設定を下記のように編集してください。

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp
MAIL_HOST=host.docker.internal
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=neko0987@example.com
MAIL_FROM_NAME="${APP_NAME}"

4.下記コマンドで docker コンテナをビルド、起動してください。

docker-compose up -d --build

5.Docker コンテナ内で、下記コマンドを実行しコンポーザーのインストールを行います。

docker-compose exec app composer install
docker-compose exec app npm install
docker-compose exec app npm run dev

6.下記コマンドでデータベースのマイグレーションを行います。

docker-compose exec app php artisan migrate

7.下記 URL からブラウザにアクセスしてアプリケーションを確認します。

http://localhost

#テストユーザー

・山田太郎

email : yamada@gmail.com

password : yamadatarou
