<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Card $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $items = \app\models\Binding::find()
        ->select(['name'])
        ->indexBy('id')
        ->column();
    $item = \app\models\ConditionBook::find()
        ->select(['condition_name'])
        ->indexBy('id')
        ->column();
    ?>



    <?= $form->field($model, 'binding_id')->dropDownList($items) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sharing_status')->radioList([ 'share' => 'Готов поделиться', 'unshare' => 'Хочу в свою библиотеку' ], ['separator' => '<br>'])->label(false) ?>

    <?= $form->field($model, 'publishing_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'condition_id')->dropDownList($item)?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
