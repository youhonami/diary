<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日記を読む</title>
    <link rel="stylesheet" href="<?= asset('css/diary_read.css') ?>">
</head>

<body>
    <h1>日記を読む</h1>

    <?php if ($diaries->isEmpty()): ?>
        <p>公開されている日記はまだありません。</p>
    <?php else: ?>
        <div class="diary-list">
            <?php foreach ($diaries as $diary): ?>
                <article class="diary-card">
                    <h2 class="diary-title">
                        <a href="<?= route('diary.public.show', ['diary' => $diary]) ?>">
                            <?= e($diary->title) ?>
                        </a>
                    </h2>
                    <div class="diary-meta">
                        <?= e($diary->diary_date->format('Y年n月j日')) ?>
                        /
                        <?= e($diary->user->name) ?>
                    </div>
                    <p><?= e(mb_strimwidth($diary->event, 0, 100, '...')) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <p>
        <a href="<?= route('toppage') ?>">トップページへ戻る</a>
    </p>
</body>

</html>
