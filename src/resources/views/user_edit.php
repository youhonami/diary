<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン情報変更</title>
    <link rel="stylesheet" href="<?= asset('css/user_edit.css') ?>">
</head>

<body>
    <main class="user-edit-page">
        <section class="user-edit-card">
            <div class="user-edit-heading">
                <p class="user-edit-subtitle">Account Setting</p>
                <h1>ログイン情報</h1>
                <p>ログインに使う名前・メールアドレス・パスワードを変更できます。</p>
            </div>

            <?php if (session('message')): ?>
                <p class="message message-success"><?= e(session('message')) ?></p>
            <?php endif; ?>

            <form action="<?= route('user.update') ?>" method="post" class="user-edit-form" novalidate>
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">名前 <span class="required-mark">必須</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= e(old('name', $user->name)) ?>"
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
                        value="<?= e(old('email', $user->email)) ?>"
                        class="<?= $errors->has('email') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('email')): ?>
                        <p class="field-error"><?= e($errors->first('email')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">新しいパスワード</label>
                    <div class="password-field">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="<?= $errors->has('password') ? 'is-invalid' : '' ?>"
                        >
                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password"
                            aria-label="新しいパスワードを表示"
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
                    <p class="form-note">変更しない場合は空欄のままにしてください。</p>
                    <?php if ($errors->has('password')): ?>
                        <p class="field-error"><?= e($errors->first('password')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">新しいパスワード確認</label>
                    <div class="password-field">
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        <button
                            type="button"
                            class="password-toggle"
                            data-target="password_confirmation"
                            aria-label="新しいパスワード確認を表示"
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

                <button type="submit" class="update-button">更新する</button>
            </form>

            <p class="back-link">
                <a href="<?= route('settings') ?>">設定へ戻る</a>
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
                    ? '新しいパスワード確認を表示'
                    : '新しいパスワードを表示';
                const hideLabel = targetId === 'password_confirmation'
                    ? '新しいパスワード確認を隠す'
                    : '新しいパスワードを隠す';

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
