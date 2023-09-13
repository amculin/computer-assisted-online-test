<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
?>

<div class="row">
    <div class="col-12">
        <div class="widget-oso-top-control-box">
            <div class="widget-oso-top-control">
                <a href="<?= Url::to('/admin/score/download'); ?>" class="btn btn-mjk btn-sm" title=""><i class="far fa-file-excel mr-2"></i> DOWNLOAD</a>
            </div>
        </div>
        <div class="widget-oso-content-box">
            <div class="header-oso-title-box">
                <div class="header-oso-title">
                    <h3>REKAP NILAI</h3>
                </div>
            </div>
            <div class="content-oso-box">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <?php

                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => ['class' => 'table-go-box table-responsive'],
                        'tableOptions' => ['class' => 'table table-bordered table-hover'],
                        'layout' => "{items}\n{pager}",
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No.',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'testeesData.full_name',
                                'header' => 'Nama Siswa',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'testeesData.class.name',
                                'header' => 'Kelas'
                            ],
                            [
                                'attribute' => 'subTestClass.name',
                                'header' => 'Nama Tes',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'total_answered',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'total_correct',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'total_wrong',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'total_score',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'total_time',
                                'headerOptions' => ['class' => 'text-center'],
                                'content' => function ($model, $key, $index, $column) {
                                    $hour = floor($model->total_time / 3600);
                                    $minute = floor(($model->total_time % 3600) / 60);
                                    $second = ($model->total_time %3600) % 60;

                                    return str_pad($hour, 2, 0, STR_PAD_LEFT) . ':' . str_pad($minute, 2, 0, STR_PAD_LEFT) . ':' . str_pad($second, 2, 0, STR_PAD_LEFT);
                                }
                            ],
                        ],
                        'pager' => [
                            'linkOptions' => ['class' => 'page-link'],
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'prevPageLabel' => 'Sebelumnya',
                            'nextPageLabel' => 'Selanjutnya',
                            'disabledListItemSubTagOptions' => ['tag' => 'span', 'class' => 'page-link']
                        ],
                    ]);
                    ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
$js = "$('td:nth-child(1), td:nth-child(5), td:nth-child(6), td:nth-child(7), td:nth-child(8)').css('text-align', 'center');";
$this->registerJs($js);