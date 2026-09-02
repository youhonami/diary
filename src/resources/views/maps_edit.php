<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Googleマップの設定</title>
    <link rel="stylesheet" href="<?= asset('css/maps_edit.css') ?>?v=<?= filemtime(public_path('css/maps_edit.css')) ?>">
</head>

<body>
    <?php
        $mapsApiKey = config('services.google.maps_api_key');

        $buildMapUrl = function (?string $place) use ($mapsApiKey): ?string {
            if ($place === null || trim($place) === '') {
                return null;
            }

            $query = urlencode($place);

            return $mapsApiKey
                ? 'https://www.google.com/maps/embed/v1/place?key=' . urlencode($mapsApiKey) . '&q=' . $query . '&language=ja'
                : 'https://maps.google.com/maps?q=' . $query . '&hl=ja&z=14&output=embed';
        };

        $places = [
            'home_place' => [
                'label' => '自宅',
                'placeholder' => '東京都渋谷区…',
                'value' => old('home_place', $user->home_place),
            ],
            'family_home_place' => [
                'label' => '実家',
                'placeholder' => '大阪府大阪市…',
                'value' => old('family_home_place', $user->family_home_place),
            ],
            'work_place' => [
                'label' => '勤務先',
                'placeholder' => '東京都千代田区…',
                'value' => old('work_place', $user->work_place),
            ],
            'favorite_place' => [
                'label' => 'よく行く場所',
                'placeholder' => 'カフェや公園など',
                'value' => old('favorite_place', $user->favorite_place),
            ],
        ];
    ?>

    <main class="maps-edit-page">
        <section class="maps-edit-card">
            <div class="maps-edit-heading">
                <p class="maps-edit-subtitle">Google Maps</p>
                <h1>Googleマップの設定</h1>
                <p>自宅や勤務先など、よく使う場所を登録できます。</p>
            </div>

            <?php if (session('message')): ?>
                <p class="message message-success"><?= e(session('message')) ?></p>
            <?php endif; ?>

            <form action="<?= route('maps.update') ?>" method="post" class="maps-edit-form" novalidate>
                <?= csrf_field() ?>

                <?php foreach ($places as $name => $place): ?>
                    <div class="form-group">
                        <label for="<?= e($name) ?>"><?= e($place['label']) ?></label>
                        <input
                            type="text"
                            id="<?= e($name) ?>"
                            name="<?= e($name) ?>"
                            value="<?= e($place['value']) ?>"
                            placeholder="<?= e($place['placeholder']) ?>"
                            class="<?= $errors->has($name) ? 'is-invalid' : '' ?>"
                        >
                        <?php if ($errors->has($name)): ?>
                            <p class="field-error"><?= e($errors->first($name)) ?></p>
                        <?php endif; ?>

                        <?php $mapUrl = $buildMapUrl($place['value']); ?>
                        <?php if ($mapUrl): ?>
                            <div class="place-map-wrap">
                                <iframe
                                    src="<?= e($mapUrl) ?>"
                                    title="<?= e($place['label']) ?>の地図"
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="update-button">保存する</button>
            </form>

            <p class="back-link">
                <a href="<?= route('settings') ?>">設定へ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
