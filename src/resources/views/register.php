<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
    <link rel="stylesheet" href="<?= asset('css/register.css') ?>">
</head>

<body>
    <main class="register-page">
        <section class="register-card">
            <div class="register-heading">
                <p class="register-subtitle">Diary</p>
                <h1>新規会員登録</h1>
                <p>あなたの日記を始めましょう。</p>
            </div>

            <form action="<?= route('register.store') ?>" method="post" class="register-form" novalidate>
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">名前 <span class="required-mark">必須</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= e(old('name')) ?>"
                        placeholder="山田 太郎"
                        class="<?= $errors->has('name') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('name')): ?>
                        <p class="field-error"><?= e($errors->first('name')) ?></p>
                    <?php endif; ?>
                </div>

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
                            class="password-toggle"
                            data-target="password"
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

                <div class="form-group">
                    <label for="password_confirmation">確認用パスワード <span class="required-mark">必須</span></label>
                    <div class="password-field">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="もう一度入力してください"
                        >
                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password_confirmation"
                            aria-label="確認用パスワードを表示"
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
                </div>

                <button type="submit" class="register-button">登録する</button>
            </form>

            <p class="login-link">
                すでにアカウントをお持ちの方は
                <a href="<?= url('/') ?>">ログイン</a>
            </p>
        </section>
    </main>

    <script>
        (function () {
            document.querySelectorAll('.password-toggle').forEach(function (toggleButton) {
                const targetId = toggleButton.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const showIcon = toggleButton.querySelector('.password-toggle-show');
                const hideIcon = toggleButton.querySelector('.password-toggle-hide');
                const showLabel = targetId === 'password_confirmation'
                    ? '確認用パスワードを表示'
                    : 'パスワードを表示';
                const hideLabel = targetId === 'password_confirmation'
                    ? '確認用パスワードを隠す'
                    : 'パスワードを隠す';

                toggleButton.addEventListener('click', function () {
                    const isVisible = passwordInput.type === 'text';

                    passwordInput.type = isVisible ? 'password' : 'text';
                    toggleButton.setAttribute('aria-pressed', String(!isVisible));
                    toggleButton.setAttribute('aria-label', isVisible ? showLabel : hideLabel);
                    showIcon.classList.toggle('is-hidden', !isVisible);
                    hideIcon.classList.toggle('is-hidden', isVisible);
                });
            });
        })();
    </script>
</body>

</html>
