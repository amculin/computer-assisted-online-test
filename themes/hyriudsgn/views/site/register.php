<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>

<div class="layout-login-row">
    <div class="layout-register-col-img">
		<img class="bg-register-img" src="images/dummy/img-13.jpg" alt="" />
	</div>
    <div class="layout-register-col-desc">
		<div class="register-box">
			<div class="register-header">
				<h1>TARUNA EDUCATION</h1>
				<h2>PENDAFTARAN</h2>
			</div>
			<div class="register-form">
                <?php
                if (Yii::$app->session->hasFlash('success-registration')) {
                    echo '<div class="alert alert-success lead" role="alert">' . Yii::$app->session->getFlash('success-registration') . '</div>';
                }
                
                $form = ActiveForm::begin([
                    'id' => 'form-register',
                ]); ?>
                
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <?php
                        echo $form->field($userModel, 'email', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->textInput();
                        
                        echo $form->field($userModel, 'password', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->passwordInput();
                        
                        echo $form->field($userDataModel, 'full_name', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->textInput();
                        
                        echo $form->field($userDataModel, 'sex', [
                            'options' => ['class' => 'form-group form-group-mjk mb-0'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->radioList([
                            1 => 'Laki-laki', 
                            2 => 'Perempuan'
                        ]);

                        echo $form->field($userDataModel, 'birth_date', [
                            'options' => ['class' => 'form-group form-group-mjk mb-0'],
                            'template' => "{label}<br />{input}\n{error}"
                        ])->widget(\yii\jui\DatePicker::classname(), [
                            'language' => 'id-ID',
                            'dateFormat' => 'yyyy-MM-dd',
                            'options' => ['class' => 'form-control'],
                            'clientOptions' => ['changeYear' => true, 'changeMonth' => true],
                        ]);
                        
                        echo $form->field($userDataModel, 'address', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->textArea();
                        
                        echo $form->field($userDataModel, 'phone_number', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->textInput();
                        ?>
					</div>

					<div class="col-12 col-lg-6">
                        <?php
                        echo $form->field($userDataModel, 'school_origin', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->textInput();

                        echo $form->field($userDataModel, 'school_entry_year', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->dropDownList($yearList, ['prompt' => 'Pilih Tahun']);

                        echo $form->field($userDataModel, 'purpose', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->textArea();

                        echo $form->field($userDataModel, 'class_id', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->dropDownList($classList, ['prompt' => 'Pilih Kelas']);
                        ?>
                    </div>
                </div>

                <div class="mt-3 mb-3">
                    <button type="submit" class="btn btn-mjk w-100" title="submit">DAFTAR</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <img class="bg-register-desc" src="images/dummy/img-13.jpg" alt="" />
</div>