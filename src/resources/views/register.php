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

                <div class="form-group">
                    <label for="password_confirmation">確認用パスワード <span class="required-mark">必須</span></label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="もう一度入力してください"
                    >
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
