<div class="title-page-box mb-5">
    <div class="title-primary">
        <h1>REKAP NILAI</h1>
        <div class="lines"></div>
    </div>
</div>
<div class="question-primary-list">
    <ul>
    <?php foreach($model as $key => $val) { ?>
        <li>
            <div class="card-secondquest-box">
                <div class="card-secondquest">
                    <div class="card-secondquest-label">
                        <h5><?= $val->subTestClass->name; ?></h5>
                        <h3><?= $val->subTestClass->description; ?></h3>
                        <div class="secondquest-label-info">
                            <p><?= ($val->subTestClass->limit_time / 60); ?> menit</p>
                        </div>
                    </div>
                    <div class="card-secondquest-info">
                        <!-- <div class="secondquest-info-col mr-4">
                            <div class="secondquest-info-item">
                                <h5>Tanggal</h5>
                                <h6>02-07-2021</h6>
                            </div>
                        </div> -->
                        <div class="secondquest-info-col mr-4">
                            <div class="secondquest-info-item mb-3">
                                <h5>Dikerjakan</h5>
                                <h3><?= $val->total_answered; ?></h3>
                            </div>
                            <div class="secondquest-info-subcol">
                                <div class="secondquest-info-item mr-4">
                                    <h5>Benar</h5>
                                    <h3><?= $val->total_correct; ?></h3>
                                </div>
                                <div class="secondquest-info-item">
                                    <h5>Salah</h5>
                                    <h3><?= $val->total_wrong; ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="secondquest-info-col score">
                            <div class="secondquest-info-item">
                                <h5>Nilai</h5>
                                <h3><?= $val->total_score; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    <?php } ?>
    </ul>
</div>

<div class="mt-3">
	<nav aria-label="pagination">
    <?php
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
            'linkOptions' => ['class' => 'page-link'],
            'linkContainerOptions' => ['class' => 'page-item'],
            'prevPageLabel' => 'Sebelumnya',
            'nextPageLabel' => 'Selanjutnya',
            'disabledListItemSubTagOptions' => ['tag' => 'span', 'class' => 'page-link']
        ]);
        ?>
	</nav>
</div>