<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($date->format('Y年n月j日')) ?>の日記</title>
    <link rel="stylesheet" href="<?= asset('css/diary_show.css') ?>?v=<?= filemtime(public_path('css/diary_show.css')) ?>">
</head>

<body>
    <main class="diary-show-page">
        <?php $theme = ($user->toppage_background ?? null) ?: 'sky'; ?>
        <section class="diary-show-card diary-show-card-<?= e($theme) ?>">
            <div class="diary-show-heading">
                <p class="diary-show-subtitle">Diary Detail</p>
                <h1><?= e($date->format('Y年n月j日')) ?>の日記</h1>
                <p><?= e($diaries->count()) ?>件の日記があります。</p>
            </div>

            <?php if (session('message')): ?>
                <p class="message message-success"><?= e(session('message')) ?></p>
            <?php endif; ?>

            <div class="diary-list">
                <?php foreach ($diaries as $diary): ?>
                    <article class="diary-detail">
                        <div class="diary-detail-header">
                            <h2><?= e($diary->title) ?></h2>
                            <span class="visibility-badge <?= $diary->visibility === 'public' ? 'is-public' : 'is-private' ?>">
                                <?= $diary->visibility === 'public' ? '公開' : '非公開' ?>
                            </span>
                        </div>

                        <div class="diary-section">
                            <div class="diary-label">場所</div>
                            <div class="diary-value"><?= e($diary->place ?: '未入力') ?></div>
                            <?php if (! empty($diary->place)): ?>
                                <?php
                                    $mapsApiKey = config('services.google.maps_api_key');
                                    $mapQuery = urlencode($diary->place);
                                    $mapUrl = $mapsApiKey
                                        ? 'https://www.google.com/maps/embed/v1/place?key=' . urlencode($mapsApiKey) . '&q=' . $mapQuery . '&language=ja'
                                        : 'https://maps.google.com/maps?q=' . $mapQuery . '&hl=ja&z=14&output=embed';
                                ?>
                                <div class="place-map-wrap">
                                    <iframe
                                        src="<?= e($mapUrl) ?>"
                                        title="<?= e($diary->place) ?>の地図"
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="diary-section">
                            <div class="diary-label">出来事</div>
                            <div class="diary-value"><?= nl2br(e($diary->event)) ?></div>
                        </div>

                        <div class="diary-section">
                            <div class="diary-label">良かったこと</div>
                            <div class="diary-value"><?= nl2br(e($diary->good_thing)) ?></div>
                        </div>

                        <div class="diary-actions">
                            <a class="edit-button" href="<?= route('diary.edit', ['diary' => $diary]) ?>">編集する</a>

                            <form
                                action="<?= route('diary.destroy', ['diary' => $diary]) ?>"
                                method="post"
                                class="delete-form"
                                onsubmit="return confirm('この日記を削除しますか？');"
                            >
                                <?= csrf_field() ?>
                                <button type="submit" class="delete-button">削除する</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <p class="page-actions">
                <a class="back-link" href="<?= route('diary.lookback', ['month' => $date->format('Y-m')]) ?>">カレンダーへ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
