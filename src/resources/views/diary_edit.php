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

            <form action="<?= route('diary.update', ['diary' => $diary]) ?>" method="post" class="diary-edit-form" novalidate>
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="title">タイトル <span class="required-mark">必須</span></label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="<?= e(old('title', $diary->title)) ?>"
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
                            value="<?= e(old('diary_date', $diary->diary_date->format('Y-m-d'))) ?>"
                            class="<?= $errors->has('diary_date') ? 'is-invalid' : '' ?>"
                        >
                        <?php if ($errors->has('diary_date')): ?>
                            <p class="field-error"><?= e($errors->first('diary_date')) ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="place">場所</label>
                        <input type="text" id="place" name="place" value="<?= e(old('place', $diary->place)) ?>" placeholder="自宅、公園、カフェなど">
                    </div>
                </div>

                <div class="form-group">
                    <label for="event">出来事 <span class="required-mark">必須</span></label>
                    <textarea
                        id="event"
                        name="event"
                        placeholder="今日はどんなことがありましたか？"
                        class="<?= $errors->has('event') ? 'is-invalid' : '' ?>"
                    ><?= e(old('event', $diary->event)) ?></textarea>
                    <?php if ($errors->has('event')): ?>
                        <p class="field-error"><?= e($errors->first('event')) ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="good_thing">良かったこと</label>
                    <textarea id="good_thing" name="good_thing" placeholder="嬉しかったこと、感謝したことを書いてみましょう。"><?= e(old('good_thing', $diary->good_thing)) ?></textarea>
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
