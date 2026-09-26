<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>他のユーザーのアルバムを見る</title>
    <link rel="stylesheet" href="<?= asset('css/album.css') ?>?v=<?= filemtime(public_path('css/album.css')) ?>">
</head>

<body>
    <?php $theme = ($user->toppage_background ?? null) ?: 'sky'; ?>
    <main class="album-page">
        <section class="album-card album-card-<?= e($theme) ?>">
            <div class="album-heading">
                <p class="album-subtitle">Browse Albums</p>
                <h1>他のユーザーのアルバムを見る</h1>
                <p>みんなが公開したアルバムを見て、写真の思い出に触れてみましょう。</p>
            </div>

            <?php if ($albums->isEmpty()): ?>
                <p class="empty-message">公開されているアルバムはまだありません。</p>
            <?php else: ?>
                <div class="album-list">
                    <?php foreach ($albums as $album): ?>
                        <article class="album-item">
                            <div class="album-item-header">
                                <div>
                                    <p class="album-item-date"><?= e($album->album_date->format('Y年n月j日')) ?></p>
                                    <h3 class="album-item-title"><?= e($album->title) ?></h3>
                                    <p class="album-item-author">
                                        <?= e($album->user->username ?: $album->user->name) ?>
                                    </p>
                                </div>
                            </div>

                            <?php if ($album->images->isEmpty()): ?>
                                <p class="form-note">写真はまだありません。</p>
                            <?php else: ?>
                                <div class="album-item-images album-item-images-readonly">
                                    <?php foreach ($album->images as $image): ?>
                                        <img src="<?= asset($image->path) ?>" alt="<?= e($album->title) ?>">
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
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
