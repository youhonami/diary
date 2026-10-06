<?php if (! auth()->check()) {
    return;
} ?>
<?php $headerTheme = (auth()->user()->toppage_background ?? null) ?: 'sky'; ?>
<header class="app-header app-header-<?= e($headerTheme) ?>">
    <a class="app-header-brand" href="<?= route('toppage') ?>">Diary</a>
    <div class="app-header-actions">
        <a class="header-icon-button" href="<?= route('settings') ?>" aria-label="設定">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/>
                <path d="M12 3.5v2.2M12 18.3v2.2M3.5 12h2.2M18.3 12h2.2M5.9 5.9l1.6 1.6M16.5 16.5l1.6 1.6M18.1 5.9l-1.6 1.6M7.5 16.5l-1.6 1.6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
        </a>
        <form action="<?= route('logout') ?>" method="post" class="logout-form">
            <?= csrf_field() ?>
            <button type="submit" class="logout-button">ログアウト</button>
        </form>
    </div>
</header>
