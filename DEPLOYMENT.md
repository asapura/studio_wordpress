# InfinityFree デプロイメントガイド

カシスタジオWordPressサイトをInfinityFreeにデプロイし、GitHub Actionsで自動デプロイを設定する手順です。

## 📋 前提条件

- ✅ InfinityFreeアカウントを作成済み
- ✅ GitHubリポジトリ（このリポジトリ）
- ✅ FTP情報とMySQL情報を取得済み

---

## 🚀 初回セットアップ

### Step 1: InfinityFreeでMySQLデータベースを作成

1. Vista Panel → **MySQL Databases**
2. 「Create Database」をクリック
3. データベース名を入力（例：kashis_wp）
4. 作成されたデータベース情報をメモ：
   - Database Name
   - Database Username
   - Database Password
   - MySQL Hostname

### Step 2: wp-config.phpを作成

InfinityFreeのファイルマネージャーまたはFTPクライアントで、`htdocs/wp-config.php`を作成します。

**重要**: このファイルはGitにコミットしません（セキュリティのため）

```php
<?php
/**
 * WordPress の設定
 */

// ** MySQL 設定 ** //
define( 'DB_NAME', 'epiz_xxxxx_kashis' );     // データベース名
define( 'DB_USER', 'epiz_xxxxx' );            // MySQLユーザー名
define( 'DB_PASSWORD', 'your_password' );      // MySQLパスワード
define( 'DB_HOST', 'sql123.epizy.com' );      // MySQLホスト名
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// ** 認証用ユニークキー ** //
// https://api.wordpress.org/secret-key/1.1/salt/ から取得してください
define('AUTH_KEY',         'ここに生成されたキーを貼り付け');
define('SECURE_AUTH_KEY',  'ここに生成されたキーを貼り付け');
define('LOGGED_IN_KEY',    'ここに生成されたキーを貼り付け');
define('NONCE_KEY',        'ここに生成されたキーを貼り付け');
define('AUTH_SALT',        'ここに生成されたキーを貼り付け');
define('SECURE_AUTH_SALT', 'ここに生成されたキーを貼り付け');
define('LOGGED_IN_SALT',   'ここに生成されたキーを貼り付け');
define('NONCE_SALT',       'ここに生成されたキーを貼り付け');

// ** WordPressデータベーステーブルの接頭辞 ** //
$table_prefix = 'wp_';

// ** デバッグモード ** //
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
```

### Step 3: GitHubシークレットを設定

1. GitHubリポジトリ → **Settings** → **Secrets and variables** → **Actions**
2. 「New repository secret」をクリック
3. 以下の3つのシークレットを追加：

| Name | Value | 説明 |
|------|-------|------|
| `FTP_SERVER` | `ftpupload.net` | FTPホスト名 |
| `FTP_USERNAME` | `epiz_xxxxx` | FTPユーザー名 |
| `FTP_PASSWORD` | `your_ftp_password` | FTPパスワード |

**重要**: パスワードは絶対にGitにコミットしないでください！

### Step 4: 初回手動デプロイ（WordPress本体）

GitHub Actionsは**テーマファイルのみ**を自動デプロイします。WordPress本体は初回のみ手動でアップロードしてください。

#### 方法1: InfinityFree Softaculousを使用（推奨）

1. Vista Panel → **Softaculous Apps Installer**
2. **WordPress**を選択
3. 「Install」をクリック
4. インストール設定：
   - Choose Installation URL: あなたのドメイン
   - Site Name: カシスタジオ
   - Admin Username: admin（推奨）
   - Admin Password: 強力なパスワード
   - Admin Email: あなたのメールアドレス
5. 「Install」をクリック

#### 方法2: FTPで手動アップロード

1. FTPクライアント（FileZillaなど）でInfinityFreeに接続
2. このリポジトリの全ファイルを`htdocs/`にアップロード
   - ただし、`.git/`フォルダーは除外
3. `wp-config.php`を上記の内容で作成

---

## 🔄 自動デプロイの仕組み

### デプロイトリガー

以下のブランチにpushすると自動デプロイが実行されます：
- `main`
- `claude/modify-wordpress-snow-file-011CV1HwHCs3gEsfys7JMgKt`

### デプロイ内容

GitHub Actionsは以下をデプロイします：
- `wp-content/themes/kashis-studio/` ディレクトリの全ファイル

### デプロイフロー

```mermaid
graph LR
    A[コード変更] --> B[GitHub push]
    B --> C[GitHub Actions起動]
    C --> D[FTPでテーマをアップロード]
    D --> E[InfinityFreeサーバー]
    E --> F[サイト更新完了]
```

---

## 🧪 デプロイのテスト

### 1. テーマファイルを変更

例：`style.css`のバージョンを更新

```css
/*
Theme Name: Kashis Studio
Version: 1.0.1
*/
```

### 2. GitHubにpush

```bash
git add wp-content/themes/kashis-studio/style.css
git commit -m "Update theme version"
git push origin main
```

### 3. GitHub Actionsを確認

1. GitHubリポジトリ → **Actions**タブ
2. 最新のワークフロー実行を確認
3. ✅ 緑のチェックマークが表示されれば成功

### 4. サイトを確認

InfinityFreeのURLにアクセスして、変更が反映されているか確認

---

## 📝 WordPress初回セットアップ（Softaculousを使った場合）

### 1. WordPress管理画面にログイン

```
https://yoursite.epizy.com/wp-admin/
```

### 2. テーマを有効化

1. 外観 → テーマ
2. 「カシスタジオ」を有効化

### 3. ダミーデータを作成

1. 管理画面 → スタジオ設定 → ダミーデータ作成
2. 「ダミーデータを作成」をクリック

### 4. 表示設定

1. 設定 → 表示設定
2. ホームページの表示: 固定ページ
3. ホームページ: 「ホーム」を選択
4. 変更を保存

### 5. パーマリンク設定

1. 設定 → パーマリンク設定
2. 「投稿名」を選択（推奨）
3. 変更を保存

### 6. プラグインをインストール

以下のプラグインをインストール・有効化：
- Advanced Custom Fields Pro（ACF）
- Contact Form 7
- Wordfence Security

---

## ⚠️ 注意事項

### セキュリティ

- ❌ `wp-config.php`をGitにコミットしない
- ❌ FTPパスワードをコードに含めない
- ✅ GitHubシークレットを使用する
- ✅ 強力なパスワードを使用する

### InfinityFree制限

- ファイルサイズ制限: 10MB/ファイル
- ディスク容量: 5GB
- 帯域幅: 無制限
- iノード: 30,000ファイル
- Cron無効（wp-cronは外部トリガーが必要）

### バックアップ

定期的にバックアップを取ってください：
1. Vista Panel → **Backups**
2. 「Download Backup」

---

## 🐛 トラブルシューティング

### デプロイが失敗する

**原因**: FTP接続エラー
**解決策**:
1. GitHubシークレットの値を確認
2. InfinityFreeのFTP情報が正しいか確認
3. FTPパスワードをリセットして再設定

### サイトが表示されない

**原因**: WordPressがインストールされていない
**解決策**: Softaculousで WordPress をインストール

### テーマが反映されない

**原因**: テーマが有効化されていない
**解決策**:
1. WordPress管理画面 → 外観 → テーマ
2. カシスタジオを有効化

### データベース接続エラー

**原因**: wp-config.phpの設定が間違っている
**解決策**:
1. InfinityFreeでMySQL情報を再確認
2. wp-config.phpの設定を修正

---

## 📞 サポート

問題が解決しない場合：
1. GitHub Actionsのログを確認
2. InfinityFreeのエラーログを確認（Vista Panel → Error Log）
3. WordPressのデバッグモードを有効化

---

## 🎉 完了！

これでGitHubにpushするたびに、InfinityFreeに自動デプロイされます！

次のステップ：
1. 実際のコンテンツを追加
2. 画像をアップロード
3. Google Mapsを埋め込み
4. STORES予約を設定
5. ドメインを設定（独自ドメインを使う場合）
