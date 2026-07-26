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
    <main class="diary-read-page">
        <section class="diary-read-card">
            <div class="diary-read-heading">
                <p class="diary-read-subtitle">Read Diary</p>
                <h1>日記を読む</h1>
                <p>みんなが公開した日記を読んで、日々の出来事に触れてみましょう。</p>
            </div>

            <?php if ($diaries->isEmpty()): ?>
                <p class="empty-message">公開されている日記はまだありません。</p>
            <?php else: ?>
                <div class="diary-list">
                    <?php foreach ($diaries as $diary): ?>
                        <article class="diary-card">
                            <div class="diary-meta">
                                <span><?= e($diary->diary_date->format('Y年n月j日')) ?></span>
                                <span><?= e($diary->user->name) ?></span>
                            </div>
                            <h2 class="diary-title">
                                <a href="<?= route('diary.public.show', ['diary' => $diary]) ?>">
                                    <?= e($diary->title) ?>
                                </a>
                            </h2>
                            <p class="diary-preview"><?= e(mb_strimwidth($diary->event, 0, 100, '...')) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <p class="page-actions">
                <a class="back-link" href="<?= route('toppage') ?>">トップページへ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
