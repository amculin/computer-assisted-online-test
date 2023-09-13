<div class="score-ego-box">
    <div class="score-ego">
        <div class="score-ego-label">
            <h5><?= $model->subTestClass->name; ?></h5>
            <h3><?= $model->subTestClass->description; ?></h3>
            <p><?= ($model->subTestClass->limit_time / 60); ?> menit</p>
        </div>
        <div class="score-ego-primary">
            <div class="score-ego-primary-value">
                <h5>Nilai</h5>
                <h3><?= $model->total_score; ?></h3>
            </div>
        </div>
        <div class="score-ego-info">
            <div class="score-ego-info-value">
                <h5>Jumlah soal</h5>
                <h3><?= $model->subTestClass->number_of_question; ?></h3>
            </div>
            <div class="score-ego-info-value">
                <h5>Jumlah dikerjakan</h5>
                <h3><?= $model->total_answered; ?></h3>
            </div>
        
            <?php if ($model->subTestClass->testClass->type != \app\models\TestClass::PERSONALITY_TEST) { ?>
                <div class="score-ego-info-value">
                    <h5>Jumlah Benar</h5>
                    <h3><?= $model->total_correct; ?></h3>
                </div>
                <div class="score-ego-info-value">
                    <h5>Jumlah Salah</h5>
                    <h3><?= $model->total_wrong; ?></h3>
                </div>
            <?php } ?>
            <div class="score-ego-info-value">
                <h5>Lama Mengerjakan</h5>
                <h3><?= $model->getConvertedTime(); ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="action-global-box">
    <a class="btn btn-mjk" href="<?= \Yii::$app->urlManager->createAbsoluteUrl('student/score/index'); ?>" title="">REKAPAN NILAI</a>
</div>