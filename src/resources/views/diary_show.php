<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($date->format('Y年n月j日')) ?>の日記</title>
    <link rel="stylesheet" href="<?= asset('css/diary_show.css') ?>">
</head>

<body>
    <h1><?= e($date->format('Y年n月j日')) ?>の日記</h1>
    <p><?= e($diaries->count()) ?>件の日記があります。</p>

    <?php foreach ($diaries as $diary): ?>
        <article class="diary-detail diary-detail-card">
            <h2><?= e($diary->title) ?></h2>

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

            <div class="diary-section">
                <div class="diary-label">公開設定</div>
                <div><?= $diary->visibility === 'public' ? '公開' : '非公開' ?></div>
            </div>
        </article>
    <?php endforeach; ?>

    <p>
        <a href="<?= route('diary.lookback', ['month' => $date->format('Y-m')]) ?>">カレンダーへ戻る</a>
    </p>
</body>

</html>
