<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BaseClass */

$this->title = 'Create Base Class';
$this->params['breadcrumbs'][] = ['label' => 'Base Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
