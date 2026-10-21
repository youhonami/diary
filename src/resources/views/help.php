<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ヘルプ</title>
    <link rel="stylesheet" href="<?= asset('css/static_page.css') ?>?v=<?= filemtime(public_path('css/static_page.css')) ?>">
    <link rel="stylesheet" href="<?= asset('css/app_header.css') ?>?v=<?= filemtime(public_path('css/app_header.css')) ?>">
</head>

<body>
    <?php
        $theme = (auth()->user()?->toppage_background ?? null) ?: 'sky';
        $isLoggedIn = auth()->check();
        $helpTopics = [
            'write' => [
                'label' => '日記を書く',
                'notes' => [
                    'タイトル、日付、出来事は必須です。',
                    '同じ日に複数の日記を保存できます。',
                    '場所の「非公開」を選ぶと、場所は保存されません。',
                    '公開にすると、他のユーザーが「日記を読む」から見られます。',
                ],
            ],
            'lookback' => [
                'label' => '日記を見返す',
                'notes' => [
                    '日記がある日付だけ、詳細を開けます。',
                    '編集と削除ができるのは、自分の日記だけです。',
                    '削除した日記は元に戻せません。',
                ],
            ],
            'map' => [
                'label' => '地図から日記を見返す',
                'notes' => [
                    '場所を入力した日記だけが表示されます。',
                    '場所の書き方が違うと、同じ場所でも別の項目になります。',
                ],
            ],
            'read' => [
                'label' => '日記を読む',
                'notes' => [
                    '他のユーザーが公開した日記だけが表示されます。',
                    '自分の日記と、非公開の日記は表示されません。',
                ],
            ],
            'album' => [
                'label' => 'アルバム',
                'notes' => [
                    '画像は1つのアルバムにつき最大5枚、各2MB以下です。',
                    '登録時の公開設定は、初期値では非公開です。',
                    '写真をすべて削除すると、アルバムも削除されます。',
                    '公開にすると、他のユーザーのアルバム一覧に表示されます。',
                ],
            ],
            'album-browse' => [
                'label' => '他のユーザーのアルバムを見る',
                'notes' => [
                    '公開されている、他のユーザーのアルバムだけが表示されます。',
                    '自分のアルバムと、非公開のアルバムは表示されません。',
                ],
            ],
            'other' => [
                'label' => 'その他',
                'notes' => [
                    'ヘルプで解決できない場合は、問い合わせ先に連絡してください。',
                    '退会はログインページの退会するから申請してください。',
                    '不適切な投稿を発見した際はお問い合わせフォームからご連絡ください。',
                ],
            ],
        ];
    ?>
    <main class="static-page">
        <section class="static-card static-card-wide static-card-<?= e($theme) ?>">
            <?php echo view('partials.app_header')->render(); ?>
            <div class="static-heading">
                <p class="static-subtitle">Help</p>
                <h1>ヘルプ</h1>
                <p>項目を選ぶと、その下に注意事項が表示されます。</p>
            </div>

            <div class="help-list">
                <?php foreach ($helpTopics as $id => $topic): ?>
                    <div class="help-item">
                        <button
                            type="button"
                            class="help-topic"
                            id="help-tab-<?= e($id) ?>"
                            aria-controls="help-panel-<?= e($id) ?>"
                            aria-expanded="false"
                        >
                            <?= e($topic['label']) ?>
                        </button>
                        <section
                            class="help-panel"
                            id="help-panel-<?= e($id) ?>"
                            aria-labelledby="help-tab-<?= e($id) ?>"
                            hidden
                        >
                            <ul>
                                <?php foreach ($topic['notes'] as $note): ?>
                                    <li><?= e($note) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </section>
                    </div>
                <?php endforeach; ?>
            </div>

            <p class="page-actions">
                <?php if ($isLoggedIn): ?>
                    <a class="back-link" href="<?= route('toppage') ?>">トップページへ戻る</a>
                <?php else: ?>
                    <a class="back-link" href="<?= route('login.index') ?>">ログインページに戻る</a>
                <?php endif; ?>
            </p>
        </section>
    </main>
    <?php echo view('partials.app_footer')->render(); ?>

    <script>
        (function () {
            const topics = document.querySelectorAll('.help-topic');

            topics.forEach(function (topic) {
                topic.addEventListener('click', function () {
                    const panel = document.getElementById(topic.getAttribute('aria-controls'));
                    const willOpen = panel.hidden;

                    topics.forEach(function (button) {
                        const otherPanel = document.getElementById(button.getAttribute('aria-controls'));
                        button.setAttribute('aria-expanded', 'false');
                        otherPanel.hidden = true;
                    });

                    if (willOpen) {
                        topic.setAttribute('aria-expanded', 'true');
                        panel.hidden = false;
                    }
                });
            });
        })();
    </script>
</body>

</html>
