<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール変更</title>
    <link rel="stylesheet" href="<?= asset('css/profile_edit.css') ?>">
</head>

<body>
    <h1>プロフィール変更</h1>

    <?php if (session('message')): ?>
        <p><?= e(session('message')) ?></p>
    <?php endif; ?>

    <?php if ($errors->any()): ?>
        <ul>
            <?php foreach ($errors->all() as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($user->icon_path): ?>
        <div class="profile-icon-preview">
            <img src="<?= asset($user->icon_path) ?>" alt="プロフィールアイコン">
        </div>
    <?php endif; ?>

    <form action="<?= route('profile.update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="username">ユーザーネーム</label>
            <input type="text" id="username" name="username" value="<?= e(old('username', $user->username ?? $user->name)) ?>" required>
        </div>

        <div class="form-group">
            <label for="birthday">生年月日</label>
            <input type="date" id="birthday" name="birthday" value="<?= e(old('birthday', optional($user->birthday)->format('Y-m-d'))) ?>">
        </div>

        <div class="form-group">
            <label for="icon">アイコン</label>
            <input type="file" id="icon" name="icon" accept="image/*">
        </div>

        <div class="form-group">
            <label for="bio">自己紹介</label>
            <textarea id="bio" name="bio"><?= e(old('bio', $user->bio)) ?></textarea>
        </div>

        <div class="form-group">
            <label for="birthplace">出身地</label>
            <input type="text" id="birthplace" name="birthplace" value="<?= e(old('birthplace', $user->birthplace)) ?>">
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="<?= e(old('email', $user->email)) ?>" required>
        </div>

        <div class="form-group">
            <label for="phone_number">電話番号</label>
            <input type="tel" id="phone_number" name="phone_number" value="<?= e(old('phone_number', $user->phone_number)) ?>">
        </div>

        <button type="submit">更新する</button>
    </form>

    <p>
        <a href="<?= route('settings') ?>">設定へ戻る</a>
    </p>
</body>

</html>
