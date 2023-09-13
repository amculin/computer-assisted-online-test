<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
?>

<div class="row">
    <div class="col-12">
        <div class="widget-oso-content-box">
            <div class="header-oso-title-box">
                <div class="header-oso-title">
                    <h3>DAFTAR TES</h3>
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
                                'attribute' => 'testClass.class.name',
                                'header' => 'Nama Kelas',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'testClass.name',
                                'header' => 'Jenis Tes',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'name',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'number_of_question',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'limit_time',
                                'headerOptions' => ['class' => 'text-center'],
                                'content' => function($model, $key, $index, $column) {
                                    return $model->getConvertedTime();
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
                                'headerOptions' => ['class' => 'text-center'],
                                'template' => '{add-question} {update} {delete}',
                                'buttons' => [
                                    'add-question' => function($url, $model, $key) {
                                        $url = Url::to(['/admin/question-test/', 'subTestClassId' => $model->id]);
                                        return Html::a('<i class="fas fa-question"></i>', $url, [
                                            'class' => 'btn btn-mjk btn-xs',
                                            'title' => 'Lihat Pertanyaan'
                                        ]);
                                    },
                                    'update' => function ($url, $model, $key) {
                                        $url = Url::to(['/admin/test/index', 'id' => $model->id]);
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
                                            'data-confirm' => 'Apakah Anda yakin ingin menghapus jenis tes ' . $model->name . '?',
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
                                'labelOptions' => ['class' => 'control-label col-sm-2 col-form-label'],
                                'template' => "{label}<div class=\"col-sm-10\">{input}</div>{error}"
                            ]
                        ]); ?>

                        <?= $form->field($model, 'test_class_id')->dropDownList($testClassList, ['prompt' => 'Pilih Jenis Tes']); ?>
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'rows' => 3]) ?>
                        <?= $form->field($model, 'limit_time')->textInput(['maxlength' => true])->label('Batas Waktu (detik)') ?>

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
$js = "$('td:nth-child(1), td:nth-child(5)').css('text-align', 'center');";
$this->registerJs($js);