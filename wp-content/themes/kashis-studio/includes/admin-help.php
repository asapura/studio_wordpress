<?php
/**
 * Admin Help Page
 *
 * @package Kashis_Studio
 * @since 1.0.7
 */

/**
 * Add help/usage guide page to admin menu
 *
 * Creates a submenu page under "スタジオ設定" (Studio Settings) that provides
 * comprehensive documentation for non-technical users on how to use the block
 * editor and manage website content.
 *
 * @since 1.0.7
 * @return void
 */
function kashis_studio_add_help_menu() {
    add_submenu_page(
        'kashis-studio-settings',
        'ブロックエディターの使い方',
        'エディターの使い方',
        'edit_posts',
        'kashis-studio-help',
        'kashis_studio_help_page'
    );
}
add_action('admin_menu', 'kashis_studio_add_help_menu', 11);

/**
 * Render the help page content
 *
 * Displays a comprehensive guide for using the block editor including:
 * - Page management locations
 * - Block pattern usage instructions
 * - Color and font customization
 * - Commonly used blocks
 * - TOP page editing methods
 * - Tips and best practices
 * - Links to official WordPress documentation
 *
 * Designed for non-technical users to easily understand how to manage the site.
 *
 * @since 1.0.7
 * @return void
 */
function kashis_studio_help_page() {
    ?>
    <div class="wrap">
        <h1>ブロックエディターの使い方</h1>

        <div class="card" style="max-width: 100%; background: #f0f9ff; border-left: 4px solid #2563eb;">
            <h2 style="color: #2563eb;">📍 ページ管理の場所一覧</h2>
            <p>各ページがどこで管理されているかを明確にします。</p>

            <table class="widefat" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th style="padding: 10px;"><strong>ページ名</strong></th>
                        <th style="padding: 10px;"><strong>管理場所</strong></th>
                        <th style="padding: 10px;"><strong>編集方法</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px;"><strong>TOPページ（ホーム）</strong></td>
                        <td style="padding: 10px;">固定ページ → 「ホーム」または「トップページ」</td>
                        <td style="padding: 10px;">
                            1. 「固定ページ」→「ホーム」を編集<br>
                            2. ブロックパターンを使って各セクションを配置<br>
                            3. 「設定」→「表示設定」で「固定ページ」を選択し、ホームページに指定
                        </td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 10px;">スタジオ紹介ページ</td>
                        <td style="padding: 10px;">固定ページ → 各ページ名</td>
                        <td style="padding: 10px;">「固定ページ」→「新規追加」で作成</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">料金システムページ</td>
                        <td style="padding: 10px;">固定ページ → 「料金システム」</td>
                        <td style="padding: 10px;">「料金表」パターンを使用</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 10px;">アクセスページ</td>
                        <td style="padding: 10px;">固定ページ → 「アクセス」</td>
                        <td style="padding: 10px;">「アクセス情報」パターンを使用</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">お知らせ（ブログ記事）</td>
                        <td style="padding: 10px;">投稿 → 記事一覧</td>
                        <td style="padding: 10px;">「投稿」→「新規追加」で作成</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 10px;">スタジオルーム詳細</td>
                        <td style="padding: 10px;">スタジオルーム → 各ルーム名</td>
                        <td style="padding: 10px;">「スタジオルーム」→「新規追加」で作成</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">電話番号・住所などの基本情報</td>
                        <td style="padding: 10px;">スタジオ設定 → 基本設定</td>
                        <td style="padding: 10px;">管理画面左メニュー「スタジオ設定」から編集</td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top: 20px; padding: 15px; background: white; border-radius: 4px;">
                <h3 style="margin-top: 0;">💡 TOPページの各セクション管理</h3>
                <p><strong>TOPページの各セクション（ヒーロー、特徴、料金表など）は、すべて「固定ページ」→「ホーム」の中で管理されています。</strong></p>
                <ol>
                    <li>管理画面左メニュー「固定ページ」をクリック</li>
                    <li>「ホーム」または「トップページ」というタイトルのページを見つける</li>
                    <li>「編集」をクリック</li>
                    <li>ブロックエディターが開き、各セクションが表示されます</li>
                    <li>編集したいセクション（ブロック）をクリックして編集</li>
                    <li>「更新」ボタンで保存</li>
                </ol>
                <p style="margin-bottom: 0;"><em>※ TOPページがまだ作成されていない場合は、下記「TOPページの作り方」を参照してください。</em></p>
            </div>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>🎨 ブロックパターンの使い方</h2>
            <p>ブロックパターンを使えば、プロフェッショナルなデザインのセクションを簡単に追加できます。</p>

            <ol>
                <li><strong>ページ編集画面を開く</strong><br>「固定ページ」→「新規追加」または既存ページの編集</li>
                <li><strong>ブロックパターンを挿入</strong><br>画面左上の「+」ボタン→「パターン」タブ→「カシスタジオ」カテゴリーを選択</li>
                <li><strong>利用可能なパターン:</strong>
                    <ul>
                        <li>✨ ヒーローセクション - トップページのメインビジュアル</li>
                        <li>🏢 スタジオルームカード - スタジオの紹介カード（3列）</li>
                        <li>💰 料金表 - 料金プランの表示</li>
                        <li>❓ FAQ（よくある質問） - アコーディオン形式のFAQ</li>
                        <li>📣 CTA（予約促進）セクション - 予約を促すエリア</li>
                        <li>📍 アクセス情報 - 地図と店舗情報</li>
                        <li>⭐ スタジオの特徴 - 6つの特徴をグリッド表示</li>
                    </ul>
                </li>
                <li><strong>テキストや画像を変更</strong><br>パターンを挿入後、テキストをクリックして編集、画像をクリックして置き換え</li>
            </ol>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>🎨 色とフォントの変更方法</h2>
            <p>ブロックエディターの右サイドバーから、色やフォントを簡単に変更できます。</p>
            
            <ol>
                <li><strong>ブロックを選択</strong><br>変更したいテキストや画像をクリック</li>
                <li><strong>右サイドバーで設定</strong>
                    <ul>
                        <li><strong>色</strong>: カラーパレットから選択（プライマリ、セカンダリなど）</li>
                        <li><strong>フォントサイズ</strong>: 小、中、大、特大など</li>
                        <li><strong>スペーシング</strong>: 余白を調整</li>
                        <li><strong>角丸</strong>: ボタンやカードの角を丸くする</li>
                    </ul>
                </li>
            </ol>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>📝 よく使うブロック</h2>
            <ul>
                <li><strong>段落</strong>: 通常のテキスト</li>
                <li><strong>見出し</strong>: タイトルや小見出し（H2〜H6）</li>
                <li><strong>画像</strong>: 写真やイラストを挿入</li>
                <li><strong>カラム</strong>: 2列、3列のレイアウト</li>
                <li><strong>ボタン</strong>: リンクボタン</li>
                <li><strong>カバー</strong>: 背景画像付きのエリア</li>
                <li><strong>グループ</strong>: 複数のブロックをまとめる</li>
                <li><strong>スペーサー</strong>: 余白を追加</li>
                <li><strong>詳細</strong>: アコーディオン（開閉式）</li>
                <li><strong>テーブル</strong>: 表を作成</li>
            </ul>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px; background: #fffbeb; border-left: 4px solid #f59e0b;">
            <h2 style="color: #f59e0b;">✏️ TOPページの編集方法（2つの方法）</h2>
            <p>TOPページを編集する方法は2つあります。どちらでも同じ結果になりますので、お好みの方法をお選びください。</p>

            <h3 style="margin-top: 1.5rem;">方法1: サイトエディターから編集（推奨）</h3>
            <ol>
                <li>管理画面左メニュー「<strong>外観</strong>」→「<strong>エディター</strong>」をクリック</li>
                <li>「<strong>テンプレート</strong>」をクリック</li>
                <li>一覧から「<strong>フロントページ</strong>」または「<strong>ホーム</strong>」を選択</li>
                <li>ブロックエディターが開くので、各セクションを編集</li>
                <li>画面右上の「<strong>保存</strong>」ボタンをクリック</li>
            </ol>
            <p style="margin-top: 1rem; padding: 10px; background: white; border-radius: 4px;">
                <strong>💡 サイトエディターの利点:</strong><br>
                ヘッダー、フッター、TOPページのコンテンツをまとめて確認しながら編集できます。<br>
                リアルタイムでプレビューを見ながら編集できます。
            </p>

            <h3 style="margin-top: 2rem;">方法2: 固定ページ「ホーム」から編集</h3>
            <ol>
                <li>管理画面左メニュー「<strong>固定ページ</strong>」をクリック</li>
                <li>一覧から「<strong>ホーム</strong>」または「<strong>トップページ</strong>」を見つけて「編集」をクリック</li>
                <li>ブロックエディターが開くので、各セクションを編集</li>
                <li>画面右上の「<strong>更新</strong>」ボタンをクリック</li>
            </ol>
            <p style="margin-top: 1rem; padding: 10px; background: white; border-radius: 4px;">
                <strong>💡 固定ページ編集の利点:</strong><br>
                他の固定ページと同じ方法で編集できるため、慣れている方におすすめです。
            </p>

            <h3 style="margin-top: 2rem;">🔍 各セクションの見つけ方</h3>
            <table class="widefat" style="margin-top: 10px; background: white;">
                <thead>
                    <tr>
                        <th style="padding: 8px;">セクション名</th>
                        <th style="padding: 8px;">見つけ方</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 8px;">ヒーローセクション</td>
                        <td style="padding: 8px;">ページ最上部の大きなビジュアルエリア（カバーブロック）</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 8px;">スタジオの特徴</td>
                        <td style="padding: 8px;">3つのカード（絵文字付き）が並んでいるセクション</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">スタジオ紹介</td>
                        <td style="padding: 8px;">スタジオルームの情報が表示されるセクション</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 8px;">料金表</td>
                        <td style="padding: 8px;">テーブルブロックで料金が表示されているセクション</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">FAQ</td>
                        <td style="padding: 8px;">詳細ブロック（アコーディオン）で質問が並んでいるセクション</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 8px;">予約促進（CTA）</td>
                        <td style="padding: 8px;">背景色が付いた「今すぐ予約」ボタンがあるセクション</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">アクセス情報</td>
                        <td style="padding: 8px;">住所・地図が表示されているセクション（ページ下部）</td>
                    </tr>
                </tbody>
            </table>

            <p style="margin-top: 1.5rem; padding: 15px; background: white; border-radius: 4px; border: 2px solid #f59e0b;">
                <strong>⚠️ 重要:</strong><br>
                各セクションをクリックすると、ブロックが選択され、右側のサイドバーに編集オプションが表示されます。<br>
                テキストをクリックすればその場で編集でき、画像をクリックすれば画像を置き換えることができます。
            </p>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>🚀 新しくTOPページを作成する方法</h2>
            <p>まだTOPページが作成されていない場合は、以下の手順で作成してください。</p>
            <ol>
                <li>「固定ページ」→「新規追加」</li>
                <li>タイトルを「ホーム」または「トップページ」に設定</li>
                <li>以下の順番でパターンを挿入:
                    <ol>
                        <li>ヒーローセクション</li>
                        <li>スタジオの特徴</li>
                        <li>スタジオルームカード</li>
                        <li>料金表</li>
                        <li>FAQ</li>
                        <li>CTA（予約促進）</li>
                        <li>アクセス情報</li>
                    </ol>
                </li>
                <li>各パターンのテキストと画像を編集</li>
                <li>「公開」ボタンをクリック</li>
                <li>「設定」→「表示設定」→「ホームページの表示」で、作成したページを「ホームページ」に設定</li>
            </ol>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>💡 Tips</h2>
            <ul>
                <li><strong>プレビュー機能</strong>: 編集中に「プレビュー」ボタンで表示を確認できます</li>
                <li><strong>リビジョン</strong>: 過去のバージョンに戻すことができます（右サイドバー→「リビジョン」）</li>
                <li><strong>下書き保存</strong>: 公開前に「下書きとして保存」で一時保存できます</li>
                <li><strong>複製</strong>: ブロックを選択→ツールバーの「︙」→「複製」で同じブロックをコピーできます</li>
                <li><strong>ブロックを移動</strong>: ブロックを選択→ツールバーの「↑↓」で上下に移動できます</li>
            </ul>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px; background: #f0f9ff; border-left: 4px solid #2563eb;">
            <h2 style="color: #2563eb;">📚 さらに詳しく学びたい方へ</h2>
            <p>WordPressの公式ドキュメントもご参照ください：</p>
            <ul>
                <li><a href="https://ja.wordpress.org/support/article/wordpress-editor/" target="_blank">WordPressエディター完全ガイド</a></li>
                <li><a href="https://ja.wordpress.org/support/article/blocks/" target="_blank">ブロック一覧</a></li>
            </ul>
        </div>
    </div>
    <?php
}
