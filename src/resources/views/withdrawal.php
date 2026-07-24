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

            <?php if ($errors->any()): ?>
                <ul class="message message-error">
                    <?php foreach ($errors->all() as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (session('withdrawal_error')): ?>
                <p class="message message-error"><?= e(session('withdrawal_error')) ?></p>
            <?php endif; ?>

            <form action="<?= route('withdrawal.destroy') ?>" method="post" class="withdrawal-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" value="<?= e(old('email')) ?>" placeholder="example@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" minlength="6" placeholder="6文字以上" required>
                </div>

                <button type="submit" class="withdrawal-button">退会する</button>
            </form>

            <p class="back-link">
                <a href="<?= route('login.index') ?>">ログインページへ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
