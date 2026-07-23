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

            <?php if ($errors->any()): ?>
                <ul class="message message-error">
                    <?php foreach ($errors->all() as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="<?= route('register.store') ?>" method="post" class="register-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" id="name" name="name" value="<?= e(old('name')) ?>" placeholder="山田 太郎" required>
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" value="<?= e(old('email')) ?>" placeholder="example@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" minlength="6" placeholder="6文字以上" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">確認用パスワード</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="6" placeholder="もう一度入力してください" required>
                </div>

                <button type="submit" class="register-button">登録する</button>
            </form>

            <p class="login-link">
                すでにアカウントをお持ちの方は
                <a href="<?= url('/') ?>">ログイン</a>
            </p>
        </section>
    </main>
</body>

</html>
