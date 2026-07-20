<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設定</title>
    <link rel="stylesheet" href="<?= asset('css/settings.css') ?>">
</head>

<body>
    <h1>設定</h1>

    <div class="menu settings-menu">
        <a class="menu-item" href="<?= route('user.edit') ?>">
            <span class="menu-icon">ロ</span>
            <span>ログイン情報</span>
        </a>

        <a class="menu-item" href="<?= route('profile.edit') ?>">
            <span class="menu-icon">プ</span>
            <span>プロフィール</span>
        </a>
    </div>

    <p>
        <a href="<?= route('toppage') ?>">トップページへ戻る</a>
    </p>
</body>

</html>
