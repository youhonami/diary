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
    <main class="profile-edit-page">
        <section class="profile-edit-card">
            <div class="profile-edit-heading">
                <p class="profile-edit-subtitle">Profile Setting</p>
                <h1>プロフィール変更</h1>
                <p>ユーザーネームや自己紹介など、プロフィール情報を変更できます。</p>
            </div>

            <?php if (session('message')): ?>
                <p class="message message-success"><?= e(session('message')) ?></p>
            <?php endif; ?>

            <?php if ($user->icon_path): ?>
                <div class="profile-icon-preview">
                    <img src="<?= asset($user->icon_path) ?>" alt="プロフィールアイコン">
                </div>
            <?php endif; ?>

            <form action="<?= route('profile.update') ?>" method="post" enctype="multipart/form-data" class="profile-edit-form" novalidate>
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">ユーザーネーム</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= e(old('username', $user->username ?? $user->name)) ?>"
                        class="<?= $errors->has('username') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('username')): ?>
                        <p class="field-error"><?= e($errors->first('username')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="birthday">生年月日</label>
                    <input
                        type="date"
                        id="birthday"
                        name="birthday"
                        value="<?= e(old('birthday', optional($user->birthday)->format('Y-m-d'))) ?>"
                        class="<?= $errors->has('birthday') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('birthday')): ?>
                        <p class="field-error"><?= e($errors->first('birthday')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="icon">アイコン</label>
                    <input
                        type="file"
                        id="icon"
                        name="icon"
                        accept="image/*"
                        class="<?= $errors->has('icon') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('icon')): ?>
                        <p class="field-error"><?= e($errors->first('icon')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="bio">自己紹介</label>
                    <textarea
                        id="bio"
                        name="bio"
                        class="<?= $errors->has('bio') ? 'is-invalid' : '' ?>"
                    ><?= e(old('bio', $user->bio)) ?></textarea>
                    <?php if ($errors->has('bio')): ?>
                        <p class="field-error"><?= e($errors->first('bio')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="birthplace">出身地</label>
                    <input
                        type="text"
                        id="birthplace"
                        name="birthplace"
                        value="<?= e(old('birthplace', $user->birthplace)) ?>"
                        class="<?= $errors->has('birthplace') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('birthplace')): ?>
                        <p class="field-error"><?= e($errors->first('birthplace')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= e(old('email', $user->email)) ?>"
                        class="<?= $errors->has('email') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('email')): ?>
                        <p class="field-error"><?= e($errors->first('email')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="phone_number">電話番号</label>
                    <input
                        type="tel"
                        id="phone_number"
                        name="phone_number"
                        value="<?= e(old('phone_number', $user->phone_number)) ?>"
                        placeholder="090-1234-5678"
                        class="<?= $errors->has('phone_number') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('phone_number')): ?>
                        <p class="field-error"><?= e($errors->first('phone_number')) ?></p>
                    <?php endif; ?>
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
