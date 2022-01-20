<?php
use yii\helpers\Url;
?>
<div class="title-page-box mb-5">
    <div class="title-primary">
        <h1><?= $title; ?></h1>
        <div class="lines"></div>
    </div>
    <p>Pilih sesuai urutan</p>
</div>

<div class="question-primary-list">
    <ul>
        <?php foreach ($model as $key => $val) { ?>
            <li>
                <div class="card-mainquest-box">
                    <div class="card-mainquest">
                        <div class="card-mainquest-label">
                            <h5><?= strtoupper($val->name); ?></h5>
                            <h3><?= $val->description; ?></h3>
                        </div>
                        <div class="card-mainquest-info">
                            <!-- <div class="mainquest-info-item mr-4">
                                <h5>Jumlah Soal</h5>
                                <h3>500</h3>
                            </div> -->
                            <div class="mainquest-info-item">
                                <h5>Durasi</h5>
                                <h3><?= ($val->limit_time / 60); ?> <span>menit</span></h3>
                            </div>
                        </div>
                        <div class="card-mainquest-action">
                            <?php
                            //echo $val->type;
                            if ($val->test_type == $val::ACCURACY_TEST)
                                $url = Url::toRoute(['/student/accuracy-test', 'subTestClassId' => $val->id]);
                            else if ($val->test_type == $val::SMART_TEST)
                                $url = Url::toRoute(['/student/smart-test', 'subTestClassId' => $val->id]);
                            else
                                $url = Url::toRoute(['/student/personality-test', 'subTestClassId' => $val->id]);
                            ?>
                            <a class="btn btn-mjk" href="<?= $url; ?>" title="">MULAI</a>
                        </div>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<!-- <ul class="pagination">
    <li class="prev disabled"><span>«</span></li>
    <li class="active"><a href="/student/sub-test-list/index?testClassId=1&amp;page=1&amp;per-page=1" data-page="0">1</a></li>
    <li><a href="/student/sub-test-list/index?testClassId=1&amp;page=2&amp;per-page=1" data-page="1">2</a></li>
    <li class="next"><a href="/student/sub-test-list/index?testClassId=1&amp;page=2&amp;per-page=1" data-page="1">»</a></li>
</ul> -->
<div class="mt-3">
	<nav aria-label="pagination">
    <?php
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
            'linkOptions' => ['class' => 'page-link'],
            'linkContainerOptions' => ['class' => 'page-item'],
            'prevPageLabel' => 'Previous',
            'nextPageLabel' => 'Next',
            'disabledListItemSubTagOptions' => ['tag' => 'span', 'class' => 'page-link']
        ]);
        ?>
	</nav>
</div>