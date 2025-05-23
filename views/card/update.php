<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Card $model */

$this->title = 'Update Card: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updform', [
        'model' => $model,
    ]) ?>

</div>
