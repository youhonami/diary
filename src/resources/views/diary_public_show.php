<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($diary->title) ?></title>
    <link rel="stylesheet" href="<?= asset('css/diary_public_show.css') ?>?v=<?= filemtime(public_path('css/diary_public_show.css')) ?>">
</head>

<body>
    <main class="diary-public-page">
        <?php $theme = ($user->toppage_background ?? null) ?: 'sky'; ?>
        <article class="diary-public-card diary-public-card-<?= e($theme) ?>">
            <div class="diary-public-heading">
                <p class="diary-public-subtitle">Public Diary</p>
                <h1><?= e($diary->title) ?></h1>
            </div>

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
                <div><?= e($diary->place ?: '未入力') ?></div>
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
                <div><?= nl2br(e($diary->event)) ?></div>
            </div>

            <div class="diary-section">
                <div class="diary-label">良かったこと</div>
                <div><?= nl2br(e($diary->good_thing)) ?></div>
            </div>

            <p class="page-actions">
                <a class="back-link" href="<?= route('diary.read') ?>">日記を読むへ戻る</a>
            </p>
        </article>
    </main>
</body>

</html>
