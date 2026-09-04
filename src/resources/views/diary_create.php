<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日記を書く</title>
    <link rel="stylesheet" href="<?= asset('css/diary_create.css') ?>">
</head>

<body>
    <main class="diary-create-page">
        <section class="diary-create-card diary-create-card-<?= e($user->toppage_background ?: 'sky') ?>">
            <div class="diary-create-heading">
                <p class="diary-create-subtitle">Write Diary</p>
                <h1>日記を書く</h1>
                <p>今日の出来事や良かったことを、ゆっくり書き残しましょう。</p>
            </div>

            <form action="<?= route('diary.store') ?>" method="post" class="diary-create-form" novalidate>
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="title">タイトル <span class="required-mark">必須</span></label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="<?= e(old('title')) ?>"
                        placeholder="今日の日記タイトル"
                        class="<?= $errors->has('title') ? 'is-invalid' : '' ?>"
                    >
                    <?php if ($errors->has('title')): ?>
                        <p class="field-error"><?= e($errors->first('title')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="diary_date">日付 <span class="required-mark">必須</span></label>
                        <input
                            type="date"
                            id="diary_date"
                            name="diary_date"
                            value="<?= e(old('diary_date')) ?>"
                            class="<?= $errors->has('diary_date') ? 'is-invalid' : '' ?>"
                        >
                        <?php if ($errors->has('diary_date')): ?>
                            <p class="field-error"><?= e($errors->first('diary_date')) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="place">場所</label>
                        <input type="text" id="place" name="place" value="<?= e(old('place')) ?>" placeholder="自宅、公園、カフェなど">
                        <?php
                            $placePresets = array_filter([
                                '自宅' => $user->home_place,
                                '実家' => $user->family_home_place,
                                '勤務先' => $user->work_place,
                                'よく行く場所' => $user->favorite_place,
                            ]);
                        ?>
                        <?php if (! empty($placePresets)): ?>
                            <div class="place-presets">
                                <?php foreach ($placePresets as $label => $address): ?>
                                    <button
                                        type="button"
                                        class="place-preset-button"
                                        data-place="<?= e($address) ?>"
                                        data-label="<?= e($label) ?>"
                                    >
                                        <?= e($label) ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <p class="form-note">ボタンを押すと、設定した住所が反映されます。</p>
                        <?php else: ?>
                            <p class="form-note">よく使う場所は、設定の Googleマップの設定 から登録できます。</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="place-map">地図</label>
                    <div class="place-map-wrap">
                        <iframe
                            id="place-map"
                            title="Googleマップ"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                        ></iframe>
                    </div>
                    <p class="form-note">場所を入力すると、地図の表示が更新されます。</p>
                </div>

                <div class="form-group">
                    <label for="event">出来事 <span class="required-mark">必須</span></label>
                    <textarea
                        id="event"
                        name="event"
                        placeholder="今日はどんなことがありましたか？"
                        class="<?= $errors->has('event') ? 'is-invalid' : '' ?>"
                    ><?= e(old('event')) ?></textarea>
                    <?php if ($errors->has('event')): ?>
                        <p class="field-error"><?= e($errors->first('event')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="good_thing">良かったこと</label>
                    <textarea id="good_thing" name="good_thing" placeholder="嬉しかったこと、感謝したことを書いてみましょう。"><?= e(old('good_thing')) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="visibility">公開設定</label>
                    <select id="visibility" name="visibility" required>
                        <option value="private" <?= old('visibility', 'private') === 'private' ? 'selected' : '' ?>>非公開</option>
                        <option value="public" <?= old('visibility') === 'public' ? 'selected' : '' ?>>公開</option>
                    </select>
                </div>

                <button type="submit" class="save-button">保存する</button>
            </form>

            <p class="back-link">
                <a href="<?= route('toppage') ?>">トップページへ戻る</a>
            </p>
        </section>
    </main>

    <script>
        (function () {
            const placeInput = document.getElementById('place');
            const mapFrame = document.getElementById('place-map');
            const mapsApiKey = <?= json_encode(config('services.google.maps_api_key')) ?>;
            const placeAliases = <?= json_encode(array_filter([
                '自宅' => $user->home_place,
                '実家' => $user->family_home_place,
                '勤務先' => $user->work_place,
                'よく行く場所' => $user->favorite_place,
            ])) ?>;
            const defaultPlace = '東京';
            let timer = null;

            function resolvePlace(place) {
                const trimmed = place.trim();

                if (Object.prototype.hasOwnProperty.call(placeAliases, trimmed) && placeAliases[trimmed]) {
                    return placeAliases[trimmed];
                }

                return trimmed;
            }

            function buildMapUrl(place) {
                const query = resolvePlace(place) || defaultPlace;

                if (mapsApiKey) {
                    return 'https://www.google.com/maps/embed/v1/place'
                        + '?key=' + encodeURIComponent(mapsApiKey)
                        + '&q=' + encodeURIComponent(query)
                        + '&language=ja';
                }

                return 'https://maps.google.com/maps'
                    + '?q=' + encodeURIComponent(query)
                    + '&hl=ja&z=14&output=embed';
            }

            function updateMap() {
                mapFrame.src = buildMapUrl(placeInput.value);
            }

            function applyResolvedPlace() {
                const resolved = resolvePlace(placeInput.value);

                if (resolved && resolved !== placeInput.value.trim()) {
                    placeInput.value = resolved;
                }

                updateMap();
            }

            placeInput.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    const resolved = resolvePlace(placeInput.value);

                    if (resolved && resolved !== placeInput.value.trim()) {
                        placeInput.value = resolved;
                    }

                    updateMap();
                }, 500);
            });

            placeInput.addEventListener('change', applyResolvedPlace);
            placeInput.addEventListener('blur', applyResolvedPlace);

            document.querySelectorAll('.place-preset-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    placeInput.value = button.getAttribute('data-place') || '';
                    updateMap();
                    placeInput.focus();
                });
            });

            updateMap();
        })();
    </script>
</body>

</html>
