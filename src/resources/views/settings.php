<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設定</title>
    <link rel="stylesheet" href="<?= asset('css/settings.css') ?>">
</head>

<body>
    <main class="settings-page">
        <section class="settings-card">
            <div class="settings-heading">
                <p class="settings-subtitle">Settings</p>
                <h1>設定</h1>
                <p>アカウントやプロフィールの設定を変更できます。</p>
            </div>

            <div class="menu">
                <a class="menu-item" href="<?= route('user.edit') ?>">
                    <span class="menu-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Z" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M4.5 20.25c1.7-3.2 4.35-4.8 7.5-4.8s5.8 1.6 7.5 4.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="menu-label">ログイン情報</span>
                    <span class="menu-description">名前・メール・パスワード</span>
                </a>

                <a class="menu-item" href="<?= route('profile.edit') ?>">
                    <span class="menu-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="8.25" stroke="currentColor" stroke-width="1.8"/>
                            <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M7.5 17.2c1.2-1.7 2.7-2.55 4.5-2.55s3.3.85 4.5 2.55" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="menu-label">プロフィール</span>
                    <span class="menu-description">アイコン・自己紹介など</span>
                </a>
            </div>

            <p class="back-link">
                <a href="<?= route('toppage') ?>">トップページへ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
