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
                <p>今日の空のように、あなたの一日を記録しましょう。</p>
            </div>

            <?php if ($errors->any()): ?>
                <ul class="message message-error">
                    <?php foreach ($errors->all() as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (session('login_error')): ?>
                <p class="message message-error"><?= e(session('login_error')) ?></p>
            <?php endif; ?>

            <form action="<?= route('login') ?>" method="post" class="login-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" value="<?= e(old('email')) ?>" placeholder="example@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" minlength="6" placeholder="6文字以上" required>
                </div>

                <button type="submit" class="login-button">ログイン</button>
            </form>

            <p class="register-link">
                アカウントをお持ちでない方は
                <a href="<?= route('register') ?>">新規会員登録</a>
            </p>
        </section>
    </main>
</body>

</html>