<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日記を編集</title>
    <link rel="stylesheet" href="<?= asset('css/diary_edit.css') ?>">
</head>

<body>
    <main class="diary-edit-page">
        <section class="diary-edit-card">
            <div class="diary-edit-heading">
                <p class="diary-edit-subtitle">Edit Diary</p>
                <h1>日記を編集</h1>
                <p>内容を修正して、更新してください。</p>
            </div>

            <?php if ($errors->any()): ?>
                <ul class="message message-error">
                    <?php foreach ($errors->all() as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="<?= route('diary.update', ['diary' => $diary]) ?>" method="post" class="diary-edit-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" id="title" name="title" value="<?= e(old('title', $diary->title)) ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="diary_date">日付</label>
                        <input type="date" id="diary_date" name="diary_date" value="<?= e(old('diary_date', $diary->diary_date->format('Y-m-d'))) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="place">場所</label>
                        <input type="text" id="place" name="place" value="<?= e(old('place', $diary->place)) ?>" placeholder="自宅、公園、カフェなど">
                    </div>
                </div>

                <div class="form-group">
                    <label for="event">出来事</label>
                    <textarea id="event" name="event" required><?= e(old('event', $diary->event)) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="good_thing">良かったこと</label>
                    <textarea id="good_thing" name="good_thing" required><?= e(old('good_thing', $diary->good_thing)) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="visibility">公開設定</label>
                    <select id="visibility" name="visibility" required>
                        <option value="private" <?= old('visibility', $diary->visibility) === 'private' ? 'selected' : '' ?>>非公開</option>
                        <option value="public" <?= old('visibility', $diary->visibility) === 'public' ? 'selected' : '' ?>>公開</option>
                    </select>
                </div>

                <button type="submit" class="save-button">更新する</button>
            </form>

            <p class="back-link">
                <a href="<?= route('diary.show', ['date' => $diary->diary_date->format('Y-m-d')]) ?>">詳細ページへ戻る</a>
            </p>
        </section>
    </main>
</body>

</html>
