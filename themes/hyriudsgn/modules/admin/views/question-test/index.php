<?php
use app\models\TestClass;
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
                    <h3>DAFTAR PERTANYAAN: <?= $model->subTestClass->testClass->class->name; ?> / <?= $model->test_name; ?></h3>
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
                                'attribute' => 'subTestClass.name',
                                'header' => 'Nama Test',
                                'headerOptions' => ['class' => 'text-center']
                            ],
                            [
                                'attribute' => 'description',
                                'headerOptions' => ['class' => 'text-center'],
                                'content' => function ($model, $key, $index, $column) {
                                    if (strlen($model->description) > 50) {
                                        $stringCut = substr($model->description, 0, 50);

                                        return substr($stringCut, 0, strrpos($stringCut, ' ')).' ...'; 
                                    } else
                                        return $model->description;
                                }
                            ],
                            [
                                'attribute' => 'question',
                                'headerOptions' => ['class' => 'text-center'],
                                'content' => function ($model, $key, $index, $column) {
                                    if (strlen($model->question) > 50) {
                                        $stringCut = substr($model->question, 0, 50);

                                        return substr($stringCut, 0, strrpos($stringCut, ' ')).' ...'; 
                                    } else
                                        return $model->question;
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Aksi',
                                'headerOptions' => ['class' => 'text-center'],
                                'template' => '{add-answer} {update} {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        $url = Url::to(['/admin/question-test/index', 'subTestClassId' => $model->sub_test_class_id, 'id' => $model->id]);

                                        return Html::a('<i class="far fa-edit"></i>', $url, [
                                            'title' => 'Update',
                                            'class' => 'btn btn-mjk btn-xs'
                                        ]);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a('<i class="far fa-trash-alt"></i>', $url, [
                                            'title' => 'Hapus',
                                            'class' => 'btn btn-mjk btn-xs',
                                            'aria-label' => 'Hapus',
                                            'data-pjax' => 0,
                                            'data-confirm' => 'Apakah Anda yakin ingin menghapus pertanyaan ini?',
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
                                'template' => "{label}<div class=\"col-sm-10\">{input}{error}</div>"
                            ]
                        ]); ?>

                        <?= $form->field($model, 'test_name')->textInput(['readonly' => true]); ?>
                        <?= $form->field($model, 'sub_test_class_id', ['options' => ['class' => 'invisible'], 'template' => "{input}"])->hiddenInput()->label(false); ?>
                        <?php
                        if ($model->subTestClass->testClass->type == TestClass::ACCURACY_TEST) {
                            echo $form->field($model, 'description', [
                                'template' => "{label}
                                <div class=\"col-sm-8\">
                                    {input}{error}
                                </div>
                                <div class=\"col-sm-2\">
                                    <button class=\"btn btn-info\" data-for=\"questiontest-description\" data-toggle=\"modal\" data-target=\"#symbol-modal\">Simbol</button>
                                </div>"
                            ])->textInput(['maxlength' => true]);
                            
                            echo $form->field($model, 'question', [
                                'template' => "{label}
                                <div class=\"col-sm-8\">
                                    {input}{error}
                                </div>
                                <div class=\"col-sm-2\">
                                    <button class=\"btn btn-info\" data-for=\"questiontest-question\" data-toggle=\"modal\" data-target=\"#symbol-modal\">Simbol</button>
                                </div>"
                            ])->textArea(['maxlength' => true, 'rows' => 4]);

                            for ($i = 0; $i < 5; $i++) {
                                $label = ['A', 'B', 'C', 'D', 'E'];
                                echo $form->field($model, 'answers[]', ['options' => ['class' => 'invisible'], 'template' => "{input}"])->hiddenInput([
                                    'value' => $model->isNewRecord ? $label[$i] : $model->questionAnswers[$i]->answer
                                ])->label(false);
                            }
                        } else if ($model->subTestClass->testClass->type == TestClass::SMART_TEST) {
                            echo $form->field($model, 'description')->textInput(['maxlength' => true]);
                            echo $form->field($model, 'question')->widget(\dosamigos\tinymce\TinyMce::className(), [
                                'options' => ['rows' => 3],
                                'language' => 'en',
                                'clientOptions' => [
                                    'plugins' => [
                                        "advlist autolink lists link charmap print preview anchor",
                                        "searchreplace visualblocks code fullscreen",
                                        "insertdatetime image media table contextmenu paste"
                                    ],
                                    'images_upload_url' => Url::to('/admin/question-test/upload-image'),
                                    'images_reuse_filename' => true,
                                    'toolbar' => "undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | link image"
                                ]
                            ]);

                            for ($i = 0; $i < 5; $i++) {
                                $label = ['A', 'B', 'C', 'D', 'E'];
                                
                                echo $form->field($model, 'answers[]')->widget(\dosamigos\tinymce\TinyMce::className(), [
                                    'options' => [
                                        'rows' => 2,
                                        'id' => 'questiontest-answers-' . $i,
                                        'value' => $model->isNewRecord ? '' : $model->questionAnswers[$i]->answer
                                    ],
                                    'language' => 'en',
                                    'clientOptions' => [
                                        'plugins' => [
                                            "advlist autolink lists link charmap print preview anchor",
                                            "searchreplace visualblocks code fullscreen",
                                            "insertdatetime image media table contextmenu paste"
                                        ],
                                        'images_upload_url' => Url::to('/admin/question-test/upload-image'),
                                        'images_reuse_filename' => true,
                                        'toolbar' => "undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | link image"
                                    ]
                                ])->label('Jawaban ' . $label[$i]);
                            }
                        } else {

                        }
                        
                        echo $form->field($model, 'is_correct_answer')->radioList($answerList);
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

<!-- Button trigger modal -->
<button type="button" id="modal-trigger" class="btn btn-primary" data-toggle="modal" data-target="#symbol-modal">
    Pilih Simbol
</button>

<!-- Modal -->
<div class="modal fade" id="symbol-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Daftar Simbol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="page-1-tab" data-toggle="tab" href="#page-1" role="tab" aria-controls="page-1" aria-selected="true">Page 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="page-2-tab" data-toggle="tab" href="#page-2" role="tab" aria-controls="page-2" aria-selected="false">Page 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="page-3-tab" data-toggle="tab" href="#page-3" role="tab" aria-controls="page-3" aria-selected="false">Page 3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="page-4-tab" data-toggle="tab" href="#page-4" role="tab" aria-controls="page-4" aria-selected="false">Page 4</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="page-5-tab" data-toggle="tab" href="#page-5" role="tab" aria-controls="page-5" aria-selected="false">Page 5</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="page-6-tab" data-toggle="tab" href="#page-6" role="tab" aria-controls="page-6" aria-selected="false">Page 6</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
            <br />
            <?php
            foreach ($symbolList as $key => $val) {
                echo '<div class="tab-pane fade show" id="' . $key . '" role="tabpanel" aria-labelledby="' . $key . '-tab">';
                $i = 1;
                foreach ($val as $index => $value) {
                    echo '<button class="btn-md btn btn-outline-dark symbol-list" title="Pilih '. $value .'" data-orig="' . $value . '">' . $value . '</button>&nbsp;';
                    if ($i % 17 == 0) {
                        echo '<br /><br />';
                    }
                    $i++;
                }
                echo '</div>';
            }
            ?>
            </div>
        </div>
        <div class="modal-footer" style="padding: 20px 15px 20px !important">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
        </div>
    </div>
</div>
<?php
$js = "
$('td:nth-child(1)').css('text-align', 'center');
$('.modal-body button').css('width', '40px');
$('td:nth-child(3), td:nth-child(4)').css('text-align', 'left');
$('#page-1').addClass('active');
$('form button').click(function() {
    var fieldTarget = $(this).attr('data-for');

    $('#symbol-modal').attr('data-field-target', fieldTarget);
});

$('#symbol-modal button.symbol-list').click(function() {
    var value = $(this).attr('data-orig');
    var target = $('#symbol-modal').attr('data-field-target');
    var fieldValue = $('#' + target).val() + value;
    console.log(fieldValue);

    $('#' + target).val(fieldValue);
})
";
$this->registerJs($js);