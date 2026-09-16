<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アルバム</title>
    <link rel="stylesheet" href="<?= asset('css/album.css') ?>?v=<?= filemtime(public_path('css/album.css')) ?>">
</head>

<body>
    <?php $theme = ($user->toppage_background ?? null) ?: 'sky'; ?>
    <main class="album-page">
        <section class="album-card album-card-<?= e($theme) ?>">
            <div class="album-heading">
                <p class="album-subtitle">Album</p>
                <h1>アルバム</h1>
                <p>日付・タイトル・画像を登録して、思い出を残せます。</p>
            </div>

            <?php if (session('message')): ?>
                <p class="message message-success"><?= e(session('message')) ?></p>
            <?php endif; ?>

            <form action="<?= route('album.store') ?>" method="post" enctype="multipart/form-data" class="album-form" novalidate>
                <?= csrf_field() ?>

                <div class="form-row">
                    <div class="form-group">
                        <label for="album_date">日付 <span class="required-mark">必須</span></label>
                        <input
                            type="date"
                            id="album_date"
                            name="album_date"
                            value="<?= e(old('album_date', now()->format('Y-m-d'))) ?>"
                            class="<?= $errors->has('album_date') ? 'is-invalid' : '' ?>"
                        >
                        <?php if ($errors->has('album_date')): ?>
                            <p class="field-error"><?= e($errors->first('album_date')) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="title">タイトル <span class="required-mark">必須</span></label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="<?= e(old('title')) ?>"
                            placeholder="旅行、誕生日など"
                            class="<?= $errors->has('title') ? 'is-invalid' : '' ?>"
                        >
                        <?php if ($errors->has('title')): ?>
                            <p class="field-error"><?= e($errors->first('title')) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="images">画像 <span class="required-mark">必須</span></label>
                    <input
                        type="file"
                        id="images"
                        name="images[]"
                        accept="image/*"
                        multiple
                        class="<?= $errors->has('images') || $errors->has('images.*') ? 'is-invalid' : '' ?>"
                    >
                    <p class="form-note">最大5枚まで、各2MB以下の画像を選択できます。</p>
                    <?php if ($errors->has('images')): ?>
                        <p class="field-error"><?= e($errors->first('images')) ?></p>
                    <?php endif; ?>
                    <?php if ($errors->has('images.*')): ?>
                        <p class="field-error"><?= e($errors->first('images.*')) ?></p>
                    <?php endif; ?>
                    <div id="image-preview" class="image-preview" hidden></div>
                </div>

                <button type="submit" class="save-button">登録する</button>
            </form>

            <div class="album-list-heading">
                <h2>登録済みアルバム</h2>
            </div>

            <?php if ($albums->isEmpty()): ?>
                <p class="empty-message">まだアルバムはありません。</p>
            <?php else: ?>
                <div class="album-list">
                    <?php foreach ($albums as $album): ?>
                        <article class="album-item">
                            <div class="album-item-header">
                                <div>
                                    <p class="album-item-date"><?= e($album->album_date->format('Y年n月j日')) ?></p>
                                    <h3 class="album-item-title"><?= e($album->title) ?></h3>
                                </div>
                                <form action="<?= route('album.destroy', ['album' => $album]) ?>" method="post" onsubmit="return confirm('このアルバムを削除しますか？');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="delete-button">削除</button>
                                </form>
                            </div>
                            <div class="album-item-images">
                                <?php foreach ($album->images as $image): ?>
                                    <img src="<?= asset($image->path) ?>" alt="<?= e($album->title) ?>">
                                <?php endforeach; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <p class="page-actions">
                <a class="back-link" href="<?= route('toppage') ?>">トップページへ戻る</a>
            </p>
        </section>
    </main>

    <script>
        (function () {
            const input = document.getElementById('images');
            const preview = document.getElementById('image-preview');

            input.addEventListener('change', function () {
                preview.innerHTML = '';
                const files = Array.from(input.files || []);

                if (files.length === 0) {
                    preview.hidden = true;
                    return;
                }

                preview.hidden = false;

                files.slice(0, 5).forEach(function (file) {
                    if (! file.type.startsWith('image/')) {
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.alt = file.name;
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            });
        })();
    </script>
</body>

</html>
