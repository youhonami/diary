<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>退会</title>
    <link rel="stylesheet" href="<?= asset('css/withdrawal.css') ?>">
</head>

<body>
    <main class="withdrawal-page">
        <section class="withdrawal-card">
            <div class="withdrawal-heading">
                <p class="withdrawal-subtitle">Diary</p>
                <h1>退会ページ</h1>
                <p>退会すると、これまでに記入した日記もすべて削除されます。</p>
            </div>

            <?php if (session('withdrawal_error')): ?>
                <p class="message message-error"><?= e(session('withdrawal_error')) ?></p>
            <?php endif; ?>

            <form action="<?= route('withdrawal.destroy') ?>" method="post" class="withdrawal-form" novalidate>
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">メールアドレス <span class="required-mark">必須</span></label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= e(old('email')) ?>"
                        placeholder="example@example.com"
                        class="<?= $errors->has('email') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('email')): ?>
                        <p class="field-error"><?= e($errors->first('email')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">パスワード <span class="required-mark">必須</span></label>
                    <div class="password-field">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="6文字以上"
                            class="<?= $errors->has('password') ? 'is-invalid' : '' ?>"
                        >
                        <button
                            type="button"
                            id="toggle-password"
                            class="password-toggle"
                            aria-label="パスワードを表示"
                            aria-pressed="false"
                        >
                            <span class="password-toggle-show" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 12s3.5-6.5 9.5-6.5S21.5 12 21.5 12s-3.5 6.5-9.5 6.5S2.5 12 2.5 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                    <circle cx="12" cy="12" r="2.8" stroke="currentColor" stroke-width="1.8"/>
                                </svg>
                            </span>
                            <span class="password-toggle-hide is-hidden" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3l18 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9.9 5.2A10.6 10.6 0 0 1 12 5.5c6 0 9.5 6.5 9.5 6.5a16.7 16.7 0 0 1-3.2 3.6M6.2 6.3A16 16 0 0 0 2.5 12S6 18.5 12 18.5c1.4 0 2.7-.3 3.9-.7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.1 10.2a2.8 2.8 0 0 0 3.7 3.7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <?php if ($errors->has('password')): ?>
                        <p class="field-error"><?= e($errors->first('password')) ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="withdrawal-button">退会する</button>
            </form>

            <p class="back-link">
                <a href="<?= route('login.index') ?>">ログインページへ戻る</a>
            </p>
        </section>
    </main>

    <script>
        (function () {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('toggle-password');
            const showIcon = toggleButton.querySelector('.password-toggle-show');
            const hideIcon = toggleButton.querySelector('.password-toggle-hide');

            toggleButton.addEventListener('click', function () {
                const isVisible = passwordInput.type === 'text';

                passwordInput.type = isVisible ? 'password' : 'text';
                toggleButton.setAttribute('aria-pressed', String(!isVisible));
                toggleButton.setAttribute('aria-label', isVisible ? 'パスワードを表示' : 'パスワードを隠す');
                showIcon.classList.toggle('is-hidden', !isVisible);
                hideIcon.classList.toggle('is-hidden', isVisible);
            });
        })();
    </script>
</body>

</html>
