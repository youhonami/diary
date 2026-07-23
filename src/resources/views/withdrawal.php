<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>退会</title>
</head>

<body>
    <h1>退会ページ</h1>
    <p>退会すると、これまでに記入した日記もすべて削除されます。</p>

    <?php if ($errors->any()): ?>
        <ul>
            <?php foreach ($errors->all() as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (session('withdrawal_error')): ?>
        <p><?= e(session('withdrawal_error')) ?></p>
    <?php endif; ?>

    <form action="<?= route('withdrawal.destroy') ?>" method="post">
        <?= csrf_field() ?>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="<?= e(old('email')) ?>" required>
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" minlength="6" required>
        </div>

        <button type="submit">退会する</button>
    </form>

    <p>
        <a href="<?= route('login.index') ?>">ログインページへ戻る</a>
    </p>
</body>

</html>
