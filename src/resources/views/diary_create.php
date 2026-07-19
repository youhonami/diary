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
    <h1>日記を書く</h1>

    <?php if ($errors->any()): ?>
        <ul>
            <?php foreach ($errors->all() as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= route('diary.store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" value="<?= e(old('title')) ?>" required>
        </div>

        <div class="form-group">
            <label for="diary_date">日付</label>
            <input type="date" id="diary_date" name="diary_date" value="<?= e(old('diary_date')) ?>" required>
        </div>

        <div class="form-group">
            <label for="place">場所</label>
            <input type="text" id="place" name="place" value="<?= e(old('place')) ?>">
        </div>

        <div class="form-group">
            <label for="event">出来事</label>
            <textarea id="event" name="event" required><?= e(old('event')) ?></textarea>
        </div>

        <div class="form-group">
            <label for="good_thing">良かったこと</label>
            <textarea id="good_thing" name="good_thing" required><?= e(old('good_thing')) ?></textarea>
        </div>

        <div class="form-group">
            <label for="visibility">公開設定</label>
            <select id="visibility" name="visibility" required>
                <option value="private" <?= old('visibility', 'private') === 'private' ? 'selected' : '' ?>>非公開</option>
                <option value="public" <?= old('visibility') === 'public' ? 'selected' : '' ?>>公開</option>
            </select>
        </div>

        <button type="submit">保存する</button>
    </form>

    <p>
        <a href="<?= route('toppage') ?>">トップページへ戻る</a>
    </p>
</body>

</html>
