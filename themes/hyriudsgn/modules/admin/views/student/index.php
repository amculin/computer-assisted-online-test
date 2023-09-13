<?php
use app\models\BaseUser;
use app\models\UserRegistration;
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
                    <h3>DAFTAR SISWA</h3>
                </div>
            </div>
            <div class="content-oso-box">
                <div class="row">
                    <div class="col-12 col-sm-7 col-md-8 col-lg-8">
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
                                'attribute' => 'full_name',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'user.email',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'sex',
                                'headerOptions' => ['class' => 'text-center'],
                                'content' => function($model, $key, $index, $column) {
                                    return $model->getGenderName();
                                }
                            ],
                            [
                                'attribute' => 'birth_date',
                                'headerOptions' => ['class' => 'text-center'],
                                'format' => ['date', 'php:d F Y']
                            ],
                            [
                                'attribute' => 'school_origin',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'class.name',
                                'header' => 'Kelas',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'user.status',
                                'headerOptions' => ['class' => 'text-center'],
                                'content' => function($model, $key, $index, $column) {
                                    return $model->user->getStatusName();
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
                                'headerOptions' => ['class' => 'text-center'],
                                'template' => '{activate} {change-password} {update} {delete}',
                                'buttons' => [
                                    'activate' => function ($url, $model, $key) {
                                        if ($model->user->status == BaseUser::INACTIVE) {
                                            $url = Url::to(['/admin/student/activate', 'id' => $model->user_id]);
                                            $icon = '<i class="fas fa-check"></i>';
                                            $title = 'Aktifkan';
                                            $confirm = 'Apakah Anda yakin ingin mengaktifkan siswa ' . $model->full_name . '?';
                                        } else {
                                            $url = Url::to(['/admin/student/deactivate', 'id' => $model->user_id]);
                                            $icon = '<i class="fas fa-ban"></i>';
                                            $title = 'Non Aktifkan';
                                            $confirm = 'Apakah Anda yakin ingin menonaktifkan siswa ' . $model->full_name . '?';
                                        }

                                        return Html::a($icon, $url, [
                                            'class' => 'btn btn-mjk btn-xs',
                                            'title' => $title,
                                            'aria-label' => $title,
                                            'data-pjax' => 0,
                                            'data-confirm' => $confirm,
                                            'data-method' => 'post'
                                        ]);
                                    },
                                    'change-password' => function ($url, $model, $key) {
                                        $url = Url::to(['/admin/student/change-password', 'id' => $model->user_id]);
                                        return Html::a('<i class="fas fa-key"></i>', $url, [
                                            'class' => 'btn btn-mjk btn-xs',
                                            'title' => 'Ganti Password'
                                        ]);
                                    },
                                    'update' => function ($url, $model, $key) {
                                        $url = Url::to(['/admin/student/index', 'id' => $model->user_id]);
                                        return Html::a('<i class="far fa-edit"></i>', $url, [
                                            'class' => 'btn btn-mjk btn-xs',
                                            'title' => 'Update'
                                        ]);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        $url = Url::to(['/admin/student/delete', 'id' => $model->user_id]);
                                        return Html::a('<i class="far fa-trash-alt"></i>', $url, [
                                            'title' => 'Hapus',
                                            'class' => 'btn btn-mjk btn-xs',
                                            'aria-label' => 'Hapus',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Apakah Anda yakin ingin menghapus siswa ' . $model->full_name . '?',
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
                    
                    <div class="col-12 col-sm-5 col-md-4 col-lg-4">
                        <?php $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'options' => ['class' => 'form-group row'],
                                'labelOptions' => ['class' => 'control-label col-sm-3 col-form-label'],
                                'template' => "{label}<div class=\"col-sm-9\">{input}</div>{error}"
                            ]
                        ]); ?>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        <?php
                        if ($model->scenario == UserRegistration::CREATE_USER)
                            echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
                        ?>
                        <?= $form->field($dataModel, 'full_name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($dataModel, 'sex')->radioList([
                            1 => 'Laki-laki', 
                            2 => 'Perempuan'
                        ]); ?>

                        <?= $form->field($dataModel, 'birth_date')->widget(\yii\jui\DatePicker::classname(), [
                            'language' => 'id-ID',
                            'dateFormat' => 'yyyy-MM-dd',
                            'clientOptions' => ['changeYear' => true, 'changeMonth' => true],
                            'options' => ['class' => 'form-control']
                        ]); ?>

                        <?= $form->field($dataModel, 'address')->textArea(['maxlength' => true, 'rows' => 3]) ?>
                        <?= $form->field($dataModel, 'phone_number')->textInput(['maxlength' => true]) ?>

                        <?php
                        echo $form->field($dataModel, 'school_origin')->textInput(['maxlength' => true]);

                        echo $form->field($dataModel, 'school_entry_year')->dropDownList($yearList, ['prompt' => 'Pilih Tahun']);

                        echo $form->field($dataModel, 'purpose')->textArea(['maxlength' => true, 'rows' => 3]);

                        echo $form->field($dataModel, 'class_id')->dropDownList($classList, ['prompt' => 'Pilih Kelas']);
                        ?>

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
$js = "$('td:nth-child(1)').css('text-align', 'center');";
$this->registerJs($js);