<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>

<div class="layout-login-row">
    <div class="layout-login-col-img">
        <img class="bg-login-img" src="images/dummy/img-13.jpg" alt="" />
    </div>
    <div class="layout-login-col-desc">
        <div class="login-box">
            <div class="login-header">
                <div class="col-sm-4 d-flex justify-content-center"><img src="images/logo/logo-taruna-education.png" alt="Logo Taruna Education" class="img-fluid" /></div>
                <div class="col-sm-8">
                    <h1>TARUNA EDUCATION</h1>
                    <h2>LOGIN</h2>
                </div>
            </div>
            <div class="login-form">                    
                <?php $form = ActiveForm::begin([
                    'id' => 'form-login',
                ]); ?>
                <div class="row" style="margin-left: 0px !important;">
                    <div class="col-12">
                        <?= $form->field($model, 'username', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->textInput() ?>
                    </div>
                    <div class="col-12">
                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'form-group form-group-mjk'],
                            'template' => "{label}\n{input}\n{error}"
                        ])->passwordInput() ?>
                    </div>
                </div>

                <div class="mt-3 mb-3">
                    <button type="submit" class="btn btn-mjk w-100" title="submit">MASUK</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="login-footer">
                <div class="mb-4">
                    <div class="title-login-footer center">
                        <h5>Belum memiliki akun? <a href="<?= Url::to(['site/register']) ?>" title="">DAFTAR</a> disini </h5>
                    </div>
                </div>
            </div>
        </div>
        <img class="bg-login-desc" src="images/dummy/img-13.jpg" alt="" />
    </div>
</div>