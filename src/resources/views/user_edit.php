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

            <?php if ($errors->any()): ?>
                <ul class="message message-error">
                    <?php foreach ($errors->all() as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="<?= route('user.update') ?>" method="post" class="user-edit-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" id="name" name="name" value="<?= e(old('name', $user->name)) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" value="<?= e(old('email', $user->email)) ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">新しいパスワード</label>
                    <input type="password" id="password" name="password" minlength="6">
                    <p class="form-note">変更しない場合は空欄のままにしてください。</p>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">新しいパスワード確認</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="6">
                </div>

                <button type="submit" class="update-button">更新する</button>
            </form>

            <p class="back-link">
                <a href="<?= route('settings') ?>">設定へ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
