<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
    <link rel="stylesheet" href="<?= asset('css/toppage.css') ?>">
</head>

<body>
    <main class="toppage">
        <section class="toppage-card">
            <div class="toppage-heading">
                <p class="toppage-subtitle">Diary</p>
                <h1>トップページ</h1>
                <p>利用したいメニューを選択してください。</p>
            </div>

            <div class="profile-summary">
                <?php if ($user->icon_path): ?>
                    <img class="profile-summary-icon" src="<?= asset($user->icon_path) ?>" alt="プロフィールアイコン">
                <?php else: ?>
                    <div class="profile-summary-icon profile-summary-icon-placeholder" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M5 19.5c1.5-3.2 3.8-4.8 7-4.8s5.5 1.6 7 4.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                <?php endif; ?>
                <p class="profile-summary-name"><?= e($user->username ?: $user->name) ?></p>
            </div>

            <div class="menu">
                <a class="menu-item" href="<?= route('diary.create') ?>">
                    <span class="menu-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 20h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M7.5 17.5 16.5 8.5l2-2a1.8 1.8 0 0 0-2.5-2.5l-2 2-9 9V17.5h2.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="menu-label">日記を書く</span>
                    <span class="menu-description">今日の出来事を記録する</span>
                </a>

                <a class="menu-item" href="<?= route('diary.lookback') ?>">
                    <span class="menu-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="5" width="16" height="15" rx="2" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M8 3.5v3M16 3.5v3M4 9.5h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <circle cx="12" cy="14" r="1.5" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="menu-label">日記を見返す</span>
                    <span class="menu-description">カレンダーから振り返る</span>
                </a>

                <a class="menu-item" href="<?= route('diary.read') ?>">
                    <span class="menu-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.5 6.5A2.5 2.5 0 0 1 7 4h5.5v14H7a2.5 2.5 0 0 0-2.5 2.5V6.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                            <path d="M19.5 6.5A2.5 2.5 0 0 0 17 4h-5.5v14H17a2.5 2.5 0 0 1 2.5 2.5V6.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="menu-label">日記を読む</span>
                    <span class="menu-description">公開された日記を読む</span>
                </a>

                <a class="menu-item" href="<?= route('settings') ?>">
                    <span class="menu-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M12 3.5v2.2M12 18.3v2.2M3.5 12h2.2M18.3 12h2.2M5.9 5.9l1.6 1.6M16.5 16.5l1.6 1.6M18.1 5.9l-1.6 1.6M7.5 16.5l-1.6 1.6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <span class="menu-label">設定</span>
                    <span class="menu-description">アカウントやプロフィール</span>
                </a>
            </div>

            <form action="<?= route('logout') ?>" method="post" class="logout-form">
                <?= csrf_field() ?>
                <button type="submit" class="logout-button">ログアウト</button>
            </form>
        </section>
    </main>
</body>

</html>
