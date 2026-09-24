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
                <p>このページは後日作成予定です。</p>
            </div>

            <p class="page-actions">
                <a class="back-link" href="<?= route('toppage') ?>">トップページへ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
