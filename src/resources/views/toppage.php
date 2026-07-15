<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
        }

        .menu {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            margin: 32px 0;
            max-width: 840px;
        }

        .menu-item {
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 12px;
            color: #333;
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 24px;
            text-decoration: none;
        }

        .menu-item:hover {
            background-color: #f7f7f7;
        }

        .menu-icon {
            align-items: center;
            background-color: #eef3ff;
            border-radius: 50%;
            display: flex;
            font-size: 28px;
            height: 64px;
            justify-content: center;
            width: 64px;
        }
    </style>
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
