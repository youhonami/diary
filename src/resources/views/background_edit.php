<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページの背景選択</title>
    <link rel="stylesheet" href="<?= asset('css/background_edit.css') ?>">
</head>

<body>
    <main class="background-edit-page">
        <section class="background-edit-card">
            <div class="background-edit-heading">
                <p class="background-edit-subtitle">Background</p>
                <h1>トップページの背景選択</h1>
                <p>トップページに使う背景テーマを選べます。</p>
            </div>

            <?php if (session('message')): ?>
                <p class="message message-success"><?= e(session('message')) ?></p>
            <?php endif; ?>

            <form action="<?= route('background.update') ?>" method="post" class="background-edit-form" novalidate>
                <?= csrf_field() ?>

                <div class="background-options">
                    <?php foreach ($backgrounds as $value => $label): ?>
                        <?php $isSelected = old('toppage_background', $user->toppage_background ?: 'sky') === $value; ?>
                        <label class="background-option <?= $isSelected ? 'is-selected' : '' ?>">
                            <input
                                type="radio"
                                name="toppage_background"
                                value="<?= e($value) ?>"
                                <?= $isSelected ? 'checked' : '' ?>
                            >
                            <span class="background-swatch background-swatch-<?= e($value) ?>" aria-hidden="true"></span>
                            <span class="background-label"><?= e($label) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <?php if ($errors->has('toppage_background')): ?>
                    <p class="field-error"><?= e($errors->first('toppage_background')) ?></p>
                <?php endif; ?>

                <button type="submit" class="update-button">保存する</button>
            </form>

            <p class="back-link">
                <a href="<?= route('settings') ?>">設定へ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
