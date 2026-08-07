<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="<?= asset('css/login.css') ?>">
</head>

<body>
    <main class="login-page">
        <section class="login-card">
            <div class="login-heading">
                <p class="login-subtitle">Diary</p>
                <h1>ログイン</h1>
                <p>あなたの一日を記録しましょう。</p>
            </div>

            <?php if (session('login_error')): ?>
                <p class="message message-error"><?= e(session('login_error')) ?></p>
            <?php endif; ?>

            <?php if (session('withdrawal_message')): ?>
                <p class="message message-success"><?= e(session('withdrawal_message')) ?></p>
            <?php endif; ?>

            <form action="<?= route('login') ?>" method="post" class="login-form" novalidate>
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
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="6文字以上"
                        class="<?= $errors->has('password') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('password')): ?>
                        <p class="field-error"><?= e($errors->first('password')) ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="login-button">ログイン</button>
            </form>

            <p class="register-link">
                アカウントをお持ちでない方は
                <a href="<?= route('register') ?>">新規会員登録</a>
            </p>

            <p class="withdrawal-link">
                <a href="<?= route('withdrawal') ?>">退会をご希望の方はこちら</a>
            </p>
        </section>
    </main>
</body>

</html>
