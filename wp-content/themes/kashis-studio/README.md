# カシスタジオ WordPress テーマ

カシスタジオ（レンタルスタジオ）専用のWordPressテーマです。Twenty Twenty-Fourをベースに、**Atlassian Design System**準拠のデザインで、ブロックエディター完全対応で構築されています。

**Version:** 1.0.6 | **CI/CD:** GitHub Actions + InfinityFree | **Design:** Atlassian Design System

## 📋 目次

- [概要](#概要)
- [必要要件](#必要要件)
- [インストール方法](#インストール方法)
- [初期設定](#初期設定)
- [機能](#機能)
- [プラグイン](#プラグイン)
- [カスタマイズ方法](#カスタマイズ方法)
- [開発者向け情報](#開発者向け情報)
- [サポート](#サポート)

---

## 概要

このテーマは、レンタルスタジオ向けに特化した機能を持つWordPressテーマです。

### 特徴
- ✅ **Atlassian Design System準拠** - エンタープライズグレードのデザインシステム
- ✅ **ブロックエディター完全対応** - WordPress Full Site Editing (FSE)
- ✅ **モジュール化されたコード** - 保守性の高いコード構造（functions.php: 1,108行 → 89行）
- ✅ **レスポンシブデザイン** - モバイル・タブレット・デスクトップ対応
- ✅ **カスタム投稿タイプ「スタジオルーム」** - スタジオ情報管理
- ✅ **Advanced Custom Fields (ACF) 対応** - 直感的なフィールド管理
- ✅ **STORES予約システム連携準備済み** - 予約システムの埋め込み対応
- ✅ **管理画面から簡単に編集可能** - 非エンジニア向けヘルプページ完備

### デザインシステム
- **カラーパレット:** Atlassian Neutral（19色）+ Blue（8色）+ Green/Red/Yellow
- **タイポグラフィ:** 11px～35px（8段階）
- **スペーシング:** 4px基準（4px～48px、9段階）
- **角丸:** 3px（Atlassian標準）
- **プライマリカラー:** Blue 500 (#0052CC)
- **CTAカラー:** Green 400 (#36B37E)

---

## 必要要件

- WordPress 6.4以上
- PHP 7.2以上
- Twenty Twenty-Four親テーマ

---

## インストール方法

### 1. テーマのインストール

```bash
# wp-content/themesディレクトリに配置されていることを確認
cd wp-content/themes/
ls -la kashis-studio/
```

### 2. 管理画面からテーマを有効化

1. WordPressの管理画面にログイン
2. 「外観」→「テーマ」
3. 「カシスタジオ」テーマを有効化

---

## 初期設定

### 1. 必須プラグインのインストール

以下のプラグインをインストール・有効化してください：

#### 必須プラグイン
1. **Advanced Custom Fields (ACF) Pro**
   - スタジオ情報のカスタムフィールド管理
   - インストール後、自動的にフィールドが読み込まれます（`acf-json/`ディレクトリ）

2. **Contact Form 7** または **WPForms**
   - お問い合わせフォーム用

3. **Wordfence Security**
   - セキュリティ対策

#### 推奨プラグイン
- **Kadence Blocks** または **Spectra**
  - ブロック機能の拡張

### 2. スタジオ設定の入力

管理画面に「スタジオ設定」メニューが追加されています。

1. 管理画面 → 「スタジオ設定」
2. 以下の情報を入力：
   - 電話番号
   - メールアドレス
   - 住所
   - 営業時間
   - アクセス情報
   - STORES予約埋め込みコード

### 3. ナビゲーションメニューの設定

1. 「外観」→「メニュー」
2. 新しいメニューを作成
3. 以下のページをメニューに追加：
   - ホーム
   - スタジオ紹介
   - 料金システム
   - ご利用方法
   - アクセス
   - お問い合わせ
4. メニューの位置を「プライマリメニュー」に設定

### 4. 固定ページの作成

以下の固定ページを作成してください：

#### トップページ
- ページタイトル: `ホーム`
- テンプレート: `フロントページ`
- 「設定」→「表示設定」で「ホームページの表示」を「固定ページ」に設定
- ブロックパターンを使って各セクションを配置

#### 料金システムページ
- ページタイトル: `料金システム`
- テンプレート: `page-pricing.html`
- スラッグ: `pricing`

#### アクセスページ
- ページタイトル: `アクセス`
- テンプレート: `page-access.html`
- スラッグ: `access`
- **重要**: Google Maps埋め込みコードを追加してください

#### その他の固定ページ
- お問い合わせ (Contact Form 7のショートコードを挿入)
- ご利用方法 (利用規約、注意事項など)

### 5. スタジオルームの登録

1. 管理画面 → 「スタジオルーム」→「新規追加」
2. スタジオ情報を入力：
   - タイトル: スタジオ名
   - 本文: スタジオの詳細説明
   - アイキャッチ画像: メイン写真
   - カスタムフィールド:
     - ギャラリー: 複数の写真
     - 広さ: 例「30㎡」
     - 収容人数: 例「15名」
     - 基本料金: 例「2500」
     - 設備リスト: チェックボックスで選択

### 6. STORES予約の設定

#### 埋め込み方法
1. STORES予約でアカウントを作成
2. 埋め込みコードを取得
3. 管理画面 → 「スタジオ設定」
4. 「STORES予約埋め込みコード」にコードを貼り付け
5. 保存

#### 予約ページの作成
- ページタイトル: `予約`
- スラッグ: `reservation`
- ショートコード `[reservation_embed]` を挿入

---

## 機能

### カスタム投稿タイプ

#### スタジオルーム (studio_room)
レンタルスタジオの各ルーム情報を管理

**カスタムフィールド (ACF)**
- ギャラリー: 複数画像アップロード
- 広さ: テキスト (例: 30㎡、15坪)
- 収容人数: 数値
- 基本料金: 数値 (1時間あたり)
- フロア: テキスト (例: 4F)
- スタジオの特徴: WYSIWYGエディタ
- 設備リスト: チェックボックス
- 利用上の注意事項: テキストエリア
- 表示順序: 数値

**カスタムタクソノミー**
- 利用用途 (studio_usage): ダンス、ヨガ、音楽練習など
- 設備 (studio_equipment): 鏡、音響、Wi-Fiなど

### ブロックパターン

「カシスタジオ」カテゴリーに7つのパターンを用意：

1. **ヒーローセクション** - Blue-500オーバーレイ、Green-400 CTAボタン
2. **スタジオの特徴** - 3カラムのFeatureグリッド
3. **スタジオルームカード** - Neutral-0カード、3px角丸
4. **料金表** - is-style-stripesテーブル
5. **FAQ（よくある質問）** - アコーディオン形式
6. **CTA（予約促進）セクション** - Blue-500カバー
7. **アクセス情報** - 2カラムレイアウト、地図プレースホルダー

### ショートコード

#### [reservation_embed]
STORES予約システムの埋め込みエリアを表示

```
[reservation_embed height="600px"]
```

### カスタム設定ページ

管理画面の「スタジオ設定」から以下を管理：
- STORES予約埋め込みコード
- 電話番号
- メールアドレス
- 住所
- 営業時間
- アクセス情報

### テンプレート

#### 主要テンプレート（全てAtlassian Design System準拠）
- `front-page.html` - トップページ
- `home.html` - ホームページ（front-page.htmlと統一）
- `single-studio_room.html` - スタジオルーム詳細
- `page-pricing.html` - 料金表ページ
- `page-access.html` - アクセスページ
- `index.html` - ブログ一覧（お知らせ）

#### テンプレートパーツ
- `parts/header.html` - ヘッダー（Neutral-0背景、Blue-500タイトル）
- `parts/footer.html` - フッター（Neutral-900背景、Blue-50見出し）

---

## プラグイン

### 必須
1. **Advanced Custom Fields Pro**
   - カスタムフィールド管理
   - ブロックエディター統合

### 推奨
1. **Contact Form 7** / **WPForms**
   - お問い合わせフォーム

2. **Kadence Blocks** / **Spectra**
   - ブロック機能拡張

3. **Wordfence Security**
   - セキュリティ対策

### 使用しないプラグイン
- ❌ Yoast SEO / All in One SEO (干渉リスクのため)
- ❌ バックアッププラグイン (後で個別対応)

---

## カスタマイズ方法

### デザインのカスタマイズ

#### カラーの変更
`style.css`の`:root`セクションで変更：

```css
:root {
  /* Atlassian Design System準拠のカラー変数 */
  --atlassian-blue-500: #0052CC;      /* プライマリカラー */
  --atlassian-green-400: #36B37E;     /* CTAカラー */
  --atlassian-neutral-900: #091E42;   /* テキスト */
  --atlassian-neutral-0: #FFFFFF;     /* 背景 */
}
```

#### フォントの変更
`theme.json`で設定を変更

### Google Maps の埋め込み

1. [Google Maps](https://www.google.com/maps)で店舗を検索
2. 「共有」→「地図を埋め込む」
3. iframeコードをコピー
4. アクセスページを編集
5. HTMLブロックを追加してコードを貼り付け

### ロゴの設定

1. 「外観」→「カスタマイズ」→「サイト基本情報」
2. 「サイトアイコン」と「ロゴ」をアップロード

### アイキャッチ画像のサイズ

テーマで定義されている画像サイズ：
- `studio-thumbnail`: 800×600px (スタジオ一覧用)
- `studio-hero`: 1920×800px (ヒーローセクション用)

画像をアップロード後、以下のコマンドで再生成：
```bash
wp media regenerate --yes
```

---

## 開発者向け情報

### テーマ構造（モジュール化）

**functions.phpの構成:**
```
functions.php (89行) - メインファイル
  ├─ includes/setup.php (93行) - テーマセットアップ・スタイル読み込み
  ├─ includes/post-types.php (39行) - カスタム投稿タイプ
  ├─ includes/taxonomies.php (53行) - カスタムタクソノミー
  ├─ includes/widgets.php (56行) - ウィジェットエリア
  ├─ includes/acf.php (21行) - ACF設定
  ├─ includes/shortcodes.php (54行) - ショートコード
  ├─ includes/block-patterns.php (30行) - ブロックパターン
  └─ includes/admin.php (872行) - 管理画面・設定・ヘルプ
```

**改善実績:**
- functions.php: 1,108行 → 89行（92%削減）
- モジュール化により保守性が大幅に向上
- 機能ごとにファイル分割され、編集が容易

### コーディング規約

- **Atlassian Design System準拠:** 全てのカラー・スペーシング・タイポグラフィ
- **ブロックエディター:** WordPressコアブロックのみ使用
- **CSS変数:** `--atlassian-*`形式で統一
- **スペーシング:** 4px基準（4, 8, 12, 16, 20, 24, 32, 40, 48px）
- **角丸:** 3px統一
- **フォントサイズ:** theme.jsonで定義（11, 12, 14, 16, 20, 24, 29, 35px）

### ファイル構造

```
kashis-studio/
├── style.css                  # メインスタイルシート (Atlassian CSS変数)
├── functions.php              # テーマ機能（モジュール読み込み）
├── theme.json                 # ブロックテーマ設定 (Atlassianカラーパレット)
├── README.md                  # このファイル
├── includes/                  # モジュール化されたコード
│   ├── setup.php
│   ├── post-types.php
│   ├── taxonomies.php
│   ├── widgets.php
│   ├── acf.php
│   ├── shortcodes.php
│   ├── block-patterns.php
│   └── admin.php
├── acf-json/                  # ACFフィールド定義
│   └── group_studio_room_details.json
├── templates/                 # ページテンプレート（全てAtlassian準拠）
│   ├── index.html
│   ├── front-page.html
│   ├── home.html
│   ├── single-studio_room.html
│   ├── page-pricing.html
│   └── page-access.html
├── parts/                     # テンプレートパーツ
│   ├── header.html
│   └── footer.html
├── patterns/                  # ブロックパターン（全7個）
│   ├── hero-section.php
│   ├── features-grid.php
│   ├── studio-room-cards.php
│   ├── pricing-table.php
│   ├── faq-section.php
│   ├── cta-section.php
│   └── access-info.php
└── assets/
    └── js/
        └── theme.js           # テーマJavaScript (Atlassian変数使用)
```

---

## ページ構成

```
トップページ (front-page.html / home.html)
├─ ヒーローセクション (Blue-500オーバーレイ)
├─ スタジオの特徴 (3カラム、Neutral-0カード)
├─ スタジオ紹介
├─ 利用用途
├─ お知らせ
└─ CTA (予約、Green-400ボタン)

料金システム (page-pricing.html)
├─ 基本料金表 (is-style-stripes)
├─ パック料金
├─ オプション・機材レンタル
├─ お支払い方法 (2カラムカード)
└─ キャンセルポリシー

アクセス (page-access.html)
├─ 店舗情報 (Blue-500左ボーダー)
├─ アクセス方法
├─ 地図 (Google Maps埋め込み)
└─ 建物への入り方

スタジオルーム詳細 (single-studio_room.html)
├─ スタジオ名 (Blue-500、35px)
├─ メイン画像 (3px角丸)
├─ 説明文
├─ スタジオ情報 (ACFフィールド)
└─ 予約ボタン (Green-400)

ブログ一覧 (index.html)
├─ アーカイブタイトル (35px)
├─ 投稿カード (Neutral-0、3px角丸)
└─ ページネーション (Neutral-10)
```

---

## よくある質問 (FAQ)

### Q1. ACFフィールドが表示されません
**A:** ACFプラグインがインストール・有効化されているか確認してください。テーマ内の`acf-json`フォルダにフィールド定義が保存されています。

### Q2. スタジオルームの投稿タイプが表示されません
**A:** テーマを有効化後、「設定」→「パーマリンク設定」で「変更を保存」をクリックしてください。これでカスタム投稿タイプのURLが有効になります。

### Q3. 料金表を編集したい
**A:** 「ページ」→「料金システム」を開き、テーブルブロックを編集してください。行や列の追加も可能です。

### Q4. Google Mapsが表示されない
**A:** アクセスページのHTMLブロックにGoogle Mapsの埋め込みコードを貼り付けてください。詳細は「カスタマイズ方法」セクションを参照。

### Q5. STORES予約を別のシステムに変更したい
**A:** 「スタジオ設定」で埋め込みコードを変更するか、予約ページのショートコードを別のシステムに置き換えてください。

### Q6. ブロックパターンはどこから使えますか？
**A:** ページ編集画面で「+」ボタン → 「パターン」タブ → 「カシスタジオ」カテゴリーから利用できます。

### Q7. 管理画面の使い方がわかりません
**A:** 管理画面左メニュー「エディターの使い方」または管理バー上部の「📘 編集ガイド」をクリックしてください。

---

## トラブルシューティング

### スタイルが反映されない
1. ブラウザのキャッシュをクリア
2. WordPressのキャッシュプラグインがある場合はクリア
3. 「外観」→「カスタマイズ」で変更を保存

### テンプレートが選択できない
1. テーマが正しく有効化されているか確認
2. 親テーマ (Twenty Twenty-Four) がインストールされているか確認

### カスタムフィールドのデータが消えた
ACFの設定は`/wp-content/themes/kashis-studio/acf-json/`に保存されています。このディレクトリを削除しないでください。

### 旧カラークラス（primary, secondaryなど）が表示される
このテーマは完全にAtlassian Design System準拠です。旧カラークラスは使用していません。もし表示される場合は、キャッシュをクリアしてください。

---

## 更新履歴

### Version 1.0.6 (2025-11-12)
- **中優先度の整理完了**
  - theme.jsのAtlassian変数統一
  - single-studio_room.htmlとfooter.htmlの完全Atlassian準拠化
  - 空の`assets/css/`ディレクトリ削除

### Version 1.0.5 (2025-11-11)
- **高優先度のリファクタリング完了**
  - page-access.htmlとpage-pricing.htmlをAtlassian準拠に更新
  - functions.phpのモジュール化（1,108行 → 89行、92%削減）
  - includes/ディレクトリに8つのモジュール作成
  - home.htmlとfront-page.htmlの統一

### Version 1.0.4 (2025-11-11)
- 全7つのブロックパターンをAtlassian Design Systemに更新
- コード削減: 465行追加、628行削除（163行削減）

### Version 1.0.3 (2025-11-11)
- Atlassian Design System準拠のデザインに全面刷新
- theme.json完全書き換え（590行）
- front-page.htmlとstyle.cssをAtlassian準拠に更新
- ブロック破損の修正

### Version 1.0.2 (2025-11-11)
- TOPページ管理場所の明確化
- 編集ガイドの追加

### Version 1.0.0 (2025-11-11)
- 初回リリース
- Twenty Twenty-Four子テーマとして作成
- カスタム投稿タイプ「スタジオルーム」追加
- ACFカスタムフィールド実装
- 主要ページテンプレート作成
- STORES予約システム連携準備

---

## サポート

### 連絡先
質問や問題がある場合は、WordPress管理者に連絡してください。

### ヘルプページ
- 管理画面: 「エディターの使い方」
- 管理バー: 「📘 編集ガイド」

### 参考リンク
- [WordPress Codex](https://wpdocs.osdn.jp/)
- [Twenty Twenty-Four ドキュメント](https://wordpress.org/themes/twentytwentyfour/)
- [Advanced Custom Fields](https://www.advancedcustomfields.com/resources/)
- [STORES 予約](https://stores.jp/reserve)
- [Atlassian Design System](https://atlassian.design/)

---

## ライセンス

GPL v2 or later

---

## クレジット

- ベーステーマ: Twenty Twenty-Four by WordPress.org
- デザインシステム: Atlassian Design System
- カスタマイズ: カシスタジオ開発チーム
- 参考デザイン: ノアスタジオ (https://www.noahstudio.jp/)
