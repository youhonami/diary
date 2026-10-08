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
                <p>ご質問は、以下の連絡先までお願いします。</p>
            </div>

            <dl class="contact-list">
                <div class="contact-item">
                    <dt>宛名</dt>
                    <dd>日記アプリ 運営事務局</dd>
                </div>
                <div class="contact-item">
                    <dt>電話番号</dt>
                    <dd><a href="tel:0300000000">03-0000-0000</a></dd>
                </div>
                <div class="contact-item">
                    <dt>メールアドレス</dt>
                    <dd><a href="mailto:contact@example.com">contact@example.com</a></dd>
                </div>
            </dl>

            <section class="contact-notes" aria-label="注意事項">
                <h2>注意事項</h2>
                <ul>
                    <li>返答は３営業日以内に行います</li>
                    <li>営業のご連絡はご遠慮ください</li>
                </ul>
            </section>
        </section>
    </main>
    <?php echo view('partials.app_footer')->render(); ?>
</body>

</html>
