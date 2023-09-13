<?php
use yii\helpers\Url;
?>
<div class="row d-flex justify-content-center">
    <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
        <div class="card-ego-box">
            <div class="card-ego">
                <div class="card-ego-img">
                    <figure data-aspect-ratio="1:1">
                        <img src="<?= Url::toRoute('/images/logo/' . $classData->logo); ?>" title="<?= $classData->description; ?>" alt="<?= $classData->description; ?>">
                    </figure>
                </div>
                <div class="card-ego-desc">
                    <h3><?= $classData->name; ?></h3>
                </div>
                <div class="card-ego-action">
                    <a class="btn btn-mjk" href="<?= Url::toRoute('/student/test'); ?>" title="">PILIH</a>
                </div>
            </div>
        </div>
    </div>
</div>