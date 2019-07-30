# reserbath

## 動作環境
- PHP: 7.2.12
- MySQL: 5.7.12
- Node.js: 8.15.0
- Nginx: 1.15.6

## 開発環境構築
開発環境はDockerにて構築する。以下はMacで`Docker for Mac`をインストール済みのものとしてすすめる。

### 1. Gitリポジトリをクローン
- ディレクトリ構成例： docker/repos/reserbath)
- 以降は (クローン先ディレクトリ)/reserbath 配下で設定を進める。
### 2. 環境ファイル .envを作成
- .env.exampleをコピーして.envを作成する。
### 3. ComposerでPHPのパッケージをインストール
- `composer install`
  - composer.jsonに記述されたパッケージがインストールされる
  - composer.lockがある場合は、lockファイルに指定されたバージョンでインストールされる
### 4. アプリケーションキーを設定
- `php artisan key:generate`
  - .envファイルにあるAPP_KEYにランダムな文字列を入れ、セッションやデータをセキュアにする。
### 5. ホストファイルに名前解決の設定追加
- ホストPC(ここではMac)の`/etc/hosts`に以下の設定を追加。
  - viなどで編集する。

```
127.0.0.1 www.reserbath-local.jp
```

### 6. Dockerで定義したイメージを構築
- `docker-compose build`
  - 各種Dockerfile、及びdocker-compose.ymlに定義された内容でイメージを構築する。
    - PHP, MySQL, Nginx, Node.js, Redisが起動する。
### 7. Docker コンテナの起動
- `docker-compose up`
  - 各種サービスのコンテナを起動する。
