<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
    <link rel="stylesheet" href="<?= asset('css/toppage.css') ?>">
</head>

<body>
    <h1>トップページ</h1>
    <p>利用したいメニューを選択してください。</p>

    <div class="menu">
        <a class="menu-item" href="<?= route('diary.create') ?>">
            <span class="menu-icon">書</span>
            <span>日記を書く</span>
        </a>

        <a class="menu-item" href="<?= route('diary.lookback') ?>">
            <span class="menu-icon">返</span>
            <span>日記を見返す</span>
        </a>

        <a class="menu-item" href="<?= route('diary.read') ?>">
            <span class="menu-icon">読</span>
            <span>日記を読む</span>
        </a>

        <a class="menu-item" href="<?= route('settings') ?>">
            <span class="menu-icon">設</span>
            <span>設定</span>
        </a>
    </div>

    <form action="<?= route('logout') ?>" method="post">
        <?= csrf_field() ?>
        <button type="submit">ログアウト</button>
    </form>
</body>

</html>
