<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;
?>

<div class="row">
    <div class="col-12">
        <div class="widget-oso-content-box">
            <div class="header-oso-title-box">
                <div class="header-oso-title">
                    <h3>DAFTAR SESI TES</h3>
                </div>
            </div>
            <div class="content-oso-box">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-9 col-lg-7">
                    <?php
                    if (Yii::$app->session->hasFlash('success-manage-class')) {
                        echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('success-manage-class') . '</div>';
                    }

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
                                'attribute' => 'session_name',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'start_time',
                                'headerOptions' => ['class' => 'text-center'],
                                'content' => function($model, $key, $index, $column) {
                                    return $model->getConvertedTime($model->start_time);
                                }
                            ],
                            [
                                'attribute' => 'end_time',
                                'headerOptions' => ['class' => 'text-center'],
                                'content' => function($model, $key, $index, $column) {
                                    return $model->getConvertedTime($model->end_time);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
                                'headerOptions' => ['class' => 'text-center'],
                                'template' => '{update} {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        $url = Url::to(['/admin/test-session/index', 'id' => $model->id]);
                                        return Html::a('<i class="far fa-edit"></i>', $url, [
                                            'class' => 'btn btn-mjk btn-xs',
                                            'title' => 'Update'
                                        ]);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a('<i class="far fa-trash-alt"></i>', $url, [
                                            'title' => 'Hapus',
                                            'class' => 'btn btn-mjk btn-xs',
                                            'aria-label' => 'Hapus',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Apakah Anda yakin ingin menghapus sesi tes ' . $model->session_name . '?',
                                            'data-method' => 'post'
                                        ]);
                                    }
                                ]
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
                    <div class="col-12 col-sm-4 col-md-3 col-lg-5">
                        <?php $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'options' => ['class' => 'form-group row'],
                                'labelOptions' => ['class' => 'control-label col-sm-3 col-form-label'],
                                'template' => "{label}<div class=\"col-sm-9\">{input}</div>{error}"
                            ]
                        ]); ?>

                        <?= $form->field($model, 'session_name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'start_time_picker')->widget(DateTimePicker::classname(), [
                            'options' => ['class' => 'form-control'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd MM yyyy, hh:ii'
                            ]
                        ]); ?>
                        <?= $form->field($model, 'end_time_picker')->widget(DateTimePicker::classname(), [
                            'options' => ['class' => 'form-control'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd MM yyyy, hh:ii'
                            ]
                        ]); ?>

                        <div class="my-3 text-center">
                            <button type="submit" class="btn btn-mjk btn-sm" title="">SIMPAN</button>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<?php
$js = "$('td:nth-child(3)').css('text-align', 'center');";
$this->registerJs($js);