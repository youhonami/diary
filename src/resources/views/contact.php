<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ先</title>
    <link rel="stylesheet" href="<?= asset('css/static_page.css') ?>?v=<?= filemtime(public_path('css/static_page.css')) ?>">
    <link rel="stylesheet" href="<?= asset('css/app_header.css') ?>?v=<?= filemtime(public_path('css/app_header.css')) ?>">
</head>

<body>
    <?php $theme = (auth()->user()->toppage_background ?? null) ?: 'sky'; ?>
    <main class="static-page">
        <section class="static-card static-card-<?= e($theme) ?>">
            <?php echo view('partials.app_header')->render(); ?>
            <div class="static-heading">
                <p class="static-subtitle">Contact</p>
                <h1>お問い合わせ先</h1>
                <p>このページは後日作成予定です。</p>
            </div>
        </section>
    </main>
    <?php echo view('partials.app_footer')->render(); ?>
</body>

</html>
