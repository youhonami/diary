<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>

<body>
    <h1>ログイン</h1>

    <?php if ($errors->any()): ?>
        <ul>
            <?php foreach ($errors->all() as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (session('login_error')): ?>
        <p><?= e(session('login_error')) ?></p>
    <?php endif; ?>

    <form action="<?= route('login') ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="<?= e(old('email')) ?>" required>
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" minlength="6" required>
        </div>

        <button type="submit">ログイン</button>
    </form>
</body>

</html>