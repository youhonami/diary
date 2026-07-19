<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日記を見返す</title>
    <link rel="stylesheet" href="<?= asset('css/diary_lookback.css') ?>">
</head>

<body>
    <h1>日記を見返す</h1>

    <?php if (session('message')): ?>
        <p><?= e(session('message')) ?></p>
    <?php endif; ?>

    <div class="calendar-nav">
        <a href="<?= route('diary.lookback', ['month' => $previousMonth]) ?>">前の月</a>
        <strong><?= e($currentMonth->format('Y年n月')) ?></strong>
        <a href="<?= route('diary.lookback', ['month' => $nextMonth]) ?>">次の月</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($weeks as $week): ?>
                <tr>
                    <?php foreach ($week as $date): ?>
                        <?php
                            $dateKey = $date->format('Y-m-d');
                            $dateDiaries = $diaries->get($dateKey);
                        ?>
                        <td class="<?= $date->isSameMonth($currentMonth) ? '' : 'outside-month' ?>">
                            <?php if ($dateDiaries): ?>
                                <a class="diary-link" href="<?= route('diary.show', ['date' => $dateKey]) ?>">
                                    <?= e($date->day) ?>
                                    <span class="calendar-label"><?= e($dateDiaries->count()) ?>件の日記</span>
                                    <span class="calendar-label"><?= e($dateDiaries->first()->title) ?></span>
                                </a>
                            <?php else: ?>
                                <?= e($date->day) ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>
        <a href="<?= route('diary.create') ?>">日記を書く</a>
    </p>

    <p>
        <a href="<?= route('toppage') ?>">トップページへ戻る</a>
    </p>
</body>

</html>
