<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>地図から日記を見返す</title>
    <link rel="stylesheet" href="<?= asset('css/diary_map_lookback.css') ?>?v=<?= filemtime(public_path('css/diary_map_lookback.css')) ?>">
</head>

<body>
    <?php $theme = ($user->toppage_background ?? null) ?: 'sky'; ?>
    <main class="diary-map-page">
        <section class="diary-map-card diary-map-card-<?= e($theme) ?>">
            <div class="diary-map-heading">
                <p class="diary-map-subtitle">Map Look Back</p>
                <h1>地図から日記を見返す</h1>
                <p>場所を選んで、その場所で書いた日記を振り返りましょう。</p>
            </div>

            <?php if ($places->isEmpty()): ?>
                <p class="empty-message">場所が登録された日記はまだありません。</p>
            <?php else: ?>
                <div class="map-layout">
                    <aside class="place-list" aria-label="場所一覧">
                        <?php foreach ($places as $place): ?>
                            <?php
                                $count = $diariesByPlace->get($place)->count();
                                $isActive = $place === $selectedPlace;
                            ?>
                            <a
                                class="place-item<?= $isActive ? ' is-active' : '' ?>"
                                href="<?= route('diary.map', ['place' => $place]) ?>"
                            >
                                <span class="place-item-name"><?= e($place) ?></span>
                                <span class="place-item-count"><?= e($count) ?>件</span>
                            </a>
                        <?php endforeach; ?>
                    </aside>

                    <div class="place-detail">
                        <h2 class="place-detail-title"><?= e($selectedPlace) ?></h2>

                        <?php
                            $mapsApiKey = config('services.google.maps_api_key');
                            $mapQuery = urlencode($selectedPlace);
                            $mapUrl = $mapsApiKey
                                ? 'https://www.google.com/maps/embed/v1/place?key=' . urlencode($mapsApiKey) . '&q=' . $mapQuery . '&language=ja'
                                : 'https://maps.google.com/maps?q=' . $mapQuery . '&hl=ja&z=14&output=embed';
                        ?>
                        <div class="place-map-wrap">
                            <iframe
                                src="<?= e($mapUrl) ?>"
                                title="<?= e($selectedPlace) ?>の地図"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen
                            ></iframe>
                        </div>

                        <div class="diary-list">
                            <?php foreach ($selectedDiaries as $diary): ?>
                                <article class="diary-item">
                                    <div class="diary-meta">
                                        <span><?= e($diary->diary_date->format('Y年n月j日')) ?></span>
                                    </div>
                                    <h3 class="diary-title">
                                        <a href="<?= route('diary.show', ['date' => $diary->diary_date->format('Y-m-d')]) ?>">
                                            <?= e($diary->title) ?>
                                        </a>
                                    </h3>
                                    <p class="diary-preview"><?= e(mb_strimwidth($diary->event, 0, 100, '...')) ?></p>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="page-actions">
                <a class="primary-link" href="<?= route('diary.lookback') ?>">カレンダーで見返す</a>
                <a class="back-link" href="<?= route('toppage') ?>">トップページへ戻る</a>
            </div>
        </section>
    </main>
</body>

</html>
