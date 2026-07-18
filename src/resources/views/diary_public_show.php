<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($diary->title) ?></title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
        }

        .diary-detail {
            max-width: 720px;
        }

        .diary-section {
            border-bottom: 1px solid #ddd;
            padding: 16px 0;
        }

        .diary-label {
            font-weight: bold;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <article class="diary-detail">
        <h1><?= e($diary->title) ?></h1>

        <div class="diary-section">
            <div class="diary-label">投稿者</div>
            <div><?= e($diary->user->name) ?></div>
        </div>

        <div class="diary-section">
            <div class="diary-label">日付</div>
            <div><?= e($diary->diary_date->format('Y年n月j日')) ?></div>
        </div>

        <div class="diary-section">
            <div class="diary-label">場所</div>
            <div><?= e($diary->place ?? '未入力') ?></div>
        </div>

        <div class="diary-section">
            <div class="diary-label">出来事</div>
            <div><?= nl2br(e($diary->event)) ?></div>
        </div>

        <div class="diary-section">
            <div class="diary-label">良かったこと</div>
            <div><?= nl2br(e($diary->good_thing)) ?></div>
        </div>
    </article>

    <p>
        <a href="<?= route('diary.read') ?>">日記を読むへ戻る</a>
    </p>
</body>

</html>
