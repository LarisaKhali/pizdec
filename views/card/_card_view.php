<?php

/** @var app\models\Card $model */

use yii\helpers\Html;

?>

<div class="card <?= $model->is_archive == 1 ? 'text-bg-warning' : 'text-bg-secondary' ?>">
    <div class="card-body">
        <h5 class="card-title"><?= $model->name ?></h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><?= $model->author ?></li>
        <li class="list-group-item"><?= $model->getShare() ?></li>
        <li class="list-group-item">Статус публикации: <?= $model->getPublish() ?></li>
        <li class="list-group-item"><?= $model->getArchive() ?></li>
    </ul>
    <div class="card-body">
        <?php if (in_array($model->is_published, [1])): ?>
        <?= Html::a('Оставить отзыв', ['review/create', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?php endif; ?>
    </div>
</div>