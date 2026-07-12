<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
</head>

<body>
    <h1>新規会員登録</h1>

    <?php if ($errors->any()): ?>
        <ul>
            <?php foreach ($errors->all() as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= route('register.store') ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label for="name">名前</label>
            <input type="text" id="name" name="name" value="<?= e(old('name')) ?>" required>
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="<?= e(old('email')) ?>" required>
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" minlength="6" required>
        </div>

        <div>
            <label for="password_confirmation">確認用パスワード</label>
            <input type="password" id="password_confirmation" name="password_confirmation" minlength="6" required>
        </div>

        <button type="submit">登録</button>
    </form>

    <p>
        <a href="<?= url('/') ?>">ログインページへ戻る</a>
    </p>
</body>

</html>
